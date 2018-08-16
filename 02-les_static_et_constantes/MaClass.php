<?php

class MaClass
{
    //Création des attributs
    public $attributPublic = 'Ma valeur mére';
    
    //Création des attributs static
    public static $attributPublicStatic = 'Ma valeur mére';

    //Création des constantes
    public const MA_CONSTANTE_PUBLIC = 'Ma valeur mére';

    //Création des méthodes static
    public static function methodPublicStatic(){ return 'Ma valeur mére'; }

    public function test1(){
        echo '<h2>Appel de test1 depuis '.static::class.'</h2>';
        echo '<h3>Avec self</h3>';
        echo '- static : '. self::$attributPublicStatic;
        echo '</br>';
        echo '- constante : '. self::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo '- méthode : '. self::methodPublicStatic();
        echo '<h3>Avec static</h3>';
        echo '- static : '. static::$attributPublicStatic;
        echo '</br>';
        echo '- constante : '. static::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo '- méthode : '. static::methodPublicStatic(); 
    }


}

class MaClassFille extends MaClass
{
    //Création des attributs
    public $attributPublic = 'Ma valeur fille';
    
    //Création des attributs static
    public static $attributPublicStatic = 'Ma valeur fille';

    //Création des constantes
    public const MA_CONSTANTE_PUBLIC = 'Ma valeur fille';

    //Création des méthodes static
    public static function methodPublicStatic(){ return 'Ma valeur fille'; }

    public function test2(){
        echo '<h2>Appel de test2 depuis '.static::class.'</h2>';
        echo '<h3>Avec self</h3>';
        echo '- static : '. self::$attributPublicStatic;
        echo '</br>';
        echo '- constante : '. self::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo '- méthode : '. self::methodPublicStatic();
        echo '<h3>Avec static</h3>';
        echo '- static : '. static::$attributPublicStatic;
        echo '</br>';
        echo '- constante : '. static::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo '- méthode : '. static::methodPublicStatic(); 
    }

}

$obj1 = new MaClass();
$obj2 = new MaClassFille();

echo '<h2>Appel depuis l\'extérieur</h2>';
echo '<h3>De l\'objet MaClass</h3>';
echo '- attribut : '. $obj1->attributPublic;
echo '</br>';
echo '- static : '. MaClass::$attributPublicStatic;
echo '</br>';
echo '- constante : '. MaClass::MA_CONSTANTE_PUBLIC;
echo '</br>';
echo '- méthode : '. MaClass::methodPublicStatic();
echo '<h3>De l\'objet MaClassFille</h3>';
echo '- attribut : '. $obj2->attributPublic;
echo '</br>';
echo '- static : '. MaClassFille::$attributPublicStatic;
echo '</br>';
echo '- constante : '. MaClassFille::MA_CONSTANTE_PUBLIC;
echo '</br>';
echo '- méthode : '. MaClassFille::methodPublicStatic();

$obj1->test1();
$obj2->test1();
$obj2->test2();

echo '<h2>Refaisons les tests en modifiants les static et attributs</h2>';

$obj1->attributPublic = 'Nouvelle valeur de MaClass';
MaClass::$attributPublicStatic = 'Nouvelle valeur de MaClass';
$obj2->attributPublic = 'Nouvelle valeur de MaClassFille';
MaClassFille::$attributPublicStatic = 'Nouvelle valeur de MaClassFille';

echo '<h3>De l\'objet MaClass</h3>';
echo '- attribut : '. $obj1->attributPublic;
echo '</br>';
echo '- static : '. MaClass::$attributPublicStatic;
echo '<h3>De l\'objet MaClassFille</h3>';
echo '- attribut : '. $obj2->attributPublic;
echo '</br>';
echo '- static : '. MaClassFille::$attributPublicStatic;


echo '<h2>Relançons les tests</h2>';

$obj1->test1();
$obj2->test1();
$obj2->test2();