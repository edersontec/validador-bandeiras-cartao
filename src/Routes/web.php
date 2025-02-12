<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Exception\HttpNotFoundException;
use App\Controllers\ValidacaoController;
use App\Middleware\AuthMiddleware;

return function (App $app) {

    $app->addBodyParsingMiddleware();

    $app->post('/api/validarNumeroCartao', [ValidacaoController::class, 'validarNumeroCartao'])->add(new AuthMiddleware());

    // Outras rotas

    // Rota padrão para capturar todas as rotas não declaradas
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(['error' => 'Rota não encontrada']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    });
};