<?php

namespace App\Controllers;

use UNIS\Controller\Action;
use UNIS\Di\Container;
use App\Models\TaskResult;

class Index extends Action
{
	private $task;

	public function __construct()
	{
		parent::__construct();
		$this->task = Container::getClass('task');
	}

	public function index()
	{
		if(!is_null($this->getParam())) {
			$this->view->result = $this->getParam();
		}

		$this->view->taskList = $this->task->fetchAll();
		//formatar os dados das tarefas.
		
		$this->render('index');
	}

	public function add()
	{
		$addResult = TaskResult::ADD_OK;
		if($this->task->add($_POST) !== true) {
			$addResult = TaskResult::ADD_ERROR;
		}
		
		$this->redirect("/index/{$addResult}");
	}

	public function delete()
	{
		
		$deleteResult = TaskResult::DELETE_OK;

		if($this->task->delete($_POST) !== true)
		{
			$deleteResult = TaskResult::DELETE_ERROR;
		};

		$this->redirect("/index/{$deleteResult}");

		//$this->render('delete');
		//$this->redirect();
	}
}