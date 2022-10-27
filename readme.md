# Máriás Zsigmond gyakorlata

Péntekenként 8.00-10.00 között tartott Szerveroldali webprogramozás gyakorlat.

## 1. gyakorlat

Vanilla PHP.

## Blog telepítése

- Klónozás githubról
  - git clone git@github.com:mrzshun/gyakorlat-2022-23-01.git
- composer.json-ban előírt PHP-s csomagok telepítése
  - composer install
  - a blog könyvtárban, ahol a laraveles appunk van
- Környezet beállítása
  - .env fájl létrehozása, tartalmába a .env.example átmásolása
  - kulcsgenerálás: php artisan key:generate
- frontend telepítése
  - npm i
  - npm i -D @fortawesome/fontawesome-free
  - npm run dev -- build
- Migráció futtatása
  - php artisan migrate
  - létrehozza az adatbázist is,
  - ne futtassunk migrate:fresh-t, mert az megpróbálja eldobni a létező táblákat, pedig azok még nem léteznek!
- Seedelés (ha akarjuk)
  - php artisan db:seed
