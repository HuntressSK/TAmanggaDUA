<?php

$password_saya = 'tuwaga';
$hash_hasilnya = password_hash($password_saya, PASSWORD_DEFAULT);

echo "Password: " . $password_saya . "<br><br>";
echo "Hash yang harus kamu copy-paste ke database adalah: <br>";
echo "<strong style='font-size: 1.2em;'>" . $hash_hasilnya . "</strong>";

?>