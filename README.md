## ChatRange
[![](https://poggit.pmmp.io/shield.state/ChatRange)](https://poggit.pmmp.io/p/ChatRange)

거리 채팅이 가능하게 만드는 플러그인.

# Developer Tool
| 커맨드 | 설명                   | 사용법                   | 예시                  | 권한 |
| ------- | ----------------------------- | ----------------------- | ------------------------ | ----------- |
| /sudo   | 다른 플래이어로 채팅이나 커맨드를 입력합니다 | /sudo <플레이어> <메시지> | /sudo PlayerName 채딩과 커맨드에 스페이스가 있어도 됩니다 | command.sudo |

# 크래딧
[ErikPDev](https://github.com/ErikPDev)

# 콘피그
```yaml
# 챗을 볼 수 있는 블럭 수 (integer)
range: 50
# chat.receive 권한이 있는 사람에게는 거리에 상관없이 무조건 보이게 하기 (true/false)
send-to-op: true
```

# 권한
| 권한 | 설명                |
| ------- | ----------------------------- |
| chat.receive | 거리를 무시하고 챗을 볼 수 있게 합니다 |
