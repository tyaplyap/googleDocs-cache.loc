<?php
	
	namespace App;
	
	/**
	* Через класс Provider управляем данымииз таблицы и кеша
	*
	*/
	class Provider
	{
		private GoogleDoc $googleDoc;
		
		private Cache $cache;
		
		public function __construct(GoogleDoc $googleDoc, Cache $cache)
		{
			$this->googleDoc = $googleDoc;
			$this->cache = $cache;
		}
		
		/**
		* Получаем массив данных из кеша, если есть файл или из таблицы
		*
		* @var string $key - ключ (имя файла), под которым данные кешируются в файл
		* @return array|null
		*/
		public function get(string $key): ?array
		{
			if($this->cache->has($key)){
				return $this->cache->get($key);
			}
			
			$data = $this->googleDoc->get();
			$this->cache->set($key, $data);
			
			return $data;
		}
		
		/**
		* Удаляем кеш
		*
		* @var string $key - ключ (имя файла), под которым данные кешируются в файл
		* @return bool
		*/
		public function deleteCache(string $key): bool
		{
			return $this->cache->delete($key);
		}
	}