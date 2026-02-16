<?php

namespace App\Services\CyberSource;

use CyberSource\Authentication\Core\MerchantConfiguration;
use CyberSource\ExternalConfiguration;

class CyberSourceConfig
{
    public static function getMerchantConfig()
    {
        $merchantConfig = new MerchantConfiguration();

        $merchantConfig->setAuthenticationType('http_signature'); // or 'jwt'
        $merchantConfig->setMerchantID('testapiwebsl_1748006956');
        $merchantConfig->setApiKeyID('2797c58e-f8a3-47ca-a828-efa15e2143c3');
        $merchantConfig->setSecretKey('rv7r1dS2VycU6JtwlVr7eC1679O/m33jCrmvveh0rIA=');
        $merchantConfig->setRunEnvironment('https://apitest.cybersource.com'); // sandbox

        return $merchantConfig;
    }
}
