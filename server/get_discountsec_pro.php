<?php

include('connection.php');


$stmt = $conn->prepare("SELECT * FROM products WHERE product_disc_percent > 0  LIMIT 4");

$stmt-> execute();

$discountsec_pro = $stmt->get_result();



?>