<?php

namespace App\Controllers;

use App\Lib\Sessao;

abstract class Controller
{
    protected $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->app = $app;
        $this->setViewParam('nameController', $app->getControllerName());
        $this->setViewParam('nameAction', $app->getAction() ?? '');

        if ($app->getControllerName() !== 'LoginController' && !Sessao::existe('usuario_logado')) {
            header('Location: http://' . APP_HOST . '/login');
            exit;
        }
    }

    public function render($view, $withLayout = true)
    {
        $viewVar = $this->getViewVar();
        $Sessao = Sessao::class;

        if ($withLayout) {
            require_once PATH . '/App/Views/layouts/header.php';
        }
        require_once PATH . '/App/Views/' . $view . '.php';
        if ($withLayout) {
            require_once PATH . '/App/Views/layouts/footer.php';
        }
    }

    public function redirect($view)
    {
        header('Location: http://' . APP_HOST . $view);
        exit;
    }

    public function getViewVar()
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue)
    {
        if ($varName != "") {
            $this->viewVar[$varName] = $varValue;
        }
    }
}
