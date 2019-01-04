<?php

namespace Drupal\thomas_more_sweets\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provides a 'Social Media Thomas More' Block.
 *
 * @Block(
 *   id = "thomas_more_sweets_block",
 *   admin_label = @Translation("Sweets Thomas More"),
 *   category = @Translation("Sweets Thomas More"),
 * )
 */
class SweetsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */ // \Drupal\thomas_more_social_media\Form\SettingsForm
    public function build() {
        $form = \Drupal::formBuilder()->getForm('Drupal\thomas_more_sweets\Form\SweetsForm');
        $waffleOrder = $this->checkIfOrderComplete('waffle');
        $iceCreamOrder = $this->checkIfOrderComplete('ice_cream');
        return [
            '#theme'    =>  'sweets',
            '#attached' => array(
                'library' => array(
                    'thomas_more_sweets/sweets',
                ),
            ),
            '#form'     =>  $form,
            '#ice_cream_count'  => \Drupal::state()->get('ice_cream_count'),
            '#waffle_count' => \Drupal::state()->get('waffle_count'),
            '#ice_cream_counter'  => $this->sweetCount('ice_cream'),
            '#waffle_counter' => $this->sweetCount('waffle'),
            '#waffle_order' => $waffleOrder,
            '#ice_cream_order' => $iceCreamOrder
        ];
    }

    public function sweetCount($sweet) {
        $result = \Drupal::database()
            ->select('sweets_data', 's')
            ->condition('s.sweet', $sweet, '=')
            ->countQuery()->execute()->fetchField();
        return $result;
    }

    public function checkIfOrderComplete($sweet) {
        $amount = $this->sweetCount($sweet);
        $totalAmount = intval(\Drupal::state()->get($sweet.'_count'));
        $rest = $totalAmount - $amount;
        if($amount >= $totalAmount) {
            $connection = \Drupal::database();
            $query = $connection->query("SELECT sweet, dressing FROM {sweets_data} WHERE sweet = '$sweet'");
            $result = $query->fetchAll();
            drupal_set_message(t($this->buildMessage($result)), 'status');
            return $result;
        }

        return 'still ' . $rest . ' needed to complete the order';
    }

    public function buildMessage($sweets) {
        $message = [];
        $type;
        foreach ($sweets as $sweet) {
            $message[] = '1 '.$sweet->sweet.' with '.$sweet->dressing;
        }
        
        $message = implode('<br>', $message);
        return $message;
    }

}

    