<?php 
//*** Время генерации страницы сервером в микросекундах
$Time = microtime(true);
//*** Параметры подключения к dbmysql, введите в кавычках ваши данные подключения к db
$db_host = "";
$db_user = "";
$db_pass = "";
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
	font:1em Verdana, Arial, Helvetica, sans-serif; /* Можна задать укороченую запись вместо font-family и font-size */
	/*font-family: normal 1em Verdana, Arial, Helvetica, sans-serif;*/
	/*font-size:1em;*/
}
hr{
	height:0px;
	width:100%;
	border:0px;
	border-top:1px solid #0066B9;
}
.time{
	font-family:Courier,"MS Courier New",monospace;
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
	border: solid #888A85; /* сокращенная запись border-style и border-color*/
    /* чтобы работал border-width нужно задать border-style, border-color не обязательный параметр */
	border-width: 1px 1px 0; /*1px;** порядок задачи, верхняя-правая-нижняя-левая. задано: верхняя 1px правая\левая 1px нижняя 0 */
	border-radius: 5px 5px 0 0; /* верхнийлевый верхнийправый нижнийправый нижнийлевый */
	background-color:#FFF7EB;
	margin-bottom:.5em;
	padding: 0 .2em; /* тут задано так верх\низ 0, правая\левая 0.2em. точка означает что перед ней 0 .2 аналогично 0.2 */
	font-weight:bold;
	color:#3F2147;
	text-shadow:#3F2147 0 .15em .10em;
}
</style>
<script>
//*** скриптик интерактивных часов
function startTime(){
	now = new Date();
	document.getElementById('time').innerHTML = checkTime(now.getHours())+':'+checkTime(now.getMinutes())+':'+checkTime(now.getSeconds());
    setTimeout(startTime, 1000); //*** вызвать функцию снова через 1 секунду
}
//*** функция добавляет ведущие ноли перед значением
function checkTime(i){
	if (i<10){
		i = "0" + i;
	}
    return i;
}
window.onload = startTime; //*** Начать отображение времени после полной загрузки доку­мента.
</script>
<title>Инфа про версии програм на сервере</title>
</head>
<body>
<?php
//*** функция для определения дня недели по-русски
function getDayRus(){
    //*** массив с названиями дней недели
    $days = array('Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
    //*** номер дня недели с 0 до 6, 0 - воскресенье, 6 - суббота
    $num_day = date('w');
    //*** получаем название дня из массива
    $name_day = $days[$num_day];
    //*** вернем название дня
    return $name_day;
}
//*** функция для получения названия месяца по-русски
function getMonthRus(){
    //*** номер текущего месяца без ведущего ноля
    $num_month = date('n');
    //*** массив с названиями месяцев
    $monthes = array(1=>'Января',2=>'Февраля',3=>'Марта',4=>'Апреля',5=>'Мая',6=>'Июня',
                     7=>'Июля',8=>'Августа',9=>'Сентября',10=>'Октября',11=>'Ноября',12=>'Декабря');
    //*** получаем название месяца из массива
    $name_month = $monthes[$num_month];
    //*** вернем название месяца
    return $name_month;
}
//*** первая строчка выводит текущий день недели, число, месяц, год и время
//*** дальше информация о веб сервере, php_uname() выдает информацию об операционной системе на которой запущен сервер
echo '<span class="time">'.getDayRus()." ".date('d')." ".getMonthRus()." ".date('Y')." "."<span id='time'></span></span>\n<hr>\n".
     '<span class="color">Операционная система:</span><span class="color0"> '.php_uname()."</span><br>\n".
     '<span class="color">Сервер:</span><span class="color0"> '.$_SERVER['SERVER_SOFTWARE']."</span>\n<hr>\n";
//*** расчёт свободного места на веб сервере.
$dfs = disk_free_space('/');//*** осталось свободного места на диске в байтах
$dts = disk_total_space('/');//*** всего доступного места на диске в байтах
$bgig = 1073741824;//*** число это количество байт в гигабайте или 2^30 или 1024^3
$bmeg = 1048576;//*** число количество байт в мегабайте или 2^20 pow(2,20) 1024^2
//*** высчитиваем гигабайты и округляем до одного знака после запятой
$gigspace = round($dfs/$bgig,1); 
$gigtspace = round($dts/$bgig,1);
//*** тоже только для мегабайт
$mbspace = round($dfs/$bmeg,1);
$mbtspace = round($dts/$bmeg,1);
//*** выбираем как показать в мегабайтах или в гигабайтах, 0.9 остаток от 1гб
if ($gigspace < 0.9 & $gigtspace < 0.9){
echo '<span class="color">Disc free space:</span><span class="color0"> '.$mbspace."Mb</span><br>\n".
     '<span class="color">Disc total space:</span><span class="color0"> '.$mbtspace."Mb</span>\n<hr>\n";
} elseif ($gigspace < 0.9 & $gigtspace >= 0.9){
	echo '<span class="color">Disc free space:</span><span class="color0"> '.$mbspace."Mb</span><br>\n".
         '<span class="color">Disc total space:</span><span class="color0"> '.$gigtspace."Gb</span>\n<hr>\n";
} else {
	echo '<span class="color">Disc free space:</span><span class="color0"> '.$gigspace."Gb</span><br>\n".
         '<span class="color">Disc total space:</span><span class="color0"> '.$gigtspace."Gb</span>\n<hr>\n";
}
//*** Версии пхп мускульи, пдо и проверка загруженых расширений, implode преобразует масив в строку explode строку в масив
$mod = get_loaded_extensions();
echo "<fieldset>\n<legend>PHP</legend>\n".
     '<span class="color">Текущая версия PHP:</span><span class="color0"> '.phpversion()."</span><br>\n".
     '<span class="color">Версия движка Zend:</span><span class="color0"> '.zend_version()."</span><br>\n".
     '<span class="color">Текущая версия PDO:</span><span class="color0"> '.phpversion('PDO')."</span><br>\n".
     '<span class="color">Текущая версия MYSQLI:</span><span class="color0"> '.phpversion('mysqli')."</span><br>\n".
     '<span class="color">Загруженные модули PHP:</span><span class="color0"><i> '.implode(", ",$mod)."</i></span><br>\n".
     '<span class="color">Всего модулей:</span><span class="color0"> '.count($mod)." шт.</span><br>\n</fieldset>\n<br>\n";
//*** Подключение и вывод информации о подключение либо вывод ошибки подключения
$link = new mysqli($db_host,$db_user,$db_pass);
if ($link->connect_error){
	die('<span class="error">Ошибка подключения к MYSQL: ('.$link->connect_errno.') '.$link->connect_error)."</span>";
}
//*** Проверка версий клиента и сервера
echo "<fieldset>\n<legend>MYSQL</legend>\n".
     '<span class="color">Соединение с MYSQL установлено:</span><span class="color0"> '.$link->host_info."</span><br>\n".
     '<span class="color">Версия сервера MYSQL:</span><span class="color0"> '.$link->server_info."</span><br>\n".
     '<span class="color">Версия клиентской библиотеки MYSQL:</span><span class="color0"> '.$link->client_info."</span><br>\n".
     '<span class="color">Текущая кодировка MYSQL:</span><span class="color0"> '.$link->character_set_name()."</span><br>\n".
     'Задаём кодировку для базы данных для работы с кирилицей $link->set_charset(\'utf8\')'."<br>\n";
//*** Задаём кодировку для базы данных для работы с кирилицей
$link->set_charset('utf8');
echo '<span class="color">Текущая кодировка MYSQL:</span><span class="color0"> '.$link->character_set_name()."</span><br>\n</fieldset>\n<br><hr>\n";
//*** Закрываем соединение с базой
$link->close();
//*** Собственно вывод результата генерации времени исполнения скрипта, с округлением числа до трёх знаков после запятой.
echo '<span class="color">Страница сгенерирована за:</span><span class="color0"> '.round((microtime(true)-$Time),3)." сек.</span>\n<br>\n";
?>
</body>
</html>
