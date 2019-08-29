<?php

namespace Backend\Factory\Banks;

use Backend\Abstracts\BankAbstract;

class Eur extends BankAbstract
{


    public function getXmlUrl(): string
    {
        return 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
    }


    public function convertData(): array
    {
        $arr = [];
        foreach ($this->currency_array->Cube->Cube->Cube as $item){
            $arr[(string) $item->attributes()->currency]['value'] = (float) str_replace(",",".", $item->attributes()->rate);
            $arr[(string) $item->attributes()->currency]['nominal'] = (int) 1;
        }

        $arr['EUR']['value'] = (string) 1;
        $arr['EUR']['nominal'] = (string) 1;

        return (array) $arr;
    }

}