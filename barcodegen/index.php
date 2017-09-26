<?php
//header('Location: html/code39.php');

require_once("RadPlusBarcode.php");

$filename = new RadPlusBarcode();
$code = $filename->parseCode('20556410'); 
echo '<img border="0" src="'.$code.'">';


?>

