### stest.php
Скрипт показывает информацию про сервер LAMP\LEMP, версии PHP и MySQL, прверяет работоспособность подключения к MySQL, количество места на диске сервера всего/осталось, а также количество модулей загруженых PHP.

Для проверки подключения к MySQL нужно в файле stest.php ввести в соответствующие переменные параметры подключения к вашему серверу:

__//*** Параметры подключения к dbmysql, пример:__   
$db_host='127.0.0.1';   
$db_user='user';   
$db_pass='mystrongpassword ';   

=== eng ===

The script displays information about the LAMP\LEMP server, PHP and MySQL versions, checks the functionality of the connection to MySQL, the amount of disk space on the server in total/remaining, and the number of loaded PHP modules.

To check the connection to MySQL, you need to enter the connection parameters to your server in the corresponding variables in the stest.php file:

//*** Connection parameters to dbmysql, example:
$db_host='127.0.0.1';
$db_user='user';
$db_pass='mystrongpassword ';
