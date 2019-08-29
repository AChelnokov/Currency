<?php

namespace Backend\Factory;

use Backend\Abstracts\BankAbstract;


class CurrencyFactory
{
    public function __construct($bank)
    {
        $bank_class = "Backend\\Factory\\Banks\\" . $bank;
        $this->process(new $bank_class );
    }

    public function process(BankAbstract $class)
    {
        $class->parseUrl();
        $class->saveFile();
    }
}