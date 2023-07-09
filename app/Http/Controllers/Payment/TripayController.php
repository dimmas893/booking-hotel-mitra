<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Customor;
use App\Models\Mitra;
use Illuminate\Http\Request;

class TripayController extends Controller
{
    public function getPaymentChannels()
    {
        $apiKey = 'DEV-A02U5RLu0ChrcK89EcbxB7ipcZbbLATnT2qVMJ3A';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT     => true,
            CURLOPT_URL               => "https://tripay.co.id/api-sandbox/merchant/payment-channel",
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HEADER            => false,
            CURLOPT_HTTPHEADER        => array(
                "Authorization: Bearer " . $apiKey
            ),
            CURLOPT_FAILONERROR       => false
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response ? json_decode($response) : $err;
    }

    public function requestTransaction($kolamrenang, $method, $user)
    {
        $mitra = Mitra::where('id', $kolamrenang->idmitra)->first();
        $customor = Customor::where('id_user', $user->id)->first();
        $apiKey       = 'DEV-A02U5RLu0ChrcK89EcbxB7ipcZbbLATnT2qVMJ3A';
        $privateKey   = '5QPaZ-uyCgB-gDkUQ-10KZg-scDUb';
        $merchantCode = 'T14095';
        $merchantRef  = 'PX-' . time();
        $amount = $kolamrenang->biayaperorang;
        // dd($user);

        $data = [
            'method'            => $method,
            'merchant_ref'      => $merchantRef,
            'amount'            => $amount,
            'customer_name'     => $user->name,
            'customer_email'    => $user->email,
            'customer_phone'    => $customor->phone,
            'order_items'       => [
                [
                    'name'      => 'Fasilitas ' . $mitra->namamitra,
                    'price'     => $amount,
                    'quantity'  => 1
                ]
            ],
            'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        // dd($response);
        return $response ? json_decode($response) : $error;
    }

    public function transactionDetail($reference)
    {
        $apiKey = 'DEV-A02U5RLu0ChrcK89EcbxB7ipcZbbLATnT2qVMJ3A';

        $payload = [
            'reference'    => $reference
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT     => true,
            CURLOPT_URL               => "https://tripay.co.id/api-sandbox/transaction/detail?" . http_build_query($payload),
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HEADER            => false,
            CURLOPT_HTTPHEADER        => array(
                "Authorization: Bearer " . $apiKey
            ),
            CURLOPT_FAILONERROR       => false,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response ? json_decode($response)->data : $err;
    }
}
