<?php
$data = $_POST;

$plan = json_decode($_COOKIE["selectedPlan"] ?? "{}", true);

$message = "
New Customer Registration

Name: {$data['fname']} {$data['lname']}
Mobile: {$data['mobile']}
Address: {$data['address']}
";

mail("vcnfibernet@gmail.com", "New Registration", $message);

echo json_encode(["success"=>true]);
