<?php

namespace Drupal\hello_galaxy\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Language\Language;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the robot entity add/edit forms.
 *
 * @ingroup upkeep_robot
 */
class UpkeepRobotForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;

  }

  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $entity->save();
    $form_state->setRedirect('entity.upkeep_robot.canonical', ['upkeep_robot'=>$entity->id()]);

  }

}
