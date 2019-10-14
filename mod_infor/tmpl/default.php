<?php
  defined('_JEXEC') or die;

  $font = $params->get('font');
  $hoeveel =  $params->get('aantal');
  $youtube = $params->get('youtube');
  $insta = $params->get('instagram');
  $twitter = $params->get('twitter');
  $linkedin = $params->get('linkedin');
  $facebook = $params->get('facebook');

  $doc = JFactory::getDocument();

  $modulePath = JURI::base() . 'modules/mod_infor/';
  $doc->addStyleSheet($modulePath.'css/style.css');
  //$doc->addScript($modulePath.'js/javascript.js');

  $css = "
    .grote_{
      font-size:".$params->get('grote')."px;
      color:".$params->get('kleur').";
      transition:0.3;
    }";
  $doc->addStyleDeclaration($css);

 ?>

<div class="informatie_">
<?php
  for($i=0; $i<=$hoeveel-1; $i++){//print de vakken zo veel keer uit als aangegeven is in de back end.
    echo "<div class='vak_' id='vak$i'></div>";
  }
  if($params->get('social')){//de social media print
    echo "<div class='social'>";

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
  } ?>

</div>

<script>
var div_ = document.getElementById('vak0');
console.log(div_);
dragElement(div_);

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (elmnt) {
    console.log(elmnt)
    /* if present, the header is where you move the DIV from:*/
    elmnt.onmousedown = dragMouseDown;
  } else {
    console.log("else");
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    console.log("doet function");
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2)+ "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>

<?php
 ?>
