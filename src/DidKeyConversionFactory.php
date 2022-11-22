<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter;

use Exception;
use Jose\Component\Core\JWK;
use PublicSquare\JWKMBConverter\MultibaseConversionFactory;

class DidKeyConversionFactory
{
    /**
     * Converts a did:key method spec string to a JWT Framework JWK
     * @param string $didKey did:key method spec string
     * @param string $alg Curve Type in Simplito Format (secp256k1, p384)
     * @return JWK JWT Framework JWK
     * @throws Exception
     */
    public function didKeyToJwk(string $didKey, string $alg): JWK | Exception
    {
        // verify did key starts with did:key:
        if (str_starts_with($didKey, 'did:key:') === false) {
            throw new Exception('Invalid DID Key.');
        }

        // remove did:key: prefix from string
        $didKey = explode('did:key:', $didKey)[1];

        $jwk = (new MultibaseConversionFactory())->mbaseToJwk($didKey, $alg);

        return $jwk;
    }

    /**
     * Converts a JWT Framework JWK to a did:key method spec string
     * @param JWK $jwk JWK to convert
     * @return string did:key method spec string
     * @throws Exception
     */
    public function jwkToDidKey(JWK $jwk): string | Exception
    {
        $mbase = (new MultibaseConversionFactory())->jwkToMbase($jwk);

        return 'did:key:' . $mbase;
    }
}
