<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter;

use Jose\Component\Core\JWK;
use Jose\Component\Core\JWKSet;
use Jose\Component\KeyManagement\Analyzer\ES256KeyAnalyzer;
use Jose\Component\KeyManagement\Analyzer\ES384KeyAnalyzer;
use Jose\Component\KeyManagement\Analyzer\KeyAnalyzerManager;

class ConversionHelper
{
    /**
     * Validates a JWT Framework JWK using the JWT Framework Key Analyzer Manager
     * @param JWK $jwk JWK to validate
     * @return boolean validity of JWK
     */
    public function validateJWK(JWK $jwk): bool
    {
        $keyAnalyzerManager = new KeyAnalyzerManager();

        $keyAnalyzerManager->add(new ES256KeyAnalyzer());
        $keyAnalyzerManager->add(new ES384KeyAnalyzer());

        $analyzedResults = $keyAnalyzerManager->analyze($jwk);

        // if the analyzed results count is not 0, errors found
        if ($analyzedResults->count() > 0) {
            return false;
        }

        return true;
    }
}
