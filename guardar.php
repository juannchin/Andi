<?php

//El Diario de Hoy
$dom = new DOMDocument();
$dom->load('http://www.elsalvador.com/rss/articulos/rss-LAST.xml');
$dom->save('xmls/edh.xml');

//La Prensa Gráfica
$dom = new DOMDocument();
$dom->load('http://www.laprensagrafica.com/Generales/feed?rss=Portada');
$dom->save('xmls/lpg.xml');


//La Pagina
$dom = new DOMDocument();
$dom->load('http://www.lapagina.com.sv/rss/rss.php');
$dom->save('xmls/dlp.xml');


//Diario 1
$dom = new DOMDocument();
$dom->load('http://diario1.com/feed/');
$dom->save('xmls/d1.xml');

//Diario El Mundo
$dom = new DOMDocument();
$dom->load('http://elmundo.sv/feed/');
$dom->save('xmls/dem.xml');


?>