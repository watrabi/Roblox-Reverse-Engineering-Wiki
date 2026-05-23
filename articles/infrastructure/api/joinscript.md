# Join Scripts

*Credits: lrre.wiki (original documentation), ORC guide server community, SomeoneInTheWorld (SavePlaceRemove)*

Joinscripts are used to make a client connect to a gameserver.

## Lua Join Script

TODO

## JSON Join Script (2016+)

In 2016, Roblox elected to use JSON join scripts rather than the legacy Lua joinscript.

Example JSON:
```json
{"ClientPort":0,"MachineAddress":"127.0.0.1","ServerPort":25564,...}
```

### Properties

| Property | Description |
|----------|-------------|
| UserName | Username of connecting player |
| CharacterAppearance | Character appearance URL |
| CharacterAppearanceId | Character appearance ID |
| ServerPort | Server port |
| ClientPort | Source port (0 = random) |
| MachineAddress | Server IP |
| BaseUrl | Base URL of the game |
| CreatorTypeEnum | User or Group |
| MembershipType | None, BuildersClub, TurboBuildersClub, OutrageousBuildersClub |
| ClientTicket | Client authentication ticket |
| SuperSafeChat | Whether Super Safe Chat is enabled |
