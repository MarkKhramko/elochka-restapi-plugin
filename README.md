# Установка 

## 1

Скопировать репозиторий в папку плагинов

`cd <wordpress_root>/wp-content/plugins/`

`git clone https://github.com/MarkKhramko/elochka-restapi-plugin elochka-rest`

## 2 

Активировать Плагин `Elochka REST` в `/wp-admin` (Плагины -> Установленные -> Elochka REST -> Активировать)

### API Routes

К роутам можно обращаться по схеме: `<HOSTNAME>/wp-json/v1/<ROUTE>`


Доступные роуты:

* `orders`