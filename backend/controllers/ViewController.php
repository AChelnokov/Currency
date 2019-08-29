<?php

namespace Backend\Controllers;

class ViewController {

	public function show() {
		$view = require realpath(__DIR__.'/../view/index.view.php');
		return $view;
	}

}