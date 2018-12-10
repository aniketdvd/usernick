<?php

namespace Drupal\usernick\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements a usernick form.
 */

class UserNick extends FormBase {

  /**
   * {@inheritdoc}
  */

   public function getFormId() {
    return 'usernick';
  }

  /**
   * {@inheritdoc}
  */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#required' => TRUE,
      '#type' => 'text',
      '#title' => $this->t('Please enter your name of which you want a usernick : '),
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Give me nicks!'),
      '#button_type' => 'primary',
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
  **/

  public function validateForm(array &$form, FormStateInterface $form_state) {

    if(strlen($form_state -> getValue('name'))<2) { //Why 2? Because my friend's name is Vi. Else validation won't work for her.
      $form_state -> setErrorByName('name', $this->t('Sorry, but your name is not long enough!'));
    }

  }

  /**
   * {@inheritdoc}
  **/

  public function submitForm(array &$form, FormStateInterface $form_state) {

    /* A function to change the
     * content of the username
     * into l337 57yl3. :P
     */

    function leetIt(var $passedName) {
      for($i=0; $i<strlen($passedName); ++$i) {
        if($passedName[$i] == 'a' || $passedName[$i] == 'A'){
          $passedName[$i] = '4';
        }
        if($passedName[$i] == 'b' || $passedName[$i] == 'B') {
          $passedName[$i] = '8';
        }
        if($passedName[$i] == 'e' || $passedName[$i] == 'E') {
          $passedName[$i] = '3';
        }
        if($passedName[$i] == 'i' || $passedName[$i] == 'I') {
          $passedName[$i] = '1';
        }
        if($passedName[$i] == 'o' || $passedName[$i] == 'O') {
          $passedName[$i] = '0';
        }
        if($passedName[$i] == 's' || $passedName[$i] == 'S') {
          $passedName[$i] = '5';
        }
        if($passedName[$i] == 't' || $passedName[$i] == 'T') {
          $passedName[$i] = '7';
        }
      }
    }

    $messenger = \Drupal::messenger(); /* messenger got called and stored in this variable */

    $name = $form_state->getValue('name'); /* Lets copy the name in another variable */

    /* Now some operations to generate usernames */

    $undersocredName = str_replace(' ', '_', $name);
    $reversedName = strrev($name);
    $leetName = leetIt($name);

    /* finally show up them through the Drupal Messenger */

    $messenger -> addMessage($this->t('You try out these names:'.$undersocredName.', '.$reversedName.' and '.$leetName));
  }
}

