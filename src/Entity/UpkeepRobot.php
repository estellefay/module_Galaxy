<?php

namespace Drupal\hello_galaxy\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;

use Drupal\hello_galaxy\UpkeepRobotInterface;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;


/**
 * Defines the UpkeepRobot entity
 *
 * @ingroup upkeep_robot
 *
 * @ContentEntityType(
 *   id = "upkeep_robot",
 *   label = @Translation("UpkeepRobot"),
 *   base_table = "upkeep_robot",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "nickname",
 *     "uuid" = "uuid",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "access" = "Drupal\hello_galaxy\UpkeepRobotAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\hello_galaxy\Form\UpkeepRobotForm",
 *       "edit" = "Drupal\hello_galaxy\Form\UpkeepRobotForm",
 *       "delete" = "Drupal\hello_galaxy\Form\UpkeepRobotDeleteForm",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/see-robot/{upkeep_robot}",
 *     "edit-form" = "/robot/{upkeep_robot}/edit",
 *     "delete-form" = "/robot/{upkeep_robot}/delete",
 *   },
 * )
 */
 
class UpkeepRobot extends ContentEntityBase implements UpkeepRobotInterface {

    use EntityChangedTrait;

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

      $fields['id'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('ID'))
          ->setDescription(t('The ID of the UpkeepRobot entity.'))
          ->setReadOnly(TRUE);

      $fields['nickname'] = BaseFieldDefinition::create('string')
        ->setLabel(t("The robot's name"))
        ->setRequired(TRUE)
        ->setDescription(t('The nickname of the robot.'))
        ->setSettings(array(
          'default_value' => '',
          'max_length' => 255,
          'text_processing' => 0,
        ))
        ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'string',
            'weight' => -5,
        ))
        ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => -5,
        ))
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE);

      $fields['uuid'] = BaseFieldDefinition::create('uuid')
          ->setLabel(t('UUID'))
          ->setDescription(t('The UUID of the UpkeepRobot entity.'))
          ->setReadOnly(TRUE);
      
      $fields['years_of_service'] = BaseFieldDefinition::create('integer')
        ->setLabel(t('Years of service'))
        ->addPropertyConstraints('value', [
            'Range' => [
              'min' => 0,
              'max' => 1000,
            ]
        ])
          ->setDisplayOptions('view', array(
              'label' => 'above',
              'type' => 'number_integer',
              'weight' => -4,
          ))
        ->setDisplayOptions('form', array(
          'type' => 'number',
          'weight' => -4,
        ))
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE);


      $fields['created'] = BaseFieldDefinition::create('created')
        ->setLabel(t('Created'))
        ->setDescription(t('The time that the robot was created.'));

      $fields['changed'] = BaseFieldDefinition::create('changed')
        ->setLabel(t('Changed'))
        ->setDescription(t('The time that the robot was last altered.'));

      $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('User Name'))
        ->setDescription(t('The Name of the associated user.'))
        ->setSetting('target_type', 'user')
        ->setSetting('handler', 'default')
        ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'author',
          'weight' => -3,
        ))
        ->setDisplayOptions('form', array(
          'type' => 'entity_reference_autocomplete',
          'settings' => array(
            'match_operator' => 'CONTAINS',
            'size' => 60,
            'placeholder' => '',
          ),
          'weight' => -3,
        ))
        ->setDisplayConfigurable('form', TRUE)
        ->setDisplayConfigurable('view', TRUE);

        return $fields;

    }

    public function getYearsOfService() {
        return $this->get('years_of_service')->value;
    }

    public function setYearsOfService($years_of_service) {
        $this->get('years_of_service')->value = $years_of_service;
        return $this;
    }

    public function getCreatedTime() {
        return $this->get('created')->value;
    }

    public function getOwner() {
        return $this->get('user_id')->entity;
    }

    public function getOwnerId() {
        return $this->get('user_id')->target_id;
    }

    public function setOwnerId($uid) {
        $this->set('user_id', $uid);
        return $this;
    }

    public function setOwner(UserInterface $account) {
        $this->set('user_id', $account->id());
        return $this;
    }

    public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
      parent::preCreate($storage_controller, $values);
      $values += array(
        'user_id' => \Drupal::currentUser()->id(),
      );
    }

}
