# How to host a *Open* site
NOTE: This tutorial was originally designed for server computers running Linux and are being hosted via Apache.

## 1. Hardware
To start running a Open-powered video hosting site, you'll need the following:
1. Any Server Computer with these min. specs.
    - Storage: Atleast 1 hard drive with atleast 1 TB of disk space.
    - RAM: 8 GBs
    - Operating System: Any OS designed for server use.
    - Networking: Ethernet or (if possible) Wireless.
2. Any Client Computer. (This will be used to control the server computer).
3. Any software for these following purposes:
    - Website Server Hosting (such as Apache).
    - PHP support
    - SSH or Remote Desktop (depending on what OS you have for the client and server computers)
    - Website Database (usually in SQL)
    - Any text editing program (like Nano, Vim, or VSCode)
    - And Website Sercuity provider
4. A resigstered domain (if you want your site to be public).
## 2. How to Start
First make sure both your server and client computers are on, and then login to your server computer as root via your client PC. On your client PC, make sure you have the `source.zip` folder and extract it. You'll need to send all of the contents of the zip folder to your server PC and then move the contents to your server's hosting directory (such as `/var/www/html` if you're using Apache on Linux). Once you have everything moved to your server computer, make sure you can access it with a localhost IP (which are IP address starting with 192.168.0.*xx*).
