<html>
    <body>

<?php

include_once 'import.php';
include_once 'options.php';

echo "Inserting sku in test table ... <br>";

//вставляем sku, таблица catalog_product_entity
//do_insert_sku('sku', '22111110', $conn);
//вставляем аттрибуты с датами (которых поумолчанию нету вообще)
//print get_product_id('sku', '22111110', $conn);
//do_insert_entity_datetime('entity_datetime', '22111110', $conn);
//        do_insert_varchar_attributes('entity_varchar', '22111110', $conn, 'CLASS 301 60 DEN' , '30160FGHH', get_autolink('CLASS 301 60 DEN'), 'Nero2','2');
//        do_insert_text_attributes('entity_text', '22111110', $conn, 'КОлготки с параметрами 1 23  34 53 456 345', 'Колготки');
// do_insert_decimal_attributes('entity_decimal', '22111110', $conn, '100000');
do_insert_int_attributes('entity_int', '22111110', $conn, '1', '4', '9','531'); 
        ?>
    </body> 
</html>