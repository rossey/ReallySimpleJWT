<?php

declare(strict_types=1);

namespace ReallySimpleJWT;

use ReallySimpleJWT\Jwt;

/**
 * The Parsed value object. This is generated by the Parse class, it contains
 * the original JWT value object, and it's component parts. The header and
 * payload are associative arrays. The class also offers helper methods which
 * provide easier access to the header and payload claim data.
 *
 * @author Rob Waller <rdwaller1984@googlemail.com>
 */
class Parsed
{
    /**
     * The pre-parsed JWT value object
     *
     * @var Jwt
     */
    private $jwt;

    /**
     * Associative array of header claims
     *
     * @var array
     */
    private $header;

    /**
     * Associative array of payload claims
     *
     * @var array
     */
    private $payload;

    /**
     * The JWT signature string
     *
     * @var string
     */
    private $signature;

    /**
     * The Parsed constructor
     *
     * @param Jwt $jwt
     * @param array $header
     * @param array $payload
     * @param string $signature
     */
    public function __construct(Jwt $jwt, array $header, array $payload, string $signature)
    {
        $this->jwt = $jwt;

        $this->header = $header;

        $this->payload = $payload;

        $this->signature = $signature;
    }

    /**
     * Return the origin JWT value object
     *
     * @return Jwt
     */
    public function getJwt(): Jwt
    {
        return $this->jwt;
    }

    /**
     * Get the header claims data as an associative array.
     *
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * Helper method to quickly access the type claim from the header. Will
     * return an empty string if not set.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->header['typ'] ?? '';
    }

    /**
     * Helper method to quickly access the content type claim from the header.
     * Will return an empty string if not set.
     *
     * @return string
     */
    public function getContentType(): string
    {
        return $this->header['cty'] ?? '';
    }

    /**
     * Get the payload claims data as an associative array.
     *
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * Helper method to quickly access the issuer claim from the payload.
     * Will return an empty string if not set.
     *
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->payload['iss'] ?? '';
    }

    /**
     * Helper method to quickly access the subject claim from the payload.
     * Will return an empty string if not set.
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->payload['sub'] ?? '';
    }

    /**
     * Helper method to quickly access the audience claim from the payload.
     * Can return a string or an array. Will return an empty string if not set.
     *
     * @return string|array
     */
    public function getAudience()
    {
        return $this->payload['aud'] ?? '';
    }

    /**
     * Helper method to quickly access the expiration claim from the payload.
     * Will return zero if not set.
     *
     * @return int
     */
    public function getExpiration(): int
    {
        return $this->payload['exp'] ?? 0;
    }

    /**
     * Helper method to quickly access the not before claim from the payload.
     * Will return zero if not set.
     *
     * @return int
     */
    public function getNotBefore(): int
    {
        return $this->payload['nbf'] ?? 0;
    }

    /**
     * Helper method to quickly access the issued at claim from the payload.
     * Will return zero if not set.
     *
     * @return int
     */
    public function getIssuedAt(): int
    {
        return $this->payload['iat'] ?? 0;
    }

    /**
     * Helper method to quickly access the JWT Id claim from the payload.
     * Will return an empty string if not set.
     *
     * @return string
     */
    public function getJwtId(): string
    {
        return $this->payload['jti'] ?? '';
    }

    /**
     * Get the JWT signature string if required.
     *
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }
}
