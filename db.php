<?php
$mysqli = new mysqli("localhost", "root", "", "acnb");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
 
function storeCarName($car_name, $car_price) {
 global $mysqli;
 $mysqli->query("INSERT INTO name_car (Цена, Название) VALUES ('$car_price', '$car_name')");  
 
}

function car() {
        
}