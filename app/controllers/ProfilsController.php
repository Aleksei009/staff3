<?php

namespace Staff\Controllers;

class ProfilsController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
        //if ($this->session('auth'));
    }

    public function indexAction()
    {

        //$session = $this->session()->get('auth',['id']);
      //  print_die($session);
        $authUser = $this->session->get('auth');
        $this->view->authUser = $authUser;
       // print_die($authUser);


      /*  if ($this->session->has('auth')) {
            // Retrieve its value
            $name = $this->session->get('auth');

            $this->view->user = $name;
        }*/
    }

}

