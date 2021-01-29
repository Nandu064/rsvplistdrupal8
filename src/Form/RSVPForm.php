<?php
  /**
    * @file
    * Contains \Drupal\rsvplist\Form\RSVPForm
    */
namespace Drupal\rsvplist\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
  * Provides an RSVP Email Form
  */
class RSVPForm extends FormBase {
    /**
      * (@inheritdoc)
      */
    public function getFormId() {
        return 'rsvplist_email_form';
    }

    /**
      * (@inheritdoc)
      */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $node = \Drupal::routeMatch()->getParameter('node');
        $nid = $node->nid->value;
        $form['email'] = array(
            '#title' => t('Email Address'),
            '#type' => 'textfield',
            '#size' => 25,
            '#description' => t("You will receive updates to this email only."),
            '#required' => TRUE,
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('RSVP'),
        );
        $form['nid'] = array(
            '#type' => 'hidden',
            '#value' => $nid
        );
        return $form;
    }
    /**
     * (@inheritdoc)
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      $value = $form_state->getValue('email');
      if($value == !\Drupal::service('email.validator')->isValid($value)) {
        $form_state->setErrorByName ('email', t('Enter a valid email address', array('%mail' => $value)));
      }

    }
    /**
     * (@inheritdoc)
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        drupal_set_message(t('The form is Working'));
    }
}


