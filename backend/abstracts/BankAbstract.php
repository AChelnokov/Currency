<?php

namespace Backend\Abstracts;


abstract class BankAbstract
{
    public $currency_array = [];

    // Получаем ссылку на xml фид с курсами
    abstract public function getXmlUrl(): string;
    // Конвертируем полученные данные в массив вида Ключ = код валюты, значение = курс валюты
    abstract public function convertData(): array;

    // Парсим ссылку на предмет xml, xml конвертируем в массив и кладем в $currency_array;
    final public function parseUrl(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getXmlUrl());
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $info = curl_exec($ch);
        curl_close($ch);

        $this->currency_array = new \SimpleXMLElement($info);
    }

    // Сохраняем данные в файл
    final public function saveFile() {
        $data = $this->convertData();
        file_put_contents('../public_html/data/currency.json', json_encode($this->convertData()));
    }
}