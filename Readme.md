### Установка

Обновите hosts файл
```shell script
127.0.0.1 time.web
```

В папке с проектом запустите композер
```shell script
composer install
```

После поднятия докера, в контейнере с бд создайте базу данных, пользователя для него и наделите его правами

Все логины/пароли: ```timeweb```

```sql
create database timeweb;
CREATE USER 'timeweb'@localhost IDENTIFIED BY 'timeweb';
GRANT ALL PRIVILEGES ON timeweb.* TO 'timeweb';
```

В папке dump находиться дамп таблиц для бд

### Запуск приложения
Adminer доступен по адресу
```shell script
http://time.web:8080
```

Сам сайт
```shell script
http://time.web:80
```

