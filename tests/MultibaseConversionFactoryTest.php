<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter\Tests;

use PHPUnit\Framework\TestCase;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;
use PublicSquare\JWKMBConverter\Tests\TestHelper;

final class MultibaseConversionFactoryTest extends TestCase
{
    private $testHelper;
    private $multibaseConversionFactory;

    public function __construct()
    {
        parent::__construct();
        $this->testHelper                 = new TestHelper();
        $this->multibaseConversionFactory = new MultibaseConversionFactory();
    }

    public function testMbaseToJWKSecp256K1(): void
    {
        // get secp256k1 keys
        $secp256k1Keys = $this->testHelper->getSecp256k1Keys();

        // get secp256k1 JWKs
        $secp256k1JWKs = $this->testHelper->getSecp256k1Jwks();

        // iterate over list of keys
        foreach ($secp256k1Keys as $key) {
            // convert to JWK
            $jwk = $this->multibaseConversionFactory->mbaseToJWK($key, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);

            $this->assertEquals(true, in_array($jwk, $secp256k1JWKs));
        }
    }

    public function testMbaseToJWKP384(): void
    {
        // get p384 keys
        $p384Keys = $this->testHelper->getP384Keys();

        // get p384 JWKs
        $p384JWKs = $this->testHelper->getP384Jwks();

        // iterate over list of keys
        foreach ($p384Keys as $key) {
            // convert to JWK
            $jwk = $this->multibaseConversionFactory->mbaseToJWK($key, MultibaseConversionFactory::SIMPLITO_P384_FORM);

            $this->assertEquals(true, in_array($jwk, $p384JWKs));
        }
    }

    public function testJWKToMbaseSecp256K1(): void
    {
        // get secp256k1 keys
        $secp256k1Keys = $this->testHelper->getSecp256k1Keys();

        // get secp256k1 JWKs
        $secp256k1JWKs = $this->testHelper->getSecp256k1Jwks();

        // iterate over list of jwks
        foreach ($secp256k1JWKs as $jwk) {
            // convert to did:key
            $didKey = $this->multibaseConversionFactory->jwkToMbase($jwk);

            $this->assertEquals(true, in_array($didKey, $secp256k1Keys));
        }
    }

    public function testJWKToMbaseP384(): void
    {
        // get p384 keys
        $p384Keys = $this->testHelper->getP384Keys();

        // get p384 JWKs
        $p384JWKs = $this->testHelper->getP384Jwks();

        // iterate over list of jwks
        foreach ($p384JWKs as $jwk) {
            // convert to did:key
            $didKey = $this->multibaseConversionFactory->jwkToMbase($jwk);

            $this->assertEquals(true, in_array($didKey, $p384Keys));
        }
    }

    public function testMbaseConversionBadCaseSecp256k1(): void
    {
        // p-521 key
        $didKey = 'z2J9gaYxrKVpdoG9A4gRnmpnRCcxU6agDtFVVBVdn1JedouoZN7SzcyREXXzWgt3gGiwpoHq7K68X4m32D8HgzG8wv3sY5j7';

        $this->expectExceptionMessage('Unknown point format');

        // convert to JWK
        $jwkSecp = $this->multibaseConversionFactory->mbaseToJWK($didKey, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);
    }

    public function testMbaseConversionBadCaseP384(): void
    {
        // p-521 key
        $didKey = 'z2J9gaYxrKVpdoG9A4gRnmpnRCcxU6agDtFVVBVdn1JedouoZN7SzcyREXXzWgt3gGiwpoHq7K68X4m32D8HgzG8wv3sY5j7';

        $this->expectExceptionMessage('Unknown point format');

        // convert to JWK
        $jwk384 = $this->multibaseConversionFactory->mbaseToJWK($didKey, MultibaseConversionFactory::SIMPLITO_P384_FORM);
    }
}
