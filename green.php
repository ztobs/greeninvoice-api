<?php

$apiKey = "3edd0eacd0457d14e983f017cf5f598c";
$apiSecret = "74fcef8c31ca6bd4ad6f601f5432877d";

$params = array(
    "timestamp" => time(), //Current timestamp
    "callback_url" => "{your-callback-url}",
    "doc_type" => 405,
    "description" => "תיאור מסמך",
    "client" => array(
        "send_email" => true,
        "name" => "לקוח חדש",
        "tax_id" => "123456789",
        "email" => "user@email.com",
        "address" => "רח' דיזנגוף 300",
        "city" => "תל אביב",
        "zip" => "1234567"
    ),
    "income" => array(
        array(
            "price" => 500.00,
            "description" => "תיאור שורת הכנסה"
        )
    ),
    "payment" => array(
        array(
            "type" => 2, //Cheque
            "date" => "2012-01-01", //YYYY-MM-DD
            "amount" => 500.00,
            "bank" => "מזרחי טפחות",
            "branch" => "761",
            "account" => "123456",
            "number" => "10928"
        )
    )
);

//Compute hashed signature with SHA-256 algorithm and the secret key
$params_encoded = json_encode($params);
$signature = base64_encode(hash_hmac('sha256', $params_encoded, $apiSecret, true));

$data = array(
    "apiKey" => $apiKey,
    "params" => $params,
    "sig" => $signature
);

//Initializing curl
$ch = curl_init();

//Configuring curl options
$options = array(
    CURLOPT_URL => "https://api.greeninvoice.co.il/api/documents/add",
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => "data=" . urlencode(json_encode($data)),
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true
);

//Setting curl options
curl_setopt_array($ch, $options);

//Getting results
$result = curl_exec($ch); // Getting jSON result string
curl_close($ch);

//Parse result to JSON
$response = json_decode($result);
print_r($response);
//If Ok
if ($response->error_code == 0) {
    //Process response here
}