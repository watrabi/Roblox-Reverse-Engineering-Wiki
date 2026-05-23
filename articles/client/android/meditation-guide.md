# Meditation's Mobile Patching Guide

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
