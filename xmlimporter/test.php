<?php
$reader = new XMLReader();

if (!$reader->open('test.xml')) {
echo "<body> Can't open the file </body>";
 die('Cannot open the file');
}
else
{
echo "<body> All ok :) </body>";
}
//Проверка струкуткры документа

$reader->setParserProperty(XMLReader::VALIDATE, true);
if (!$reader->isValid()) {
 die('Неправильный XML');
}


$all_files=array();
GetListFiles("xml_files",$all_files);
print_r($all_files);

foreach ($all_files as $value) {
// �������� � $value
print '<p>'.$value.'</p>';
}
print "test_from_index.php";
include_once 'controller.php';
$v1 = new OpenFile();
$v1->ListFromServer('xml_files');
