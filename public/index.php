<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Middleware\AuthMiddleware;

require __DIR__ . '/../vendor/autoload.php';

// Carregar variáveis de ambiente do arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

(require __DIR__ . '/../src/Routes/web.php')($app);

// Adicionar o middleware de autenticação
$app->add(new AuthMiddleware());

$app->run();
