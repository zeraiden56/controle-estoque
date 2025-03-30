<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../../vendor/autoload.php';

class JwtHelper {
    private static $chave = 'chave_super_secreta'; // Trocar depois por algo seguro

    public static function gerarToken($payload) {
        $payload['exp'] = time() + (60 * 60 * 2); // expira em 2 horas
        return JWT::encode($payload, self::$chave, 'HS256');
    }

    public static function verificarToken($token) {
        try {
            return JWT::decode($token, new Key(self::$chave, 'HS256'));
        } catch (Exception $e) {
            return false;
        }
    }
}
