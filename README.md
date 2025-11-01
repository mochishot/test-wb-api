# WB API Data Collector

## Описание
Laravel приложение для сбора данных с Wildberries API

## Установка
1. `composer install`
2. Настроить .env файл с данными БД
3. `php artisan migrate`
4. `php artisan wb:fetch-data`

## Доступы к БД
- Хост: `test-testapi-database.f.aivencloud.com`
- Порт: `14442`
- База данных: `defaultdb`
- Пользователь: `employer_access`
- Пароль: приложен текстовым файлом env.txt

## Структура таблиц
- `stocks` - остатки товаров
- `incomes` - поступления товаров
- `sales` - продажи
- `orders` - заказы

## Структура БД
- `stocks` - 150 записей (остатки товаров)
- `incomes` - 0 записей* (поступления)
- `sales` - 0 записей (продажи)
- `orders` - 0 записей (заказы)
* за сегодня данных нет (на 1.11.2025)

## Команды
- `php artisan wb:fetch-data` - сбор данных с API

## Примечание
API сервер может быть временно недоступен. Stocks данные собираются успешно, другие эндпоинты могут не иметь данных за текущую дату.
