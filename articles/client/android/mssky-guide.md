# Mobile Patching Guide — mssky 2024

*Credits: mssky (author)*

## Android

1. Decompile APK with apktool (or APKTool M on mobile)
2. Open decompiled folder in text editor
3. Ctrl+Shift+F → replace roblox.com → your domain
4. Compile with APKTool M
5. Can also change package name

## iOS

1. Rename .ipa → .zip
2. Unzip
3. Open in text editor
4. Replace all roblox.com → your domain
5. Zip back up, rename .zip → .ipa
6. Sideload

## Required Endpoints

- `idkwhatsubdomain.urdomain/device/initialize` → returns `{"browserTrackerId":0,"appDeviceIdentifier":null}`
- `urdomain/login/v1`
- `urdomain/sign-up/v1` or `/signup/v1`
