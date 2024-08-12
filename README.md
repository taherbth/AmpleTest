<p align="center" style="font-size: 18px; font-weight: bold">Link Harvester Apps </p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

----------------------------  SETUP  Instruction ---------------------------------
1. sudo docker system prune -a
2. sudo docker-compose down --remove-orphans
3. sudo docker network create app-network
4. sudo docker-compose up --build -d
5. sudo docker exec -it laravel-db mysql -u taher -p
	THEN inside mysql run : CREATE DATABASE IF NOT EXISTS Link_Harvester;
6. sudo docker exec -it my-laravel-app bash
	THEN move to dir: cd /var/www and run: php artisan migrate:refresh
          AND php artisan db:seed
7. sudo docker exec -it my-laravel-app bash
          THEN run below comands:
 	chmod -R 755 /etc/supervisor/
	chown -R root:root /etc/supervisor/
	supervisord -n -c /etc/supervisor/supervisord.conf

After All above process browse : http://127.0.0.1:8000
To login a default user : admin@test.com , Pass: 123456

Service available in docker: npm, php artisan, git