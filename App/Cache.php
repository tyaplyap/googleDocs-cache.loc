<?php
	
	namespace App;
	
	/**
	* Класс кеширования данных частично соответствует стандарту PSR-16
	*
	*/
	class Cache
	{
		// формат пути к кеш-файлу
		const FILE_PATH_FORMAT = 'cache/%s.txt';
		
		/**
		* Кешируем данные из Google таблицы в файл
		*
		* @var string $key - ключ (имя файла), под которым данные кешируются в файл
		* @var array - массив для записи в файл
		* @var string | null - метка времени, сколько хранить данные в кеше
		* @eturn bool 
		*/
		public function set(string $key, $value, $ttl = null): bool
		{
			$cacheFilename = $this->getFilename($key);
			
			$serialized = serialize($value);
			$result = file_put_contents($cacheFilename, $serialized);
			
			return $result !== false ? true : false;
		}
		
		/**
		* Получить данные из файла по ключу (имени файла)
		*
		* @var string $key - ключ (имя файла), под которым данные кешируются в файл
		* @var $default null - значение, возвращаемое по умолчанию, если не удалось получить данные
		*/
		public function get(string $key, $default = null): ?array
		{
			$cacheFilename = $this->getFilename($key);
			
			if(!file_exists($cacheFilename)){
				return $default;
			}
			
			$serialized = file_get_contents($cacheFilename);
			
			return unserialize($serialized);
		}
		
		/**
		* Удалить кеш-файл
		*
		* @var string $key - ключ (имя файла), под которому определяются данные к удалению
		* @return bool
		*/
		public function delete(string $key): bool
		{
			$cacheFilename = $this->getFilename($key);
			
			if(!file_exists($cacheFilename)){
				return true;
			}
			
			return unlink($cacheFilename);
		}
		
		/**
		* Проверяет есть ли файл
		*
		* @var string $key - ключ (имя файла)
		* @return bool
		*/
		public function has(string $key): bool
		{
			$cacheFilename = $this->getFilename($key);
			
			return file_exists($cacheFilename);
		}
		
		/**
		* Получаем полный путь к файлу по формату, подставляя название файла
		*
		* @var string $key - ключ (имя файла)
		* @return string полный путь к файлу
		*/
		private function getFilename(string $key): string
		{
			return sprintf(self::FILE_PATH_FORMAT, $key);
		}
	}