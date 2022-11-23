<?php

declare(strict_types=1);

namespace PublicSquare\JWKMBConverter;

use Elliptic\EC;
use Exception;
use Jose\Component\Core\JWK;
use ParagonIE\ConstantTime\Base64UrlSafe;

use PublicSquare\JWKMBConverter\ConversionHelper;
use YOCLIB\Multiformats\Multibase\Multibase;

class MultibaseConversionFactory
{
    public const SECP256K1_MULTICODEC_HEX_VALUE = 'e701';
    public const P384_MULTICODEC_HEX_VALUE      = '8124';
    public const SIMPLITO_P384_FORM             = 'p384';
    public const SIMPLITO_SECP256K1_FORM        = 'secp256k1';
    public const P384_JWK_CURVE                 = 'P-384';
    public const SECP256K1_JWK_CURVE            = 'secp256k1';
    public const Y_EVEN_KEY_PREFIX              = '02';
    public const Y_ODD_KEY_PREFIX               = '03';

    /**
     * Converts a multibase string to a JWT Framework JWK
     * @param string $mbase multibase string
     * @param string $alg Curve Type in Simplito Format (secp256k1, p384)
     * @return JWK JWT Framework JWK
     * @throws Exception
     */
    public function mbaseToJwk(string $mbase, string $alg): JWK | Exception
    {
        // validate simplito type
        if (in_array($alg, [self::SIMPLITO_SECP256K1_FORM, self::SIMPLITO_P384_FORM]) === false) {
            throw new Exception('Invalid algorithm type.');
        }

        // if mbase begins with did:key:, throw error
        if (str_starts_with('did:key:', $mbase) === true) {
            throw new Exception('Invalid multibase string.');
        }

        $ec = null;

        // load up EC based on type
        try {
            $ec = new EC($alg);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        // decode base58btc string with multibase into binary
        try {
            $multibaseValue = Multibase::decode($mbase);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        // remove first 2 bytes from multibase value and convert to hex
        $multibaseValue = bin2hex(substr($multibaseValue, 2));

        // get x and y values using EC in try-catch
        try {
            $key = $ec->keyFromPublic($multibaseValue, 'hex');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        $xBinary = (string) hex2bin($key->getPublic()->getX()->toString(16));
        $yBinary = (string) hex2bin($key->getPublic()->getY()->toString(16));

        // JWT Framework requires values to be Base64 URL Safe
        $jwk = new JWK([
            'kty' => 'EC',
            'crv' => $alg === self::SIMPLITO_P384_FORM ? self::P384_JWK_CURVE : self::SECP256K1_JWK_CURVE,
            'x'   => Base64UrlSafe::encodeUnpadded($xBinary),
            'y'   => Base64UrlSafe::encodeUnpadded($yBinary),
        ]);

        $isValidJWK = (new ConversionHelper())->validateJWK($jwk);

        if ($isValidJWK === false) {
            throw new \Exception('Invalid JWK');
        }

        return $jwk;
    }

    /**
     * Converts a JWT Framework JWK to a multibase string
     * @param JWK $jwk JWK to convert
     * @return string multibase string
     * @throws Exception
     */
    public function jwkToMbase(JWK $jwk): string | Exception
    {
        $isValidJWK = (new ConversionHelper())->validateJWK($jwk);

        if ($isValidJWK === false) {
            throw new \Exception('Invalid JWK');
        }

        // transform JWK X and Y back to original hex
        $x = bin2hex(Base64UrlSafe::decode($jwk->get('x')));
        $y = bin2hex(Base64UrlSafe::decode($jwk->get('y')));

        $type = $jwk->get('crv');

        // set multicodec hex value based on type of curve
        $multicodecHexValue = match ($type) {
            self::SECP256K1_JWK_CURVE => self::SECP256K1_MULTICODEC_HEX_VALUE,
            self::P384_JWK_CURVE      => self::P384_MULTICODEC_HEX_VALUE,
            default                   => throw new \Exception('Invalid Curve Type'),
        };

        // verify if Y is even or odd
        $isYEven = gmp_cmp(gmp_mod(gmp_init($y, 16), 2), 0) === 0;

        // create compressed version of X
        $compressedX = implode('', [
            $multicodecHexValue,
            $isYEven ? self::Y_EVEN_KEY_PREFIX : self::Y_ODD_KEY_PREFIX,
            $x,
        ]);

        $compressedXBinary = (string) hex2bin($compressedX);

        try {
            $multibaseValue = Multibase::encode(Multibase::BASE58BTC, $compressedXBinary);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $multibaseValue;
    }
}
