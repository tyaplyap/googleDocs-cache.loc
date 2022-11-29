# Получение и кеширование данных Google таблиц

Получаем данные с Google таблицы, кешируем их в файле. Обновляем данные в кеше по необходимости. Приложение написано широкими мазками, на получении данных всего из одной таблицы. Доделаю, если будет понятен практический смысл. **Основая идея - это работа с Google таблицами и кеширване данных.**

Точка входа - `index.php`. Загружаются данные либо из кеша, если он есть, либо из таблицы. 

`class GoogleDoc`  - отвечает за получение данных с таблицы. 
`class Cache` - работает с кешем, записывает, возвращает, удаляет. 
`class Provider` - управляет работой объектов классов GoogleDoc и Cache, определяет когда данные нужно получать из кеша, когда из таблицы и т.д. 

Для проектировария класса Cache частично применялся [psr-16](https://www.php-fig.org/psr/psr-16/).
