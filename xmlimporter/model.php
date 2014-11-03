<?php
include_once 'import.php';
include_once 'options.php';

class Product
{
    public $productSku;
    public $productName;
    public $productDescription;
    public $productShortDescription;
    public $productSkuMf;
    public $productStatus;
    public $productVisibility = '4';
    public $productBrand;
    public $productType;
    public $productPrice;
    
    public $productMainTable = 'catalog_product_entity';
    public $productDateTable = 'catalog_product_entity_datetime';
    public $productVarCharTable = 'catalog_product_entity_varchar';
    public $productTextTable = 'catalog_product_entity_text';
    public $productDecimalTable = 'catalog_product_entity_decimal';
    public $productIntTable = 'catalog_product_entity_int';
    
    public function insert_all()
    {
        $this->productVisibility=5;
        
        
        do_insert_sku($this->productMainTable, $this->productSku, $conn);
        //вставляем аттрибуты с датами (которых поумолчанию нету вообще)
        //print get_product_id('sku', $this->productSku, $conn);
        do_insert_entity_datetime($this->productDateTable, $this->productSku, $conn);
        do_insert_varchar_attributes($this->productVarCharTable, $this->productSku, $conn, 'CLASS 301 60 DEN' , '30160FGHH', get_autolink('CLASS 301 60 DEN'), 'Nero2','2');
        do_insert_text_attributes($this->productTextTable, $this->productSku, $conn, 'КОлготки с параметрами 1 23  34 53 456 345', 'Колготки');
        do_insert_decimal_attributes($this->productDecimalTable, $this->productSku, $conn, '100000');
        do_insert_int_attributes($this->productIntlTable, $this->productSku, $conn, '1', '4', '9','531'); 
    }
    
}