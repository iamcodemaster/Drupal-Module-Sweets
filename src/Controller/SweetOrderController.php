<?php

namespace  Drupal\thomas_more_sweets\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Database\Connection;

class SweetOrderController extends ControllerBase {
    public function order(Request $request) {
        $sweet = $request->get('sweet');

        $connection = \Drupal::database();
        $query = $connection->delete('sweets_data')
            ->condition('sweet', $sweet);
        $result = $query->execute();

        return new Response("Your order is in place!");
    }
}
