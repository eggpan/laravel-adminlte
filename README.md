## About
AdminLTE を利用した管理画面のサンプル

## Usage
```
git clone git@github.com:eggpan/laravel-adminlte.git
cd laravel-adminlte
cp .env.local .env
find storage/* -type d | xargs chmod o+w
chmod o+w bootstrap/cache
docker-compose up -d
docker exec -ti --user $UID web composer install
docker exec -ti --user $UID web ./artisan migrate --seed
```
