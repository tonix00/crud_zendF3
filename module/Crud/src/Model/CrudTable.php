<?php

namespace Crud\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class CrudTable
{
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function saveData($post)
    {
        $data = [
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'category' => $post->getCategory()
        ];

        if($post->getId()){
            return $this->tableGateway->update($data,[
                'id'=>$post->getId()
            ]);
        }else{
            return $this->tableGateway->insert($data);
        }
    }

    public function getPost($id)
    {
        $data = $this->tableGateway->select([
            'id'=>$id
        ]);
        return $data->current();
    }

    public function detelePost($id){
        return $this->tableGateway->delete([
            'id'=>$id
        ]);
    }
}
