<?php

namespace Staff\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use Staff\Forms\SignUpForm;
use Staff\Forms\SignInForm;

use Staff\Controllers\ControllerBase;
use Staff\Services\UserService;
use Staff\Models\Users;


class UsersController extends ControllerBase
{

    public function initialize()
    {

    }

    /**
     * Index action
     */
    public function indexAction()
    {

       // $this->view->setTemplateBefore('main-public');
       // $this->persistent->parameters = null;

        //$form = new SignUpForm();
       // $this->view->form = $form;
    }

    /**
     * Searches for users
     */

    public function registerAction()
    {
        $user = new Users();

        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $user->login = $login;

        // Сохраняем пароль хэшированным
        $user->password = $this->security->hash($password);

        $user->save();
    }


    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Users', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");

            $this->dispatcher->forward([
                "controller" => "users",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $users,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("user was not found");

                $this->dispatcher->forward([
                    'controller' => "users",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("name", $user->name);
            $this->tag->setDefault("email", $user->email);
            
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
       /* $this->session->set('user-name', 'Michael');
        print_die($this->session->get('user-name'));*/

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);
            return;
        }
        $data = $this->request->get();
        $data['password'] = $this->security->hash( $data['password']);

        $userService = new UserService();
        $userSave    = $userService->registerUser($data);

        if (!$userSave) {
            $messages = $userSave->getMessages();
            foreach($messages as $message){

               $this->flashSession->error($message);
                //return $this->response->redirect('index');
                $this->dispatcher->forward([
                   'controller' => 'index',
                    'action' => 'index'
                ]);
            }
        }else{
            $this->flash->success("user is created");

            $this->response->redirect('index');
            return;

            /*$this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);
            return;*/
        }

       // $this->view->disable();
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        $user->name = $this->request->getPost("name");
        $user->email = $this->request->getPost("email", "email");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'edit',
                'params' => [$user->id]
            ]);

            return;
        }

        $this->flash->success("user was updated successfully");

        $this->dispatcher->forward([
            'controller' => "users",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        /*$users = Users::find();

        foreach($users as $user){
            $user->delete();
        }*/

        $user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error("user was not found");

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("user was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "users",
            'action' => "index"
        ]);
    }

    public function signInAction()
    {
        $form = new SignInForm();
        $this->view->form = $form;

    }

    public function signUpAction()
    {
        $form = new SignUpForm();
        $this->view->form = $form;

    }

    public function authAction()
    {


        //$data = $this->request->get();
       // $user = Users::query()->where('email = $data[email]')->execute();
        /*if($this->request()->isPost()){

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::find([
                'email' =>  $data['email']
            ]);

            $user = Users::findFirst(
                [
                    "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                    'bind' => [
                        'email'    => $email,
                        'password' => sha1($password),
                    ]
                ]
            );




            print_die($user);
        }*/
       // $user = Users::findFirst($data['email']);


        if ($this->request->isPost()) {
            /*
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirst(
                [
                    "email = :email: AND password = :password:",
                    'bind' => [
                        'email'    => $email,
                        'password' => $password,
                    ]
                ]
            );

            print_die($user);*/

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirstByEmail($email);

          //  print_die($user->email);
            if ($user) {
                if ($this->security->checkHash($password, $user->password)) {
                    // Пароль верный

                    if($user->role == 'admin'){

                        $this->session->set('auth',[
                            'id'   => $user->id,
                            'role' => $user->role,
                            'name' => $user->name,
                            'user' => $user->email
                        ]);

                        // $this->session->set('role','admin');
                        $this->response->redirect('admin');
                    }

                    if($user->role == 'user'){

                        $this->session->set('auth',[
                            'id' => $user->id,
                            'role' =>  $user->role,
                            'name' =>  $user->name,
                            'email' => $user->email
                        ]);
                        // $this->session->set('role', 'user');
                        $this->response->redirect('profils');
                    }

                }
            }

            } else {
                // Защита от атак по времени. Regardless of whether a user
                // exists or not, the script will take roughly the same amount as
                // it will always be computing a hash.

                $this->security->hash(rand());
                 return  $this->response->redirect('');
            }



            /* $data = $this->request->get();

             $user = Users::findFirst($data['email']);
             */


            //print_die($user);

           /* if($user){

                if($user->role == 'admin'){

                    $this->session->set('auth',[
                        'id'   => $user->id,
                        'role' => $user->role,
                        'name' => $user->name,
                        'user' => $user->email
                    ]);

                   // $this->session->set('role','admin');
                    $this->response->redirect('');
                }

                if($user->role == 'user'){

                    $this->session->set('auth',[
                        'id' => $user->id,
                       'role' =>  $user->role,
                       'name' =>  $user->name,
                       'email' => $user->email
                    ]);
                   // $this->session->set('role', 'user');
                    $this->response->redirect('');
                }

            }
        }else{

          return  $this->response->redirect('');
        }*/

      //  print_die($user);


    }

}
