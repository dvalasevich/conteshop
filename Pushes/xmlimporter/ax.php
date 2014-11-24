        <?php 
        include_once 'import.php'; 
        include_once 'options.php'; 
        ?>
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
//echo  "Can't open the file";
 die('Cannot open the file');
}
else
{
////echo  "All ok";
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
             include_once 'model.php';
             include_once 'import.php';
             include_once 'options.php';
             if ($_POST['parsing']!='True')
             {
             echo  " <br /> Something goes very wrong ..";
             }
             else
             {
                 print "<br /> Importing additional atrributes ... <br /> <br />";
//print $_POST['file'];
$path = 'xml_files/'.$_POST['file'];
$reader = new XMLReader();

if (!$reader->open($path)) {
//echo  "Can't open the file";
 die('Cannot open the file');
}
else
{
////echo  "All ok";
}

$count=0;
$materialcount = 1;

$parseObject = new Product();


$dbHost='localhost'; // чаще всего это так, но иногда требуется прописать ip адрес базы данных 
$dbName='contedev_db'; // название вашей базы 
$dbUser='root'; // пользователь базы данных 
$dbPass='qwer1234'; // пароль пользователя
$dbTable='table1';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

$conn->query("SET NAMES 'utf8'"); 
$conn->query("SET CHARACTER SET 'utf8'");
$conn->query("SET SESSION collation_connection = 'utf8'");  

//$parseObject->productBrand = '';

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
                        while ($reader->moveToNextAttribute())
                        {
                            
                            $item[$name]['__attribs'][$reader->localName] = $reader->value;
                            
                                                     
                            if ($name == 'sku')
                            {
                              $parseObject->productSku = $reader->value;
                            }
                            
                            if ($name == 'sku_mf')
                            {
                              $parseObject->productSkuMf = $reader->value;
                            }
                            
                            if ($name == 'status')
                            {
                              $parseObject->productStatus = $reader->value;
                            }
                            
                           
                            
                        }
                        $reader->read();
                        if (isset($item[$name]) && is_array($item[$name])){
                            $item[$name]['value'] = $reader->value;
                            
                                                       
                            if ($name == 'sku')
                            {
                              $parseObject->productSku = $reader->value;
                            }
                            
                            if ($name == 'sku_mf')
                            {
                              $parseObject->productSkuMf = $reader->value;
                            }
                            
                            if ($name == 'status')
                            {
                              $parseObject->productStatus = $reader->value;
                            }
                            
                        }else
                            
                            $item[$name] = $reader->value;
                            ////echo  "Имя атрибута : ".$name." <br> Значение: ".$reader->value." <br /> ------------------------------------------------- <br />";
 
                            if ($name == 'sku')
                            {
                              $parseObject->productSku = $reader->value;
                            }
                            
                            if ($name == 'sku_mf')
                            {
                              $parseObject->productSkuMf = $reader->value;
                            }
                            
                            if ($name == 'status')
                            {
                              $parseObject->productStatus = $reader->value;
                            }
                            
                    }
                    if ($reader->nodeType == XMLReader::END_ELEMENT && $reader->localName == 'product')
                        break;
                }
                // � ���� ����� �� ��� ����� �������������� ������ � ����� �������� ��� �� ����� ���� ���������
                //print_r($item);
                ////echo  "Next product";
                //print "<br />".$parseObject->productSku."<br />";
                //$parseObject->productSkuMf="test";
                //print "<br />".$parseObject->productSkuMf."<br />";
                
                
                
                ////echo  $parseObject->productSku;
                
                             
                insert_all($parseObject, $conn);
                //mysqli_commit($conn);
                //mysqli_close($conn);
                $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
                //$count= $count +1;
                print " ".$count;
                $materialcount = 0;
            }
    }
}

print '<br /><br /> Total products parsed : '.$count;
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
