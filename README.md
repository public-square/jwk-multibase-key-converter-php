JWK Multibase Key Converter
=================

[![Latest Stable Version](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/v/stable.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)
[![Total Downloads](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/downloads.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)
[![Latest Unstable Version](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/v/unstable.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)
[![License](https://poser.pugx.org/public-square/jwk-multibase-key-converter-php/license.png)](https://packagist.org/packages/public-square/jwk-multibase-key-converter-php)

## Information

This library is a tool to assist in the conversion of **did:key** method keys to JWK, and vice versa. It utilizes Multibase/Multicodec, Simplito-EC, and JWT Framework to aid in these conversions.

For more information on the **did:key** spec, please read the current unofficial draft [here](https://w3c-ccg.github.io/did-method-key/).

Currently, the only support curves are as follows:

 - secp256k1
 - nistp384

## Convert a Multibase / Multicodec public key to JWK
...

## Requirements

* \>= PHP 8.1
* composer
* ext-gmp

## Installation

You can install this library via Composer :

`composer require public-square/jwk-multibase-key-converter-php-php`

## Contribute

Please open a pull request.

## License

This software is release under [MIT license](LICENSE).
