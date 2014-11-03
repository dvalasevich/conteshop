<?php
$content = file_get_contents("http://192.168.0.183/skin/frontend/default/theme556/images/logo/logo.jpg");
  // Записать полученное содержимое в файл image.png
  file_put_contents("/var/www/html/xmlimporter/images/image_c.jpg",$content); 
  print "<body> <img src='images/image_c.jpg'></body>";