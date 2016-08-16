<?php 
//*** Время генерации страницы сервером в микросекундах
$time=microtime(true);
//*** Параметры подключения к dbmysql
$db_host=' ';
$db_user=' ';
$db_pass=' ';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<style>
body{  
	margin:0.5em;
	padding:1.5em;
	border:2px ridge #0066B9;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:1em;
}
hr{
	height:0px;
	width:100%;
	border:0px;
	border-top:1px solid #0066B9;
}
.time{
	font-family:Courier,"MS Courier New";
	font-style:normal;
	font-size:1em;
	text-shadow:#224500 0 .15em .10em;
	color:#224500;
}
.color{
	font-style:normal;
	color:#3F2147;
}
.color0{  
	font-style:italic;
	color:#6D3C14;
}
.error{
	font-style:italic;
	font-weight:bold;
	color:red;
}
fieldset{
	border:1px solid #888A85;
	background-color:#FFF7EB;
}
legend{
	border-top:1px solid #888A85;
	border-right:1px solid #888A85;
	border-left:1px solid #888A85;
	border-top-right-radius:5px;
	border-top-left-radius:5px;
	background-color:#FFF7EB;
	margin-bottom:.5em;
	padding-left:.2em;
	padding-right:.2em;
	font-weight:bold;
	color:#3F2147;
	text-shadow:#3F2147 0 .15em .10em;
}
</style>
<title>Инфа про версии програм на сервере</title>
</head>
<body>
<?php
//*** информация о веб сервере, php_uname() выдает информацию об операционной системе на которой запущен сервер
echo '<span class="time">'.date('d-m-Y l d F H:i:s')."<br></span><br>\n<hr>\n".
     '<span class="color">Операционная система:</span><span class="color0"> '.php_uname()."</span><br>\n".
     '<span class="color">Сервер:</span><span class="color0"> '.$_SERVER['SERVER_SOFTWARE']."</span>\n<hr>\n";
//*** расчёт свободного места на веб сервере.
$dfs=disk_free_space('/');
$dts=disk_total_space('/');
$powgig=pow(2,30);//*** вычисляем сколько в гигабайте байт 1073741824 байт в гиге, или 2^30
$powmb=pow(2,20);//*** тоже что и сверху только для мегабайт
//*** высчитиваем гигабайты и округляем до одного знака после запятой
$gigspace=round(($dfs/$powgig),1);
$gigtspace=round(($dts/$powgig),1);
//*** тоже только для мегабайт 
$mbspace=round(($dfs/$powmb),1);
$mbtspace=round(($dts/$powmb),1);
//*** выбираем как показать в мегабайтах или в гигабайтах, 0.99 остаток от 1гб
if($gigspace<0.99&$gigtspace<0.99){
echo '<span class="color">Disc free space:</span><span class="color0"> '.$mbspace."Mb</span><br>\n".
     '<span class="color">Disc total space:</span><span class="color0"> '.$mbtspace."Mb</span><br>\n"; 
}
elseif($gigspace<0.99&$gigtspace>=0.99){
echo '<span class="color">Disc free space:</span><span class="color0"> '.$mbspace."Mb</span><br>\n".
     '<span class="color">Disc total space:</span><span class="color0"> '.$gigtspace."Gb</span><br>\n";
} 
else
echo '<span class="color">Disc free space:</span><span class="color0"> '.$gigspace."Gb</span><br>\n".
     '<span class="color">Disc total space:</span><span class="color0"> '.$gigtspace."Gb</span>\n<hr>\n<br>\n";
//*** Версии пхп мускульи, пдо и проверка загруженых расширений, implode преобразует масив в строку explode строку в масив
$mod=get_loaded_extensions();
echo '<fieldset><legend>PHP</legend>
      <span class="color">Текущая версия PHP:</span><span class="color0"> '.phpversion()."</span><br>\n".
     '<span class="color">Версия движка Zend:</span><span class="color0"> '.zend_version()."</span><br>\n".
     '<span class="color">Текущая версия PDO:</span><span class="color0"> '.phpversion('PDO')."</span><br>\n".
     '<span class="color">Текущая версия MYSQLI:</span><span class="color0"> '.phpversion('mysqli')."</span><br>\n".
     '<span class="color">Загруженные модули PHP:</span><span class="color0"><i> '.implode(", ",$mod)."</span></i><br>\n".
     '<span class="color">Всего модулей:</span><span class="color0"> '.count($mod)." шт.</span><br></fieldset><br>\n";
//*** Подключение и вывод информации о подключение либо вывод ошибки подключения
$link = new mysqli($db_host,$db_user,$db_pass);
if ($link->connect_error){
    die('<span class="error">Ошибка подключения к MYSQL: ('.$link->connect_errno.') '.$link->connect_error)."</span>";
   }
//*** Проверка версий клиента и сервера
echo '<fieldset><legend>MYSQL</legend>
      <span class="color">Соединение с MYSQL установлено:</span><span class="color0"> '.$link->host_info."</span><br>\n".
     '<span class="color">Версия сервера MYSQL:</span><span class="color0"> '.$link->server_info."</span><br>\n".
     '<span class="color">Версия клиентской библиотеки MYSQL:</span><span class="color0"> '.$link->client_info."</span><br>\n".
     '<span class="color">Текущая кодировка MYSQL:</span><span class="color0"> '.$link->character_set_name()."</span><br>\n".
     'Задаём кодировку для базы данных для работы с кирилицей $link->set_charset(\'utf8\')'."<br>\n";
//*** Задаём кодировку для базы данных для работы с кирилицей
$link->set_charset('utf8');
echo '<span class="color">Текущая кодировка MYSQL:</span><span class="color0"> '.$link->character_set_name()."</span><br></fieldset><br>\n<hr>\n";
//*** Закрываем соединение с базой
$link->close();
//*** Собственно вывод результата генерации времени исполнения скрипта, с округлением числа до трёх знаков после запятой.
echo '<span class="color">Страница сгенерирована за:</span><span class="color0"> '.round((microtime(true)-$time),3)." сек.</span><br>\n";
?>
</body>
</html>
