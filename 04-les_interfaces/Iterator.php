<?php

/*
ITERATOR :

Si votre classe implémente l'interface natif "Iterator", alors vous pourrez modifier le comportement de votre obj lorsqu'il est parcouru.
Cette interface comporte 5 méthodes :
    •current: renvoie l'élément courant ;
    •key: retourne la clé de l'élément courant ;
    •next: déplace le pointeur sur l'élément suivant ;
    •rewind: remet le pointeur sur le premier élément ;
    •valid: vérifie si la position courante est valide.
En écrivant ces méthodes, on pourra renvoyer la valeur qu'on veut, et pas forcément la valeur de l'attribut actuellement lu.
*/

/*
SEEKABLEITERATOR :

L'interface SeekableIterator hérite de l'interfaceIterator. Elle rajoute la fonction "seek" qui permet de place le curseur où on le souhaite.
*/

/*
ARRAYACCESS :

Nous allons enfin, grâce à cette interface, pouvoir placer des crochets à la suite de notre objet avec la clé à laquelle accéder, comme sur un vrai tableau ! L'interfaceArrayAccessliste quatre méthodes :
    •offsetExists: méthode qui vérifiera l'existence de la clé entre crochets lorsque l'objet est passé à la fonctionissetouempty(cette valeur entre crochet est passée à la méthode en paramètre) ;
    •offsetGet: méthode appelée lorsqu'on fait un simple$obj['clé']. La valeur 'clé' est donc passée à la méthodeoffsetGet;
    •offsetSet: méthode appelée lorsqu'on assigne une valeur à une entrée. Cette méthode reçoit donc deux arguments, la valeur de la clé et la valeur qu'on veut lui assigner.
    •offsetUnset: méthode appelée lorsqu'on appelle la fonctionunsetsur l'objet avec une valeur entre crochets. Cette méthode reçoit un argument, la valeur qui est mise entre les crochets.
*/

class MaClasse implements SeekableIterator, ArrayAccess
{
    private $position = 0;
    private $tableau = ['Premier élément', 'Deuxième élément', 'Troisième élément', 'Quatrième élément', 'Cinquième élément'];
    
    /*
    Retourne l'élément courant du tableau.
    */
    public function current()
    {
        return $this->tableau[$this->position];
    }
    
    /*
    Retourne la clé actuelle (c'est la même que la position dans notre cas).
    */
    public function key()
    {
        return $this->position;
    }
    
    /*
    Déplace le curseur vers l'élément suivant.
    */
    public function next()
    {
        $this->position++;
    }
    
    /*
    Remet la position du curseur à 0.
    */
    public function rewind()
    {
        $this->position = 0;
    }

    /*
    Déplace le curseur interne.
    */
    public function seek($position)
    {
        $anciennePosition = $this->position;
        $this->position = $position;
        
        if (!$this->valid())
        {
            trigger_error('La position spécifiée n\'est pas valide', E_USER_WARNING);
            $this->position = $anciennePosition;
        }
    }
    
    /*
    Permet de tester si la position actuelle est valide.
    */
    public function valid()
    {
        return isset($this->tableau[$this->position]);
    }

    /* MÉTHODES DE L'INTERFACE ArrayAccess */
  
  
    /*
    Vérifie si la clé existe.
    */
    public function offsetExists($key)
    {
        return isset($this->tableau[$key]);
    }
    
    /*
    Retourne la valeur de la clé demandée.
    Une notice sera émise si la clé n'existe pas, comme pour les vrais tableaux.
    */
    public function offsetGet($key)
    {
        return $this->tableau[$key];
    }
    
    /*
    Assigne une valeur à une entrée.
    */
    public function offsetSet($key, $value)
    {
        $this->tableau[$key] = $value;
    }
    
    /*
    Supprime une entrée et émettra une erreur si elle n'existe pas, comme pour les vrais tableaux.
    */
    public function offsetUnset($key)
    {
        unset($this->tableau[$key]);
    }

}

echo '<h2>Les interfaces</h2>';

//Iterator
echo '<h2>L\'interface "Iterator"</h2>';

$obj = new MaClasse;

foreach ($obj as $key => $value)
{
  echo $key, ' => ', $value, '<br />';
}

//SeekableIterator
echo '<h3>Le plus avec "SeekableIterator"</h3>';

echo 'Remise du curseur en troisième position...<br />';
$obj->seek(2);
echo 'Élément courant : ', $obj->current(), '<br />';


//ArrayAccess
echo '<h2>L\'interface "ArrayAccess"</h2>';

echo 'Affichage du troisième élément : ', $obj[2], '<br />';
echo 'Modification du troisième élément... ';
$obj[2] = 'Hello world !';
echo 'Nouvelle valeur : ', $obj[2], '<br /><br />';

echo 'Destruction du quatrième élément...<br />';
unset($obj[3]);

if (isset($obj[3]))
{
  echo '$obj[3] existe toujours... Bizarre...';
}
else
{
  echo 'Tout se passe bien, $obj[3] n\'existe plus !';
}