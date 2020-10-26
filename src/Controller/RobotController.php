<?php

namespace Drupal\hello_galaxy\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\hello_galaxy\Entity\UpkeepRobot;

class RobotController extends ControllerBase {

    public function createRobot(){
        // Creaction des robots 
        $robot = UpkeepRobot::create(array(
            'nickname' => 'TE54',
            'years_of_service' => 15,
        ));

        $robot->save();

        return array(
            '#theme' => 'panel_page',
            // Affectation du text de la config
            '#text' => "robot ajouté",
          );
    }

    public function deleteRobot(){
        // obtenir un robo
        $robot = UpkeepRobot::load(4);

        $robot->delete();
        //UpkeepRobot::delete($this->robot);

        return array(
            '#theme' => 'panel_page',
            // Affectation du text de la config
            '#text' => "robot ajouté",
          );
    }
}

