<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter\Tests;

use Jose\Component\Core\JWK;
use PHPUnit\Framework\TestCase;
use PublicSquare\JWKMBConverter\DidKeyConversionFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;

final class DidKeyConversionFactoryTest extends TestCase
{
    private $testHelper;
    private $didKeyConversionFactory;

    public function __construct()
    {
        parent::__construct();
        $this->testHelper              = new TestHelper();
        $this->didKeyConversionFactory = new DidKeyConversionFactory();
    }

    public function testDidKeyToJWKSecp256K1(): void
    {
        // get secp256k1 keys
        $secp256k1Keys = $this->testHelper->getSecp256k1Keys(true);

        // get secp256k1 JWKs
        $secp256k1JWKs = $this->testHelper->getSecp256k1Jwks();

        // iterate over list of keys
        foreach ($secp256k1Keys as $key) {
            // convert to JWK
            $jwk = $this->didKeyConversionFactory->didKeyToJWK($key, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);

            $this->assertEquals(true, in_array($jwk, $secp256k1JWKs));
        }
    }

    public function testDidKeyToJWKP384(): void
    {
        // get p384 keys
        $p384Keys = $this->testHelper->getP384Keys(true);

        // get p384 JWKs
        $p384JWKs = $this->testHelper->getP384Jwks();

        // iterate over list of keys
        foreach ($p384Keys as $key) {
            // convert to JWK
            $jwk = $this->didKeyConversionFactory->didKeyToJWK($key, MultibaseConversionFactory::SIMPLITO_P384_FORM);

            $this->assertEquals(true, in_array($jwk, $p384JWKs));
        }
    }

    public function testJWKToDidKeySecp256K1(): void
    {
        // get secp256k1 keys
        $secp256k1Keys = $this->testHelper->getSecp256k1Keys(true);

        // get secp256k1 JWKs
        $secp256k1JWKs = $this->testHelper->getSecp256k1Jwks();

        // iterate over list of jwks
        foreach ($secp256k1JWKs as $jwk) {
            // convert to did:key
            $didKey = $this->didKeyConversionFactory->jwkToDidKey($jwk);

            $this->assertEquals(true, in_array($didKey, $secp256k1Keys));
        }
    }

    public function testJWKToDidKeyP384(): void
    {
        // get p384 keys
        $p384Keys = $this->testHelper->getP384Keys(true);

        // get p384 JWKs
        $p384JWKs = $this->testHelper->getP384Jwks();

        // iterate over list of jwks
        foreach ($p384JWKs as $jwk) {
            // convert to did:key
            $didKey = $this->didKeyConversionFactory->jwkToDidKey($jwk, true);

            $this->assertEquals(true, in_array($didKey, $p384Keys));
        }
    }

    public function testDidKeyConversionBadCaseSecp256k1(): void
    {
        // p-521 key
        $didKey = 'did:key:z2J9gaYxrKVpdoG9A4gRnmpnRCcxU6agDtFVVBVdn1JedouoZN7SzcyREXXzWgt3gGiwpoHq7K68X4m32D8HgzG8wv3sY5j7';

        $this->expectExceptionMessage('Unknown point format');

        // convert to JWK
        $jwkSecp = $this->didKeyConversionFactory->didKeyToJWK($didKey, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);
    }

    public function testDidKeyConversionBadCaseP384(): void
    {
        // p-521 key
        $didKey = 'did:key:z2J9gaYxrKVpdoG9A4gRnmpnRCcxU6agDtFVVBVdn1JedouoZN7SzcyREXXzWgt3gGiwpoHq7K68X4m32D8HgzG8wv3sY5j7';

        $this->expectExceptionMessage('Unknown point format');

        // convert to JWK
        $jwk384 = $this->didKeyConversionFactory->didKeyToJWK($didKey, MultibaseConversionFactory::SIMPLITO_P384_FORM);
    }
}
