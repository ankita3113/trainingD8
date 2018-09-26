<?php

namespace Drupal\d8_routing_demo\Controller;
use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

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
	public function listNode(NodeInterface $node) {
	    $owner = $node->getOwner()->getAccountName();
	    return [
	      '#type' => '#markup',
	      '#markup' => $node->getTitle() . '|' . $owner,
	    ];
	 }

	 public function listNodeAccess(NodeInterface $node, AccountInterface $account){

	 	return AccessResult::allowedIf(
	 		$node->getOwnerId()=== $account->id()
	 		);
	 }

}