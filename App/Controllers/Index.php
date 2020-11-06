<?php

namespace App\Controllers;

use UNIS\Controller\Action;
use UNIS\Di\Container;
use App\Models\TaskResult;
use App\Models\TaskFormat;

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
		TaskFormat::taskListFormat($this->view->taskList);
		
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

	public function edit()
	{
		
		var_dump($this->getParam());
	}
	
	public function delete()
	{
		var_dump($this->getParam());
	
	}
	
}