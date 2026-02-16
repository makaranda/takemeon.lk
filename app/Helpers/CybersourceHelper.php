<?php
namespace App\Helpers;

class CybersourceHelper
{
    const SECRET_KEY = '01ec03da150242119b821515da6435594b2e0410de184c2a991fc3a30fb10f60a7800a333793408b8edaeec3992993a21b3d855e49c44054a4d7a125faaf182c6dd308a82f0e4818b23909d90dab9dc9cbf2668fbb5048e788317cfb17dcc6c72fa8282c86bd46f793ed8056b3695b7d3e038c42eaf14a979c1677bebde7133b';

    public static function sign($params)
    {
        $signedData = self::buildDataToSign($params);
        return base64_encode(hash_hmac('sha256', $signedData, self::SECRET_KEY, true));
    }

    public static function verifySignature($params)
    {
        $expected = self::sign($params);
        return $params['signature'] === $expected;
    }

    private static function buildDataToSign($params)
    {
        $signedFieldNames = explode(",", $params['signed_field_names']);
        $dataToSign = [];
        foreach ($signedFieldNames as $field) {
            $dataToSign[] = $field . "=" . $params[$field];
        }
        return implode(",", $dataToSign);
    }
}

