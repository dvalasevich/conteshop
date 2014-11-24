<html>
    <body>

<?php

include_once 'import.php';
include_once 'options.php';

echo "Inserting sku in test table ... <br>";

$dbHost='localhost'; // чаще всего это так, но иногда требуется прописать ip адрес базы данных 
$dbName='test_bd'; // название вашей базы 
$dbUser='root'; // пользователь базы данных 
$dbPass='qwer1234'; // пароль пользователя
$dbTable='table1';

$conn1 = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

$conn1->query("SET NAMES 'utf8'"); 
$conn1->query("SET CHARACTER SET 'utf8'");
$conn1->query("SET SESSION collation_connection = 'utf8'");    

/*
//вставляем sku, таблица catalog_product_entity
do_insert_sku('sku', '12111110', $conn1);
//mysqli_commit($conn1);
//mysqli_close($conn1);
//$conn1 = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
//$conn1->init();

$conn1->refresh(MYSQLI_REFRESH_HOSTS);

do_insert_sku('sku', '12111111', $conn1);
//mysqli_commit($conn1);
//mysqli_close($conn1);
//$conn1 = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
$conn1->refresh(MYSQLI_REFRESH_HOSTS);
//$conn1->;

do_insert_sku('sku', '12111112', $conn1);
//mysqli_commit($conn1);
*/

//вставляем аттрибуты с датами (которых поумолчанию нету вообще)
//print get_product_id('sku', '22111110', $conn);
//do_insert_entity_datetime('entity_datetime', '22111110', $conn);
//        do_insert_varchar_attributes('entity_varchar', '22111110', $conn, 'CLASS 301 60 DEN' , '30160FGHH', get_autolink('CLASS 301 60 DEN'), 'Nero2','2');
        do_insert_text_attributes2('entity_text', '22111110', $conn1, 'КОлготки с параметрами 1 23  34 53 456 345', 'Колготки');
// do_insert_decimal_attributes('entity_decimal', '22111110', $conn, '100000');
//do_insert_int_attributes('entity_int', '22111110', $conn, '1', '4', '9','531'); 
        
        
        function do_insert_text_attributes2 ($table,$sku_value, $mysqli, $product_description, $product_short_description)
{
$mysqli->query("SET NAMES 'utf8'"); 
$mysqli->query("SET CHARACTER SET 'utf8'");
$mysqli->query("SET SESSION collation_connection = 'utf8'");    
 
//Product description

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '72', '0', '88', '".mysql_escape_string($product_description)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Product short description

 $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '73', '0', '88', '".mysql_escape_string($product_short_description)."');";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка 1
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '83', '0', '88', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

//Нулевка2
    $eq1="INSERT INTO `".$table."` (`entity_type_id`, `attribute_id`, `store_id`, `entity_id`, `value`) VALUES ('4', '106', '0', '88', NULL);";
    
   
if (!$mysqli->query($eq1)) 
               {
    echo "<br> Не удалось вставить значение sku ".$sku_value." в поле таблицы ".$table." по причине: (" . $mysqli->errno . ") " . $mysqli->error;
    echo "<br> Запрос : ".$eq1;
    
}

mysqli_autocommit($mysqli, TRUE);
mysqli_autocommit($mysqli, FALSE);

}
        
        ?>
    </body> 
</html>