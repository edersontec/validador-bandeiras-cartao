<?php

use PHPUnit\Framework\TestCase;
use App\Middleware\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

class AuthMiddlewareTest extends TestCase
{
    public function testAuthMiddlewareWithValidToken()
    {
        $_ENV['BEARER_TOKEN'] = '1234567890';

        $middleware = new AuthMiddleware();
        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('GET', '/')
                                  ->withHeader('Authorization', 'Bearer 1234567890');
        $response = $responseFactory->createResponse();

        $handler = $this->createMock(RequestHandler::class);
        $handler->method('handle')->willReturn($response);

        $result = $middleware->__invoke($request, $handler);

        $this->assertEquals(200, $result->getStatusCode());
    }

    public function testAuthMiddlewareWithInvalidToken()
    {
        $_ENV['BEARER_TOKEN'] = '1234567890';

        $middleware = new AuthMiddleware();
        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('GET', '/')
                                  ->withHeader('Authorization', 'Bearer invalidtoken');
        $response = $responseFactory->createResponse();

        $handler = $this->createMock(RequestHandler::class);

        $result = $middleware->__invoke($request, $handler);

        $this->assertEquals(401, $result->getStatusCode());

        $responseBody = (string) $result->getBody();
        $decodedBody = json_decode($responseBody, true);
        $this->assertArrayHasKey('error', $decodedBody);
        $this->assertEquals('Token inválido', $decodedBody['error']);
    }

    public function testAuthMiddlewareWithoutToken()
    {
 
        $middleware = new AuthMiddleware();
        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('GET', '/');

        $response = $responseFactory->createResponse();

        $handler = $this->createMock(RequestHandler::class);

        $result = $middleware->__invoke($request, $handler);

        $this->assertEquals(401, $result->getStatusCode());

        $responseBody = (string) $result->getBody();
        $decodedBody = json_decode($responseBody, true);
        $this->assertArrayHasKey('error', $decodedBody);
        $this->assertEquals('Token não fornecido ou inválido', $decodedBody['error']);
    }
}