<!DOCTYPE html>
<html>
    <head> <meta http-equiv="content-type" content="text/html; charset=utf8"></head>

<?php
print "Parsing ... <br /> <br />";
//print $_POST['file'];
$path = 'xml_files/'.$_POST['file'];
$reader = new XMLReader();

if (!$reader->open($path)) {
echo "Can't open the file";
 die('Cannot open the file');
}
else
{
//echo "All ok";
}

$count=0;

$item = array();
while ($reader->read()) {
    switch ($reader->nodeType) {
        case (XMLReader::ELEMENT):
            // ���� ������� � xml ������� <item> �������� ������������ ���
            if ($reader->localName == 'product') {
		$count=$count+1;
                // �� ����� ����������� ������ ������� ����� ��������� ��� �������� �������� �������� <item>
                $item = array();
                while ($reader->read()){
                    if ($reader->nodeType == XMLReader::ELEMENT) {
                        $name = strtolower($reader->localName);
                        while ($reader->moveToNextAttribute()){
                            // ����� �� �������� �������� ���� ��� ����
                            $item[$name]['__attribs'][$reader->localName] = $reader->value;
                            echo "Имя атрибута :".$reader->localName." значение: ".$reader->value;
                        }
                        $reader->read();
                        if (isset($item[$name]) && is_array($item[$name])){
                            $item[$name]['value'] = $reader->value;
                            echo "Имя атрибута :".$reader->localName." значение: ".$reader->value;
                        }else
                            $item[$name] = $reader->value;
                            echo "Имя атрибута : ".$name." <br> Значение: ".$reader->value." <br /> ------------------------------------------------- <br />";
 
                    }
                    if ($reader->nodeType == XMLReader::END_ELEMENT && $reader->localName == 'product')
                        break;
                }
                // � ���� ����� �� ��� ����� �������������� ������ � ����� �������� ��� �� ����� ���� ���������
                //print_r($item);
            }
    }
}

print '<br /><br /> Products parsed : '.$count;