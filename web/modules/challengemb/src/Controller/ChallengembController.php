<?php

namespace Drupal\challengemb\Controller;

use Drupal\Core\Controller\ControllerBase;
/**
 * Returns responses for Balidea routes.
 */
class ChallengembController extends ControllerBase {

  private $config;
  private $config_factory;

  public function __construct(\Drupal\Core\Config\ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->getEditable('challengemb.settings');
  }

  public static function create(\Symfony\Component\DependencyInjection\ContainerInterface $container) {
    return new static($container->get('config.factory'));
  }

  /**
   * Builds the response.
   */
  public function build() {
    
    /**
     * Workaround:
     * El siguiente helper no debería ser necesrio ya que la config factory me debería traer el texto en el idioma
     * correcto (según el prefijo del path).
     * Continúo investigando si se debe a un bug del core o si no estoy guardandolo de forma correcta.
     *  
     * TODO: Debería inyectarse y no usarse de forma estática en caso de seguirse utilizando.
     *  */ 

    $translatedConfig = \Drupal::service('translated_config.helper')->getTranslatedConfig('challengemb.settings')->get();
    $text = isset($translatedConfig['text']) ? $translatedConfig['text']['value'] : '<No definido>';
    $number = $this->config->get('number') ? $this->config->get('number') : '<No definido>';

    return [
      '#theme' => 'challengemb',
      '#text' => $text,
      '#number' => $number
    ];
  }
}
