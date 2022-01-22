<?php

declare(strict_types=1);

namespace minijaham\ChatRange;

use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;

use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener
{
	private Config $config;
	
	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveResource("config.yml");
		$this->config = (new Config($this->getDataFolder() . "config.yml", Config::YAML));
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		switch (strtolower($command->getName())) {
			# Credit to ErikPDev for this code
			case "sudo":
			if (count($args) < 2) {
				$sender->sendMessage('Usage: /sudo <player> <message>');
				$sender->sendMessage('If you wish to execute a command, add "/" in front of the message argument.');
				return true;
			}
			$player = $this->getServer()->getPlayerExact(array_shift($args));
			if ($player instanceof Player) {
				$player->chat(trim(implode(" ", $args)));
				return true;
			}
			$sender->sendMessage("Player not found");
		}
		return true;
	}
	
	public function onChat(PlayerChatEvent $event) {
		$player     = $event->getPlayer();
		$recipients = [(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage())), $player];
		
		$range      = $this->config->get("range");
		$entities   = $player->getWorld()->getNearbyEntities($player->getBoundingBox()->expandedCopy($range, 255, $range), $player);
		foreach ($entities as $entity) {
			if ($entity instanceof Player) {
				array_push($recipients, $entity);
			}
		}
		if ($this->config->get("send-to-op") == true) {
			foreach ($this->getServer()->getOnlinePlayers() as $p) {
				if ($this->getServer()->isOp($p->getName())) {
					if (in_array($p, $recipients)) # Check if the OP player is already in the array
						continue;
					array_push($recipients, $p);
				}
			}
		}
		$event->setRecipients($recipients);
	}
}
