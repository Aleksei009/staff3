<?php

class ProfilsController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
        //if ($this->session('auth'));
    }

    public function indexAction()
    {
        if ($this->session->has('user-name')) {
            // Retrieve its value
            $name = $this->session->get('user-name');

            $this->view->user = $name;
        }
    }

}

