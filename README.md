# Рационы питания

Проект, выполенный для [тестового задания](https://github.com/privatecrm/back-task).

## Запуск проекта
### Склонировать репозиторий:
```
git clone git@github.com:davydovks/rations.git
cd rations
```
### Создать в MySQL базу данных:
```
sudo service mysql start
sudo mysql
```
Внутри MySQL вводим:
```
CREATE DATABASE rations;
CREATE USER 'rationsuser'@'localhost' IDENTIFIED WITH mysql_native_password BY 'myPassword';
GRANT ALL PRIVILEGES ON rations.* TO 'rationsuser'@'localhost';
exit;
```
### Установить зависимости:
```
make setup
```
### Локальный запуск приложения:
```
make start-frontend
make start
```
