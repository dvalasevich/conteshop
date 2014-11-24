<?php

//include_once 'import.php';
//include_once 'options.php';

class Product
{
    public $productSku;
    public $productName;
    public $productDescription;
    public $productShortDescription;
    public $productSkuMf;
    public $productStatus = '1';
    public $productVisibility = '4';
    public $productBrand;
    public $productType;
    public $productPrice;
    public $productColor;
    public $productSize;
    public $productMaterial = [];
    
    public $productMainTable = 'catalog_product_entity';
    public $productDateTable = 'catalog_product_entity_datetime';
    public $productVarCharTable = 'catalog_product_entity_varchar';
    public $productTextTable = 'catalog_product_entity_text';
    public $productDecimalTable = 'catalog_product_entity_decimal';
    public $productIntTable = 'catalog_product_entity_int';
    
    //new
    
    //public $productModel;
    //public $productPatternName;
    public $productModelCode;
    public $productTypeCode;
    public $productPatternCode;
    public $productSizeCode;
    public $productColorCode;
    
    //additional
    
    public $productMaterialRu;
    public $productMaterialEn;
    public $productWeightNetto;
    public $productWeightBrutto;
    
    
    
}