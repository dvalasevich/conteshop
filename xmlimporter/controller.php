<?php
include_once 'test2.php';

class OpenFile
{
public function OpenFromUserDisk($path)
{
$uploaddir = $path;
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "���� ��������� � ��� ������� ��������.\n";
} else {
    echo "������ �������� ����� �� ������\n";
}
print 'File Uploaded';
}
public function ListFromServer($path)
{
//Initializing
$all_files=array();
//$myList = new ListFiles();
GetListFiles($path,$all_files);
//nt_r($all_files); 


//Priniting
$i=0;
$i2=0;
foreach ($all_files as $value) {
$i=$i+2;
$i2=$i+1;
//print '<DIV id="u1000'.$i.'container">';
print '<LABEL for="u1000'.$i.'" style="min-width: 250px;">';
print '<INPUT id="u1000'.$i.'" name="u1000"  type="radio" value="'.$value.'"   data-label="'.$value.'">';
print $value;
print '</LABEL> <br/>';

//print '</DIV>';

}
}

}
class TestFile
{
public function VerifyFile($path)
{
$reader = new XMLReader();

if (!$reader->open($path)) {
echo "Can't open the file";
 die('Cannot open the file');
}
else
{
echo "All ok";
}
//Проверка струкуткры документа

$reader->setParserProperty(XMLReader::VALIDATE, true);
if (!$reader->isValid()) {
 die('Неправильный XML');
}

}
//end class TestFile
}

?>