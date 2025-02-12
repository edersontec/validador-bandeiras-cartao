<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $authHeader = $request->getHeader('Authorization');
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader[0], $matches)) {
            $response = new SlimResponse();
            $response->getBody()->write(json_encode(['error' => 'Token não fornecido ou inválido']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }

        $token = $matches[1];

        // Verifique o token aqui (substitua esta lógica pela sua verificação de token)
        if (!$this->isValidToken($token)) {
            $response = new SlimResponse();
            $response->getBody()->write(json_encode(['error' => 'Token inválido']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }

        return $handler->handle($request);
    }

    private function isValidToken($token)
    {
        // Implementar a lógica de validação do token aqui
        // Retornar true se o token for válido, caso contrário, false
        return $token === $_ENV['BEARER_TOKEN']; // Usar a variável de ambiente
    }
}