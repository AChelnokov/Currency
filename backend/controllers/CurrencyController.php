<?php

namespace Backend\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Backend\Models\Currency;

class CurrencyController
{

    public function create(){
        $obj = (new Currency())->createOrder();
        $response = new Response(json_encode($obj),  Response::HTTP_OK, ['content-type' => 'application/json']);
        $response->send();
    }

    public function getOrders(){
        $obj = (new Currency())->getOrders();
        $response = new Response(json_encode($obj),  Response::HTTP_OK, ['content-type' => 'application/json']);
        $response->send();
    }

}