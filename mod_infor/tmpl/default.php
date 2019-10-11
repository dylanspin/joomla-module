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
  for($i=0; $i<=$hoeveel; $i++){
    echo "<div class='vak_'>test</div>";
  }
  if($params->get('social')){
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
