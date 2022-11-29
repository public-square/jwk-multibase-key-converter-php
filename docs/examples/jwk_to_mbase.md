## Converting a Public JWK to a Multibase Key
___

To allow for conversions from JWK to a Multibase Key, we need to include the `MultibaseConversionFactory`.

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
// zQ3s...
```

These standard forms for P-384 can be found [here](https://w3c-ccg.github.io/did-method-key/#p-384). Secp256k1's standard forms can be found [here](https://w3c-ccg.github.io/did-method-key/#secp256k1).

Please note that this is only for the `mb-value` or Multibase Key Value and not the entire **did:key** (`did:key:mb-value`).
