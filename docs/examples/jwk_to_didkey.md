## Converting a Public JWK to a did:key

To allow for conversions from JWK to a **did:key**, we need to include the `DidKeyConversionFactory`.

Please note that if you would like to use any of our constants, you can include the `MultibaseConversionFactory` as below.

```php
<?php

require __DIR__ . './../vendor/autoload.php';

use Jose\Component\KeyManagement\JWKFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;
use PublicSquare\JWKMBConverter\DidKeyConversionFactory;

$didKeyConversionFactory = new DidKeyConversionFactory();

// This generates a secp256k1 private key (kty, crv, d, x, y), we convert that to a Public Key
$jwkPriv = JWKFactory::createECKey(MultibaseConversionFactory::SECP256K1_JWK_CURVE);
$jwkPub  = $jwkPriv->toPublic();

$didKey  = $didKeyConversionFactory->jwkToDidKey($jwkPub);
// did:key:zQ3s[... same as above]
```

The standard form should be similar to the Multibase form, but prefixed with `did:key:`.

These standard forms for P-384 can be found [here](https://w3c-ccg.github.io/did-method-key/#p-384). Secp256k1's standard forms can be found [here](https://w3c-ccg.github.io/did-method-key/#secp256k1).
