# Compiling robloxsrc.zip (Client, Studio, RCC)

*Credits: simple the dimple (author), hadi (compilation help, security patch), Crypt (protip)*

## Requirements

- Source code (ogrobloxsrc.zip or robloxsrc.zip)
- Contrib libraries (boost_1_56_0, etc.)
- VS 2012 build tools
- VS 2019/2022 (to open and edit)
- Mesa (for RCC)
- DirectX 9

## Setup

1. Create `C:\Trunk2012\Build` and `C:\Trunk2012\Contribs`
2. Export contribs to `C:\Trunk2012\Contribs`
3. Set system variable `CONTRIB_PATH = C:\Trunk2012\Contribs`
4. Open `Client_2012.sln` in VS 2019/2022
5. Change all to v110 toolchain
6. Disable "treat warnings as errors"
7. Build in Release (Client), ReleaseRCC (RCC), ReleaseStudio (Studio)

## RCC Specific

1. Extract Mesa to `C:/Trunk2012/Build/RCCService`
2. Fix library dirs: `$(VCInstallDir)lib;$(VCInstallDir)atlmfc\lib;$(WindowsSDK_LibraryPath_x86);$(CONTRIB_PATH)\boost_1_56_0\lib;`
3. Copy zlib files from 3rd party to Graphics3D zlib filter
4. Delete deflate.cpp lines 54-55
5. Build ReleaseRCC config

## Security Fix

Patch buffer overflow in signature checking:

```cpp
// Find: for (int i=0; i<signatureLen; ++i)
// Replace: for (int i=0; i<signatureLen && i<=10240; ++i)
```
