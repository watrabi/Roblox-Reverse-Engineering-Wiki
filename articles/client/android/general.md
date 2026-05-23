# Android Patching Guide

## Meditation's Guide

*Credits: meditation/meditexts*

What you need:
- OpenSSL
- Block games android (can work in 2014-2019, since i got 2014 semi functional too.)
- Brain 🧠 <---
- Some editor.

Alr how to patch:

Use your apk editor (that atleast supports unpacking classes.dex files known as smali.)

Alr go to res > raw > roblox_settings and change base url to yours.

Do same thing for res > strings, because it will not work propely and trust check will happen.

After that use notepad + or some other editor like visual editor (if r'u using android, you can use apk editor to replace the strings in the smali folder)

Go to com > roblox > client and select all and replace the roblox.com to your domain.

### Now for the part of libroblox.so

Use hxd or nmm (android) to change the roblox.com to yours.

Use Openssl and type this command: `openssl -in privatekey.pem -pubout > publickey.rsa`

**IF R'U USING WINDOWS, USE HXD TO DELETE SOME CRLF STUFF BECAUSE IT CAN CAUSE SERIOUS DAMAGE TO YOUR CLIENT**

Go to hxd and open publickey.rsa, then you will need to remove 0D (known as \r), because it is a compilation and system issue that causes this crap.

erm, nerdy stuff 🤓, but: Windows uses xD/xA (\r\n) , meanwhile linux only uses xA (\n).

### Termux users

You can install the openssl, but you will need to get the private key.

Return to libroblox and search "BEGIN PUBLIC KEY". Paste it and done.

If you do correctly, feel happy, cus its useful. And i think that after releasing this guide, roblox and a bunch of underages will skid this guide to make 1 billion revivals with this guide.

idc if its skidded or not, but enjoy playing your recently patched client.

CREDIT ME AFTER USING THIS GUIDE OR RAAAHHHHHHHH 🧟

---

## 2016+ Mobile Guide

*Credits: ORC guide server community*

- hex editor
- apk decompiler
- text editor

1. On smali, replace all roblox url with your url
2. Replace urls in libroblox.so on hex editor
3. Setup your site — add a folder called device and put the needed files there

For 2014/2015 you need to replace all urls in smali and in libroblox but you need to change urls in roblox settings located in a folder in res too.

---

## mssky's Mobile Patch Guide

*Credits: mssky (2024)*

Stuff you need in both iOS and Android: VSCode (or any text editor that can replace strings in every file of the dir).

### Android

You will need apktool, apktool m.

Decompile ur apk with apktool (if u dont have a pc then u still can do allat on mobile 🤫, js use apktool m). Open the decompiled folder in the text editor, click search (ctrl + shift + f), replace roblox.com to urdomain. Move this folder to your android phone, compile with apktool m there. Also you can use it to change package name n stuff.

### iOS

Rename roblox ipa to zip, unzip it, open in the text editor u chose, replace all roblox.com to urdomain. Now put it back into a zip archive, rename ur .zip to .ipa, sideload it, done.

You will also need `idkwhatsubdomain.urdomain/device/initialize`. It returns: `{"browserTrackerId":0,"appDeviceIdentifier":null}`

Login api: `urdomain/login/v1`
Register api: `urdomain/sign-up/v1` (or `urdomain/signup/v1` i dont remember)

---

## ARC's Noob-Friendly Mobile Guide

*Credits: ARC (wallh4ck3rz), for 2014-2021*

How 2 mobile for noobies :D (android since i dont have ios device)

### Requirements

1. Brain (yes its very important because u cant live without it)
2. Hex Editor that is not bad
3. Termux (or pc with linux distro on it. It requires for generating public key and much)
4. Client itself
5. APKTool (or APKTool M if you are mobile)

### Decompiling

1. Grab your client
2. Do this command (linux): `apktool d client.apk` (you have to decompile classes.dex too. if you are on android just press decompile button and pick Decompile classes*.dex cuz its important to patch domains lel)
3. Basically done. Just get in decompiled folder

### Public Key

(Roblox uses MIGf key for old clients like 2014-2017. the MIGf is 1k key. The new is using 2k and its MII. They changed it on 2018 (i think))

1. Get Your Private Key
2. Run this on termux or linux distro: `openssl rsa -in privatekey.pem -pubout -out pubkey.txt`
3. Copy public key this will be required later

### Patching

1. Patch domains on all files like smali. DO NOT TOUCH .SO YET.
   If you are using 2014 you have to check res/raw and theres will be file RobloxSettings (or something like that) it will contain domains, patch them!
2. Check out lib/(architecture)/libroblox.so with your HEX editor.
3. Replace domains and replace the public key that you copied earlier. CHECK IF MII or MIGf HAVE BEGIN PUBLIC KEY
4. Make sure that the end of public keys have 2 dots (i think) if after it has some english chars then u messed up...

### Compiling

After domain and public key patched you have to build it and sign it ofc.

1. Run this: `apktool b clientsrcfolder` (or just build on mobile using aapt)
2. idk how to sign it on linux so think by yourself
3. Congrats u successfully patched mobile!

---

## Android Compiler Guide

*Credits: ORC guide server community*

This is under work, because I'm doing that while I'm trying to compile the android client.

Requirements:
- Android studio version 1.5.0 to 2.2.3
- android ndk version r10e (this specific version)
- bricks game source code
- a brain
- a gud computar

> i'm sad to tell you but I USED CHAT GPT 😭 because i am super dumb doing fixes, but credit ai for 20% of the fix

### Step 1: Brick up the client
You need to download android studio (modern versions doesnt work yuck 🤢) to compile it, also make sure you have your source code.
i hate lazy ppl who wasnt able to touch android src

### Step 2: fix build.grape 🍇
This is crucial because it will display a lot of errors.

Copy this line of code on build.grapes and make sure its on ANDROID FILE OR I WILL KILL YOU 😡😡😡😡😡

```gradle
buildscript {
    repositories {
        mavenCentral()
        maven { url 'https://maven.fabric.io/public' }
    }
    dependencies {
        classpath 'com.android.tools.build:gradle:2.2.3'
        classpath 'io.fabric.tools:gradle:1.25.4'
    }
}
```

If you didnt apply that, well uhhm you will def get a lot of errors related to amazondebug, dont tell me why.

### Step 3: add icon 🚀
"No resource found that matches the given name (at 'icon' with value '@drawable/ic_launcher')."
Idk what roblox was thinking of, but its a terrible idea not putting your icons in every build. To fix that is just simple: just put the god damn icon; that's how.

### Step 4: fix NDK path
Depending which operating system you use to compile the client, just go to /android/nativeshell/build.grapes and find function `runNDKBuild()`. Replace it to your path where's the ndk stored at.

### Step 5: Under construction 🚧
This guide is not complete, also if you reached so far, congrats 🥳, i think you compiled correctly your android client by doing that.

CREDIT ME OR I WILL GET YOU 😠
