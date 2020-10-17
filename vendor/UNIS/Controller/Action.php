<?php

namespace UNIS\Controller;

class Action
{
	protected $view;
	protected $action;
	protected $stdLayout;
    const URL_WITH_PARAM = 3;
    const URL_PARAM = 2;

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
        $url = explode('/', $_SERVER['REQUEST_URI']);
        
        if (count($url) < self::URL_WITH_PARAM 
            || empty($url[self::URL_PARAM])) {
            
            return null;
        }

        return $url[self::URL_PARAM];
    }

    public function redirect($route = '/')
    {
        header("Location: {$route}");
    }
}