<?php
require_once("paytm/config.php");
require_once("paytm/PaytmChecksum.php");

$orderId = "VCN" . time();
$amount  = $_POST["amount"];
$custId  = $_POST["customer_id"];

$paytmParams = array(
  "MID" => PAYTM_MERCHANT_ID,
  "ORDER_ID" => $orderId,
  "CUST_ID" => $custId,
  "TXN_AMOUNT" => $amount,
  "CHANNEL_ID" => "WEB",
  "INDUSTRY_TYPE_ID" => "Retail",
  "WEBSITE" => PAYTM_WEBSITE,
  "CALLBACK_URL" => PAYTM_CALLBACK_URL
);

$checksum = PaytmChecksum::generateSignature($paytmParams, PAYTM_MERCHANT_KEY);
?>

<html>
<body onload="document.paytm.submit()">

<h3>Redirecting to Paytm...</h3>

<form name="paytm" method="post" action="<?php echo PAYTM_TXN_URL; ?>">
<?php
foreach($paytmParams as $name => $value) {
  echo '<input type="hidden" name="'.$name.'" value="'.$value.'">';
}
?>
<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checksum; ?>">
</form>

</body>
</html>
