
<?php
header("Content-Type: application/json");

echo json_encode([
  ["name"=>"20 Mbps Unlimited", "price"=>400, "speed"=>"Unlimited", "popular"=>true],
  ["name"=>"40 Mbps Unlimited", "price"=>600, "speed"=>"Unlimited", "popular"=>false],
  ["name"=>"100 Mbps Unlimited", "price"=>800, "speed"=>"Unlimited", "popular"=>false]
]);




/*
<?php
header("Content-Type: application/json");

$plans = [
  "internet" => [
    ["speed"=>"20 Mbps","speed"=>"300GB","price"=>300,"popular"=>false],
    ["speed"=>"20 Mbps","speed"=>"Unlimited","price"=>400,"popular"=>true],
    ["speed"=>"30 Mbps","speed"=>"Unlimited","price"=>500,"popular"=>false],
    ["speed"=>"40 Mbps","speed"=>"Unlimited","price"=>600,"popular"=>false],
    ["speed"=>"100 Mbps","speed"=>"Unlimited","price"=>800,"popular"=>false],
  ],

  "cable" => [
    ["name"=>"SD Pack","channels"=>"300+ SD Channels","price"=>250,"popular"=>false],
    ["name"=>"HD Pack","channels"=>"SD + HD | 300+ Channels","price"=>300,"popular"=>true],
  ],

  "combo" => [
    ["name"=>"15 Mbps + SD","speed"=>"300GB","price"=>450,"popular"=>false],
    ["name"=>"20 Mbps + SD","speed"=>"Unlimited","price"=>500,"popular"=>false],
    ["name"=>"25 Mbps + SD","speed"=>"Unlimited","price"=>550,"popular"=>true],
    ["name"=>"40 Mbps + SD","speed"=>"Unlimited","price"=>650,"popular"=>false],
    ["name"=>"100 Mbps + HD","speed"=>"Unlimited","price"=>900,"popular"=>false],
  ]
];

echo json_encode($plans);


//<--?php
header("Content-Type: application/json");

*/