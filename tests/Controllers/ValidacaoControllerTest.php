<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\ValidacaoController;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

class ValidacaoControllerTest extends TestCase
{
    public function testValidarNumeroCartaoValido()
    {
        $controller = new ValidacaoController();
        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('POST', '/api/validarNumeroCartao')
                                  ->withParsedBody(['numeroCartao' => '4111111111111111']);
        $response = $responseFactory->createResponse();

        $result = $controller->validarNumeroCartao($request, $response, []);

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertStringContainsString('Visa', (string) $result->getBody());
    }

    public function testValidarNumeroCartaoInvalido()
    {
        $controller = new ValidacaoController();
        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('POST', '/api/validarNumeroCartao')
                                  ->withParsedBody(['numeroCartao' => '000000']);
        $response = $responseFactory->createResponse();

        $result = $controller->validarNumeroCartao($request, $response, []);

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertStringContainsString('{"numeroCartao":"000000","valido":false}', (string) $result->getBody());
    }
}