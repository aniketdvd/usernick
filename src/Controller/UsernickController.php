<?php

/**
 * @file
 * Contains \Drupal\usernick\Controller\UsernickController.
 */

namespace Drupal\usernick\Controller;

class UsernickController {
  public function whoami() {
    return array(
      '#type' => 'markup',
      '#markup' => t('Attention! I am controller for Usernick'),
    );
  }
}
