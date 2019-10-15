<?php

  defined('_JEXEC') or die;

  function checkManager()
  {
  	$user   = JFactory::getUser();
  	$groups = $user->groups;

  	if (in_array(6, $groups)) {
  		return true;
  	} elseif ($user->get('`1`')) {
  		return true;
  	} else {
  		return false;
  	}
  }

class ModFrontendInfoEditer {

  public function select($id){//id moet nog aangepast worden naar de nummers van de for loop.

     $db = JFactory::getDbo();
     $query = $db->getQuery(true);
     $query->select('*');
     $query->from($db->quoteName('#__info_database'));
     $query->where($db->quoteName('id')." = ".$db->quote($id));

     $db->setQuery($query);
     $result = $db->loadRow();

     //return new Data($result[0], $position1[$id], $position2[$id], true);
     if ( $result ) {
        return new Data($result[0], $result[1], $result[2], true);
     } else {
        return new Data(0, '', '', false);
     }
  }

  public function update($id, $values = ['','']){

       $db = JFactory::getDbo();

       $query = $db->getQuery(true);

       // Fields to update.
       $fields = array(
          $db->quoteName('pos1') . ' = ' . $db->quote($values[0]),
          $db->quoteName('pos2') . ' = ' . $db->quote($values[1]),
          $db->quoteName('id') . ' = ' . $id
       );

       $conditions = array(
          $db->quoteName('id') . ' = ' . $id
       );

       $query->update($db->quoteName('#__info_database'))->set($fields)->where($conditions);

       $db->setQuery($query);

       $result = $db->execute();
    }
}

class Data { //moet het zo maken dat die dit niet gebruikt maar de select functie waar je de id aan mee geeft die dan de data van dat id geeft.
   public $id;
   public $position1; //top/down
   public $position2; //link/rechts
   public $succes; //if succes

   public function __construct($id, $position1 = "", $position2 = "", $succes = false) {
      $this->id = $id;
      $this->position1 = $position1;
      $this->position2 = $position2;
      $this->succes = $succes;
   }
}
 ?>
