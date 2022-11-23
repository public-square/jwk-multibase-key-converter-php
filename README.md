JWK Multibase Key Converter
=================

[![Latest Stable Version](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/v/stable.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)
[![Total Downloads](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/downloads.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)
[![Latest Unstable Version](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/v/unstable.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)
[![License](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/license.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)

## Information

This library is a tool to assist in the conversion of Multibase/Multicodec strings and **did:key** method spec keys to JWK, and vice versa. It utilizes Multibase/Multicodec, Simplito-EC, and JWT Framework to aid in these conversions.

For more information on the **did:key** spec, please read the current unofficial draft [here](https://w3c-ccg.github.io/did-method-key/).

Currently, this libary only supports the following curves:

 - secp256k1
 - nistp384

## OpenSSL and Windows

In order for key generation to work on Windows machines, this [Installation](https://www.php.net/manual/en/openssl.installation.php) documentation must be done correctly, specifically regarding `openssl.cnf`.

## Generating a JWK
```php
<?php

require __DIR__ . './../vendor/autoload.php';

use Jose\Component\KeyManagement\JWKFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;

// This generates a secp256k1 private key (kty, crv, d, x, y)
$jwk = JWKFactory::createECKey(MultibaseConversionFactory::SECP256K1_JWK_CURVE);
```

## Converting a JWK to a Multibase Key or did:key
```php
<?php

require __DIR__ . './../vendor/autoload.php';

use Jose\Component\KeyManagement\JWKFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;
use PublicSquare\JWKMBConverter\DidKeyConversionFactory;

$multibaseConversionFactory = new MultibaseConversionFactory();
$didKeyConversionFactory    = new DidKeyConversionFactory();

// This generates a secp256k1 private key (kty, crv, d, x, y)
$jwk = JWKFactory::createECKey(MultibaseConversionFactory::SECP256K1_JWK_CURVE);

$mbaseKey = $multibaseConversionFactory->jwkToMbase($jwk);
// zQ3s...

$didKey   = $didKeyConversionFactory->jwkToDidKey($jwk);
// did:key:zQ3s[... same as above]
```

## Converting a Multibase Key or did:key to a Public JWK
```php
<?php

require __DIR__ . './../vendor/autoload.php';

use Jose\Component\KeyManagement\JWKFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;
use PublicSquare\JWKMBConverter\DidKeyConversionFactory;

$multibaseConversionFactory = new MultibaseConversionFactory();
$didKeyConversionFactory    = new DidKeyConversionFactory();

// This generates a secp256k1 private key (kty, crv, d, x, y)
$jwk = JWKFactory::createECKey(MultibaseConversionFactory::SECP256K1_JWK_CURVE);

$mbaseKey = $multibaseConversionFactory->jwkToMbase($jwk);
$didKey   = $didKeyConversionFactory->jwkToDidKey($jwk);

// uses SIMPLITO EC Standards for Algorithm Names, returns JWT Framework Public JWK
$mbaseToJwk  = $multibaseConversionFactory->mbaseToJwk($mbaseKey, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);
// returns the above JWK without the private key

// Constants are located in MultibaseConversionFactory, returns JWT Framework Public JWK
$didKeyToJwk = $didKeyConversionFactory->didKeyToJwk($didKey, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);
// returns the above JWK without the private key
```

## Requirements

* \>= PHP 8.1
* composer
* ext-gmp

## Installation

You can install this library via Composer :

`composer require public-square/jwk-multibase-key-converter-php`

## Contribute

Please open a pull request.

## License

This software is release under [MIT license](LICENSE).
