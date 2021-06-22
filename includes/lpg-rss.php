 <?php
    // Variables Globales
    
    $url1 = "xmls/edh.xml";
    $url2 = "xmls/dlp.xml";
    $url3 = "xmls/d1.xml";
    $url4 = "xmls/dem.xml";
    $url5 = "xmls/lpg.xml";
?>

<div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Ultimas noticias Medios Salvadoreños
                                </h4><ol class="breadcrumb pull-right">
                                    <li><a href="#">ANDI</a></li>
                                    <li>RSS</li>
                                    <li class="active">ESA</li>
                                </ol>
                            </div>
                        </div>


                        <div class="row"><!-- col-->
                            
                        </div> <!-- End row -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Grid Example</h3>  <div id="fb-share"></div> 
                                    </div>
                                    <!-- Parseo de RSS -->
                                    
                                    <div class="section group">
  										<div class="col span_1_of_5 menu-box">
                                        
                                        <table width="100%" border="0">
                                          <tr>
                                            <td valign="top">&nbsp;</td>
                                            <td valign="top" width="20%">La Prensa Gráfica</td>
                                            <td valign="top">&nbsp;</td>
                                            <td valign="top" width="20%">elsalvador.com</td>
                                            <td valign="top">&nbsp;</td>
                                            <td valign="top" width="20%">La Pagina</td>
                                            <td valign="top">&nbsp;</td>
                                            <td valign="top" width="20%">Diario 1</td>
                                            <td valign="top">&nbsp;</td>
                                            <td valign="top" width="20%">Diario El Muido</td>
                                          </tr>
                                          <tr>
                                                            <td valign="top" width="3px">&nbsp;</td>
                                            <td valign="top" height="100px"><?php parsearrss($url5); ?></td>
                                                            <td valign="top" width="3px">&nbsp;</td>
                                            <td valign="top" height="100px"><?php parsearrss($url1); ?></td>
                                                            <td valign="top" width="3px">&nbsp;</td>
                                            <td valign="top" height="100px"><?php parsearrss($url2); ?></td>
                                                            <td valign="top" width="3px">&nbsp;</td>
                                            <td valign="top" height="100px"><?php parsearrss($url3); ?></td>
                                                            <td valign="top" width="3px">&nbsp;</td>
                                            <td valign="top" height="100px"><?php parsearrss($url4); ?></td>
                                          </tr>
                                        </table>
                                          
                                          
                                  </div>
                                    
                                </div> <!-- panel -->
                            </div> <!-- Col -->
                        </div> <!-- End row -->



            </div>