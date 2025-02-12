<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\CartaoModel;

class ValidacaoController
{

    protected $cartaoModel;

    public function __construct()
    {
        $this->cartaoModel = new CartaoModel();
    }

    public function validarCartao(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $numeroCartao = $data['numeroCartao'] ?? '';

        $arrayResponse = [
            'numeroCartao' => $numeroCartao,
            'valid' => false
        ];

        // Lógica de validação do cartão de crédito
        $bandeira = $this->cartaoModel->detectarBandeira($numeroCartao);

        if($bandeira){
            $arrayResponse['bandeira'] = $bandeira;
            $arrayResponse['valid'] = true;
        }

        $response->getBody()->write(json_encode($arrayResponse));
        return $response->withHeader('Content-Type', 'application/json');
    }
}