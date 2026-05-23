# ARC's Noob-Friendly Mobile Guide

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
