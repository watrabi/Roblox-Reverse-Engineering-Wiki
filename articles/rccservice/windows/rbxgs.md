# RBXGS (Roblox Game Server)

*Credits: lrre.wiki (original documentation)*

RBXGS (Roblox Game Server) was the predecessor to RCCService and managed rendering and game servers prior to May 2008. It was an IIS plugin that used ATL for Grid. Unlike RCCService, RBXGS calls Jobs "environments." RBXGS also uses ISAPI and can be communicated with using Apache.

## Installing on Windows Server 2003

- Requires .NET Framework 2.0
- Requires IIS 4.0
- Installs to the RBXGS directory on the IIS web server

## SOAP Commands

| Command | Description |
|---------|-------------|
| roblox:Execute | Executes a script on an environment, returns result |
| roblox:OpenEnvironment | Opens a new environment, returns environment ID |
| roblox:GetAllEnvironments | Returns all running environments |
| roblox:CloseEnvironment | Closes an environment by ID |
