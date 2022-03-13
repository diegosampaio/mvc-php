<?php
namespace Application\core;

/**
 * Classe responsável por capturar da URL o controller, o método e os paramêtros
 */
class App
{
  protected $controller = 'Home';
  protected $metodo = 'index';
  protected $pagina404 = false;
  protected $parametros = [];

  public function __construct()
  {
    $urlArray = $this->parseURL();
    $this->getControllerURL($urlArray);
    $this->getMetodoURL($urlArray);
    $this->getParametrosURL($urlArray);

    // chama o método da classe passando os parametros
    call_user_func_array([$this->controller, $this->metodo], $this->parametros);
  }

  /**
   * Método que pega as informações após o domínio do site/sistema
   *
   * @return void
   */
  private function parseURL()
  {
    $request_uri = explode('/', substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1));
    return $request_uri;
  }

  /**
   * Método que verifica se o controller existe de fato, caso não exista ativa
   * página de erro 404
   *
   * @param array $url
   * @return void
   */
  private function getControllerURL(array $url)
  {
    
    if ( !empty($url[0]) && isset($url[0]) ) {
      if ( file_exists('../Application/controllers/' . ucfirst($url[0] . '.php'))) {
        $this->controller = ucfirst($url[0]);
      } else {
        $this->pagina404 = true;
      }
    }
    $filePath = '../Application/controllers/' . $this->controller . '.php';
    var_dump($url, $filePath);
    require $filePath;
    $this->controller = new $this->controller();
  }

  /**
   * Esse método verifica se foi passado método via url, atraves da posição 1
   * do array informado.
   *
   * @param array $url
   * @return void
   */
  private function getMetodoURL(array $url)
  {
    if ( !empty($url[1]) && isset($url[1]) ) {
      if ( method_exists($this->controller, $url[1]) && !$this->pagina404 ) {
        $this->metodo = $url[1];
      } else {
        $this->metodo = 'pageNotFound';
      }
    }
  }

  private function getParametrosURL(array $url)
  {
    if ( count($url) > 2 ) {
      $this->parametros = array_slice($url, 2);
    }

  } 



}
