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
</form>
<br />
<form action="ax.php" method="post" enctype="multipart/form-data">
<?php
print '<INPUT TYPE=HIDDEN NAME=file VALUE="'.$_POST['file'].'">';
?>
<INPUT TYPE=HIDDEN NAME=parsing VALUE="True">
<input type="submit" value="More Attributes" />
</form>
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
             echo  " <br /> Parsing not performed yet ...";
             }
             else
             {
                 print "<br /> Parsing ... <br /> <br />";
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
$dbPass='7IjEcvHtxpSqoU'; // пароль пользователя
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
                        while ($reader->moveToNextAttribute()){
                            // ����� �� �������� �������� ���� ��� ����
                            $item[$name]['__attribs'][$reader->localName] = $reader->value;
                            
                            
                            if ($name == 'name')
                            {
                              ////echo  "found name";
                              $parseObject->productName = $reader->value;
                            }
                            
                            if ($name == 'price')
                            {
                              $parseObject->productPrice = $reader->value;
                            }
                            
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
                            
                            if ($name == 'descriptrion')
                            {
                              $parseObject->productDescription = $reader->value;
                            }
                            
                            if ($name == 'short_descriptrion')
                            {
                              $parseObject->productShortDescription = $reader->value;
                            }
                            
                            if ($name == 'size')
                            {
                              $parseObject->productSize = $reader->value;
                            }
                            
                          if ($name == 'type')
                            {
                            
                                                             
                              switch ($reader->value) {
                              case 'DiWaRi':
                              $parseObject->productType = '557';
                              break;
                              case 'DiWaRi трусы муж.':
                              $parseObject->productType = '558';
                              break;
                              case 'ESLI':
                              $parseObject->productType = '559';
                              break;
                              case 'ESLI трусы жен.':
                              $parseObject->productType = '560';
                              break;
                              case 'SEAMLESS':
                              $parseObject->productType = '561';
                              break;
                              case 'Аксессуар ESLI':
                              $parseObject->productType = '563';
                              break;
                              case 'Бельевой трикотаж ESLI':
                              $parseObject->productType = '564';
                              break;
                              case 'Берет дет.':
                              $parseObject->productType = '565';
                              break;
                              case 'Брюки жен.':
                              $parseObject->productType = '566';
                              break;
                              case 'Гетры':
                              $parseObject->productType = '567';
                              break;
                              case 'Гольфины жен. хлопковые':
                              $parseObject->productType = '562';
                              break;
                              case 'Гольфы дет.':
                              $parseObject->productType = '572';
                              break;
                              case 'Гольфы дет. нарядные':
                              $parseObject->productType = '571';
                              break;
                              case 'Гольфы дет. праздничные':
                              $parseObject->productType = '570';
                              break;
                              case 'Гольфы жен.':
                              $parseObject->productType = '569';
                              break;
                              case 'Гольфы жен. хлопковые':
                              $parseObject->productType = '568';
                              break;
                              case 'ИКТ ESLI':
                              $parseObject->productType = '573';
                              break;
                              case 'ИКТ ESLI-kids':
                              $parseObject->productType = '574';
                              break;
                              case 'Колготки дет.':
                              $parseObject->productType = '575';
                              break;
                              case 'Колготки дет. нарядные':
                              $parseObject->productType = '576';
                              break;
                              case 'Колготки дет. полиамидные':
                              $parseObject->productType = '577';
                              break;
                              case 'Колготки дет. праздничные':
                              $parseObject->productType = '582';
                              break;
                              case 'Колготки дет. соц.':
                              $parseObject->productType = '581';
                              break;
                              case 'Колготки жен.':
                              $parseObject->productType = '580';
                              break;
                              case 'Колготки жен. хлопковые':
                              $parseObject->productType = '579';
                              break;
                              case 'Комплект дет. трикотажный':
                              $parseObject->productType = '578';
                              break;
                              case 'Леггинсы жен.':
                              $parseObject->productType = '583';
                              break;
                              case 'Легинсы дет. нарядные':
                              $parseObject->productType = '584';
                              break;
                              case 'Легинсы дет. полиамидные':
                              $parseObject->productType = '585';
                              break;
                              case 'Легинсы для девочек':
                              $parseObject->productType = '586';
                              break;
                              case 'Легинсы для мальчиков':
                              $parseObject->productType = '587';
                              break;
                              case 'Легинсы жен.':
                              $parseObject->productType = '588';
                              break;
                              case 'Легинсы жен. вискозные':
                              $parseObject->productType = '589';
                              break;
                              case 'Легинсы жен. хлопковые':
                              $parseObject->productType = '590';
                              break;
                              case 'Майка жен.':
                              $parseObject->productType = '591';
                              break;
                              case 'Набор чулочно-носочных изделий':
                              $parseObject->productType = '592';
                              break;
                              case 'Носки дет.':
                              $parseObject->productType = '593';
                              break;
                              case 'Носки жен.':
                              $parseObject->productType = '594';
                              break;
                              case 'Носки жен. вискозные':
                              $parseObject->productType = '595';
                              break;
                              case 'Носки жен. хлопковые':
                              $parseObject->productType = '596';
                              break;
                              case 'Носки муж.':
                              $parseObject->productType = '597';
                              break;
                              case 'Трикотаж DiWaRi':
                              $parseObject->productType = '598';
                              break;
                              case 'Трикотаж бельевой дет. CONTE KIDS':
                              $parseObject->productType = '599';
                              break;
                              case 'Трикотаж верхний дет. CONTE KIDS':
                              $parseObject->productType = '600';
                              break;
                              case 'Трусы жен.':
                              $parseObject->productType = '601';
                              break;
                              case 'Шапка дет.':
                              $parseObject->productType = '602';
                              break;
                              case 'Чулки жен.':
                              $parseObject->productType = '603';
                              break;
                              case 'Шарф дет.':
                              $parseObject->productType = '604';
                              break;
                              case 'Шарф манишка дет.':
                              $parseObject->productType = '605';
                              break;
                              case 'Шарфовые изделия':
                              $parseObject->productType = '606';
                              break;
                              default:
                              $parseObject->productType = '607';
                              break;
                              
                              }
                              
                                
                            }
                              
                            if ($name == 'material_value')
                            {
                                   $materialcount = $materialcount +1;
                                   $parseObject->productMaterial[$materialcount] = $reader->value;
                            }
                              
                                
                            
                            
                            if ($name == 'color')
                            {
                              $parseObject->productColor = $reader->value;
                            }
                            ////echo  "Имя атрибута :".$name." значение: ".$reader->value;
                              //new
                            
                            //if ($name == 'pattern_name')
                            //{
                            //   $parseObject->productPatternName = $reader->value;
                            // }
                            
                            if ($name == 'model_code')
                            {
                              $parseObject->productModelCode = $reader->value;
                            }
                            
                            if ($name == 'type_code')
                            {
                              $parseObject->productTypeCode = $reader->value;
                            }
                            
                            if ($name == 'pattern_code')
                            {
                              $parseObject->productPatternCode = $reader->value;
                            }
                            
                            if ($name == 'size_code')
                            {
                              $parseObject->productSizeCode = $reader->value;
                            }
                            
                            if ($name == 'color_code')
                            {
                              $parseObject->productColorCode = $reader->value;
                            }
                            
                            if ($name == 'material_ru')
                            {
                              $parseObject->productMaterialRu = $reader->value;
                            }
                            
                            if ($name == 'material_en')
                            {
                              $parseObject->productMaterialEn = $reader->value;
                            }
                            
                            if ($name == 'weight')
                            {
                              $parseObject->productWeightBrutto = $reader->value;
                            }
                            
                        }
                        $reader->read();
                        if (isset($item[$name]) && is_array($item[$name])){
                            $item[$name]['value'] = $reader->value;
                            
                             if ($name == 'name')
                            {
                              ////echo  "found name";
                              $parseObject->productName = $reader->value;
                            }
                            
                            if ($name == 'price')
                            {
                              $parseObject->productPrice = $reader->value;
                            }
                            
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
                            
                            if ($name == 'descriptrion')
                            {
                              $parseObject->productDescription = $reader->value;
                            }
                            
                            if ($name == 'short_descriptrion')
                            {
                              $parseObject->productShortDescription = $reader->value;
                            }
                            
                            if ($name == 'size')
                            {
                              $parseObject->productSize = $reader->value;
                            }
                            
                           if ($name == 'type')
                            {
                            
                                                             
                              switch ($reader->value) {
                              case 'DiWaRi':
                              $parseObject->productType = '557';
                              break;
                              case 'DiWaRi трусы муж.':
                              $parseObject->productType = '558';
                              break;
                              case 'ESLI':
                              $parseObject->productType = '559';
                              break;
                              case 'ESLI трусы жен.':
                              $parseObject->productType = '560';
                              break;
                              case 'SEAMLESS':
                              $parseObject->productType = '561';
                              break;
                              case 'Аксессуар ESLI':
                              $parseObject->productType = '563';
                              break;
                              case 'Бельевой трикотаж ESLI':
                              $parseObject->productType = '564';
                              break;
                              case 'Берет дет.':
                              $parseObject->productType = '565';
                              break;
                              case 'Брюки жен.':
                              $parseObject->productType = '566';
                              break;
                              case 'Гетры':
                              $parseObject->productType = '567';
                              break;
                              case 'Гольфины жен. хлопковые':
                              $parseObject->productType = '562';
                              break;
                              case 'Гольфы дет.':
                              $parseObject->productType = '572';
                              break;
                              case 'Гольфы дет. нарядные':
                              $parseObject->productType = '571';
                              break;
                              case 'Гольфы дет. праздничные':
                              $parseObject->productType = '570';
                              break;
                              case 'Гольфы жен.':
                              $parseObject->productType = '569';
                              break;
                              case 'Гольфы жен. хлопковые':
                              $parseObject->productType = '568';
                              break;
                              case 'ИКТ ESLI':
                              $parseObject->productType = '573';
                              break;
                              case 'ИКТ ESLI-kids':
                              $parseObject->productType = '574';
                              break;
                              case 'Колготки дет.':
                              $parseObject->productType = '575';
                              break;
                              case 'Колготки дет. нарядные':
                              $parseObject->productType = '576';
                              break;
                              case 'Колготки дет. полиамидные':
                              $parseObject->productType = '577';
                              break;
                              case 'Колготки дет. праздничные':
                              $parseObject->productType = '582';
                              break;
                              case 'Колготки дет. соц.':
                              $parseObject->productType = '581';
                              break;
                              case 'Колготки жен.':
                              $parseObject->productType = '580';
                              break;
                              case 'Колготки жен. хлопковые':
                              $parseObject->productType = '579';
                              break;
                              case 'Комплект дет. трикотажный':
                              $parseObject->productType = '578';
                              break;
                              case 'Леггинсы жен.':
                              $parseObject->productType = '583';
                              break;
                              case 'Легинсы дет. нарядные':
                              $parseObject->productType = '584';
                              break;
                              case 'Легинсы дет. полиамидные':
                              $parseObject->productType = '585';
                              break;
                              case 'Легинсы для девочек':
                              $parseObject->productType = '586';
                              break;
                              case 'Легинсы для мальчиков':
                              $parseObject->productType = '587';
                              break;
                              case 'Легинсы жен.':
                              $parseObject->productType = '588';
                              break;
                              case 'Легинсы жен. вискозные':
                              $parseObject->productType = '589';
                              break;
                              case 'Легинсы жен. хлопковые':
                              $parseObject->productType = '590';
                              break;
                              case 'Майка жен.':
                              $parseObject->productType = '591';
                              break;
                              case 'Набор чулочно-носочных изделий':
                              $parseObject->productType = '592';
                              break;
                              case 'Носки дет.':
                              $parseObject->productType = '593';
                              break;
                              case 'Носки жен.':
                              $parseObject->productType = '594';
                              break;
                              case 'Носки жен. вискозные':
                              $parseObject->productType = '595';
                              break;
                              case 'Носки жен. хлопковые':
                              $parseObject->productType = '596';
                              break;
                              case 'Носки муж.':
                              $parseObject->productType = '597';
                              break;
                              case 'Трикотаж DiWaRi':
                              $parseObject->productType = '598';
                              break;
                              case 'Трикотаж бельевой дет. CONTE KIDS':
                              $parseObject->productType = '599';
                              break;
                              case 'Трикотаж верхний дет. CONTE KIDS':
                              $parseObject->productType = '600';
                              break;
                              case 'Трусы жен.':
                              $parseObject->productType = '601';
                              break;
                              case 'Шапка дет.':
                              $parseObject->productType = '602';
                              break;
                              case 'Чулки жен.':
                              $parseObject->productType = '603';
                              break;
                              case 'Шарф дет.':
                              $parseObject->productType = '604';
                              break;
                              case 'Шарф манишка дет.':
                              $parseObject->productType = '605';
                              break;
                              case 'Шарфовые изделия':
                              $parseObject->productType = '606';
                              break;
                              default:
                              $parseObject->productType = '607';
                              break;
                              
                              }
                              
                                
                            }
                            
                            if ($name == 'material_value')
                            {
                                   $materialcount = $materialcount +1;
                                   $parseObject->productMaterial[$materialcount] = $reader->value;
                            }
                            
                            if ($name == 'color')
                            {
                              $parseObject->productColor = $reader->value;
                            }
                            //echo  "Имя атрибута :".$name." значение: ".$reader->value;
                            //new
                            
                            //if ($name == 'pattern_name')
                            //{
                            //  $parseObject->productPatternName = $reader->value;
                            //}
                            
                            if ($name == 'model_code')
                            {
                              $parseObject->productModelCode = $reader->value;
                            }
                            
                            if ($name == 'type_code')
                            {
                              $parseObject->productTypeCode = $reader->value;
                            }
                            
                            if ($name == 'pattern_code')
                            {
                              $parseObject->productPatternCode = $reader->value;
                            }
                            
                            if ($name == 'size_code')
                            {
                              $parseObject->productSizeCode = $reader->value;
                            }
                            
                            if ($name == 'color_code')
                            {
                              $parseObject->productColorCode = $reader->value;
                            }
                            
                             if ($name == 'material_ru')
                            {
                              $parseObject->productMaterialRu = $reader->value;
                            }
                            
                            if ($name == 'material_en')
                            {
                              $parseObject->productMaterialEn = $reader->value;
                            }
                            
                            if ($name == 'weight')
                            {
                              $parseObject->productWeightBrutto = $reader->value;
                            }
                            
                            
                        }else
                            
                            $item[$name] = $reader->value;
                            ////echo  "Имя атрибута : ".$name." <br> Значение: ".$reader->value." <br /> ------------------------------------------------- <br />";
 
                            if ($name == 'name')
                            {
                              
                              $parseObject->productName = $reader->value;
                              echo  " ".$parseObject->productName;
                            }
                            
                            if ($name == 'brand')
                            {
                              ////echo  "found brand";
                                
                              if ($reader->value == 'Conte elegant')
                              { $parseObject->productBrand = '9'; }
                              else
                              if ($reader->value == 'Conte kids')
                              { $parseObject->productBrand = '8'; }
                              else
                              if ($reader->value == 'ESLI')
                              { $parseObject->productBrand = '7'; }
                              else
                              if ($reader->value == 'DiWaRi')
                              { $parseObject->productBrand = '6'; }
                              else { $parseObject->productBrand = '7';}
                              
                            }
                            
                            if ($name == 'price')
                            {
                              $parseObject->productPrice = $reader->value;
                            }
                            
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
                            
                            if ($name == 'descriptrion')
                            {
                              $parseObject->productDescription = $reader->value;
                            }
                            
                            if ($name == 'short_descriptrion')
                            {
                              $parseObject->productShortDescription = $reader->value;
                            }
                            
                            if ($name == 'size')
                            {
                              $parseObject->productSize = $reader->value;
                            }
                            
                            if ($name == 'type')
                            {
                            
                                                             
                              switch ($reader->value) {
                              case 'DiWaRi':
                              $parseObject->productType = '557';
                              break;
                              case 'DiWaRi трусы муж.':
                              $parseObject->productType = '558';
                              break;
                              case 'ESLI':
                              $parseObject->productType = '559';
                              break;
                              case 'ESLI трусы жен.':
                              $parseObject->productType = '560';
                              break;
                              case 'SEAMLESS':
                              $parseObject->productType = '561';
                              break;
                              case 'Аксессуар ESLI':
                              $parseObject->productType = '563';
                              break;
                              case 'Бельевой трикотаж ESLI':
                              $parseObject->productType = '564';
                              break;
                              case 'Берет дет.':
                              $parseObject->productType = '565';
                              break;
                              case 'Брюки жен.':
                              $parseObject->productType = '566';
                              break;
                              case 'Гетры':
                              $parseObject->productType = '567';
                              break;
                              case 'Гольфины жен. хлопковые':
                              $parseObject->productType = '562';
                              break;
                              case 'Гольфы дет.':
                              $parseObject->productType = '572';
                              break;
                              case 'Гольфы дет. нарядные':
                              $parseObject->productType = '571';
                              break;
                              case 'Гольфы дет. праздничные':
                              $parseObject->productType = '570';
                              break;
                              case 'Гольфы жен.':
                              $parseObject->productType = '569';
                              break;
                              case 'Гольфы жен. хлопковые':
                              $parseObject->productType = '568';
                              break;
                              case 'ИКТ ESLI':
                              $parseObject->productType = '573';
                              break;
                              case 'ИКТ ESLI-kids':
                              $parseObject->productType = '574';
                              break;
                              case 'Колготки дет.':
                              $parseObject->productType = '575';
                              break;
                              case 'Колготки дет. нарядные':
                              $parseObject->productType = '576';
                              break;
                              case 'Колготки дет. полиамидные':
                              $parseObject->productType = '577';
                              break;
                              case 'Колготки дет. праздничные':
                              $parseObject->productType = '582';
                              break;
                              case 'Колготки дет. соц.':
                              $parseObject->productType = '581';
                              break;
                              case 'Колготки жен.':
                              $parseObject->productType = '580';
                              break;
                              case 'Колготки жен. хлопковые':
                              $parseObject->productType = '579';
                              break;
                              case 'Комплект дет. трикотажный':
                              $parseObject->productType = '578';
                              break;
                              case 'Леггинсы жен.':
                              $parseObject->productType = '583';
                              break;
                              case 'Легинсы дет. нарядные':
                              $parseObject->productType = '584';
                              break;
                              case 'Легинсы дет. полиамидные':
                              $parseObject->productType = '585';
                              break;
                              case 'Легинсы для девочек':
                              $parseObject->productType = '586';
                              break;
                              case 'Легинсы для мальчиков':
                              $parseObject->productType = '587';
                              break;
                              case 'Легинсы жен.':
                              $parseObject->productType = '588';
                              break;
                              case 'Легинсы жен. вискозные':
                              $parseObject->productType = '589';
                              break;
                              case 'Легинсы жен. хлопковые':
                              $parseObject->productType = '590';
                              break;
                              case 'Майка жен.':
                              $parseObject->productType = '591';
                              break;
                              case 'Набор чулочно-носочных изделий':
                              $parseObject->productType = '592';
                              break;
                              case 'Носки дет.':
                              $parseObject->productType = '593';
                              break;
                              case 'Носки жен.':
                              $parseObject->productType = '594';
                              break;
                              case 'Носки жен. вискозные':
                              $parseObject->productType = '595';
                              break;
                              case 'Носки жен. хлопковые':
                              $parseObject->productType = '596';
                              break;
                              case 'Носки муж.':
                              $parseObject->productType = '597';
                              break;
                              case 'Трикотаж DiWaRi':
                              $parseObject->productType = '598';
                              break;
                              case 'Трикотаж бельевой дет. CONTE KIDS':
                              $parseObject->productType = '599';
                              break;
                              case 'Трикотаж верхний дет. CONTE KIDS':
                              $parseObject->productType = '600';
                              break;
                              case 'Трусы жен.':
                              $parseObject->productType = '601';
                              break;
                              case 'Шапка дет.':
                              $parseObject->productType = '602';
                              break;
                              case 'Чулки жен.':
                              $parseObject->productType = '603';
                              break;
                              case 'Шарф дет.':
                              $parseObject->productType = '604';
                              break;
                              case 'Шарф манишка дет.':
                              $parseObject->productType = '605';
                              break;
                              case 'Шарфовые изделия':
                              $parseObject->productType = '606';
                              break;
                              default:
                              $parseObject->productType = '607';
                              break;
                              
                              }
                              
                                
                            }
                            
                            if ($name == 'material_value')
                            {
                                   $materialcount = $materialcount +1;
                                   $parseObject->productMaterial[$materialcount] = $reader->value;
                            }
                            
                            if ($name == 'color')
                            {
                              $parseObject->productColor = $reader->value;
                            }
                            //echo  "<br>Имя атрибута :".$name." значение: ".$reader->value."<br>";
                              //new
                            
                            //if ($name == 'pattern_name')
                            //{
                            //  $parseObject->productPatternName = $reader->value;
                            //}
                            
                            if ($name == 'model_code')
                            {
                              $parseObject->productModelCode = $reader->value;
                            }
                            
                            if ($name == 'type_code')
                            {
                              $parseObject->productTypeCode = $reader->value;
                            }
                            
                            if ($name == 'pattern_code')
                            {
                              $parseObject->productPatternCode = $reader->value;
                            }
                            
                            if ($name == 'size_code')
                            {
                              $parseObject->productSizeCode = $reader->value;
                            }
                            
                            if ($name == 'color_code')
                            {
                              $parseObject->productColorCode = $reader->value;
                            }
                            
                            if ($name == 'material_ru')
                            {
                              $parseObject->productMaterialRu = $reader->value;
                            }
                            
                            if ($name == 'material_en')
                            {
                              $parseObject->productMaterialEn = $reader->value;
                            }
                            
                            if ($name == 'weight')
                            {
                              $parseObject->productWeightBrutto = $reader->value;
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

    </section>
  </article>
  <footer>Conte 2014</footer>
</body>
</html>
