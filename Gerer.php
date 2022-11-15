<?php

class Gerer extends Controller
{
    function accueil() {
        $this->set(array(
            'message' => "C'est la page d'accueil"
        ));
        $vue = 'v_bienvenue.php';
        $this->afficher($vue); //affichage dans la vue defaut.php
    }

}