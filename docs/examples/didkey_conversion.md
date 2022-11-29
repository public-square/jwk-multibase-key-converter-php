## Converting a did:key to a Public JWK

The following code shows the complete roundabout for generation, PubKey to **did:key**, and did:key back to Public JWK.

To allow for such, we need to include the `DidKeyConversionFactory`.

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

// Constants are located in MultibaseConversionFactory, returns JWT Framework Public JWK
$didKeyToJwkPub = $didKeyConversionFactory->didKeyToJwk($didKey, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);
// returns the above Public JWK
```

It is important to note that the `didKeyToJwk` function's algorithm parameter can accept several forms for P-384 or secp256k1, but is only limited to those two curves for now.

These forms include: `P-384`, `p384`, `ES384` (preferred), `secp256k1`, `ES256K` (preferred).
