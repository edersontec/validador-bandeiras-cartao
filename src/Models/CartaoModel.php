<?php

namespace App\Models;

class CartaoModel
{

    public function detectarBandeira($numeroCartao)
    {
        // Implementar a lógica de validação do cartão de crédito aqui
        // Retornar true se o cartão for válido, caso contrário, false

        if($numeroCartao == NULL || $numeroCartao == '') {
            return false;
        }

        if( strlen($numeroCartao) == 4 ) {
            return true;
        }

        return false;
    }

    // Add additional methods for data manipulation as needed
}