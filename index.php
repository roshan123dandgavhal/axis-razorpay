<?php
$array = array (
  'amount' => 300,'currency' => 'INR','payment_capture' => 1,
  'transfers' => 
  array (
    array (
      'account' => 'acc_FB6ybpv11GrZ4n',
      'amount' => 200,
      'currency' => 'INR',
      'notes' => array (  'branch' => 'Acme Corp Bangalore North', 'name' => 'Roshan Dandgavhal',),
      'linked_account_notes' => 
      array ('branch', ),
      'on_hold' => 0,
    ),
    array (
      'account' => 'acc_FB6zxFt9nfb3ZB',
      'amount' => 100,
      'currency' => 'INR',
      'notes' => array ('branch' => 'Acme Corp Bangalore South','name' => 'Manasi Joshi', ),
      'linked_account_notes' =>  array ('branch', ),
      'on_hold' => 0,
    ),
  ),
);

$postdata = json_encode($array);
$return_url = "http://example.com/response.php";
$cancel_url = "http://example.com/cancel.php";
$mg_api='rzp_test_8NnEHBOmF7kLxL:zpsK0ArEU4bhvbfMBldez8PS';
$curl_post_url = "https://api.razorpay.com/v1/orders";
//$curl_post_url = "https://api.razorpay.com/v1/payments/pay_E8JR8E0XyjUSZd/transfers";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_VERBOSE, 0);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($ch, CURLOPT_USERPWD, $mg_api);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_POST, true);
curl_setopt ($ch, CURLOPT_HEADER, false);
//curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt ($ch, CURLOPT_URL, $curl_post_url);
curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt ($ch, CURLOPT_TIMEOUT, 0);
$result = curl_exec($ch);
curl_close($ch);
$someArray = json_decode($result, true);

//print_r($someArray); exit;
//$weburl=$someArray['payment_links']['web'];
//header('Location:'.$weburl);*/


echo '<form method="POST" action="https://api.razorpay.com/v1/checkout/embedded" id="paymentForm">';
echo '<input type="hidden" name="key_id" value="rzp_test_8NnEHBOmF7kLxL">';
echo '<input type="hidden" name="order_id" value="'.$someArray['id'].'">';
echo '<input type="hidden" name="amount" value="'.$someArray['amount'].'">';
echo '<input type="hidden" name="name" value="Progressive Education Society">';
echo '<input type="hidden" name="description" value="Online Payment Form">';
echo '<input type="hidden" name="image" value="https://cdn.razorpay.com/logos/BUVwvgaqVByGp2_large.png">';
echo '<input type="hidden" name="prefill[name]" value="Roshan Dandgavhal">';
echo '<input type="hidden" name="prefill[contact]" value="9881764929">';
echo '<input type="hidden" name="prefill[email]" value="roshandandgavhal@gmail.com">';
echo '<input type="hidden" name="notes[shipping address]" value="LBM House Nashik">';
echo '<input type="hidden" name="callback_url" value="'.$return_url.'">';
echo '<input type="hidden" name="cancel_url" value="'.$cancel_url.'">';
echo '<button>Submit</button>';
echo '</form> ';
?>

