<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter\Tests;

use Jose\Component\Core\JWK;

class TestHelper
{
    public function getSecp256k1Jwks(): array
    {
        $jwks = [];

        $jwks[] = new JWK([
            'kty' => 'EC',
            'crv' => 'secp256k1',
            'x'   => 'h0wVx_2iDlOcblulc8E5iEw1EYh5n1RYtLQfeSTyNc0',
            'y'   => 'O2EATIGbu6DezKFptj5scAIRntgfecanVNXxat1rnwE',
        ]);

        $jwks[] = new JWK([
            'kty' => 'EC',
            'crv' => 'secp256k1',
            'x'   => '1LjPGVO9OOqfeaUcT9S-Ml_5wQOybbSQ0SGgMgG9U0M',
            'y'   => 'aq-OS5tX6WqaY6fDHtATYwbIUijr8PvcGWd-FnCNQBM',
        ]);

        $jwks[] = new JWK([
            'kty' => 'EC',
            'crv' => 'secp256k1',
            'x'   => 'tS0TJpT9-UUpJvjMZUyA0C0oI9l7VW8d2ADptYRJVdM',
            'y'   => 'RQEb5Z7oO52oHNpYk9lbbuwZmA_GFNenqSjX4joDh-A',
        ]);

        return $jwks;
    }

    public function getP384Jwks(): array
    {
        $jwks = [];

        $jwks[] = new JWK([
            'kty' => 'EC',
            'crv' => 'P-384',
            'x'   => 'lInTxl8fjLKp_UCrxI0WDklahi-7-_6JbtiHjiRvMvhedhKVdHBfi2HCY8t_QJyc',
            'y'   => 'y6N1IC-2mXxHreETBW7K3mBcw0qGr3CWHCs-yl09yCQRLcyfGv7XhqAngHOu51Zv',
        ]);

        $jwks[] = new JWK([
            'kty' => 'EC',
            'crv' => 'P-384',
            'x'   => 'CA-iNoHDg1lL8pvX3d1uvExzVfCz7Rn6tW781Ub8K5MrDf2IMPyL0RTDiaLHC1JT',
            'y'   => 'Kpnrn8DkXUD3ge4mFxi-DKr0DYO2KuJdwNBrhzLRtfMa3WFMZBiPKUPfJj8dYNl_',
        ]);

        return $jwks;
    }

    public function getSecp256k1Keys(bool $didKey = false): array
    {
        // if didKey is true, return did:key: prefixed keys
        $didKeyPrefix = $didKey ? 'did:key:' : '';

        return [
            $didKeyPrefix . 'zQ3shokFTS3brHcDQrn82RUDfCZESWL1ZdCEJwekUDPQiYBme',
            $didKeyPrefix . 'zQ3shtxV1FrJfhqE1dvxYRcCknWNjHc3c5X1y3ZSoPDi2aur2',
            $didKeyPrefix . 'zQ3shZc2QzApp2oymGvQbzP8eKheVshBHbU4ZYjeXqwSKEn6N'
        ];
    }

    public function getP384Keys(bool $didKey = false): array
    {
        // if didKey is true, return did:key: prefixed keys
        $didKeyPrefix = $didKey ? 'did:key:' : '';

        return [
            $didKeyPrefix . 'z82Lm1MpAkeJcix9K8TMiLd5NMAhnwkjjCBeWHXyu3U4oT2MVJJKXkcVBgjGhnLBn2Kaau9',
            $didKeyPrefix . 'z82LkvCwHNreneWpsgPEbV3gu1C6NFJEBg4srfJ5gdxEsMGRJUz2sG9FE42shbn2xkZJh54'
        ];
    }
}
