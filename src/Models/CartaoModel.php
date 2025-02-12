<?php

namespace App\Models;

class CartaoModel
{
    public function detectarBandeira($numeroCartao)
    {
        // Remover espaços em branco
        $numeroCartao = preg_replace('/\s+/', '', $numeroCartao);

        if ($numeroCartao == NULL || $numeroCartao == '') {
            return false;
        }

        // Visa: Começa sempre com o número 4
        if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $numeroCartao)) {
            return 'Visa';
        }

        // MasterCard: Começa com dígitos entre 51 e 55, ou entre 2221 a 2720
        if (preg_match('/^5[1-5][0-9]{14}$/', $numeroCartao) || preg_match('/^2(2[2-9][1-9]|[3-6][0-9]{2}|7[01][0-9]|720)[0-9]{12}$/', $numeroCartao)) {
            return 'MasterCard';
        }

        // Elo: Pode começar com vários intervalos
        if (preg_match('/^(4011|4312|4389|4514|4576|5041|5066|5067|509|6277|6362|6363|650|6516|6550)[0-9]{0,}$/', $numeroCartao)) {
            return 'Elo';
        }

        // American Express: Inicia com 34 ou 37
        if (preg_match('/^3[47][0-9]{13}$/', $numeroCartao)) {
            return 'American Express';
        }

        // Discover: Começa com 6011, 65, ou com a faixa de 644 a 649
        if (preg_match('/^6(?:011|5[0-9]{2}|4[4-9][0-9])[0-9]{12}$/', $numeroCartao)) {
            return 'Discover';
        }

        // Hipercard: Geralmente começa com 6062
        if (preg_match('/^606282|^3841(?:[0|4|6]{1})0/', $numeroCartao)) {
            return 'Hipercard';
        }

        return false;
    }

    // Adicionar métodos adicionais para manipulação de dados conforme necessário
}