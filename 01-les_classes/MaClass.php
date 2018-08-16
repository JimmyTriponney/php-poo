<?php

class MaClass //Création d'une class
{
    // LES ATTRIBUTS //

    /* 
    Création d'un attribut à la visibilité public
    celui-ci sera visible partout et tout le temps
    */
    public $attributPublic = "Je suis un attribut 'public'.";
    /*
    Création d'un attribut à la visibilité private
    celui-ci sera visible uniquement dans la classe
    */
    private $attributPrivate = "Je suis un attribut 'private'.";
    /*
    Création d'un attribut à la visibilité protected
    celui-ci sera visible dans la classe et celles qui en héritent
    */
    protected $attributProtected = "Je suis un attribut 'protected'.";

    /*
    Le fonctionnement est le même pour les méthodes.
    En fonction de leurs visibilitées elles pourront être appelé :
    - Depuis l'extérieur de la class "public"
    - Depuis la classe uniquement "private"
    - Depuis la classe et celles qui en héritent "protected"
    */
    public function methodPublic(){ return "Je suis une méthode 'public'."; }
    private function methodPrivate(){ return "Je suis une méthode 'private'."; }
    protected function methodProtected(){ return "Je suis une méthode 'protected'."; }


    // LES CONSTANTES ET STATIC //
    /*
    Création d'une constante, celle-ci sera accéssible de partout,
    en utilisant MaClass::MA_CONSTANTE depuis l'extérieur et
    en utilisant self::MA_CONSTANTE ou static::MA_CONSTANTE dans la classe.
    Sa valeur sera fixe et rattaché à la classe et non à l'instance de celle-ci
    */
    public const MA_CONSTANTE_PUBLIC = "Je suis une contante 'public'.";
    private const MA_CONSTANTE_PRIVATE = "Je suis une contante 'private'.";
    protected const MA_CONSTANTE_PROTECTED = "Je suis une contante 'protected'.";
    /*
    Création d'un attribut static, celui-ci sera accéssible de partout,
    en utilisant MaClass::attributStatic depuis l'extérieur et
    en utilisant self::attribut ou static::attribut.
    Sa valuer sera modifiable et rattaché à la classe, ainsi si il est modifié
    toutes les instances de cette classe auront la modification, mais aussi les instances
    des classes qui en hérites
    */
    public static $attributPublicStatic = "Je suis un attribut 'public' et 'static'.";
    private static $attributPrivateStatic = "Je suis un attribut 'private' et 'static'.";
    protected static $attributProtectedStatic = "Je suis un attribut 'protected' et 'static'.";

    /*
    Le fonctionnement des méthodes est identique.
    */
    public static function methodPublicStatic(){ return "Je suis une méthode 'public' et 'static'."; }
    private static function methodPrivateStatic(){ return "Je suis une méthode 'private' et 'static'."; }
    protected static function methodProtectedStatic(){ return "Je suis une méthode 'protected' et 'static'."; }

    public function test(){
        echo '<h2>Appel depuis la fonction test de '.self::class.' '.( self::class !== static::class ? 'depuis la class '.static::class : '' ).'</h2>';
        echo '<h3>Les attributs</h3>';

        echo 'TEST, dans '.static::class.' : Appel de mon attribut public : ' . $this->attributPublic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut private : ' . $this->attributPrivate;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut protected : ' . $this->attributProtected;
        
        echo '<h3>Les constantes</h3>';

        echo 'TEST, dans '.static::class.' : Appel de ma constante public avec self : ' . self::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante private avec self : ' . self::MA_CONSTANTE_PRIVATE;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante protected avec self : ' . self::MA_CONSTANTE_PROTECTED;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante public avec static : ' . static::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante private avec static : ' . ( self::class === static::class ? static::MA_CONSTANTE_PRIVATE : "Cette appel est impossible car je suis en private.");
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante protected avec static : ' . static::MA_CONSTANTE_PROTECTED;
        echo '</br>';
        
        echo '<h3>Les static</h3>';

        echo 'TEST, dans '.static::class.' : Appel de mon attribut static public avec self : ' . self::$attributPublicStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static private avec self : ' . self::$attributPrivateStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static protected avec self : ' . self::$attributProtectedStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static public avec static : ' . static::$attributPublicStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static private avec static : ' . ( self::class === static::class ? static::MA_CONSTANTE_PRIVATE : "Cette appel est impossible car je suis en private.");
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static protected avec static : ' . static::$attributProtectedStatic;
        echo '</br>';
    }


}

class MaClassFille extends MaClass // Création d'une class qui hérite de la classe MaClass
{
    public function testFille(){
        echo '<h2>Appel depuis la fonction test de '.self::class.'</h2>';
        echo '<h3>Les attributs</h3>';

        echo 'TEST, dans '.static::class.' : Appel de mon attribut public : ' . $this->attributPublic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut private : ' . "Cette appel est impossible car je suis en private.";
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut protected : ' . $this->attributProtected;
        
        echo '<h3>Les constantes</h3>';

        echo 'TEST, dans '.static::class.' : Appel de ma constante public avec self : ' . self::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante private avec self : ' . "Cette appel est impossible car je suis en private.";
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante protected avec self : ' . self::MA_CONSTANTE_PROTECTED;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante public avec static : ' . static::MA_CONSTANTE_PUBLIC;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante private avec static : ' . "Cette appel est impossible car je suis en private.";
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de ma constante protected avec static : ' . static::MA_CONSTANTE_PROTECTED;
        echo '</br>';
        
        echo '<h3>Les static</h3>';

        echo 'TEST, dans '.static::class.' : Appel de mon attribut static public avec self : ' . self::$attributPublicStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static private avec self : ' . "Cette appel est impossible car je suis en private.";
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static protected avec self : ' . self::$attributProtectedStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static public avec static : ' . static::$attributPublicStatic;
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static private avec static : ' . "Cette appel est impossible car je suis en private.";
        echo '</br>';
        echo 'TEST, dans '.static::class.' : Appel de mon attribut static protected avec static : ' . static::$attributProtectedStatic;
        echo '</br>';
    }
}

$obj1 = new MaClass();

echo '<h2>Appel depuis l\'extérieur de MaClass</h2>';

echo 'Appel de mon attribut public : ' . $obj1->attributPublic;
echo '</br>';
echo 'Appel de ma méthode public : ' . $obj1->methodPublic();
echo '</br>';
echo 'Appel de ma constante public : ' . MaClass::MA_CONSTANTE_PUBLIC;
echo '</br>';
echo 'Appel de mon attribut static public : ' . MaClass::$attributPublicStatic;
echo '</br>';
echo 'Appel de ma fonction static public : ' . MaClass::methodPublicStatic();

$obj1->test();

$obj2 = new MaClassFille();

$obj2->test();
$obj2->testFille();