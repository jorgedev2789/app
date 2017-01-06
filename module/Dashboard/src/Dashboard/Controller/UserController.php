<?php

/**
 * UserController - This allows add, delete and edit users
 * @autor Francis Gonzales <fgonzalestello91@gmail.com>
 */

namespace Dashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Dashboard\Form\UserForm;
use ZfcDatagrid\Column;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        $viewmodel = new ViewModel();

        return $viewmodel;
    }

    public function listAction()
    {

        $request = $this->getRequest();
        if($request->isXmlHttpRequest()){

            $sl = $this->getServiceLocator();
            $userTable = $sl->get('Dashboard/Model/UserTable');

            $list = $userTable->getUsersList($request);
            $result = new JsonModel($list);
     
            return $result;
        }else{
            $viewmodel = new ViewModel();
            $viewmodel->setTerminal(true);
            return $viewmodel;
        }
    }

    public function newAction()
    {
        $viewmodel = new ViewModel();
        $sl = $this->getServiceLocator();
        $roleTable = $sl->get('Dashboard/Model/RoleTable');
        $form = new UserForm($roleTable);
        $request = $this->getRequest();
        $serviceLocator = $this->getServiceLocator();
        $form->get('submit');
        $message = ""; //Message
        
        if ($request->isPost()) {
            // @TODO addfilters
            //$form->setInputFilter($filters);
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $userTable = $serviceLocator->get('Dashboard\Model\UserTable');
                unset($data['submit']);
                
                $rs = $userTable->addUser($data);
                if ($rs) {
                    $form = new UserForm($roleTable);
                }
            }
        }
        $viewmodel->form = $form;
        $viewmodel->message = $message;
        return $viewmodel;
    }
    
    public function editAction()
    {
        $userId = $this->params('id');
        $request = $this->getRequest();
        $viewmodel = new ViewModel();
        $sl = $this->getServiceLocator();
        $roleTable = $sl->get('Dashboard\Model\RoleTable');
        $userTable = $sl->get('Dashboard\Model\UserTable');
        $form = new UserForm($roleTable);

        $form->get('submit')->setValue('Update');
        
        if ($request->isPost()) {
            // @TODO addfilters
            //$form->setInputFilter($filters);
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                $dataId = array('id' => $userId);
                $userTable->editUser($data, $dataId);
                $this->redirect()->toRoute('dash_user');
            }
        } else {
            $userData = $userTable->getUser($userId);
            foreach ($userData as $user) {
                $form->get('full_name')->setValue($user['full_name']);
                $form->get('username')->setValue($user['username']);
                $form->get('email')->setValue($user['email']);
                $form->get('role_id')->setValue($user['role_id']);
            }
        }
       
        $viewmodel->form = $form;
        return $viewmodel;
    }
    
    public function deleteAction()
    {
        $sl = $this->getServiceLocator();
        $userId = $this->params('id');
        $userTable = $sl->get('Dashboard\Model\UserTable');
        $userTable->deleteUser($userId);
        $this->redirect()->toRoute('dash_user_list');
    }
}
