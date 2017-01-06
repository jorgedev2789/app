<?php
/**
 * Description of UserForm
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */
namespace Dashboard\Form;

use Zend\Form\Form;
use Dashboard\Model\Role;

class UserForm extends Form
{
    public function __construct($roleTable) {
        parent::__construct('user');
        
        $roles = $roleTable->fetchAll();
        $selRol = array();
        foreach($roles as $role) {
            $id = $role->getId();
            $selRol[$id] = $role->getName();
        }
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'full_name',
            'attributes' => array(
                'type'  => 'text',
                'class'=> 'form-control'
            ),
            'options' => array(
                'label' => 'Full Name',
            )
        ));
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type'  => 'text',
                'class'=> 'form-control'
            ),
            'options' => array(
                'label' => 'Usuario',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'class'=> 'form-control'
            ),
            'options' => array(
                'label' => 'Clave',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'class'=> 'form-control'
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'role_id',
            'attributes' => array(
                'class'=> 'form-control'
            ),
            'options' => array(
                'label' => 'Role',
                'value_options' => $selRol,
             ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'class' => 'btn btn-md btn-primary',
                'id' => 'submitbutton',
            ),
        ));
    }
}
