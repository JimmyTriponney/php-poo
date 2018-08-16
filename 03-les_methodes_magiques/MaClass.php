<?php
/*
Toutes les fonctions magiques commence par un double underscore
et doivent toujours être en public
*/
class MaClass
{
    public $attr1 = 'attr 1';
    private $attr2 = 'attr 2';
    protected $attr3 = 'attr 3';

    /*
    La méthode construct est appelée à chaque l'instanciation de la class.
    Elle peut prendre autant d'argument que voulu, il suffit de les compléter à la l'instance
    ex : new MaClass(args1, args2, args3, ...);
    */
    public function __construct(){
        echo '__construct : Nouvelle instance de '.static::class.'.</br></br>';
    }

    /*
    La méthode set est appelée quand on essai d'assigner une valeur à un attribut auquel on n'a pas accès
    ou qui n'existe pas.
    Elle prend 2 arguments :
        - Le nom de l'attribut ciblé
        - La valeur
    */
    public function __set($att, $valeur){
        echo '__set : L\'attribut "'.$att.'" n\'existe pas ou est inacessible, on vient de tenter de lui mettre la valeur : "'.$valeur.'".</br></br>';
    }

    /*
    La méthode get est appelée quand on essai d'accéder à un attribut auquel on n'a pas accès
    ou qui n'existe pas.
    Elle prend 1 arguments :
        - Le nom de l'attribut ciblé
    */
    public function __get($att){
        echo '__get : L\'attribut "'.$att.'" n\'existe pas ou est inacessible.</br></br>';
    }

    /*
    La méthode isset est appelée lorsque l'on appelle la fonction isset sur un attribut qui n'existe pas ou auquel on n'a pas accès.
    On peut donc lui faire renvoyer true ou false en fonction de ce qui est demandé
    Elle prend 1 arguments :
        - Le nom de l'attribut ciblé
    */
    public function __isset($att){
        echo '__isset : L\'attribut "'.$att.'" n\'existe pas ou est inacessible.</br></br>';
    }
    
    /*
    La méthode unset est appelée lorsque l'on appelle la fonction unset sur un attribut qui n'existe pas ou auquel on n'a pas accès.
    Elle prend 1 arguments :
        - Le nom de l'attribut ciblé
    */
    public function __unset($att){
        echo '__unset : L\'attribut "'.$att.'" n\'existe pas ou est inacessible.</br></br>';
    }
    
    /*
    La méthode call est appelée lorsque l'on appelle une fonction qui n'existe pas ou auquel on n'a pas accès.
    Elle prend 2 arguments :
        - Le nom de la méthode ciblé
        - Les arguments sous forme de tableau
    */
    public function __call($methode, $args){
        echo '__call : La méthode "'.$methode.'" n\'existe pas ou est inacessible, on vient de tenter de lui mettre en argument : "'.implode($args, '", "').'".</br></br>';
    }

    /*
    La méthode callStatic est appelée lorsque l'on appelle une fonction static qui n'existe pas dans un context static.
    Elle prend 2 arguments :
        - Le nom de la méthode ciblé
        - Les arguments sous forme de tableau
    */
    public static function __callStatic($methode, $args){
        echo '__callStatic : La méthode "'.$methode.'" n\'existe pas en static, on vient de tenter de lui mettre en argument : "'.implode($args, '", "').'".</br></br>';
    }

    /*
    La méthode sleep surcharge la fonction serialize, elle ne prend aucun argument et doit juste retourner un tableau
    des attributs que l'on souhaite serializer, bien-sûr on fait ce qu'on veut avant le return
    */
    public function __sleep(){
        return ['attr1','attr2'];
    }

    /*
    La méthode wakeup surcharge la fonction unserialize, elle ne prend aucun argument et ne doit rien retourner de particulier
    on fait ce qu'on veut, comme lancer des fonctions au "unserialize".
    ATTENTION : cela redéclanche le destruct
    */
    public function __wakeup(){
        $this->attr3 = 'toto';
        echo '__wakeup : Je viens d\'être "unserialize", j\'ai mis à l\'"attr3" la value de toto.</br></br>';
    }

    /*
    La méthode toString permet de transformer l'objet en un chaine de caractéres, elle ne surcharge pas serialize.
    Elle peut fonctionner avec "echo" ou "(string)" par exemple
    */
    public function __toString(){
        return '__toString : Voici ce que je souhaite afficher quand je veux voir mon objet sous forme de string.</br></br>';
    }

    /*
    La méthode clone permet de faire des actions lorsque l'on clone un objet, pour rappel un objet à un identifiant unique
    si on souhaite copié un objet indépendant dans une nouvelle variable, voici la syntaxe $newObj = clone $oldObj.
    ATTENTION la fonction destruct est là aussi appelé sur le nouvel objet.
    */
    public function __clone(){
        echo '__clone : Comment ça j\'ai un clone, pourtant je suis unique.</br></br>';
    }

    /*
    La méthode set_state surcharge la fonction "var_export" qui converti votre objet en code php.
    Ainsi lors d'un var_export vous pouvez complétement modifier votre objet en en recréant un, et le
    code généré étant du php il est utilisable avec eval.
    Elle prend 1 argument :
        - Un tableau contenant tous les attributs et valeurs de l'objet
    */
    public function __set_state($attrs){
        $obj = new MaClass($attrs['attr1'], $attrs['attr2'], $attrs['attr3']);
        return $obj;
    }

    /*
    La méthode invoke permet d'ulitser l'objet comme une fonction.
    Elle prend autant d'argument que vous souhaitez en passer à la fonction
    */
    public function __invoke($arg){
        echo '__invoke : Et voila je suis une fonction, la classe non (c\'est drôle pour une class de dire ça)? J\'ai demandé un argument le voici : "'.$arg.'".</br></br>';
    }

    /*
    La méthode destruct est appelée à la destruction de l'instance, elle ne prend aucun argument
    */
    public function __destruct(){
        echo '__destruct : Destruction de l\'instance de '.static::class.'.</br></br>';
    }


}

echo '<h1>Les méthodes magique.</h1>';

$obj = new MaClass();

$obj->fantome1 = 'Ma valeur';
$obj->fantome2;
isset($obj->fantome3);
unset($obj->fantome4);
$obj->maMethod('arg1','arg2', 'arg3');
MaClass::maMethodStatic('arg1','arg2', 'arg3');
$serialize = serialize($obj);
echo '__sleep : retour de la méthode avec un serialize, voici le retour : '.$serialize.'.</br></br>';
unserialize($serialize);
echo $obj;
echo '__set_state : '; var_export($obj); echo '</br></br>';
$obj('Mon argument');
$objBis = clone $obj;