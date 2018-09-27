<?php
namespace Drupal\d8_routing_demo\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
class WeatherConfigForm extends ConfigFormBase{
 public function getFormId() {
    return 'd8_routing_demo_weather_config_form';
  }

public function buildForm(array $form, FormStateInterface $form_state) {
	$app_value = $this->config('d8_routing_demo.settings')->get('weather_config_key'); 
    $form ['app_id'] = [
      '#type' => 'textfield',
      '#title' => t('Enter some text'),
      '#size' => 60,
      '#maxlength' => 128,
      '#default_value' => $app_value,
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit')
    ];
   return $form;
}
public function validateForm(array &$form, FormStateInterface $form_state){

	}
public function SubmitForm(array &$form, FormStateInterface $form_state){
$this->config('d8_routing_demo.settings')
      ->set('weather_config_key', $form_state->getValue('app_id'))
      ->save();	
parent::submitForm($form, $form_state);

  }

protected function getEditableConfigNames() {
    return [
      'd8_routing_demo.settings',
    ];
  }
	}