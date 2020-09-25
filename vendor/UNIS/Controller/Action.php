<?php

namespace UNIS\Controller;

class Action
{
	protected $view;
	protected $action;
	protected $stdLayout;

	public function __construct()
	{
		$this->view = new \stdClass();
		$this->stdLayout = "../App/views/layout.phtml";
	}

    public function render($action, $layout=true)
    {
    	$this->action = $action;

    	if ($layout == true && file_exists($this->stdLayout)) {
    		include_once $this->stdLayout;
    	} else {
    		$this->content();
    	}

    }

    public function content()
    {
    	$current = get_class($this); 
    	
    	$singleClassName = strtolower(str_replace("App\\Controllers\\", "", $current));	

    	include_once '../App/views/' . $singleClassName . '/' . $this->action . '.phtml';

    }

    public function getParam()
    {

    }

    public function redirect()
    {

    }
}