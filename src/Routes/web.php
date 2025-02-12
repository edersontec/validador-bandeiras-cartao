<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->get('/validar', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });

    // Outras rotas
};