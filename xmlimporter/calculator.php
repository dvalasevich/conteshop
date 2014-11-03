<!DOCTYPE html>
<html>
<head>
    <head> <meta http-equiv="content-type" content="text/html; charset=utf8"></head>
<title>
Conte XML Importer by Vitaly Soroko
</title>
<style>
header, nav, footer, section
{
text-align: center;
}
</style>
</head>
<body>
  <header> Conte XML Importer ver.0.1 Alpha by Vitaly Soroko</header>
  <nav> <a href="options.html"> Options </a></nav>
  <article>
    <section>
	
     <br />
	 <h1> Step 3 - Data import </h1>
	 
	 
	 <b>You have selected the following file:</b><br /><br />

<?php
//print "Calculating ...";
print $_POST['file'];
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
                        }
                        $reader->read();
                        if (isset($item[$name]) && is_array($item[$name])){
                            $item[$name]['value'] = $reader->value;
                        }else
                            $item[$name] = $reader->value;
 
                    }
                    if ($reader->nodeType == XMLReader::END_ELEMENT && $reader->localName == 'product')
                        break;
                }
                // � ���� ����� �� ��� ����� �������������� ������ � ����� �������� ��� �� ����� ���� ���������
                //print_r($item);
            }
    }
}

print '<br /><br /> Products count in file = '.$count;
?>
<br /><br />
<form action="calculator.php" method="post" enctype="multipart/form-data">
<input type="button" value="<- Back" OnClick="javascript: history.go(-1);" /> &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp
<?php
print '<INPUT TYPE=HIDDEN NAME=file VALUE="'.$_POST['file'].'">';
?>
<INPUT TYPE=HIDDEN NAME=parsing VALUE="True">
<input type="submit" value="Start Import" />
	 <br />
	 <br />
	 Import Log
	 <br />
	 <br />
	 <div id="log_area" style="border: 2px solid; min-width: 30vh; min-height: 40vh; max-height: 60vh; overflow-y: scroll;">
             <?php
             if ($_POST['parsing']!='True')
             {
             echo " <br /> Parsing not performed yet ...";
             }
             else
             {
                 print "<br /> Parsing ... <br /> <br />";
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
             }
             ?>
	 </div>
	 <br />
	 <br />
</form>
    </section>
  </article>
  <footer>Conte 2014</footer>
</body>
</html>
