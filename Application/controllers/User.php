<?php
namespace Application\controllers;

use Application\core\Controller;

class User extends Controller
{

  public function index()
  {
    $users = $this->model('UsersModel');
    $data = $users::findAll();
    $this->view('user/index', ['users' => $data]);
  }

  public function show($id = null)
  {
    if (is_numeric($id)) {
      $users = $this->model('UsersModel');
      $data = $users::findById($id);
      $this->view('user/show', ['user' => $data]);
    } else {
      $this->pageNotFound();
    }
  }

}
