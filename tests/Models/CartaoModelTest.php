<?php

use PHPUnit\Framework\TestCase;
use App\Models\CartaoModel;

class CartaoModelTest extends TestCase
{
    public function testDetectarBandeiraVisa()
    {
        $model = new CartaoModel();
        $result = $model->detectarBandeira('4111111111111111');
        $this->assertEquals('Visa', $result);
    }

    public function testDetectarBandeiraMasterCard()
    {
        $model = new CartaoModel();
        $result = $model->detectarBandeira('5105105105105100');
        $this->assertEquals('MasterCard', $result);
    }

    public function testDetectarBandeiraStringVazia()
    {
        $model = new CartaoModel();
        $result = $model->detectarBandeira('');
        $this->assertEquals( false, $result);
    }

    // Adicione mais testes para outras bandeiras de cartão
}