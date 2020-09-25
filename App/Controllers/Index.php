<?php

namespace App\Controllers;

use UNIS\Controller\Action;

class Index extends Action
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->render('index');
	}

	public function add()
	{
		$this->render('add');
		//$this->redirect();
	}
}