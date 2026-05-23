# NetworkServer Instance

*Credits: lrre.wiki (original documentation)*

NetworkServer is an Instance which stores every NetworkReplicator and handles connecting to the server.

- Parent: NetworkPeer
- Introduced: Unknown
- Removed: Most features removed in 2017, yet still exists
- Replicates: No
- Creatable: No

## Methods (all LocalUserSecurity)

| Method | Notes |
|--------|-------|
| int GetClientCount() | Removed 2020-02-07 |
| void SetGameId(string) | Existed only one week in Feb 2014 |
| void Start(int port=0, int threadSleepTime=20) | Removed 2017-10-10 |
| void Stop(int blockDuration=1000) | Removed 2017-10-03 |
| void SetIsPlayerAuthenticationRequired(bool) | Removed 2017-10-03 |

## Properties

| Property | Notes |
|----------|-------|
| int Port | Removed 2020-06-19 |

## Events

| Event | Notes |
|-------|-------|
| IncommingConnection(string peer, Instance replicator) | Removed 2017-10-03 (spelt "Incomming") |
