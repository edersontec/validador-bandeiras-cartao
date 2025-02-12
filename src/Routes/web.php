<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use App\Controllers\ValidacaoController;

return function (App $app) {

    $app->post( '/validar', [ValidacaoController::class, 'validarCartao'] );

    // Outras rotas
};