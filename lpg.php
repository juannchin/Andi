<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="300">
    <title>Dashboard Medios Salvadorenos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <?php      
	//require("class/shareCount.php");
	
      $url1 = "http://www.elsalvador.com/rss/articulos/rss-LAST.xml";
      $url2 = "http://www.lapagina.com.sv/rss/rss.php";
		  $url3 = "http://diario1.com/feed/";
		  $url4 = "http://elmundo.sv/feed/";
		  $url5 = "http://www.laprensagrafica.com/Generales/feed?rss=Portada";
      $url6 = "http://www.esmitv.com/feed/";

		  function parsearrss($url) { 

          $xml = simplexml_load_file($url);
		      echo "<dl class='faq menu-box-menu'>"; 

          for($i = 0; $i < 10; $i++){

			  	$titulo = $xml->channel->item[$i]->title;
                echo "<dt>"; 
                echo "<a href='". $xml->channel->item[$i]->link ."' target='_blank'>";
                echo htmlentities($titulo, ENT_QUOTES, "UTF-8");
                echo "</a>";
                echo "</dt>";
				echo "<dd>". $xml->channel->item[$i]->pubDate . "<dd>";
				
				$URLArt = (string) $xml->channel->item[$i]->link;
        //$XmlReacciones = "https://count.donreach.com/?url="."http://www.laprensagrafica.com/2015/10/24/reviva-la-hazaa-del-salvadoreo-que-marco-la-historia-de-la-aviacion-mundial"."&format=xml";
         $XmlReacciones = "https://api.facebook.com/method/links.getStats?urls=".$URLArt."&format=xml";

        //echo $XmlReacciones;
        $reacciones = simplexml_load_file($XmlReacciones);

        //$obj = new shareCount($URLArt);
        echo "<dd><img src='css/fbicon.png' /> ". (int) $reacciones->link_stat->total_count; 
        //echo " / <img src='css/icon-hdr-twitter.png' /> ". (int) $reacciones->shares->twitter;
        //echo " / <img src='css/google-plus.png' /> " . (int) $reacciones->shares->google; 
        echo "</dd>";
        echo "<hr style='color:#000; '/>";
            } 
      echo "</dl>";
		  }
    ?>
    <style>
    </style>

  </head>
  <body>
  <script> 
/*miFecha = new Date() 
document.write(miFecha.getHours() + ":" + miFecha.getMinutes() + ":" + miFecha.getSeconds()) */
</script> 

<div class="section group">
  <div class="col span_1_of_5 menu-box">
    <h2 class="titular">lpg.com</h2>
        <?php parsearrss($url5); ?>
  </div>
  <div class="col span_1_of_5 menu-box">
    <h2 class="titular">elsalvador.com</h2>
        <?php parsearrss($url1); ?>
  </div>
  <div class="col span_1_of_5 menu-box">
  <h2 class="titular">lapagina.com.sv</h2>
		<?php parsearrss($url2); ?>
  </div>
  <div class="col span_1_of_5 menu-box">
   <h2 class="titular">diario1.com</h2>
        <?php parsearrss($url3); ?>
  </div>
  <div class="col span_1_of_5 menu-box">
   <h2 class="titular">elmundo.sv</h2>
        <?php parsearrss($url4); ?>
  </div>
</div>
  </body>
</html>