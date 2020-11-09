<?php

namespace App\Models;

class Form
{
	private $action;
	private $actionButton;
	private $actionButtonText;

	public function setAction($action)
	{
		$this->isIndex($action);
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getActionButton()
	{
		return $this->actionButton;
	}

	public function getActionButtonText()
	{
		return $this->actionButtonText;
	}

	private function isIndex($action)
	{
		$this->action = '/add';
		$this->actionButton = 'save';
		$this->actionButtonText = 'Salvar';

		if($action != 'index') {
			$this->action = '/update';
			$this->actionButton = 'update';
			$this->actionButtonText = 'Atualizar';
		}
	}
}