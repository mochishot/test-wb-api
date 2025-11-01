# WB API Data Collector

## Описание
Laravel приложение для сбора данных с Wildberries API

## Установка
1. `composer install`
2. Настроить .env файл с данными БД
3. `php artisan migrate`
4. `php artisan wb:fetch-data`

## Доступы к БД
- Хост: [ваш хост Aiven]
- Порт: [ваш порт Aiven]
- База данных: `defaultdb`
- Пользователь: `avnadmin`
- Пароль: [ваш пароль]

## Структура таблиц
- `stocks` - остатки товаров
- `incomes` - поступления товаров
- `sales` - продажи
- `orders` - заказы

## Команды
- `php artisan wb:fetch-data` - сбор данных с API

## Примечание
API сервер может быть временно недоступен. Stocks данные собираются успешно, другие эндпоинты могут не иметь данных за текущую дату.
