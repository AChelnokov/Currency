<?php

namespace Backend\Factory\Banks;

use Backend\Abstracts\BankAbstract;

class Rsb extends BankAbstract
{


    public function getXmlUrl(): string
    {
        return 'http://www.cbr.ru/scripts/XML_daily.asp';
    }


    public function convertData(): array
    {
        $arr = [];
        foreach ($this->currency_array->Valute as $k=>$item){
            $arr[(string) $item->CharCode]['value'] = (float) str_replace(",",".", $item->Value);
            $arr[(string) $item->CharCode]['nominal'] = (int) $item->Nominal;
        }

        $arr['RUB']['value'] = (string) 1;
        $arr['RUB']['nominal'] = (string) 1;

        return (array) $arr;
    }

}