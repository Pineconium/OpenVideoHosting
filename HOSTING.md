# How to host a *Open* site
NOTE: This tutorial was originally designed for server computers running Linux and are being hosted via Apache. Depending on what you're going to use to host Open, you may need to do different things to get it to work.

## 1. Hardware
To start running an Open-powered video hosting site, you'll need the following:
1. Any Server Computer with these minimum specs.
    - Storage: At least 1 hard drive with at least 1 TB of disk space.
    - RAM: 8 GB
    - Operating System: Any OS designed for server use.
    - Networking: Ethernet or (if possible) Wireless.
2. Any Client Computer. (This will be used to control the server computer).
3. Any software for the following purposes:
    - Website Server Hosting (such as Apache).
    - PHP support.
    - SSH or Remote Desktop (depending on your OS for the client and server computers).
    - Website Database (usually in SQL).
    - Any text editing program (like Nano, Vim, or VSCode).
    - And Website Security provider.
4. A registered domain (if you want your site to be public).
## 2. How to Start
First, ensure both your server and client computers are on, and then log in to your server computer as root via your client PC. Make sure you have the `source.zip` folder on your client PC and extract it. You'll need to send all of the contents of the zip folder to your server PC and then move the contents to your server's hosting directory (such as `/var/www/html` if you're using Apache on Linux). Once you have everything moved to your server computer, ensure you can access it with a localhost IP (which is any IP address starting with 192.168.0.*xx*).

## 3. Making your SQL tables.
First, create an SQL database, you can call it whatever you want. Now add these 2 tables to it, `users`, `comments`, `likes`, and `videos`, as well as their respective columns. Here is the cheatsheet for you:
```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    trn_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    backgroundpath VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    profilepicturepath VARCHAR(255)
);
CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    filepath VARCHAR(255) NOT NULL,
    thumbnailpath VARCHAR(255) NOT NULL,
    creationdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    views INT DEFAULT 0,
    vidlength INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video_id INT NOT NULL,
    user_id INT NOT NULL,
    type ENUM('like', 'dislike') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (video_id) REFERENCES videos(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```
You'll also need to replace the placeholder fields in `db.php` to match the database's information. Once that is done, try going to the page and registering an account. If you can successfully access the main page and be logged in, then you are nearly ready to start hosting your own Open! If you can't, or can only access one part with little to no problems, check on both your SQL database as well as `db.php`.
