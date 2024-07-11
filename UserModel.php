<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
  protected $allowedFields = ['id','FirstName','LastName','email','Password','Confirm_Password'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];
  protected $createdField  = 'created_at';
  protected $table = 'users';

  protected function beforeInsert(array $data) {
    if(isset($data['data']['password'])) {
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    }

    return $data;
  }

  protected function beforeUpdate(array $data) {


    return $data;
  }
}