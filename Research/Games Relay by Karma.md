# Games Relay (2013-2014 Version)

#### What is it used for?
Games Relay facilitates easier game server requests. Roblox has used it since 2012-2013.
You can use it to stop games, get server stats (such as how many RCC instances are running), evict players, execute scripts, renew job lifetime, and of course, request games.

#### Requirements
- A web server
- RCCService (any version, even 2008)
- Arbiter (Roblox's version, not a custom one)

#### Let's begin!
Every 5 seconds (or as configured in `Roblox.Games.Relay.exe.config`), Relay requests a dispatch from url:  
`{Settings.Default.GameServiceUrl}/v1.0/GetDispatch?apiKey={Settings.Default.GamesRelayApiKey}`  
This endpoint returns a JSON response:
```JSON
{
    "data": {
        "GameId": "{GUID JOB ID}",
        "ExpirationInSeconds": 120,
        "ScriptName": "GameServer script execution",
        "Script": "local a, b = ... print(a + b)",
        "Arguments": [1, 5]
    }
}
```
Games Relay executes this script and then requests dispatch again. Pretty simple, isn't it?

#### Additional endpoints
There are also additional HTTP endpoints. To access them, use Relay url (configurable in `Roblox.Games.Relay.exe.config`). My url is:  
`http://192.168.1.138:7720/{endpoint}`

##### /GetStats (GET)
Returns server statistics.
```JSON
{
    "AvailablePhysicalMemoryGigabytes": 24.8012543,
    "CpuUsage": 1.74569511,
    "DownloadSpeedKilobytesPerSecond": 0.522460938,
    "GamesRelayVersion": "1.0.5380.27393",
    "LogicalProcessorCount": 24,
    "ProcessorCount": 12,
    "RccServiceProcesses": 0,
    "RccVersion": null,
    "TotalPhysicalMemoryGigabytes": 31.8447075,
    "UploadSpeedKilobytesPerSecond": 1.19726563
}
```

##### /StopGame (POST)
Stops a game.  
Request body:
```JSON
{
    "gameId": "{GUID JOB ID}"
}
```

##### /EvictPlayers (POST)
Evict players.
Request body:
```JSON
{
    "gameId": "{GUID JOB ID}",
    "playerIds" : [1, 69, 128],
    "script": "figure out yourself, nerd"
}
```

##### /ExecuteScript (POST)
Execute script to a game instance.
Request body:
```JSON
{
    "gameId": "{GUID JOB ID}",
    "scriptName": "{Script name}",
    "arguments": [1, 5, 2],
    "script": "local a, b, c = ... print(a + b + c)"
}
```
##### /RenewLease (POST)
Renew job lifetime.
Request body:
```JSON
{
    "gameId": "{GUID JOB ID}",
    "expirationInSeconds": 120,
}
```

#### Credits
 - la (if you ever read this, thank you)

Written by Karma.
P.S: Reuploading. Honestly, I don't give a fuck if y'all hate me or something. I'm doing this guide because I still hope that ORC is not a place where, no matter how many things you leaked or published, if you said one wrong word, everyone will cancel you.