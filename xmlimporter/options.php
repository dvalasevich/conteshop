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

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

//атрибуты

$attr1 = 'description1';




