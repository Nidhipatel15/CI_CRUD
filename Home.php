<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $userModel; // Declare property to hold UserModel instance

    public function __construct()
    {
        helper(['url']);
        $this->userModel = new UserModel(); // Instantiate UserModel
    }

    public function index()
    {
        echo view('inc/header'); // Load header view

        // Fetch users data using UserModel
        $data['users'] = $this->userModel->findAll();
        
        // Print data for debugging purposes
        // print_r($data);

        echo view('inc/home', $data); // Pass data to home view

        echo view('inc/footer'); // Load footer view
    }

    public function saveUser(){
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');

        $this->userModel->save(["username" =>$username , "email" =>$email]);

        session()->setFlashdata("success", "Data inserted sucessfully");
        return redirect()->to(base_url());
    }
    public function getSingleUser($id){
        $data=$this->userModel->where('id',$id)->first();
        echo json_encode($data);
    }

    public function updateUser(){
        $id = $this->request->getVar('userId');
        $username=$this->request->getVar('username');
        $email=$this->request->getVar('email');

        $data['username'] =$username;
        $data['email']=$email;
        $data['id']=$id;
// print_r($data);die;
        $this->userModel->save($data);
        return redirect()->to(base_url("/"));
    }

    public function deleteUser(){

        $id =$this->request->getVar('id');
        //  echo $id;die();
        $this->userModel->delete($id);
         echo 'deleted';
        //  return redirect()->to(base_url());   
    }  

    public function deleteMultiUser(){
        $ids = $this->request->getVar('ids');

        for($count = 0;$count < count($ids);$count++){
            $this->userModel->delete($ids[$count]);
        }
        echo "multi deleted";
    }
}
