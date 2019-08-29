<?php 

namespace Backend;

use Symfony\Component\HttpFoundation\Response;

class System 
{
    // Время начала выполнения скрипта
    private static $start = 0;

    /* Инициализируем систему и передаем в параметре время старта системы (берется из входной точки скрипта public_html/index.php) */

    public function init(int $start = 0)
    {
        $this->setStartTime($start);

        // Грузим файл со списком возможных роутов, если текущий url не найден в списке роутов то $route присвоится 404 (возвращается из route.php)
    	$route = require __DIR__.'/routes/route.php';

    	// Если наш url не найден в списке роутов и нам было возвращено 404 то возвращаем клиенту 404 заголовок
    	if ($route == 404){
    		$response = new Response('',  Response::HTTP_NOT_FOUND, ['content-type' => 'application/json']);
    		$response->send();
    	}else{
    	    // Если роут был найден то создаем экземляр класса который указан в роутере и инициализируем указанный метод
            $controller = new $route['_controller'];
            $controller->{$route['f']}();
    	}
    }

    private function setStartTime($time){
        self::$start = $time;
    }

    public static function getStartTime(){
        return self::$start;
    }



}
