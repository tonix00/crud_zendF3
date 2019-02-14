<?php

namespace Crud\Form;
use Zend\Form\Form;

class CrudForm extends Form
{
    function __construct(){
        parent::__construct('crud');

        $this->add([
            'name'=>'id',
            'type'=>'hidden'
        ]);

        $this->add([
            'name'=>'title',
            'type'=>'text',
            'options'=>[
                'label' => 'Title'
            ],
            'attributes' => array(
                'class' => 'mtz-monthpicker-widgetcontainer',
                'required' => 'required',
            ),
        ]);

        $this->add([
            'name'=>'description',
            'type'=>'textarea',
            'options'=>[
                'label' => 'Description'
            ],
            'attributes' => array(
                'class' => 'mtz-monthpicker-widgetcontainer',
                'required' => 'required',
            ),
        ]);

        $this->add([
            'name'=>'category',
            'type'=>'text',
            'options'=>[
                'label' => 'Category'
            ],
            'attributes' => array(
                'class' => 'mtz-monthpicker-widgetcontainer',
                'required' => 'required',
            ),
        ]);

        $this->add([
            'name'=>'submit',
            'type'=>'submit',
            'attributes'=>[
                'value' => 'Save',
                'id'=>'buttonSave'
            ]
        ]);
    }
}