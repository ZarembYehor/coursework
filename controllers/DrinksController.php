<?php

namespace controllers;

use core\Controller;
use core\Template;
use models\Drinks;

class DrinksController extends Controller {
    public function actionIndex() {
        $this->addRows(Drinks::getDrinks());
        return $this->render();
    }
    public function actionError($code) {
        echo $code;
    }
}