<?php
	//echo '<pre>';
  //print_r($_POST);
  //exit;
 $generated_signature = '';
if(isset($_POST)) {
	if(isset($_POST['razorpay_payment_id'])) {
		$razorpay_payment_id	= $_POST['razorpay_payment_id'];
		$razorpay_order_id		= $_POST['razorpay_order_id'];
		$razorpay_signature		= $_POST['razorpay_signature'];

		$string					= $razorpay_order_id.'|'.$razorpay_payment_id;
		$secret					= 'iLpCUJYz5mwScwpbKUwhKSE6';
		$generated_signature	= hash_hmac('sha256', $string, $secret); //hmac_sha256(razorpay_order_id + "|" + razorpay_payment_id, secret);

		if ($generated_signature == $razorpay_signature) {
			echo "Payment is successful";
		} else {
			echo "Payment is failed";
		}
	} elseif(isset($_POST['error'])) {
		echo $_POST['error']['code'];
	}
}

echo $generated_signature;
echo '<pre>';
  print_r($_POST);
  exit;
?>


