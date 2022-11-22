<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter\Tests;

use Jose\Component\Core\JWK;
use PHPUnit\Framework\TestCase;
use PublicSquare\JWKMBConverter\ConversionHelper;
use PublicSquare\JWKMBConverter\Tests\TestHelper;

final class ConversionHelperTest extends TestCase
{
    private $testHelper;
    private $conversionHelper;

    public function __construct()
    {
        parent::__construct();
        $this->testHelper       = new TestHelper();
        $this->conversionHelper = new ConversionHelper();
    }

    public function testValidateJWK(): void
    {
        // grab a random JWK from secp256k1 jwks
        $jwk = $this->testHelper->getSecp256k1Jwks()[array_rand($this->testHelper->getSecp256k1Jwks())];

        $validJWK = $this->conversionHelper->validateJWK($jwk);

        $this->assertEquals(true, $validJWK);
    }

    public function testInvalidJWK(): void
    {
        // create a JWK
        $jwk = new JWK([
            'kty' => 'EC',
            'crv' => 'P-384',
            'x'   => 'apple',
            'y'   => 'banana',
        ]);

        $validJWK = $this->conversionHelper->validateJWK($jwk);

        $this->assertEquals(false, $validJWK);
    }
}
