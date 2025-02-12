<?php

namespace App\Models;

class ValidacaoModel
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    // Add additional methods for data manipulation as needed
}