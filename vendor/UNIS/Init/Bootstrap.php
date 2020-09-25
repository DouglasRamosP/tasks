<?php

namespace UNIS\Init;

abstract class Bootstrap
{
	private $routes;
	private $controller;
	const URL_ROUTE = 1;

	public function __construct()
	{
		$controller = null;
		$this->initRoutes();
		$this->run($this->getUrl());
	}

	abstract protected function initRoutes();

	protected function run($url)
	{
		array_walk($this->routes, function($route) use ($url) {
		   if($url == $route['route']) {
		   	  $class = 'App\\Controllers\\' . ucfirst($route['controller']);
		      $this->controller = new $class;
		      
		      $action = $route['action'];
		      $this->controller->$action();
		   }
		});
		//error page
		if (is_null($this->controller)) {
			echo 'ERROR 404 - Page Not Found';
		}
	}

	protected function setRoutes(array $routes)
	{
	    $this->routes = $routes;
	}

	protected function getUrl()
	{
		$url = explode('/', $_SERVER['REQUEST_URI']);
        
        return parse_url('/' . $url[self::URL_ROUTE], PHP_URL_PATH);
	}
}