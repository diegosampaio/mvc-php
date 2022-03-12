<?php
namespace Application\core;

class Controller
{
  /**
   * Método responsável por chamar uma determinada model
   *
   * @param [type] $model
   * @return void
   */
  public function model($model) 
  {
    require_once '../Application/models/' . $model .'.php';
    $classe = 'Application\\models\\' . $model;
    return new $classe();
  }

  /**
   * Método responsável por chamar uma determinada view
   *
   * @param string $view
   * @param array $data
   * @return void
   */
  public function view(string $view, $data = [])
  {
    require_once '../Application/views' . $view .'.php';
  }

  public function pageNotFound()
  {
    $this->view('erro404');
  }


}
