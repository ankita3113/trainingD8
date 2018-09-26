<?php

namespace Drupal\d8_routing_demo\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;

class DIForm extends FormBase{
    protected $db;

  public function __construct(Connection $db) {
    $this->db = $db;
  }
 public function getFormId() {
    return 'd8_routing_demo_di_form';
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }
public function buildForm(array $form, FormStateInterface $form_state) {
  
    $results = $this->db->select('d8_demo', 'dd')
      ->fields('dd')
      ->orderBy('id', 'DESC')
      ->range(0,1)
      ->execute()
      ->fetchAll();
    $last_value = $results[0];

    $form ['first_name'] = [
      '#type' => 'textfield',
      '#title' => t('Enter First Name'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#default_value' => $last_value->first_name,
    ];
    $form ['last_name'] = [
      '#type' => 'textfield',
      '#title' => t('Enter Last Name'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#default_value' => $last_value->last_name,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit')
    ];

    return $form;
}
public function SubmitForm(array &$form, FormStateInterface $form_state){
$this->db->insert('d8_demo')
      ->fields([
        'first_name' => $form_state->getValue('first_name'),
        'last_name' => $form_state->getValue('last_name'),
      ])
      ->execute();
    $this->messenger()->addMessage(
      $this->t('Form submitted successfully.')
    );
	}

}