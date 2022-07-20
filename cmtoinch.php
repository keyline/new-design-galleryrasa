<?php

echo $cm = "12.5 x 12.7 x 13.5 cms";
echo '<br>';
$cmarr1 = explode('x', $cm);

//print_r($cmarr1);


echo $length = trim($cmarr1[0]);
echo '<br>';
echo $breadth = trim($cmarr1[1]);
echo '<br>';
$heightstr = trim($cmarr1[2]);

//echo $heightstr;
//echo '<br>';
preg_match_all('!\d+\.*\d*!', $heightstr, $heightarr);

//var_dump the result
var_dump($heightarr);
echo $height = $heightarr[0][0];

//preg_match_all('!\d+!', $heightstr, $height);
//echo $height[0][0];
//echo $height = filter_var($heightstr, FILTER_SANITIZE_NUMBER_INT);
//echo '<br>';
echo '<br>';
echo 'INCHES: ';
echo '<br>';
$lengthfloat = floatval($length);
$lengthinch = $lengthfloat * 0.393700787;
echo $lengthinch = round(floatval($lengthinch), 1);

echo '<br>';
$breadthfloat = floatval($breadth);
$breadthinch = $breadthfloat * 0.393700787;
echo $breadthinch = round(floatval($breadthinch), 1);

echo '<br>';
$heightfloat = floatval($height);
$heightinch = $heightfloat * 0.393700787;
echo $heightinch = round(floatval($heightinch), 1);

echo '<br>';