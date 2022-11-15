<?php

/**
 * Description of Class
 *
 * @author prof
 */
class Dispatcher
{

    private string $_uc= 'Gerer';
    private string $_action= 'accueil';
    private array $_params = array();

    function __construct()
    {
        $this->loadRoute();
        //Creation et appel controleur
        $controleur = $this->loadControleur();
        //Appel de l'action
        call_user_func(array($controleur,$this->_action));

    }

    function loadRoute()
    {
        //Gestion de l'url
        if (isset($_REQUEST['action'])) {
            $this->_action = $_REQUEST['action'];
        }

        if (isset($_REQUEST['uc'])) {
            $this->_uc =ucfirst($_REQUEST['uc']) ;
        }
    }

    function loadControleur()
    {
        $name = $this->_uc;
        require $name . '.php';

        return new $name();
    }

    function error($message)
    {
        $controller = new Controller();
        $controller->e404($message);
    }

}


