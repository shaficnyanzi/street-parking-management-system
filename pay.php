<?php 
if(isset($_POST['pay']))
{
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    //* Prepare our rave request
    $request = [
        'tx_ref' => time(),
        'amount' => $amount,
        'currency' => 'UGX',
        'payment_options' => 'card',
        'redirect_url' => 'http://localhost/smart-parking/rave/process.php',
        'customer' => [
            'email' => $email,
            'name' => 'shafic'
        ],
        'meta' => [
            'price' => $amount
        ],
        'customizations' => [
            'title' => 'payment for street parking fees',
            'description' => 'sample'
        ]
    ];

    //* Call flutterwave endpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK-8904a881e9af1544b069d955ff71dbe2-188201a8a43vt-X',
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($request))
    ),
));

    $response = curl_exec($curl);

    curl_close($curl);
    
    $res = json_decode($response);
    if($res->status == 'success')
    {
        $link = $res->data->link;
        header('Location:'.$link);
    }
    else
    {
        echo 'We can not process your payment';
    }
}

?>
