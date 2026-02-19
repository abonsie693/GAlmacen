<?php
#--------------------------------------------
#  La forma de utilizar este archivo es con la siguiente instrucción en la primera línea:
  
#  php require_once('gest/conexion.php');
  
#  Después realizamos la conexión de la siguiente manera:
  
#  mysql_select_db($Base, $c);
#---------------------------------------------------

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
####################################

# Configuración para conexión Web
//$Servidor_conexion = "localhost";
//$login_conexion = "iesturaniana2";
//$password_conexion = "LasV...";
//$base = "iesturaniana";
//
# Configuración para conexión LOCAL
$Servidor_conexion = "localhost";
$login_conexion = "root";
$password_conexion = "";
$base = "almacen"; // Entre comillas debe aparecer el nombre del esquema de BD.

# Selección de la base de datos y conexión 

$c = mysqli_connect($Servidor_conexion, $login_conexion, $password_conexion, $base) or trigger_error(mysqli_error(),E_USER_ERROR);

?>
