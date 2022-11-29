<?php
	
	namespace App;
	
	class View
	{
		public function renderHtml(array $vars = [])
		{
			extract($vars);
			
			ob_start();
			include __DIR__ .'/../template/main.php';
			$buffer = ob_get_clean();
			
			echo $buffer;
		}
	}