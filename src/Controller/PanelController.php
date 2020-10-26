<?php

namespace Drupal\hello_galaxy\Controller;

use Drupal\Core\Controller\ControllerBase;

class PanelController extends ControllerBase {

  public function displayPanelPage() {

    //Récup du text saisie pendant la config
  	$config = $this->config('hello_galaxy.settings');
  	
    return array(
      '#theme' => 'panel_page',
      // Affectation du text de la config
      '#text' => $config->get('page_text'),
    );
  }

}