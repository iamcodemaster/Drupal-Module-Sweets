<?php

namespace  Drupal\thomas_more_sweets\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Database\Connection;

class SweetsForm extends FormBase {
    public function getFormId() {
        return 'thomas_more_sweets_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['sweets'] = [
            '#type' => 'radios',
            '#title' => $this->t("<h2 class='title-moto'>Hmm... what will you choose?</h2>"),
            '#options' => [
                'waffle' => $this->t('🥮 Waffle'),
                'ice_cream' => $this->t('🍦 Ice Cream'),
            ],
        ];

        $form['flavors'] = [
            '#type' => 'select',
            '#title' => $this->t('Select a flavor for your ice cream'),
            '#options' => [
              \Drupal::state()->get('ice_cream_flavor_1') => \Drupal::state()->get('ice_cream_flavor_1'),
              \Drupal::state()->get('ice_cream_flavor_2') => \Drupal::state()->get('ice_cream_flavor_2'),
              \Drupal::state()->get('ice_cream_flavor_3') => \Drupal::state()->get('ice_cream_flavor_3'),
              \Drupal::state()->get('ice_cream_flavor_4') => \Drupal::state()->get('ice_cream_flavor_4'),
              \Drupal::state()->get('ice_cream_flavor_5') => \Drupal::state()->get('ice_cream_flavor_5')
            ],
            '#states' => [
                'visible' => [
                    ':input[name="sweets"]' => array('value' => 'ice_cream'),
                ],
            ],
        ];

        $form['topping'] = [
            '#type' => 'checkboxes',
            '#title' => $this->t('Select a topping for your waffle'),
            '#options' => [
              \Drupal::state()->get('waffle_topping_1') => \Drupal::state()->get('waffle_topping_1'),
              \Drupal::state()->get('waffle_topping_2') => \Drupal::state()->get('waffle_topping_2'),
              \Drupal::state()->get('waffle_topping_3') => \Drupal::state()->get('waffle_topping_3'),
              \Drupal::state()->get('waffle_topping_4') => \Drupal::state()->get('waffle_topping_4'),
              \Drupal::state()->get('waffle_topping_5') => \Drupal::state()->get('waffle_topping_5')
            ],
            '#states' => [
                'visible' => [
                    ':input[name="sweets"]' => array('value' => 'waffle'),
                ],
            ],
        ];
              
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
            '#states' => [
                'visible' => [
                    [':input[name="sweets"]' => array('value' => 'ice_cream')],
                    'or',
                    [':input[name="sweets"]' => array('value' => 'waffle')],
                ]
            ]
        ];
        
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        if($form['sweets']['#value'] == 'waffle') {
            $toppings = [];
            foreach($form['topping']['#value'] as $topping) {
                $toppings[] = $topping;
            }
            $toppings = implode(', ', $toppings);
            \Drupal::database()->insert('sweets_data')
            ->fields([
                'sweet'       =>  $form['sweets']['#value'],
                'dressing'  =>  $toppings,
            ])
            ->execute();
        } else {
            \Drupal::database()->insert('sweets_data')
            ->fields([
                'sweet'       =>  $form['sweets']['#value'],
                'dressing'  =>  $form['flavors']['#value']
            ])
            ->execute();
        }

        // $waffleQuery = \Drupal::database()
        //     ->select('sweets_data', 's')
        //     ->condition('s.sweet', 'waffle', '=')
        //     ->countQuery()->execute()->fetchField();
        // $waffleNeededForOrder = \Drupal::state()->get('waffle_count');
        // $tempMod = (float)($waffleQuery / $waffleNeededForOrder);
        // $tempMod = ($tempMod - (int)$tempMod)*$waffleNeededForOrder;
        // // $totalIcecreams = $query->condition('s.sweet', 'ice-cream', '=');

        // // \Drupal::state()->set('ice_cream_counter', $totalIcecreams%10);
        // \Drupal::state()->set('waffle_counter', $tempMod);

        // $result = $query->countQuery()->execute()->fetchField();

        // if($result == \Drupal::state()->get('waffle_count')) {
        //     $messenger = \Drupal::messenger();
        //     $messenger->addMessage('STUFF', $messenger::TYPE_WARNING);
        // }
    }
}