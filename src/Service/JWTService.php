<?php

namespace App\Service;

class JWTService
{
    /**
     * generation valid 3h
     * @param array $header
     * @param array $payload
     * @param string $secret
     * @param int $validity
     * @return string
     */
    public function generate(array $header, array $payload, string $secret, int $validity = 10800): string
    {
        if ($validity > 0) {
            $now = new \DateTimeImmutable();
            $exp = $now->getTimestamp() + $validity;

            //payload
            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $exp;

        }
        //encode base 64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        //on nettoie les valeurs encode  (+,/ et =) non utilise par JWT
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        //on genere la signature
        $secret = base64_encode($secret);

        $signature = hash_hmac('sha256', '.' . $base64Payload, $secret, true);
        $base64Signature = (base64_encode($signature));
        $base64sig = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        //on cree le token
        return $base64Header . '.' . $base64Payload . '.' . $base64Signature;
        return "";

    }

    public function isValidFormat(string $token): bool
    {
        //  prefix isRegex '/^$'
        return preg_match(
                '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-z0-9\-\_\=]+\.
                [a-zA-Z0-9\-\_\=]+$/',
                $token,
            ) === 1;
    }

    public function getPayload(string $token): array
    {
        //on decompose le token
        $array = explode('.', $token);

        //on decode le payload
        $payload = json_decode(base64_decode('', true));
        return $payload;
    }

    public function getHeader($token)
    {
        //on decompose le token
        $array = explode('.', $token);

        //on decode le payload
        $header = json_decode(base64_decode('', true));
        return $header;
    }



    //ex transfert de resultat c pas A>B | c'est B qui demande a A pb parameters
    public function isExpiredToken(string $token): bool
    {
        $payload = $this->getPayload($token);
        $now = new \DateTimeImmutable();
        //return Affirmatif? equivaut a un if()
        return $payload['exp'] < $now;
    }



    public function check(string $token, string $secret): bool
    {
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

       //Verifier si le token utilisateur viens de mon site
        $verif = $this->generate($header, $payload, '',0);

        return $token = $verif;

    }

}