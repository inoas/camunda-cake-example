<?php

namespace App\Controller;

use Cake\Controller\Controller;

class VacationController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        $this->autoRender = false;
    }

    public function list()
    {
        $this->render();
    }

}