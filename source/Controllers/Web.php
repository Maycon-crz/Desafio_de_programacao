<?php

namespace Source\controllers;

use League\Plates\Engine;
use Source\Models\User;
class Web{
	private $view;

	public function __construct($router){
		$this->view = Engine::create(
			dirname(__DIR__, 2) . "/theme",
			"php"
		);
		$this->view->addData(["router" => $router]);
	}

	public function home(): void{
		echo $this->view->render("home", [
			"dados" => "Testes"
		]);
	}
}
