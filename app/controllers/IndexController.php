<?php

namespace Staff\Controllers;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl as Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;


use Staff\Controllers\ControllerBase;
use Staff\Roles\UserRole;
use Staff\Roles\ModelResource;

use Staff\Forms\SignUpForm;
use Staff\Forms\UsersForm;
use Staff\Forms\SignInForm;

use Staff\Models\Users;
use Staff\Models\Times;


class IndexController extends ControllerBase
{

    public function initialize()
    {

        if(!$this->session->get('auth')){

            $this->view->setTemplateBefore('main-public');

        }else{

            if($this->session->get('role') == 'admin'){

                $this->view->setTemplateBefore('main-private-admin');
            }

            if($this->session->get('role') == 'user'){

                $this->view->setTemplateBefore('main-private-user');
            }

        }

        $this->view->setTemplateBefore('index');

    }


    public function indexAction()
    {

       /* if(!$this->session->get('auth')){

            return $this->response->redirect('')
        }*/

       // $startSession = $session->set('name','Alseksei');


        /*$this->session->set('auth',[
            'role' => 'admin',
            'name' => 'aleksei',
            'email' => 'aleksei@mail.ru'
        ]);

        print_die($this->session->get('auth'));*/

        /*$users = Users::find();

        $data = null;*/


        //print_die($data);

        /*$acl = new AclList();
        $acl->setDefaultAction(
                Acl::DENY
        );

        $roleAdmins = new Role('Administrators', 'Super-UserRepository role');
        $roleGuests = new Role('Guests');

        $acl->addRole($roleGuests);

        $acl->addRole('Designers');

        $customersResource = new Resource('Articles');

         $acl->addResource(
            $customersResource,
            'search'
        );

        $acl->addResource(
            $customersResource,
            [
                'create',
                'update',
            ]
        );

        $acl->allow('Guests', 'Articles', 'search');
        $acl->allow('Guests', 'Articles', 'create');
        $acl->allow('Guests', 'Articles', 'update');

        $result = $acl->isAllowed('Guests', 'Articlesss', 'update');

        print_die($result);*/

       // print_die($result);

       /* $acl->addResource(
            $customersResource,
            [
                'create',
                'update',
            ]
        );*/


         //$form = new UsersForm();

        $users = Users::find([
            'order' => 'id DESC'
        ]);
        $this->view->users = $users;

        $form = new SignUpForm();
        $this->view->form = $form;




    }

    public function signInAction()
    {
        $form = new SignInForm();
        $this->view->form = $form;

    }

}

