<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;
use models\Users;

class InformationController extends Controller {
    public function actionAbout() {
        return $this->render();
    }

    public function actionServices() {
        return $this->render();
    }

    public function actionContacts() {
        return $this->render();
    }
}