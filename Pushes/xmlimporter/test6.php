<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dbHost='localhost'; // чаще всего это так, но иногда требуется прописать ip адрес базы данных 
$dbName='test_bd'; // название вашей базы 
$dbUser='root'; // пользователь базы данных 
$dbPass='qwer1234'; // пароль пользователя
$dbTable='table1';

$conn1 = new mysqli($dbHost, $dbUser, $dbPass, $dbName);


$str1 = "Can't insert this ;";
$str2 = mysqli_escape_string($str1, $conn1);
echo $str1."<br>";
echo $str2;

$item = "Zak's and Derick's Laptop";
$escaped_item = mysql_escape_string($item);
printf ("Escaped string: %s\n", $escaped_item);