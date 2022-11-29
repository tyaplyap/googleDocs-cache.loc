<?php

	error_reporting(E_ALL);
	
	require_once __DIR__ . '/App/GoogleDoc.php';
	require_once __DIR__ . '/App/Cache.php';
	require_once __DIR__ . '/App/Provider.php';
	require_once __DIR__ . '/App/View.php';
	
	$action = $_GET['action']?? '';
	
	// Через класс Provider управляем источниками данных: таблица, кеш
	$provider = new \App\Provider(
		new \App\GoogleDoc(),
		new \App\Cache()
	);
	
	if($action === 'refresh'){
		
		// удаляем кеш в файле
		$provider->deleteCache('smeta');
		
		// убираем get-параметр с помощью редиректа на главную
		// т.к. файл кеша удален, данные будут взяты из таблицы
		// файл кеша со свежими данными будет создан заново
		header('Location: /');
		exit();
	}
	
	// Выводим массив данных в разметку
	$view = (new \App\View())
		->renderHtml(
			[
				'data' => $provider->get('smeta')
			]
		);
	
?>