<?php
	
	namespace App;
	
	class GoogleDoc
	{
		// Ссылка на таблицу Google, опубликованную в интернете в формате CSV
		const CSV_DATA_URL = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTq9NB-muDwGVKXnDueeWs8aIg--kY-5QLOUNDcfEzSUZ339SvpZ4hRtPjBDHSSN_7QNF6kd2vqjjYL/pub?gid=0&single=true&output=csv';
		
		/**
		* Получить массив данных из Google таблицы
		*
		* @return array
		*/
		public function get(): array
		{
			$csvDataHandle = fopen(self::CSV_DATA_URL, 'r');
			
			$tableData = [];
			$firstLine = true; 
			while(false !== ($line = fgetcsv($csvDataHandle, null,','))){
				
				// Пропускаем первую строку в таблице с названиями столбцов
				if($firstLine){
					$firstLine = false;
					continue;
				}
				
				// Приводим массим к нужному нам виду
				$tableData[] = [
					'item' => $line[0], 
					'price' => $line[1], 
					'date' => $line[2]
				];
			}
			
			 fclose($csvDataHandle);
			 
			 return $tableData;
		}
	}