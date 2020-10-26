<?php

namespace Drupal\hello_galaxy\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\hello_galaxy\Entity\UpkeepRobot;

class PanelController extends ControllerBase {

  public function displayPanelPage() {

    //Récup du text saisie pendant la config
  	$config = $this->config('hello_galaxy.settings');
    
    // creation d'un article 
    $article = Node::create(array(
      'type' => 'article',
      'title' => 'Article créé par programmation',
      'langcode' => 'fr',
      'uid' => '1',
      'status' => 1,
      'body' => 'Lorem ipsum...',
    ));
    $article->save();

    return array(
      '#theme' => 'panel_page',
      // Affectation du text de la config
      '#text' => $config->get('page_text'),
    );
  }

}