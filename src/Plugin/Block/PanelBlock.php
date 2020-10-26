<?php

namespace Drupal\hello_galaxy\Plugin\Block;

use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "panel_block",
 *   admin_label = @Translation("Panneau indicateur"),
 * )
 */
class PanelBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
        // chosir le theme
      '#theme' => 'panel_block',
      // faire passer l'argument message
      '#message' => $this->t('Bienvenue, noble visiteur !'),
    );
  }

/**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
      // Crée formulaire
    $form = parent::blockForm($form, $form_state);
    //Récup config
    $config = $this->getConfiguration();

    $form['panel_block_silicium_offer'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Réduction sur le silicium'),
      '#description' => $this->t("Renseignez ici l'offre commerciale"),
      '#default_value' => isset($config['silicium_offer']) ? $config['silicium_offer'] : '',
      '#maxlength' => 50,
      '#required' => TRUE,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    // Récuperation de la valeur de ....
    $silicium_offer = $form_state->getValue('panel_block_silicium_offer');

    // Vérification de la taille
    if ( strlen($silicium_offer) < 10 ) {
      $form_state->setErrorByName('panel_block_silicium_offer', t("L'offre semble trop courte pour être honnête !"));
    }
    
  }

    /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
      kint($form_state).die();
    $this->configuration['silicium_offer'] = $form_state->getValue('panel_block_silicium_offer');
  }

}