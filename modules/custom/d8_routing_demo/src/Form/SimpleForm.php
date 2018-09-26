<?php

namespace Drupal\d8_routing_demo\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class SimpleForm extends FormBase{
 public function getFormId() {
    return 'd8_routing_demo_simple_form';
  }

public function buildForm(array $form, FormStateInterface $form_state) {
    $form ['demo_textfield'] = [
      '#type' => 'textfield',
      '#title' => t('Enter some text'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];
    $form ['qualification'] = [
      '#type' => 'select',
      '#title' => t('Enter Qualification'),
      '#options' => array('ug'=>'UG','pg'=>'PG','other'=>'other'),
      '#maxlength' => 128,
      '#required' => TRUE,
    ];
    $form ['other'] = [
      '#type' => 'textfield',
      '#title' => t('Enter Details'),
      '#size' => 60,
      '#states' => array(
        'visible' => array(
          ':input[name="qualification"]' => array('value' => 'other'),
        ),
      ),
    ];
    $form ['country'] = [
      '#type' => 'select',
      '#title' => t('Select Country'),
      '#options' => array('UK'=>'UK','India'=>'India','other'=>'other'),
      '#required' => TRUE,
    ];
     $form ['state'] = [
      '#type' => 'select',
      '#title' => t('Select State'),
      '#options' => array('London'=>'London','Dorset'=>'Dorset'),
       '#states' => array(
        'visible' => array(
          ':input[name="country"]' => array('value' => 'UK'),
        ),
      ),

      '#required' => TRUE,
    ];
     $form ['states'] = [
      '#type' => 'select',
      '#title' => t('Select State'),
      '#options' => array('Delhi'=>'Delhi','Mumbai'=>'Mumbai'),
       '#states' => array(
        'visible' => array(
          ':input[name="country"]' => array('value' => 'India'),
        ),
      ),

      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit')
    ];

    return $form;
  }
public function validateForm(array &$form, FormStateInterface $form_state){

	if (strlen($form_state->getValue('demo_textfield'))>5){
		$message = t('It should contain 5 charachters only');
		$form_state->setErrorByName('demo_textfield'. $message);
	}
	}
public function SubmitForm(array &$form, FormStateInterface $form_state){

      $this->messenger()->addMessage(
      $this->t('Form submitted successfully.')
    );
	}

}