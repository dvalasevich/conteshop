<?php
function get_autolink ($s1)
{
//$s1="CONTE 400 DEN";
$s2=mb_strtolower($s1);
//echo $s2;
$s3=str_replace(" ","-",$s2);
return $s3;
}