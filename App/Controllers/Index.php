<?php

namespace App\Controllers;

use UNIS\Controller\Action;
use UNIS\Di\Container;
use App\Models\TaskResult;
use App\Models\TaskFormat;

class Index extends Action
{
	private $task;
	private $form;

	public function __construct()
	{
		parent::__construct();
		$this->task = Container::getClass('task');
		$this->form = Container::getClass('form');
	}

	public function index()
	{
		if(!is_null($this->getParam())) {
			$this->view->result = $this->getParam();
		}

		$this->view->taskList = $this->task->fetchAll();
		TaskFormat::taskListFormat($this->view->taskList);

		$this->form->setAction('index');
		$this->view->form = $this->form;
		//formatar os dados das tarefas.
		$this->render('index');
	}

	public function add()
	{
		$addResult = TaskResult::ADD_OK;
		//receber os dados do formulários
		if($this->task->add($_POST) !== true)
		{
			$addResult = TaskResult::ADD_ERROR;
		};

		$this->redirect("/index/{$addResult}");

		//$this->render('add');
		//$this->redirect();
	}

	public function edit()
    {

		$this->view->taskEdit = $this->task->find($this->getParam());

		if($this->view->taskEdit == false) {
			$this->redirect("/index");
		}

		$this->form->setAction('edit');
		$this->view->form = $this->form;

		$this->render('edit');
	}
	

	public function update()
	{
		$editResult = TaskResult::EDIT_OK;
		if($this->task->update($_POST, $_POST['id']) !== 1) 
		{
			$editResult = TaskResult::EDIT_ERROR;
		}
		
		$this->redirect("/index/{$editResult}");
	}



	public function delete()
	{

		$deleteResult = TaskResult::DELETE_OK;
		if ($this->task->delete($_POST) !== true) {
			$deleteResult = TaskResult::DELETE_ERROR;
		}

		$this->redirect("/index/{$deleteResult}");

	}
	
}