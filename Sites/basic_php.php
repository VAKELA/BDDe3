<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<?php


$num =rand(3, 10);
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$length = strlen($characters);
$randomString = '';

for ($i = 0; $i < $num; $i++) {
    $randomString .= $characters[rand(0, $length - 1)];
}

echo "$randomString";


// $array2['ewe'] = 'uwu'
?>



</body>
</html>
