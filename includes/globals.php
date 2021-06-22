<?php
	// Variables Globales
	---------------------

	// Funciones Globales

	ini_set('max_execution_time', 300); //300 seconds = 5 minutes

	function calfecha($date) { 

		$originalDate = (string) $date;

		//echo "Original Date: ".$originalDate."<br />";

	    date_default_timezone_set("America/El_Salvador");
	    $raw = $originalDate;
	    $raw = str_replace(".", "", $raw); //am/pm
	    if(strpos($raw,'am') !== false){ $ampm = "a";}else{$ampm = "A";}
	    //echo $raw."<br />";

	    $time = DateTime::createFromFormat("d/m/Y g:i:s $ampm", $raw);
	    //echo $time->format("Y/m/d g:i:s")."<br />";
	    //Wed, 14 Oct 2015 02:58:27 +0000

	    //$date2 = str_replace("/", "-", $time->format("Y/m/d g:i:s"));
		//echo "Date: ".$date."<br />";
		return $date2;
	}

	
	function parsearrss($url) { 

		$feed = file_get_contents($url);
        $xml = simplexml_load_string($feed);
		
		echo "<span class='faq menu-box-menu'>"; 

          for($i = 0; $i < 10; $i++) {
          		$link = (string) $xml->channel->item[$i]->link;
			  	$titulo = $xml->channel->item[$i]->title;
			  	$fecha = $xml->channel->item[$i]->pubDate;

                echo "<a href='". $link ."' target='_blank'>";
                echo htmlentities($titulo, ENT_QUOTES, "UTF-8");
                echo "</a>";
				echo "<p>". $fecha . "</p>";
         	
         		$XmlReacciones = "https://api.facebook.com/method/links.getStats?urls=".$link."&format=xml";

        		//echo $XmlReacciones;
        		$reacciones = simplexml_load_file($XmlReacciones);

        		//$obj = new shareCount($URLArt);
        		echo "<p><img src='css/fbicon.png' /> ". (int) $reacciones->link_stat->total_count; 
        		//echo " / <img src='css/icon-hdr-twitter.png' /> ". (int) $reacciones->shares->twitter;
        		//echo " / <img src='css/google-plus.png' /> " . (int) $reacciones->shares->google; 
        		echo "</p>";
        		echo "<hr style='color:#000; '/>";
            } 

      	echo "</span>";
	}

	function guardarss($url) { 

    	$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "andi";

		$feed = file_get_contents($url);
        $xml  = simplexml_load_string($feed);

		// Crear conexión
		$conn = new mysqli($servername, $username, $password, $dbname);
			
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$canal = (string) $xml->channel->title;

		echo $canal;

		//Buscamos el Ultimo registro por canal
		//$query = "SELECT Links FROM links WHERE Canal = ".$canal." ORDER BY id DESC LIMIT 1";
		//$row = $conn->query($query) or die('Fallo la consulta del ultimo registro');
		//$ult_reg  = (string) $conn->fetch_row($row);
		
		//echo $ult_reg;
		
        for($i = 0; $i < 10; $i++) {
          	$link = (string) $xml->channel->item[$i]->link;
			$titulo = $xml->channel->item[$i]->title;
			$date = $xml->channel->item[$i]->pubDate;
			$fecha = calfecha($date);
         	
         	$XmlReacciones = "https://api.facebook.com/method/links.getStats?urls=".$link."&format=xml";
        	$reacciones = simplexml_load_file($XmlReacciones);
        	$reacts = (int) $reacciones->link_stat->total_count;

			$sql = "INSERT INTO links (ID, Links, Titulo, Reacciones, Canal, Fecha)
			VALUES ('', '$link', '$titulo', '$reacts', '$canal', '$fecha')";

			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
        } 
	}

    
?>