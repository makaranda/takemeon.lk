<?php
// app/Http/Controllers/PaymentController.php


namespace App\Http\Controllers\frontend;

use App\Helpers\VisitorHelper;
use App\Http\Controllers\Controller;
use CyberSource\ApiClient;
use CyberSource\Configuration;
use CyberSource\Model\CreatePaymentRequest;
use CyberSource\Model\Ptsv2paymentsClientReferenceInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CybersourceHelper;

class PaymentController extends Controller
{
    private $accessKey = 'd67211dd1c40356cb2095b85338f282b';
    private $profileId = 'DC55C851-733B-4B4D-AF9E-0660CCA0A82C';
    private $secretKey = '01ec03da150242119b821515da6435594b2e0410de184c2a991fc3a30fb10f60a7800a333793408b8edaeec3992993a21b3d855e49c44054a4d7a125faaf182c6dd308a82f0e4818b23909d90dab9dc9cbf2668fbb5048e788317cfb17dcc6c72fa8282c86bd46f793ed8056b3695b7d3e038c42eaf14a979c1677bebde7133b';

    public function showForm()
    {
        $params = $this->buildPaymentParams();

        // Sign the request
        $params['signature'] = $this->sign($params);

        return view('pages.frontend.payment.checkout', compact('params'));
    }

    public function processPayment(Request $request)
    {
        $params = $this->buildPaymentParams();
        $params['signature'] = $this->sign($params);

        return view('pages.frontend.payment.checkout', compact('params'));
    }

    public function handleReceipt(Request $request)
    {
        $params = $request->all();
        $verified = CybersourceHelper::verifySignature($params);

        return view('pages.frontend.payment.receipt', compact('params', 'verified'));
    }

    private function buildPaymentParams(): array
    {
        return [
            "access_key" => $this->accessKey,
            "profile_id" => $this->profileId,
            "transaction_uuid" => Str::uuid()->toString(),
            "signed_field_names" => "access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,payment_method,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code",
            "unsigned_field_names" => "card_type,card_number,card_expiry_date",
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "locale" => "en",
            "card_type" => "001",
            "card_number" => "4242424242424242",
            "card_expiry_date" => "11-2025",
            "transaction_type" => "authorization",
            "reference_number" => uniqid("REF_"),
            "amount" => "100.00",
            "currency" => "LKR",
            "payment_method" => "card",
            "bill_to_forename" => "John",
            "bill_to_surname" => "Doe",
            "bill_to_email" => "makarandapathirana@gmail.com",
            "bill_to_phone" => "0773944180",
            "bill_to_address_line1" => "1 Card Lane",
            "bill_to_address_city" => "My City",
            "bill_to_address_state" => "Westurn",
            "bill_to_address_country" => "LK",
            "bill_to_address_postal_code" => "10240",
        ];
    }

    private function sign(array $params): string
    {
        $signedFieldNames = explode(",", $params["signed_field_names"]);
        $dataToSign = [];

        foreach ($signedFieldNames as $field) {
            $dataToSign[] = $field . "=" . $params[$field];
        }

        $data = implode(",", $dataToSign);
        $binaryKey = hex2bin($this->secretKey);

        return base64_encode(hash_hmac('sha256', $data, $binaryKey, true));
    }
}

