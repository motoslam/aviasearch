## Поиск аэропорта по части названия

При установке необходимо выполнить миграции и загрузить начальные данные:

`
php artisan migrate --seed
`

GET запрос на `/api/airports` должен содержать параметры:

* query* - часть названия аэропорта, строка >= 2 символов
* limit - количество результатов в ответе
