<?php
include_once 'model.php';

$product1 = new Product();
echo $product1->productVisibility;
echo $product1->insert_all();
echo $product1->productVisibility;