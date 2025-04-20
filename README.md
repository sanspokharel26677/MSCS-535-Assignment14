# 🔐 Secure Login App – JavaScript + PHP + MySQL

This is a secure login system built using **JavaScript (frontend)**, **PHP (backend)**, and **MySQL (database)**. It demonstrates best practices in web security, including input validation, password hashing, and SQL injection prevention.

---

## 📦 Project Structure

```
secure-login-app/
├── index.html               → Login page with Bootstrap styling
├── login.php                → Secure backend login logic using PHP
├── js/
│   └── validate.js          → JavaScript for client-side input validation
└── assets/css/
    └── style.css            → Optional custom styles
```

---

## 🚀 Features

- ✅ Bootstrap 5 responsive UI
- ✅ Client-side input validation
- ✅ Secure database connection via PDO
- ✅ Passwords hashed using `password_hash()` and verified with `password_verify()`
- ✅ SQL Injection protection via prepared statements
- ✅ XSS protection using `htmlspecialchars()` during input/output

---

## ⚙️ Prerequisites

Make sure the following are installed:

- [PHP](https://www.php.net/downloads.php)
- [MySQL](https://dev.mysql.com/downloads/)
- [Homebrew (Mac)](https://brew.sh) *(for installing PHP/MySQL on macOS)*
- A terminal and a browser

---

## 🖥️ How to Run This Project (Mac/Linux/Windows WSL)

1. **Clone or extract this project to a folder:**
   ```bash
   cd ~/Documents/
   mkdir secure-login-app
   ```

2. **Start PHP server:**
   ```bash
   cd secure-login-app
   php -S localhost:8000
   ```

3. **Visit in browser:**
   ```
   http://localhost:8000/index.html
   ```

---

## 🛠️ How to Set Up the MySQL Database

1. Open terminal and log in to MySQL:
   ```bash
   mysql -u root -p
   ```

2. Create the database and table:
   ```sql
   CREATE DATABASE secure_login_db;
   USE secure_login_db;

   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(100) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL
   );
   ```

3. Create a hashed password:
   ```bash
   php -a
   ```

   Inside PHP shell:
   ```php
   echo password_hash("test1234", PASSWORD_DEFAULT);
   ```

4. Insert a test user:
   ```sql
   INSERT INTO users (username, password) VALUES (
     'admin',
     '<<PASTE_HASH_HERE>>'
   );
   ```

---

## 🔐 Edge Case Testing (Optional)

To test against XSS:
- Insert a user with a username like `<script>alert("XSS")</script>`
- Log in using that exact string as both username and password
- Confirm that it does **not execute**, but displays as plain text

---

## 🧾 Credits

Created by Sandesh Pokharel  
Secure Software Development (MSCS-535)

---

## 📸 Screenshots

> Please see report `MSCS-535-Assignment14.pdf` for screenshots and analysis.