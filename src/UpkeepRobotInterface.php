<?php

namespace Drupal\hello_galaxy;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Robot entity.
 *
 * We have this interface so we can join the other interfaces it extends.
 *
 * @ingroup upkeep_robot
 */
interface UpkeepRobotInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}