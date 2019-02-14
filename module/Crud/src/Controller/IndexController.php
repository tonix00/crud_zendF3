<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Crud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $table;

    public function __construct($table){
        $this->table = $table;
    }

    public function indexAction(){
        $data = $this->table->fetchAll();
        return new ViewModel(['data'=>$data]);
    }

    public function addAction(){
        $form = new \Crud\Form\CrudForm;

        $request = $this->getRequest();
        if(!$request->isPost()){
            return new ViewModel(['form'=>$form]);
        }
       
        
        $form->setData($request->getPost());
        if(!$form->isValid()){
            exit('id is not correct');
        }

        $post = new \Crud\Model\Crud();
        $post->exchangeArray($form->getData());
        $this->table->saveData($post);
        return $this->redirect()->toRoute('home',[
            'controller' => 'home',
            'action'=>'add'
       ]);
    }

    public function viewAction(){
        $id = (int)$this->params()->fromRoute('id',0);
        if($id == 0){
            exit('Error');
        }
        try {
            $post = $this->table->getPost($id);
        } catch (Exception $e) {
            exit('Error');
        }
        return new ViewModel([
            'post' => $post,
            'id' => $id
        ]);
    }

    public function updateAction(){
        $id = (int)$this->params()->fromRoute('id',0);
        if($id == 0){
            exit('Error1');
        }
        try {
            $post = $this->table->getPost($id);
        } catch (Exception $e) {
            exit('Error2');
        }

        $form = new \Crud\Form\CrudForm;
        $form->bind($post);

        $request = $this->getRequest();
        if(!$request->isPost()){
            return new ViewModel([
                'form' => $form,
                'id' => $id
            ]);
        }

        $form->setData($request->getPost());
        if(!$form->isValid()){
            exit('id is not correct');
        }

        $this->table->saveData($post);
        return $this->redirect()->toRoute('home',[
            'controller' => 'edit',
            'action'=>'edit',
            'id'=>$id
       ]);
        
    }

    public function deleteAction(){
        $id = (int)$this->params()->fromRoute('id',0);
        if($id == 0){
            exit('Error1');
        }
        try {
            $post = $this->table->getPost($id);
        } catch (Exception $e) {
            exit('Error2');
        }
        $request = $this->getRequest();
        if(!$request->isPost()){
            return new ViewModel([
                'post' => $post,
                'id' => $id
            ]);
        }
        
        $delete = $request->getPost('delete','No');
        if($delete == 'Yes'){
            $id = (int) $post->getId();
            $this->table->detelePost($id);
        }

        return $this->redirect()->toRoute('home',[
            'controller' => 'home',
            'action'=>'view'
       ]);
    }
}
