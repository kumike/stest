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
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset='utf-8'>
<style>
body{  
	margin:0.5em;
	padding:1.5em;
	border:2px ridge #0066B9;
	font:1em Verdana, Arial, Helvetica, sans-serif; /* Можна задать укороченую запись вместо font-family и font-size */
    transition: background 0.5s, color 0.5s, border 0.5s;
	/*font-family: normal 1em Verdana, Arial, Helvetica, sans-serif;*/
	/*font-size:1em;*/
}

.dark{
    background:#111;
    color:#f5f5f5;
    border:2px ridge #90CAF9;
    hr{ 
        height:0px;
        border:0px;
        border-top:1px solid #90CAF9;
        }
    legend{
	    border: solid #888A85; /* сокращенная запись border-style и border-color*/
        /* чтобы работал border-width нужно задать border-style, border-color не обязательный параметр */
	    border-width: 1px 1px 0; /*1px;** порядок задачи, верхняя-правая-нижняя-левая. задано: верхняя 1px правая\левая 1px нижняя 0 */
	    border-radius: 5px 5px 0 0; /* верхнийлевый верхнийправый нижнийправый нижнийлевый */
	    background-color:#413C46;
	    margin-bottom:.5em;
	    padding: 0 .2em; /* тут задано так верх\низ 0, правая\левая 0.2em. точка означает что перед ней 0 .2 аналогично 0.2 */
	    font-weight:bold;
	    color:#A546B5;
	    text-shadow:#3F2147 0 .15em .10em;
    }
    .fieldsetd{
	    border:1px solid #888A85;
        background-color:#413C46;
       /** color:#A546B5; **/
    }
    .color{
	    font-style:normal;
        color:#A546B5;
    }
    .color0{  
	    font-style:italic;
        color: #D2995B;
    }
}

button{
    padding:10px 20px;
    font-size:1rem;
    cursor:pointer;
}

hr{
	height:0px;
	width:100%;
	border:0px;
	border-top:1px solid #0066B9;
}
@font-face {
    font-family: 'Digiface';
    src: url('/Digiface-regular.ttf') format('truetype');
    font-style: normal;
    font-weight: normal;
}
.time{
    font-family:'Digiface',monospace;
	font-size:1.8em;
	text-shadow:#224500 0 .10em .10em;
	color:#224500;
	background: #ddf;        /* Светлый, голубовато-серыйфон */
	padding: 4px;           /* Отступы вокруг */
	border: solid #0066B9 1px; /* И сплошная черная рамка */
	border-radius: 5px;     /* Закругленные углы */

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
    transition:all 0.5s ease; /* плавный переход */
	border:1px solid #888A85;
	background-color:#FFF7EB;
}
legend{
    transition:all 0.5s ease; /* плавный переход */
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

/*============ переключатель тем  =================*/

.checkbox {
  position: relative;
  display: inline-block;
}
.checkbox label {
  width: 90px;
  height: 42px;
  background: #ccc;
  position: relative;
  display: inline-block;
  border-radius: 46px;
  transition: 0.4s;
}
.checkbox label:after {
  content: '';
  position: absolute;
  width: 50px;
  height: 50px;
  border-radius: 100%;
  left: 0;
  top: -5px;
  z-index: 2;
  background: #fff;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  transition: 0.4s;
}
.checkbox input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  z-index: 5;
  opacity: 0;
  cursor: pointer;
}
.checkbox input:hover + label:after {
  box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.2), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
}
.checkbox input:checked + label:after {
  left: 40px;
}

/*=====================*/
.model-4 .checkbox label {
  background: #DDDDDD;
  height: 16.7px; /* было 25px */
  width: 50px;    /* было 75px */
}

.model-4 .checkbox label:after {
  background: #EFEFEF;
  top: -5.3px;    /* было -8px */
  width: 25.3px;  /* было 38px */
  height: 25.3px;
}

.model-4 .checkbox input:checked + label {
  background: #77C2BB;
}

.model-4 .checkbox input:checked + label:after {
  background: #009688;
  left: 26.7px;   /* было 40px */
}


/*====================== контейнер с переключалкой и часами ========================*/
.container {
            display: flex;
            justify-content: space-between;
        }

        .left, .right {
            display: flex;
        }
/*======= icon ===========*/
@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.2);
    opacity: 0.8;
  }
}

.icon {
  font-size: 1.5em;
  margin: 0 8px;
  opacity: 0.1;
  transition: 0.4s ease;
  user-select: none;
  transform-origin: center center;
}

.icon.active {
  opacity: 1;
  animation: pulse 2s infinite ease-in-out;
}

</style>
<script>
//*** скриптик интерактивных часов
function startTime(){
	var now = new Date();
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
<script>
//*** скритик-функция переключения темы
function toggleTheme() {
    document.body.classList.toggle('dark');
}
function chClass() {
    const fieldsets = document.querySelectorAll('fieldset.fieldsetn, fieldset.fieldsetd');
   // alert(fieldsets);
    fieldsets.forEach(fs => {
        if (fs.classList.contains('fieldsetn')) {
            fs.classList.replace('fieldsetn','fieldsetd');
        } else {
            fs.classList.replace('fieldsetd','fieldsetn');
        }    
    });
}
</script>

<script>
function toggleIcons() {
  const sun = document.getElementById('sun');
  const moon = document.getElementById('moon');
  const toggle = document.getElementById('themeToggle');

  if (toggle.checked) {
    sun.classList.remove('active');
    moon.classList.add('active');
  } else {
    sun.classList.add('active');
    moon.classList.remove('active');
  }
}

//*** при загрузке: установить светлую тему и яркое солнце
window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('themeToggle').checked = false;
  toggleIcons();
});
</script>

<title>Инфа про версии програм на сервере</title>
</head>
<body>
<?php
//*** установка часового пояса
date_default_timezone_set('Europe/Kyiv');
//echo date('Y-m-d H:i:s');
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
echo '<div class="container">
            <div class="left">
                <span class="time">'.getDayRus()." ".date('d')." ".getMonthRus()." ".date('Y')." "."<span id='time'></span></span>
            </div>".
           //*** кнопка переключения день-ноч
            '<div class="right">  
               <section class="model-4">
                 <div class="checkbox">
                   <span id="sun" class="icon active">☀️</span>
                   <input type="checkbox" onchange="toggleTheme(); chClass(); toggleIcons();" id="themeToggle">
                   <label></label>
                   <span id="moon" class="icon">🌙</span>
                 </div>
               </section>
             </div>
      </div>'.
"\n<hr>\n".
'<span class="color">Операционная система:</span><span class="color0"> '.php_uname()."</span><br>\n".
'<span class="color">Сервер:</span><span class="color0"> '.$_SERVER['SERVER_SOFTWARE'].' '. $_SERVER['SERVER_PROTOCOL']."</span><br>\n";
//***  функция склонения универсальная, день\дня\дней, час\часов\часа, минут, секунда\секунды\секунд и тп. 
function num_decline($number, $titles, $show_number = true) {
    $number_clean = preg_replace('/<\/?[^>]+>/', '', $number);
    $intnum = abs((int)$number_clean);

    if (is_string($titles)) {
        $titles = preg_split('/\s*,\s*/', $titles);
    }

    if (!isset($titles[2])) {
        $titles[2] = $titles[1];
    }

    $cases = [2, 0, 1, 1, 1, 2];
    $index = ($intnum % 100 > 4 && $intnum % 100 < 20)
        ? 2
        : $cases[min($intnum % 10, 5)];

    return ($show_number ? "$number " : '') . $titles[$index];
}

//***  аптайм  
$uptime = @file_get_contents("/proc/uptime"); // аптайм
$uptime = explode(" ", $uptime);
$uptime = $uptime[0];
$days = floor($uptime / 86400); // дни
$hours = floor(($uptime % 86400) / 3600); // часы
$minutes = floor(($uptime % 3600) / 60);  // минуты

echo '<span class="color">Аптайм сервера:</span><span class="color0"> '.
    num_decline($days, "день,дня,дней").' '.
    num_decline($hours, "час,часа,часов").' '.
    num_decline($minutes, "минута,минуты,минут")."</span>\n<hr>\n";

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
echo "<br>\n<fieldset class='fieldsetn'>\n<legend class='legendn'>PHP</legend>\n".
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
echo "<fieldset class='fieldsetn'>\n<legend class='legendn' >MYSQL</legend>\n".
     '<span class="color">Соединение с MYSQL установлено:</span><span class="color0"> '.$link->host_info."</span><br>\n".
     '<span class="color">Версия сервера MYSQL:</span><span class="color0"> '.$link->server_info."</span><br>\n".
     '<span class="color">Версия клиентской библиотеки MYSQL:</span><span class="color0"> '.$link->client_info."</span><br>\n".
     '<span class="color">Текущая кодировка MYSQL:</span><span class="color0"> '.$link->character_set_name()."</span><br>\n";
//$link->set_charset('utf8');
echo '<span class="color">Текущая кодировка MYSQL:</span><span class="color0"> '.$link->character_set_name()."</span><br>\n</fieldset>\n<br><hr>\n";
//*** Закрываем соединение с базой
$link->close();
//*** Собственно вывод результата генерации времени исполнения скрипта, с округлением числа до трёх знаков после запятой.
echo '<span class="color">Страница сгенерирована за:</span><span class="color0"> '.round((microtime(true)-$Time),3)." сек.</span>\n<br>\n";
?>
