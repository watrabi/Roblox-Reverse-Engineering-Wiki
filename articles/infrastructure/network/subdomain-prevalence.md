# Subdomain Prevalence Across Client Binaries

*Description: Cross-reference of known Roblox subdomains against client binaries from 2016, 2018, and 2020E*
*Credits: daniel176 (strings analysis), DrWalty/Ranged222/WaltherSan23 (subdomain enumeration)*

The subdomain list from [Ranged222's enumeration](https://github.com/Ranged222/Actual-accurate-list-of-roblox-subdomains-19k-) (1983 entries, 2026-05-05) was searched across four client binaries using `strings` to determine which subdomains appear in each build.

## Results

| Subdomain | 2016 Player | 2018 Player | 2020E Player | 2020E Studio |
|-----------|:-----------:|:-----------:|:------------:|:------------:|
| `www.roblox.com` | ✓ | ✓ | ✓ | ✓ |
| `assetgame.roblox.com` | ✓ | ✓ | | ✓ |
| `assetdelivery.roblox.com` | | | | ✓ |
| `api.roblox.com` | ✓ | | | |
| `devforum.roblox.com` | | ✓ | | ✓ |
| `developer.roblox.com` | | | | ✓ |
| `chat.roblox.com` | | | | ✓ |
| `presence.roblox.com` | | | | ✓ |
| `en.help.roblox.com` | | | | ✓ |
| `c0ak.rbxcdn.com` | | | | ✓ |
| `c0cfly.rbxcdn.com` | | | | ✓ |
| `assetdelivery.roblox.qq.com` | | | | ✓ |
| `assetgame.roblox.qq.com` | | | | ✓ |
| `www.roblox.qq.com` | | | | ✓ |

**Total matches from list:** 14 unique subdomains

## Additional Subdomains Not in Ranged222 List

These subdomains were found in the binaries but are absent from the 1983-entry enumeration:

| Subdomain | 2016 Player | 2018 Player | 2020E Player | 2020E Studio |
|-----------|:-----------:|:-----------:|:------------:|:------------:|
| `test.public.ecs.roblox.com` | ✓ | ✓ | | ✓ |
| `clientsettings.api.roblox.com` | ✓¹ | ✓¹ | ✓² | ✓ |
| `upload.crashes.rbxinfra.com` | | | | ✓ |
| `c0hw.rbxcdn.com` | | | | ✓ |
| `c0ll.rbxcdn.com` | | | | ✓ |
| `rbxcdn.qq.com` | | | | ✓ |
| `roblox.sp.backtrace.io` | | ✓ | | |

¹ `clientsettings` / `FetchClientSettingsData` strings present but domain may be runtime-constructed
² VMProtect-obscured; endpoint known from other builds

## Key Observations

- The 2020E **Studio** binary has the most embedded subdomains (13 matches), as it is not VMProtect-packed.
- The 2020E **Player** binary is VMProtect-packed and only retains `www.roblox.com` in plain text.
- The 2016 and 2018 Player binaries were domain-patched to `r1blox.xyz`; their subdomains were recovered by mapping back to `roblox.com`.
- 7 additional subdomains found in the binaries are missing from the public enumeration, including infrastructure endpoints like `test.public.ecs.roblox.com` and `upload.crashes.rbxinfra.com`.
