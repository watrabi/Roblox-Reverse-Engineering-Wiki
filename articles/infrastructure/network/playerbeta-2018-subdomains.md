# 2018 RobloxPlayerBeta Subdomains

*Description: Subdomains found in the 2018 RobloxPlayerBeta.exe via strings analysis*
*Credits: daniel176 (strings analysis)*

The following subdomains were extracted from `/Middleware/2018/Player/RobloxPlayerBeta.exe` (≈28.7 MB) using `strings`.

## Subdomains

| Domain | Purpose |
|--------|---------|
| `www.roblox.com` | Main website |
| `assetgame.roblox.com` | Asset/game server |
| `devforum.roblox.com` | Developer Forum |
| `clientsettings.api.roblox.com` | Client settings / FFlags delivery |
| `test.public.ecs.roblox.com` | Test Elastic Compute Service endpoint |

### Runtime-Constructed (partial strings)

| Pattern | Likely Full Domain |
|---------|-------------------|
| `setup` | `setup.roblox.com` |

## Third-Party Services

| Domain | Purpose |
|--------|---------|
| `roblox.sp.backtrace.io:8443` | Backtrace crash reporting (minidump upload with token) |

## Referenced Paths

| Path | Full URL |
|------|----------|
| `/roblox.xsd` | `www.roblox.com/roblox.xsd` |
| `/drivers` | `www.roblox.com/drivers` |
| `/robloxStartedEvent` | `www.roblox.com/robloxStartedEvent` |

## Build Info

| Attribute | Value |
|-----------|-------|
| Size | ≈28.7 MB |

## Notes

- Unlike the 2020E PlayerBeta, this binary is **not VMProtect-packed**.
- Backtrace (`roblox.sp.backtrace.io:8443`) is used for crash report collection with a hardcoded token.
- The `devforum` subdomain appears in a deprecation warning about `Chat:FilterStringAsync`.
