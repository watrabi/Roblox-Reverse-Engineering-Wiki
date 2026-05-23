# Useful Lua Scripts

## FixAssetLinks.lua

*Credits: Atomic (author, 2020)*

Converts old asset links to new asset delivery URLs:

```lua
local assetPropertyNames = {"Texture", "TextureId", "SoundId", "MeshId", "SkyboxUp", "SkyboxLf", "SkyboxBk", "SkyboxRt", "SkyboxFt", "SkyboxDn", "PantsTemplate", "ShirtTemplate", "Graphic", "Image", "LinkedSource", "AnimationId"}

-- Iterates all descendants, replaces roblox.com/asset links with assetdelivery URLs
-- Make sure to backup your place before running!
```

## Play_Solo.lua

Creates a local player and runs the game solo:

```lua
game:getService("Players"):CreateLocalPlayer(0);
game:service("RunService"):run();
game.Players.Player:LoadCharacter();
game.Players.Player:SetSuperSafeChat(false);
function onDied(humanoid)
  wait(5);
  game.Players.Player:LoadCharacter(0);
end
game.Players.Player.Character.Humanoid.Died:connect(onDied);
```
