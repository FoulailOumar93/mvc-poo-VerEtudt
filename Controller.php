<?php

/**
 * Description of Class
 *
 * @author prof
 */
class Controller
{

    //variables à passer à la vue dans le controller page à partir du principal
    private $_vars = array();// valeurs envoyées par la fonction set
    private $_affichage; // flag pour savoir si la page est déjà affichée

//    function __construct() {        
//        
//    }

    /**
     * Afficher les vues dans default
     * @param $view
     * @return bool
     */
    function afficher($view)
    {
        //charge une seule fois la page
        if ($this->_affichage) {
            return false;
        }
        //affecte les variables du set
        extract($this->_vars);
        //stockage contenu
        ob_start();
        require($view);
        $contenu = ob_get_clean();
        require 'v_defaut.php';

        $this->_affichage = true;// pas deux fois l'affichage reinitialise
        return true;
    }

    /**
     * $message="C'est la page d'accueil";
     * $this->set('message',$message);
     * envoie les paramètres de la vue à partir du contrôleur fils
     * @param  $key
     * @param  $value
     * return _var
     */
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->_vars += $key;
        } else {
            $this->_vars[$key] = $value;
        }
    }

    /**
     * affiche la page d'erreur
     * @param  $message
     */
    function e404($message)
    {
        header("HTTP/1.0 404 Not Found");
        $this->set('message', $message);
        $this->afficher('v_404.php');
        die();
    }

    /**
     * inclure le modèle
     * @return null
     */
    function loadModel()
    {
        require_once 'PdoBridge.php';
        return PdoBridge::getPdoBridge();
    }


}
