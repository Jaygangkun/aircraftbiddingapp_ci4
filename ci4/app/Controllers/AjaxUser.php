<?php

namespace App\Controllers;

use App\Models\UserModel;
use Firebase\JWT\JWT;

class AjaxUser extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new UserModel();
        $all = $model->findAll();
        $data = array();
        foreach($all as $row) {
            $data[] = array(
                $row['name'],
                $row['email'],
                $row['status'],
                $row['role'],
                '<div class="table-col-actions"><span class="text-success tbl-action-btn tbl-action-btn-edit" data-id="'.$row['id'].'">Edit</span><span class="text-danger tbl-action-btn tbl-action-btn-delete" data-id="'.$row['id'].'">Delete</span></div>'
            );
        }
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $data
        ));
    }

    public function add()
    {
        $model = new UserModel();
        $model->insert(array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'email' => isset($_POST['email']) ? $_POST['email'] : '',
            'status' => isset($_POST['status']) ? $_POST['status'] : '',
            'role' => isset($_POST['role']) ? $_POST['role'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function update()
    {
        $model = new UserModel();
        $model->update(isset($_POST['id']) ? $_POST['id'] : '', array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'email' => isset($_POST['email']) ? $_POST['email'] : '',
            'status' => isset($_POST['status']) ? $_POST['status'] : '',
            'role' => isset($_POST['role']) ? $_POST['role'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true
        ));
    }

    public function get($id)
    {
        $model = new UserModel();
        $found = $model->find($id);
        if($found) {
            return $this->response->setJson(array(
                'success' => true,
                'data' => $found
            ));
        }
        else {
            return $this->response->setJson(array(
                'success' => false,
                'message' => 'Not found data'
            ));
        }
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        
        return $this->response->setJson(array(
            'success' => true,
        ));
    }
}
