<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$dbHost='localhost'; // чаще всего это так, но иногда требуется прописать ip адрес базы данных 
$dbName='contedev_db'; // название вашей базы 
$dbUser='root'; // пользователь базы данных 
$dbPass='7IjEcvHtxpSqoU'; // пароль пользователя
$dbTable='table1';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

//$conn->
//атрибуты

$attr1 = 'description1';

class Connection
{
public $dbHost='localhost'; // чаще всего это так, но иногда требуется прописать ip адрес базы данных 
public $dbName='contedev_db'; // название вашей базы 
public $dbUser='root'; // пользователь базы данных 
public $dbPass='qwer1234'; // пароль пользователя
public $dbTable='table1';   
}

