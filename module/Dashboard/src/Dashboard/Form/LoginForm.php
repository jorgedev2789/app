<?php
/**
 * Description of LoginForm
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */
namespace Dashboard\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null) {
        parent::__construct('login');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Username'
            )
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password'
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Login',
                'id' => 'submitbutton',
                'class'=>'btn btn-success btn-block'
            ),
        ));
    }
}
