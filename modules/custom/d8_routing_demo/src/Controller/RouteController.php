<?php

namespace Drupal\d8_routing_demo\Controller;
use Drupal\user\UserInterface;

class RouteController{

	public function hello_world(){

		return[
			'#type' => '#markup',
			'#markup' => 'Hello World.!'
		];
	}
	public function helloDynamic($name){

		return[
			'#type' => '#markup',
			'#markup' => 'Hello '.$name
		];
	}
	public function helloDynamicTitleCallback($name){

		return $name;
	}

	public function helloDynamicEntity(UserInterface $user){
		//ksm($user);

		return[
			'#type' => '#markup',
			'#markup' => 'Hello '.$user->getUsername()
		];
	}
	public function helloDynamicEntityTitleCallback(UserInterface $user){

		return $user->getUsername();
	}

}