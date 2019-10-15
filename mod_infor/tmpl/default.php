<?php
  defined('_JEXEC') or die;

  $font = $params->get('font');//grote text van alle vakken //kan mischien nog veranderen.
  $hoeveel =  $params->get('aantal');//aantall vakken

  //alle href's voor de social media logo's
  $youtube = $params->get('youtube');
  $insta = $params->get('instagram');
  $twitter = $params->get('twitter');
  $linkedin = $params->get('linkedin');
  $facebook = $params->get('facebook');

  $doc = JFactory::getDocument();
  $helper = new ModFrontendInfoEditer(); //helper class.
  //for($p=0; $p<$hoeveel+1; $p++){ //pas weer aan zetten als de een keer update bug gefixt is.
    $data = $helper->select();
  //}

  $modulePath = JURI::base() . 'modules/mod_infor/';
  $doc->addStyleSheet($modulePath.'css/style.css');
  //$doc->addScript($modulePath.'js/javascript.js');

  $css = "
    .grote_{
      font-size:".$params->get('grote')."px;
      color:".$params->get('kleur').";
      transition:0.3;
    }";
  $doc->addStyleDeclaration($css);//add de css aan style.css

  $p1hoogte = $data->position1;
  $p1breed = $data->position2;

 ?>

 <!---<form method="post" style="display:block;">
   <label style="float:left; width:80px;">Kleur</label><input type="color" name="kleur" class="kleur_">
   <textarea name="text" rows="5"placeholder="inhoud"></textarea>
   <input type="submit" name="stuur" value="Stuur">
 </form>
 --->

 <!--Wat de vakken nog moeten krijgen:
 * de saving van de locatie waar die staat in de database.
 * de saving van de grote van het vak
 * kleur keuze van een input type color background en text kleur
 * font size keuze
 * text saving ook in een __info_database
 * mischien er voor zorgen dat ze niet buiten de informatie div kunnen.
 * een reset optie in de back end zo dat ze weer op de standaard locatie staan.
 * mischien een foto optie.
 * mischien een kaart optie. een iframe dus
 * --->

 <!--Wat er eerst nog moet gebeuren:
  * Fixen dat er maar een keer word opgeslagen door php best kut.
  * Fixen dat er meerdere locaties worden opgeslagen.
  * Fixen dat er meerdere locaties worden gepakt en bij de goede div worden gezet.
  * Grote vak moet worden gepakt en in een database gedaan worden.
  * De grote moet het zelfde blijfen iedere keer dus uit de database gepakt worden.-->

<div class="informatie_"> <!--het vak waar alles in komt te staan  moet nog edit opties krijgen zo als
background color,hoogte,ook de optie mischien voor de social media.-->
<?php

  for($i=0; $i<=$hoeveel-1; $i++){//print de vakken zo veel keer uit als aangegeven is in de back end.
    echo "<div class='vak_' id='vak$i'>
            <div class='sleep_' id='sleep$i'>Sleep</div><br>
          </div>";//moet nog de text van elk id hier laten uit printen.
  }

  if($params->get('social')){ //social media.
    echo"<div id='vak9' class='social_'>
          <div class='sleep_' id='sleep9'>Sleep</div><br>";

          if(strlen($youtube) > 0){
            echo "<a href=".$youtube."><i class='fa fa-youtube-play fa-2x grote_'></i></a> ";
          }
          if(strlen($insta) > 0){
            echo "<a href=".$insta."><i class='fa fa-instagram fa-2x grote_'></i></a> ";
          }
          if(strlen($twitter) > 0){
            echo "<a href=".$twitter."><i class='fa fa-twitter fa-2x grote_'></i></a> ";
          }
          if(strlen($linkedin) > 0){
            echo "<a href=".$linkedin."><i class='fa fa-linkedin fa-2x grote_'></i></a> ";
          }
          if(strlen($facebook) > 0){
            echo "<a href=".$facebook."><i class='fa fa-facebook fa-2x grote_'></i></a> ";
          }

    echo"</div>";
  }
  ?>
</div>

<script>

var i;

for(i=0; i<(<?php echo $hoeveel+1; ?>); i++){

  (document.getElementById("vak"+i)).style.top = (<?php echo $p1hoogte ?>+ "px");//zet de div op de locatie die in de database staat
  (document.getElementById("vak"+i)).style.left = (<?php echo $p1breed ?> + "px");

  dragElement(document.getElementById("vak"+i));

  function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById("sleep"+i)) {
      document.getElementById("sleep"+i).onmousedown = dragMouseDown;
    } else {
      document.getElementById("sleep"+i).onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
      e = e || window.event;
      e.preventDefault();
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
      e = e || window.event;
      e.preventDefault();
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;
      elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
      elmnt.style.left = (elmnt.offsetLeft - pos1 - 20) + "px";
    }

    function closeDragElement() {
      var hoog = elmnt.offsetTop - pos2;
      var breed = elmnt.offsetLeft - pos1;
      console.log(breed+" "+hoog);

      document.cookie=("hoog=" + hoog + ";");//doet de hoogte/breedte in de cookies zo dat de php er bij kan
      document.cookie=("breed=" + breed + ";");

      <?php //set de informatie in de database.
        $hoogte = $_COOKIE["hoog"];
        $breedte = $_COOKIE["breed"]-20;

        $values = [$hoogte,$breedte];
        $helper->update($i, $values);
      ?>
      document.onmouseup = null;
      document.onmousemove = null;
    }
  } //functie : dragElement
  (document.getElementById("vak"+i)).style.top = (<?php echo  $hoogte?>+ "px");
  (document.getElementById("vak"+i)).style.left = (<?php echo $breedte ?> + "px");
} //for loop

</script>
