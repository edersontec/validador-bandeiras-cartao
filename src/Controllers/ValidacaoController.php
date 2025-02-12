<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ValidacaoController
{
    public function index(Request $request, Response $response, $args)
    {
        // Logic to handle the index request
        $response->getBody()->write("List of examples");
        return $response;
    }

    public function show(Request $request, Response $response, $args)
    {
        // Logic to handle the show request for a specific example
        $id = $args['id'];
        $response->getBody()->write("Details of example with ID: $id");
        return $response;
    }

    public function create(Request $request, Response $response, $args)
    {
        // Logic to handle the creation of a new example
        $response->getBody()->write("Creating a new example");
        return $response;
    }

    public function update(Request $request, Response $response, $args)
    {
        // Logic to handle the update of an existing example
        $id = $args['id'];
        $response->getBody()->write("Updating example with ID: $id");
        return $response;
    }

    public function delete(Request $request, Response $response, $args)
    {
        // Logic to handle the deletion of an example
        $id = $args['id'];
        $response->getBody()->write("Deleting example with ID: $id");
        return $response;
    }
}