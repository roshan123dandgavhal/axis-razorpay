1. login to https://axis.razorpay.com/#/access/signin
2. Goto left hand side menu seeting tab. Copy or create Key and Secret key. Save this keys for further use
3. Crete Order using curl

curl  -X POST https://api.razorpay.com/v1/orders
-H 'content-type:application/json'
-d '{
    "amount": 50000,
    "currency": "INR",
    "receipt": "rcptid_11",
    "payment_capture": 1
}'

4. Create folowing form. 
<form method="POST" action="https://api.razorpay.com/v1/checkout/embedded">
  <input type="hidden" name="key_id" value="YOUR_KEY_ID">
  <input type="hidden" name="order_id" value="razorpay_order_id">
  <input type="hidden" name="name" value="Acme Corp">
  <input type="hidden" name="description" value="A Wild Sheep Chase">
  <input type="hidden" name="image" value="https://cdn.razorpay.com/logos/BUVwvgaqVByGp2_large.png">
  <input type="hidden" name="prefill[name]" value="Gaurav Kumar">
  <input type="hidden" name="prefill[contact]" value="9123456780">
  <input type="hidden" name="prefill[email]" value="gaurav.kumar@example.com">
  <input type="hidden" name="notes[shipping address]" value="L-16, The Business Centre, 61 Wellfield Road, New Delhi - 110001">
  <input type="hidden" name="callback_url" value="https://example.com/payment-callback">
  <input type="hidden" name="cancel_url" value="https://example.com/payment-cancel">
  <button>Submit</button>
</form>

a) razorpay_order_id will get from step 3
b) callback_url after successfull payment response return to given page
c) If customer cancel payment

5. After Successfull payment you will get follwowin information. Store this info in table for signature verification.

{
  "razorpay_payment_id": "pay_29QQoUBi66xm2f",
  "razorpay_order_id": "order_9A33XWu170gUtm",
  "razorpay_signature": "9ef4dffbfd84f1318f6739a3ce19f9d85851857ae648f114332d8401e0949a3d"
}

6. Verify signature (Payment Finalization)
Write down follwoing code in callback_url

$generated_signature = hmac_sha256($razorpay_order_id + "|" + $razorpay_payment_id, secret);
if ($generated_signature == $razorpay_signature) {
	echo "payment is successful";
}

a) razorpay_order_id & razorpay_payment_id will get from step 5
b) razorpay_signature get from step 1



https://razorpay.com/docs/payment-gateway/web-integration/hosted/
https://razorpay.com/docs/api/