<?php

namespace  Drupal\thomas_more_sweets\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends FormBase {
    public function getFormId() {
        return 'thomas_more_settings_sweets_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['waffle_topping_1'] = [
            '#type' => 'textfield',
            '#title' => 'Waffle topping',
            '#default_value' => \Drupal::state()->get('waffle_topping_1')
        ];

        $form['waffle_topping_2'] = [
            '#type' => 'textfield',
            '#title' => 'Waffle topping',
            '#default_value' => \Drupal::state()->get('waffle_topping_2')
        ];

        $form['waffle_topping_3'] = [
            '#type' => 'textfield',
            '#title' => 'Waffle topping',
            '#default_value' => \Drupal::state()->get('waffle_topping_3')
        ];

        $form['waffle_topping_4'] = [
            '#type' => 'textfield',
            '#title' => 'Waffle topping',
            '#default_value' => \Drupal::state()->get('waffle_topping_4')
        ];

        $form['waffle_topping_5'] = [
            '#type' => 'textfield',
            '#title' => 'Waffle topping',
            '#default_value' => \Drupal::state()->get('waffle_topping_5')
        ];

        $form['ice_cream_flavor_1'] = [
            '#type' => 'textfield',
            '#title' => 'Ice Cream flavor',
            '#default_value' => \Drupal::state()->get('ice_cream_flavor_1')
        ];

        $form['ice_cream_flavor_2'] = [
            '#type' => 'textfield',
            '#title' => 'Ice Cream flavor',
            '#default_value' => \Drupal::state()->get('ice_cream_flavor_2')
        ];

        $form['ice_cream_flavor_3'] = [
            '#type' => 'textfield',
            '#title' => 'Ice Cream flavor',
            '#default_value' => \Drupal::state()->get('ice_cream_flavor_3')
        ];

        $form['ice_cream_flavor_4'] = [
            '#type' => 'textfield',
            '#title' => 'Ice Cream flavor',
            '#default_value' => \Drupal::state()->get('ice_cream_flavor_4')
        ];

        $form['ice_cream_flavor_5'] = [
            '#type' => 'textfield',
            '#title' => 'Ice Cream flavor',
            '#default_value' => \Drupal::state()->get('ice_cream_flavor_5')
        ];

        $form['waffle_amount'] = [
            '#type' => 'textfield',
            '#title' => 'Waffle amount needed per order',
            '#default_value' => \Drupal::state()->get('waffle_count')
        ];

        $form['ice_cream_amount'] = [
            '#type' => 'textfield',
            '#title' => 'Ice Cream amount needed per order',
            '#default_value' => \Drupal::state()->get('ice_cream_count')
        ];
              
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];
        
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::state()->set('waffle_topping_1', $form['waffle_topping_1']['#value']);
        \Drupal::state()->set('waffle_topping_2', $form['waffle_topping_2']['#value']);
        \Drupal::state()->set('waffle_topping_3', $form['waffle_topping_3']['#value']);
        \Drupal::state()->set('waffle_topping_4', $form['waffle_topping_4']['#value']);
        \Drupal::state()->set('waffle_topping_5', $form['waffle_topping_5']['#value']);
        \Drupal::state()->set('ice_cream_flavor_1', $form['ice_cream_flavor_1']['#value']);
        \Drupal::state()->set('ice_cream_flavor_2', $form['ice_cream_flavor_2']['#value']);
        \Drupal::state()->set('ice_cream_flavor_3', $form['ice_cream_flavor_3']['#value']);
        \Drupal::state()->set('ice_cream_flavor_4', $form['ice_cream_flavor_4']['#value']);
        \Drupal::state()->set('ice_cream_flavor_5', $form['ice_cream_flavor_5']['#value']);
        \Drupal::state()->set('ice_cream_count', $form['ice_cream_amount']['#value']);
        \Drupal::state()->set('waffle_count', $form['waffle_amount']['#value']);
    }
}