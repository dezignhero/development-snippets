<?

$host="localhost"; // Host name 
$username="inspiref"; // Mysql username 
$password="thisisbh"; // Mysql password 
$db_name="inspiref_confirmation"; // Database name 


//Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect to server"); 
mysql_select_db("$db_name")or die("cannot select DB");

?>