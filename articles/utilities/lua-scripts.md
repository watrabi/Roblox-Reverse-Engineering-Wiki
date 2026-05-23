# Useful Lua Scripts

## FixAssetLinks.lua

*Credits: Atomic (author, 2020)*

Converts old asset links to new asset delivery URLs:

```lua
--Author: Atomic
--Date: 9/22/2020
--Due to a Roblox update, asset links (http://roblox.com/asset?id=) don't work because Roblox is using a different link for assets now. 2020 Roblox can automatically change the link to the new asset link, but not old clients.  
--This script can look through a game to change asset links to what Roblox uses now. (https://assetdelivery.roblox.com/v1/asset?id=)
--It does not change scripts! Only properties of objects that ask for an asset link, like decals, sounds, and tools.

--Make sure to backup your place in case something goes wrong, or you need to revert changes!

local assetPropertyNames = {"Texture", "TextureId", "SoundId", "MeshId", "SkyboxUp", "SkyboxLf", "SkyboxBk", "SkyboxRt", "SkyboxFt", "SkyboxDn", "PantsTemplate", "ShirtTemplate", "Graphic", "Image", "LinkedSource", "AnimationId"}
local variations = {"http://www%.roblox%.com/asset/%?id=", "http://www%.roblox%.com/asset%?id=", "http://%.roblox%.com/asset/%?id=", "http://%.roblox%.com/asset%?id="}

function GetDescendants(o)
    local allObjects = {}
    function FindChildren(Object)
       for _,v in pairs(Object:GetChildren()) do
            table.insert(allObjects,v)
            FindChildren(v)
        end
    end
    FindChildren(o)
    return allObjects
end

local replacedProperties = 0--Amount of properties changed

for i, v in pairs(GetDescendants(game)) do
	for _, property in pairs(assetPropertyNames) do
		pcall(function()
			if v[property] and not v:FindFirstChild(property) then
				assetText = string.lower(v[property])
				for _, variation in pairs(variations) do
					v[property], matches = string.gsub(assetText, variation, "http://2.lf45p.pw/asset?id=")
					if matches > 0 then
						replacedProperties = replacedProperties + 1
						print("Replaced " .. property .. " asset link for " .. v.Name)
						break
					end
				end
			end
		end)
	end
end

print("DONE! Replaced " .. replacedProperties .. " properties")
```

[Download FixAssetLinks.lua](Resources/FixAssetLinks.lua)

## Play_Solo.lua

Creates a local player and runs the game:

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

[Download Play_Solo.lua](Resources/Play_Solo.lua)
