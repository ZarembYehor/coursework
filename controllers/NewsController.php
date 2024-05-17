<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;
use models\Users;

class NewsController extends Controller {
    public function actionAdd() {
        return $this->render();
    }
    public function actionIndex() {
        $row = Users::findById(1);
        var_dump($row);
        die;
        return $this->render('views/news/view.php');
    }
    public function actionView($parts) {
        return $this->render();
    }
}