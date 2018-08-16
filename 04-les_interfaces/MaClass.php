<?php

/*
Les interfaces sont un modèle pour les classes.
On peut via celles-ci créer des base pour toutes nos classes
*/
interface iA
{
    const ARG1 = 'toto';
    /*
    Toutes les méthodes d'une interface doivent être public
    On lui met autant d'argument que souhaité.
    Le but est de forcer un fonctionnement uniforme des class qui implément les interfaces
    */
    public function maFonctionIA($arg1);
}


/*
On peut faire hérité une interface d'une autre voir de plusieurs
en les séparent d'une virgule
*/
interface iB extends iA
{
    public function maFonctionIB($arg1);
}


class MaClass implements iB
{
    protected $attr1 = 'toto';

    public function maFonctionIA($arg1){
        echo $arg1;
    }

    public function maFonctionIB($arg1){
        echo $arg1;
    }

}

$obj = new MaClass();
$obj->maFonctionIA('Dans maFonctionIA. </br>');
$obj->maFonctionIB('Dans maFonctionIB. </br>');