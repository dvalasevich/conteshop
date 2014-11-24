<!DOCTYPE html>
<html>
    <head> <meta http-equiv="content-type" content="text/html; charset=utf8"></head>
<?php

         
        //include_once 'import.php'; 
        include_once 'options.php'; 
        
//ini_set('display_errors','On');
//error_reporting(E_ALL|E_STRICT);
include_once 'options.php';

//print_select($conn,$dbTable,$attr1);
//include_once 'options.php';
//do_insert('table1','id1','2','description1','Bad product for bad boys only!!!',$conn);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function print_select ($mysqli,$Table,$attr) {


if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'utf8'"); 
$mysqli->query("SET CHARACTER SET 'utf8'");
$mysqli->query("SET SESSION collation_connection = 'utf8'");


//$q1=    "SELECT * FROM ".$dbTable;
$q1="SELECT ".$attr." FROM `".$Table."`"; 
////echo $q1;

$res = $mysqli->query($q1);
//echo "<body>";



//echo "<br> Обратный порядок... <br> \n";
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
    //echo " attribute = " . $row[$attr] . "<br> \n";
}

//echo "<br> Исходный порядок строк... <br> \n";
$res->data_seek(0);
while ($row = $res->fetch_assoc()) {
    //echo " attribute = " . $row[$attr] . "<br> \n";
}



//echo "</body>";    
}

function do_insert ($table,$id_name,$id_value,$attribut,$value,$mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";



//$q1=    "SELECT * FROM ".$dbTable;
//$q1="SELECT ".$attr1." FROM `".$dbTable."`"; 

if (!$mysqli->query("INSERT INTO ".$table." (".$id_name.",".$attribut.") VALUES ('".$id_value."','".$value."') ")) 
                {
    //echo "<br> Не удалось вставить значение ".$value." в поле ".$attribut." таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Пробуем обновить значение ...";
    
    if (!$mysqli->query("UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' "))
    {
        //echo "<br> Не удалось обновить значение ".$value." в поле ".$attribut." таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    

    
}


    $eq="INSERT INTO ".$table." (".$id_name.",".$attribut.") VALUES ('".$id_value."','".$value."') ";
    //echo "<br> Запрос 1: ".$eq;
    $eq="UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' ";
    //echo "<br> Запрос 2: ".$eq;
mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 
}

function do_update ($table,$id_name,$id_value,$attribut,$value,$mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";



//$q1=    "SELECT * FROM ".$dbTable;
//$q1="SELECT ".$attr1." FROM `".$dbTable."`"; 

    
    if (!$mysqli->query("UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' "))
    {
        //echo "<br> Не удалось обновить значение ".$value." в поле ".$attribut." таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    $eq="UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' ";
    //echo "<br> Запрос : ".$eq;
mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 
}

function do_insert_sku ($table,$sku_value, $mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";



//INSERT INTO `".$table"` (`entity_id`, `entity_type_id`, `attribute_set_id`, `type_id`, `sku`, `has_options`, `required_options`, `created_at`, `updated_at`) VALUES ((SELECT MAX(entity_id)+1 FROM sku), '4', '4', 'simple', '".$sku_value."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_set_id`, `type_id`, `sku`, `has_options`, `required_options`, `created_at`, `updated_at`) VALUES ('4', '4', 'simple', '".$sku_value."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
    
   
if (!$mysqli->query($eq1)) 
                {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
        
    
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 
    

}

function do_insert_entity_datetime ($table,$sku_value, $mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
////echo $mysqli->host_info . "\n";



//First record
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '93', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}



//Second record
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '94', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Third record
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '77', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Fourth record
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '78', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Fifth record
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '104', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Sixth record
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '105', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 

}

function get_product_id($table,$sku_value, $mysqli)
{
   $table='catalog_product_entity'; 
   $eq1 ="SELECT entity_id FROM `".$table."` WHERE sku='".$sku_value."'"; 
    //echo "<br /> <br />  Ищем продукт: ".$eq1;
    ////echo $mysqli->host_info . "\n";
    
    $res = $mysqli->query($eq1);
    $row = $res->fetch_assoc();
    //echo "Найден sku id :".$row['entity_id'];
    return $row['entity_id'];
    
}

function get_autolink ($s1)
{
//$s1="CONTE 400 DEN";
$s2=mb_strtolower($s1);
////echo $s2;
$s3=str_replace(" ","-",$s2);
return $s3;
}

function do_insert_varchar_attributes ($table,$sku_value, $mysqli, $product_name, $sku_mf, $auto_link, $color, $size)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
////echo $mysqli->host_info . "\n";



//Product Name
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '71', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_name."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}
//Product Model
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '155', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_name."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Sku_mf
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '144', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$sku_mf."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Short link
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '97', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$auto_link."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Color
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '137', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$color."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}


//Нулевка1
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '153', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '154', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка3
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '82', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}    

//Нулевка4
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '84', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка5
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '157', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Атрибуты склада и магазина 
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '118', '0', '".get_product_id($table, $sku_value, $mysqli)."', '2');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '119', '0', '".get_product_id($table, $sku_value, $mysqli)."', '4');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

// Размер
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '136', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$size."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 

}

function do_insert_text_attributes ($table,$sku_value, $mysqli, $product_description, $product_short_description)
{
 
 
//Product description

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '72', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_description)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Product short description

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '73', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_short_description)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка 1
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '83', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '106', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE);

}


function do_insert_decimal_attributes ($table,$sku_value, $mysqli, $product_price, $product_weight)
{
  

//Product weight

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '80', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_weight."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}    
    
//Product price

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '75', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_price."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка 1
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '76', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '120', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE);

}

function do_insert_int_attributes ($table,$sku_value, $mysqli, $product_status, $product_visibility, $product_brand, $product_type)
{
  
 
//Нулека 1 - Product featured

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '133', '0', '".get_product_id($table, $sku_value, $mysqli)."', '0');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Product brand

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '142', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_brand."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Product type

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '164', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_type."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Product status

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '96', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_status."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Product visibility

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '102', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$product_visibility."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулёвка 2 - tax_class_id

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '121', '0', '".get_product_id($table, $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулёвка 3 - price_cahnge_allow

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '145', '0', '".get_product_id($table, $sku_value, $mysqli)."', '0');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Нулёвка 4 - is_reccuring

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '100', '0', '".get_product_id($table, $sku_value, $mysqli)."', '0');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

        

}

function insert_new_vcattributes ($table, $sku_value, $mysqli, $modelCode, $typeCode, $patternCode, $sizeCode, $colorCode)
{

    //$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    //echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
////echo $mysqli->host_info . "\n";



//Pattern Name
//    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '157', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$patternName."');";
    
   
//if (!$mysqli->query($eq1)) 
//               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
//}

//Model Code
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '159', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$modelCode."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Type Code
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '160', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$typeCode."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Pattern Code
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '161', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$patternCode."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Size Code
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '162', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$sizeCode."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Color Code
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '163', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".$colorCode."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//end new

}


//Materials

function do_insert_material_attributes ($table,$sku_value, $mysqli, $product_material_en, $product_material_ru)
{
 
 
//Value 10

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '0', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_en)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 1

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '46', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 2

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '52', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 3

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '53', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 4

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '54', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 5

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '45', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 6

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '55', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 7

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '57', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 8

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '58', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 9

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '11', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 10

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '30', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 11

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '35', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 12

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '40', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 13

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '23', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 14

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '61', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 15

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '62', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 16

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '63', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 17

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '47', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 18

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '64', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 19

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '65', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 20

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '66', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 21

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '48', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 22

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '67', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 23

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '68', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//Value 24

$eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '165', '69', '".get_product_id($table, $sku_value, $mysqli)."', '".mysql_escape_string($product_material_ru)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    //echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    //echo "<br> Запрос : ".$eq1;
    
}

//end materials

}


function insert_all($product, $conn)
    {
        
        //$product->productVisibility=5;
        
        $conn->query("SET NAMES 'utf8'"); 
        $conn->query("SET CHARACTER SET 'utf8'");
        $conn->query("SET SESSION collation_connection = 'utf8'");   
        
        do_insert_sku($product->productMainTable, $product->productSku, $conn);
        //вставляем аттрибуты с датами (которых поумолчанию нету вообще)
        //print get_product_id($table, $product->productSku, $conn);
        do_insert_entity_datetime($product->productDateTable, $product->productSku, $conn);
        do_insert_varchar_attributes($product->productVarCharTable, $product->productSku, $conn, $product->productName , $product->productSkuMf, get_autolink($product->productName), $product->productColor, $product->productSize);
        do_insert_text_attributes($product->productTextTable, $product->productSku, $conn, $product->productDescription, $product->productShortDescription);
        do_insert_decimal_attributes($product->productDecimalTable, $product->productSku, $conn, $product->productPrice, $product->productWeightBrutto);
        if ($product->productStatus =='true') { $product->productStatus = '1'; } else { $product->productStatus = '2'; }
        
        //do_insert_int_attributes('entity_int', '22111110', $conn, '1', '4', '9','531'); 
         
        //$product->productBrand='9';
        
        //$product->productType='531';
        
        do_insert_int_attributes($product->productIntTable, $product->productSku, $conn, $product->productStatus, $product->productVisibility, $product->productBrand,$product->productType); 
        insert_new_vcattributes ($product->productVarCharTable, $product->productSku, $conn, $product->productModelCode, $product->productTypeCode, $product->productPatternCode, $product->productSizeCode, $product->productColorCode);
        do_insert_material_attributes($product->productTextTable, $product->productSku, $conn, $product->productMaterialEn, $product->productMaterialRu);  
    
        //mysqli_close($conn);
        //mysqli_connect($host, $user, $password, $database, $port, $socket) $dbHost, $dbUser, $dbPass, $dbName, 3306, )
        //$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    
        mysqli_commit($conn);
        mysqli_close($conn);    
    
        $dbHost='localhost'; // чаще всего это так, но иногда требуется прописать ip адрес базы данных 
        $dbName='contedev_db'; // название вашей базы 
        $dbUser='root'; // пользователь базы данных 
        $dbPass='7IjEcvHtxpSqoU'; // пароль пользователя
    //$dbTable='table1';
    
    
        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);  
        
         
        
       // $conn = reopen_conn($conn);
    }
    
    function reopen_conn($conn1)
    {
    //include_once('options.php');
      
    
    return $conn1;
   // //echo $dbHost;
    }
    
    



?>
</html>
