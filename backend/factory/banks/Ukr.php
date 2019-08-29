<?php

namespace Backend\Factory\Banks;

use Backend\Abstracts\BankAbstract;

class Ukr extends BankAbstract
{

    public function getXmlUrl(): string
    {
        return 'https://bank.gov.ua/NBU_Exchange/exchange';
    }


    public function convertData(): array
    {

        $arr = [];
        foreach ($this->currency_array->ROW as $k=>$item){
            $arr[(string) $item->CurrencyCodeL]['value'] = (float) str_replace(",",".",$item->Amount);
            $arr[(string) $item->CurrencyCodeL]['nominal'] = (int) $item->Units;
        }
        $arr['UAH']['value'] = (string) 1;
        $arr['UAH']['nominal'] = (string) 1

        return (array) $arr;
    }

}