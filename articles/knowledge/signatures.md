# Cryptographic Signatures

*Credits: lrre.wiki (original documentation)*

Signatures are found in many scripts and files used by Roblox. Introduced in 2009 (v0.13.17.0). Used to verify join scripts, CoreScripts, and authenticate clients.

Uses RSA public-key cryptosystem (1024-bit keys).

- Base64 encoded, surrounded by % signs (e.g., `%AQIDBA==%`)
- Since v0.116 (8/14/2013): must be prepended with `--rbxsig`
- Uses SHA-1 hashing algorithm
- Public key stored as CAPI blob (not PEM), accessible via Microsoft Crypto API
- Newer versions have rbxsig2 and rbxsig4 for backwards compatibility

## Pre-2018 Public Key Blob (Base64)

```
BgIAAACkAABSU0ExAAQAAAEAAQCjbUyx9OXTBcWEAonZOfAoT7YhMS+L21WwAZlsEjvzHXQpulpasNFhC1U6tBX6c8Qey2fiRBXHpqbh7vAC7u2niT6dMLLqY9UzII0jyxKD/EUODcQHTKpbM18FRobqLcvK0DNdIaHwypr7NRnSWk4NXhtM0v40W7/mr35PxbJ8rQ==
```
