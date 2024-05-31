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

    public function actionFilter() {
        $category_id = $this->post->get('category_id');
        $sort_price = $this->post->get('sort_price');
        $volume = $this->post->get('volume');
        $search_name = $this->post->get('search_name');
    
        $this->addRows(Drinks::FindByCategory($category_id, $sort_price, $volume, $search_name));
        return $this->render();
    }    

    public function actionError($code) {
        echo $code;
    }
}