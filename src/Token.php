<?php namespace ReallySimpleJWT;

/**
 * A simple Package for creating JSON Web Tokens that uses HMAC SHA256 to sign
 * signatures. Exposes a simple interface to allow you to create a simple token
 * that stores a user identifier. The Package is set up to allow extension and
 * the use of larger payloads.
 *
 * For more information on JSON Web Tokens please see https://jwt.io
 *
 * @author Rob Waller <rdwaller1984@gmail.com>
 */

class Token
{
    /**
     * Create a JSON Web Token that contains a User Identifier Payload
     *
     * @param mixed $userId
     * @param string $secret
     * @param string $expiration
     * @param string $issuer
     *
     * @return string
     */
    public static function getToken($userId, string $secret, string $expiration, string $issuer): string
    {
        $builder = Self::builder();

        return $builder->addPayload(['key' => 'user_id', 'value' => $userId])
            ->setSecret($secret)
            ->setExpiration($expiration)
            ->setIssuer($issuer)
            ->build();
    }

    /**
     * Validate a JSON Web Token's expiration and signature
     *
     * @param string $token
     * @param string $secret
     *
     * @return bool
     */
    public static function validate(string $token, string $secret): bool
    {
        $validator = Self::validator();

        return $validator->splitToken($token)
            ->validateExpiration()
            ->validateSignature($secret);
    }

    /**
     * Interface to return instance of the token builder
     *
     * @return TokenBuilder
     */
    public static function builder(): TokenBuilder
    {
        return new TokenBuilder();
    }

    /**
     * Interface to return instance of the token validator
     *
     * @return TokenValidator
     */
    public static function validator(): TokenValidator
    {
        return new TokenValidator();
    }
}
