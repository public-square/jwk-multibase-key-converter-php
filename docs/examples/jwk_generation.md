## Generating a Public JWK

The following code helps generate a Public JWK to use with Multibase or **did:key** conversions.

```php
<?php

require __DIR__ . './../vendor/autoload.php';

use Jose\Component\KeyManagement\JWKFactory;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;

// This generates a secp256k1 private key (kty, crv, d, x, y), we convert that to a Public Key
$jwkPriv = JWKFactory::createECKey(MultibaseConversionFactory::SECP256K1_JWK_CURVE);
$jwkPub  = $jwkPriv->toPublic();
```

Note: We deal with Public JWKs (kty, crv, x, y).

JWKFactory creates a private key JWK (kty, crv, x, y, and d).

**Do not expose your private key anywhere**.

The `d` key is your private key and this function ensures it does not get exposed.
