#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

// Фабрика создает экземпляр класса банка ( классы банков лежат в factory/banks)
// На данный момент доступны: Rsb - Центробанк РФ, Ukr - Центробанк Украины, Eur - Центробанк Евросоюза
$factory = new \Backend\Factory\CurrencyFactory('Eur');

