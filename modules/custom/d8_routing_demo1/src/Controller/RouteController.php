<?php

namespace Drupal\d8_routing_demo1\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class RouteController.
 */
class RouteController extends ControllerBase {

  /**
   * Hellodynamic.
   *
   * @return string
   *   Return Hello string.
   */
  public function helloDynamic($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello '.$name),
    ];
  }

}
