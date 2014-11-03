<!DOCTYPE html>
<html>
    <head> <meta http-equiv="content-type" content="text/html; charset=utf8"></head>
<?php

ini_set('display_errors','On');
error_reporting(E_ALL|E_STRICT);
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
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'cp1251'"); 
$mysqli->query("SET CHARACTER SET 'cp1251'");
$mysqli->query("SET SESSION collation_connection = 'cp1251'");


//$q1=    "SELECT * FROM ".$dbTable;
$q1="SELECT ".$attr." FROM `".$Table."`"; 
//echo $q1;

$res = $mysqli->query($q1);
echo "<body>";



echo "<br> Обратный порядок... <br> \n";
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
    echo " attribute = " . $row[$attr] . "<br> \n";
}

echo "<br> Исходный порядок строк... <br> \n";
$res->data_seek(0);
while ($row = $res->fetch_assoc()) {
    echo " attribute = " . $row[$attr] . "<br> \n";
}



echo "</body>";    
}

function do_insert ($table,$id_name,$id_value,$attribut,$value,$mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'cp1251'"); 
$mysqli->query("SET CHARACTER SET 'cp1251'");
$mysqli->query("SET SESSION collation_connection = 'cp1251'");


//$q1=    "SELECT * FROM ".$dbTable;
//$q1="SELECT ".$attr1." FROM `".$dbTable."`"; 

if (!$mysqli->query("INSERT INTO ".$table." (".$id_name.",".$attribut.") VALUES ('".$id_value."','".$value."') ")) 
                {
    echo "<br> Не удалось вставить значение ".$value." в поле ".$attribut." таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Пробуем обновить значение ...";
    
    if (!$mysqli->query("UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' "))
    {
        echo "<br> Не удалось обновить значение ".$value." в поле ".$attribut." таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    

    
}


    $eq="INSERT INTO ".$table." (".$id_name.",".$attribut.") VALUES ('".$id_value."','".$value."') ";
    echo "<br> Запрос 1: ".$eq;
    $eq="UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' ";
    echo "<br> Запрос 2: ".$eq;
mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 
}

function do_update ($table,$id_name,$id_value,$attribut,$value,$mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'cp1251'"); 
$mysqli->query("SET CHARACTER SET 'cp1251'");
$mysqli->query("SET SESSION collation_connection = 'cp1251'");


//$q1=    "SELECT * FROM ".$dbTable;
//$q1="SELECT ".$attr1." FROM `".$dbTable."`"; 

    
    if (!$mysqli->query("UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' "))
    {
        echo "<br> Не удалось обновить значение ".$value." в поле ".$attribut." таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    
    $eq="UPDATE ".$table." SET ".$attribut." = '".$value."' WHERE ".$id_name."='".$id_value."' ";
    echo "<br> Запрос : ".$eq;
mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 
}

function do_insert_sku ($table,$sku_value, $mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'cp1251'"); 
$mysqli->query("SET CHARACTER SET 'cp1251'");
$mysqli->query("SET SESSION collation_connection = 'cp1251'");


//INSERT INTO `".$table"` (`entity_id`, `entity_type_id`, `attribute_set_id`, `type_id`, `sku`, `has_options`, `required_options`, `created_at`, `updated_at`) VALUES ((SELECT MAX(entity_id)+1 FROM sku), '4', '4', 'simple', '".$sku_value."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
    $eq1="INSERT INTO `".$table."` (`entity_id`, `entity_type_id`, `attribute_set_id`, `type_id`, `sku`, `has_options`, `required_options`, `created_at`, `updated_at`) VALUES (LAST_INSERT_ID(), '4', '4', 'simple', '".$sku_value."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
    
   
if (!$mysqli->query($eq1)) 
                {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
        
    
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 
    

}

function do_insert_entity_datetime ($table,$sku_value, $mysqli)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'cp1251'"); 
$mysqli->query("SET CHARACTER SET 'cp1251'");
$mysqli->query("SET SESSION collation_connection = 'cp1251'");


//First record
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID(), '4', '93', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}



//Second record
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+1, '4', '94', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Third record
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+2, '4', '77', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Fourth record
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+3, '4', '78', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Fifth record
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+4, '4', '104', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Sixth record
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+5, '4', '105', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 

}

function get_product_id($table,$sku_value, $mysqli)
{
   $eq1 ="SELECT entity_id FROM `".$table."` WHERE sku='".$sku_value."'"; 
   
    //echo $mysqli->host_info . "\n";
    $mysqli->query("SET NAMES 'cp1251'"); 
    $mysqli->query("SET CHARACTER SET 'cp1251'");
    $mysqli->query("SET SESSION collation_connection = 'cp1251'");
    $res = $mysqli->query($eq1);
    $row = $res->fetch_assoc();
    return $row['entity_id'];
}

function get_autolink ($s1)
{
//$s1="CONTE 400 DEN";
$s2=mb_strtolower($s1);
//echo $s2;
$s3=str_replace(" ","-",$s2);
return $s3;
}

function do_insert_varchar_attributes ($table,$sku_value, $mysqli, $product_name, $sku_mf, $auto_link, $color, $size)
{

//$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";
$mysqli->query("SET NAMES 'cp1251'"); 
$mysqli->query("SET CHARACTER SET 'cp1251'");
$mysqli->query("SET SESSION collation_connection = 'cp1251'");


//Product Name
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID(), '4', '71', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_name."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}



//Sku_mf
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+1, '4', '144', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$sku_mf."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Short link
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+2, '4', '97', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$auto_link."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Color
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+3, '4', '137', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$color."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}


//Нулевка1
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+4, '4', '153', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+5, '4', '154', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка3
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+6, '4', '82', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}    

//Нулевка4
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+7, '4', '84', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка5
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+8, '4', '157', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Атрибуты склада и магазина 
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+9, '4', '118', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '2');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+10, '4', '119', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '4');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

// Размер
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+11, '4', '136', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$size."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE); 

}

function do_insert_text_attributes ($table,$sku_value, $mysqli, $product_description, $product_short_description)
{
$mysqli->query("SET NAMES 'utf8'"); 
$mysqli->query("SET CHARACTER SET 'utf8'");
$mysqli->query("SET SESSION collation_connection = 'utf8'");    
 
//Product description

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID(), '4', '72', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_description."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Product short description

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+1, '4', '73', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_short_description."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка 1
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+2, '4', '83', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+3, '4', '106', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE);

}


function do_insert_decimal_attributes ($table,$sku_value, $mysqli, $product_price)
{
$mysqli->query("SET NAMES 'utf8'"); 
$mysqli->query("SET CHARACTER SET 'utf8'");
$mysqli->query("SET SESSION collation_connection = 'utf8'");    
 
//Product price

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID(), '4', '75', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_price."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка 1
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+1, '4', '76', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+2, '4', '120', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE);

}

function do_insert_int_attributes ($table,$sku_value, $mysqli, $product_status, $product_visibility, $product_brand, $product_type)
{
$mysqli->query("SET NAMES 'utf8'"); 
$mysqli->query("SET CHARACTER SET 'utf8'");
$mysqli->query("SET SESSION collation_connection = 'utf8'");    
 
//Нулека 1 - Product featured

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID(), '4', '133', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '0');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Product brand

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+1, '4', '142', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_brand."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Product type

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+2, '4', '156', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_type."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Product status

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+3, '4', '96', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_status."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Product visibility

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+4, '4', '102', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '".$product_visibility."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулёвка 2 - tax_class_id

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+5, '4', '121', '0', '".get_product_id('sku', $sku_value, $mysqli)."', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулёвка 3 - price_cahnge_allow

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+6, '4', '145', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '0');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулёвка 4 - is_reccuring

 $eq1="INSERT INTO `".$table."` (`value_id`, `entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES (LAST_INSERT_ID()+7, '4', '100', '0', '".get_product_id('sku', $sku_value, $mysqli)."', '0');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE);

}

?>
</html>
