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
    
    $text = $this->config->get('text') ? $this->config->get('text')['value'] : '<No definido>';
    $number = $this->config->get('number') ? $this->config->get('number') : '<No definido>';

    return [
      // Your theme hook name.
      '#theme' => 'challengemb',
      // Your variables.
      '#text' => $text,
      '#number' => $number
    ];
  }

}
