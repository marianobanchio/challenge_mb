<?php
/**
 * @file
 * Contains Drupal\challengemb\Form\ConfigForm.
 */
namespace Drupal\challengemb\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'challengemb.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_challengemb_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('challengemb.settings');

    $form['text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Texto'),
      '#default_value' => $config->get('text')['value'],
      '#allowed_formats' => ['full_html'],
      '#format'=> $config->get('format'),
    ];
    $form['number'] = [
      '#type' => 'number',
      '#title' => $this->t('Número entero'),
      '#step' => 1,
      '#default_value' => $config->get('number'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $settings = $this->configFactory->getEditable('challengemb.settings');
    $settings->set('text', $form_state->getValue('text'))->save();
    $settings->set('number', $form_state->getValue('number'))->save();

  }
}
