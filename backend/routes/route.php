<?php 
namespace Backend\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


  
$collection = new RouteCollection();
$request = Request::createFromGlobals();


/* Коллекция маршрутов */

// Данный роут выводит шаблон страницы SPA, если его закомментить то главная страница / будет возвращать 404
$collection->add('/', new Route('/', array(
    '_controller' => 'Backend\Controllers\ViewController',
    'f' => 'show',
    'method' => 'GET'
)));

$collection->add('/set_currency', new Route('/set_currency', array(
    '_controller' => 'Backend\Controllers\CurrencyController',
    'f' => 'create',
    'method' => 'POST'
)));

$collection->add('/get_orders', new Route('/get_orders', array(
    '_controller' => 'Backend\Controllers\CurrencyController',
    'f' => 'getOrders',
    'method' => 'GET'
)));




/* Конец коллекции маршрутов */

$context = new RequestContext($request->server->get('REQUEST_URI'),$request->server->get('REQUEST_METHOD'));
$matcher = new UrlMatcher($collection, $context);

try {
   $parameters = $matcher->match($request->server->get('REQUEST_URI'));
   if ($request->server->get('REQUEST_METHOD') != $parameters['method']){
   	 throw new ResourceNotFoundException;
   }
}
catch (ResourceNotFoundException $e) {
	return 404;
}



return $parameters;