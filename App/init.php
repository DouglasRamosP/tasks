<?php

namespace App;

use UNIS\Init\Bootstrap;

class Init extends Bootstrap
{
	protected function initRoutes()
	{
	    $taskRoutes['home'] = [
	       'route' => '/',
	       'controller' => 'index',
	       'action' => 'index'
	    ];

	    $taskRoutes['add'] = [
	       'route' => '/add',
	       'controller' => 'index',
	       'action' => 'add'	
	    ];

	    $this->setRoutes($taskRoutes);
	}
}