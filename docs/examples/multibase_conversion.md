## Converting a Multibase Key to a Public JWK

The following code shows the complete roundabout for generation, PubKey to multibase key, and multibase key back to Public JWK.

To allow for such, we need to include the `MultibaseConversionFactory`.

```php
<?php

require __DIR__ . './../vendor/autoload.php';

use Jose\Component\KeyManagement\JWKFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;

$multibaseConversionFactory = new MultibaseConversionFactory();

// This generates a secp256k1 private key (kty, crv, d, x, y), we convert that to a Public Key
$jwkPriv = JWKFactory::createECKey(MultibaseConversionFactory::SECP256K1_JWK_CURVE);
$jwkPub  = $jwkPriv->toPublic();

$mbaseKey = $multibaseConversionFactory->jwkToMbase($jwkPub);

// Constants are located in MultibaseConversionFactory, returns JWT Framework Public JWK
$mbaseToJwkPub  = $multibaseConversionFactory->mbaseToJwk($mbaseKey, MultibaseConversionFactory::SIMPLITO_SECP256K1_FORM);
// returns the above Public JWK
```

It is important to note that the `mbaseToJwk` function's algorithm parameter can accept several forms for P-384 or secp256k1, but is only limited to those two curves for now.

These forms include: `P-384`, `p384`, `ES384` (preferred), `secp256k1`, `ES256K` (preferred).
