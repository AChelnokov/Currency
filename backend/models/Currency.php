<?php

namespace Backend\Models;

use Symfony\Component\HttpFoundation\Request;
use Backend\Db;

class Currency
{

    public function createOrder()
    {
        $request = Request::createFromGlobals();
        $data = json_decode($request->getContent());
        $currency = $data->form->currency ?? "EUR";

        $obj = [];
        $obj['cost'] = $this->convert($data->form->usd, $currency);
        $obj['currency'] =  $currency;
        $obj['start_time'] = \Backend\System::getStartTime();

        $db = Db::getInstance();
        $q = $db->prepare("INSERT INTO orders (user_id, ip, usd, currency, cost, start_time, stop_time) VALUES (:user_id, :ip, :usd, :currency, :cost, :start_time, :stop_time)");
        $q->bindValue(':user_id', $data->form->user_id ?? 0);
        $q->bindValue(':ip', $request->getClientIp());
        $q->bindValue(':usd', $data->form->usd ?? 1);
        $q->bindValue(':currency', $obj['currency']);
        $q->bindValue(':cost', $obj['cost']);
        $q->bindValue(':start_time', $obj['start_time']);
        $q->bindValue(':stop_time', microtime(true));
        $q->execute();

        return $obj;
    }

    private function getList(){
        $f = file_get_contents(__DIR__.'/../../public_html/data/currency.json');
        return json_decode($f);
    }

    private function convert($num = 1, $to_currency = "EUR"){
        if (!$num || $num <= 0){
        	$num = 1;
        }

        $list = $this->getList();

        $convert = $num * ($list->USD->value / $list->{$to_currency}->value) / ($list->USD->nominal * $list->{$to_currency}->nominal);
        return round($convert, 2);
    }

    public function getOrders(){
        $response = [];

        $db = Db::getInstance();
        $stm2 = $db->prepare("SELECT * FROM orders WHERE 1");
        $stm2->execute();

        $response['data'] = $stm2->fetchAll(\PDO::FETCH_ASSOC);

        return $response;
    }

}