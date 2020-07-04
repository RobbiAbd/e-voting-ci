# E-Voting - Robbi Abdul Rohman

Introduction
------------

Aplikasi E-voting di buat dengan PHP Framework Codeigniter 4 dan Bootstrap.

Fitur
--------

- Crud Kandidat
- Crud User
- Crud Token
- dll

Requirements
--------

- php 7.2 keatas
- composer

##Setup
*1.* Clone repo

```bash
git clone https://github.com/RobbiAbd/e-voting-ci.git
```

*2.* Buka project dan jalankan composer install
```bash
composer install
```

*3.* import database

*4.* set .env

Buat/buka file .env di root project dan set `CI_ENVIRONMENT`, `app.baseURL`, `app.indexPage`,  `database`:

```bash
# file .env
CI_ENVIRONMENT = development

app.baseURL    = 'http://localhost:8080'

app.indexPage  = ''

database.default.hostname = localhost
database.default.database = e-voting
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

*4.* Jalankan Development server

```php
cd nama-project

php spark serve
```

*5.* Open web browser http://localhost:8080

Admin akun
--------
email : admin@gmail.com
pass  : admin


Petugas akun
--------
email : petugas@gmail.com
pass  : petugas
