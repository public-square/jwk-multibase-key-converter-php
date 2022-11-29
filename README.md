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

## How It Works
- Public JWK Generation
  - [Generating a Public Key](docs/examples/jwk_generation.md)
- Multibase Conversion
  - [Converting a Multibase Key to a Public JWK](docs/examples/multibase_conversion.md)
- **did:key** Conversion
  - [Converting a did:key to a Public JWK](docs/examples/didkey_conversion.md)
- Public JWK Conversion
  - [Converting a Public JWK to a Multibase Key](docs/examples/jwk_to_mbase.md)
  - [Converting a Public JWK to a did:key](docs/examples/jwk_to_didkey.md)

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
