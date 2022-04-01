# MKBLOG

###### CMS Boilerplate 

## Installation

### Clone Repo

```bash
git clone https://github.com/manusiakemos/mkblog.git yourblogname
```

### Run Command

```bash
cd yourblogname

composer i

cp .env.example .env
#configure .env variables

php artisan key:generate

npm i

npm run prod 
#or npm run dev for development

php artisan migrate

php artisan storage:link

php artisan db:seed

touch .htaccess
```



## htaccess cpanel



```bash
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /

  # Force SSL
  RewriteCond %{HTTPS} !=on
  RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
  # Remove public folder form URL
  RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```



## Features

- [x] Post
- [x] Kategori Post
- [x] Sliders
- [x] Gallery
- [x] Halaman
- [x] Kontak
- [x] Pengumuman
- [x] Link terkait
- [x] Youtube
- [x] User Management
- [x] Setting
- [ ] Menu Builder