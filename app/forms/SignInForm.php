<?php

namespace Staff\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


class SignInForm extends Form
{

    public function initialize()
    {

        $email = new Text('email',[
            'placeholder' => 'email',
            'class' => 'form-control'
        ]);

        $email->addValidators([
           new PresenceOf([
              'message' => 'Yor email is required'
           ]),
            new Email([
                'message' => 'this email is not correct'
            ])
        ]);

        $this->add($email);

        $password = new Text('password',[
            'placeholder' => 'password',
            'class' => 'form-control'
        ]);

        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ])
        ]);

        $this->add($password);

        $this->add(new Submit('go',[
            'class' => 'btn btn-success'
        ]));
    }

}