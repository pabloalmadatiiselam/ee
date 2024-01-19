<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
    <title>Inicio</title>
    <link rel="stylesheet" media="print" href="estilos/estiloimp.css" type="text/css">
    <style>
        img
		{
        float:left;        
        }
        .tabimpdet
		{        
         margin-top:3px;
         clear:both;         
         width:700px;
         border-collapse: separate;
         border-spacing:5px;
		 }
         
         table td
		 {
            vertical-align: top;
         }       
         
    </style> 
</head>
<body>
   <div id="contenedor">    
    <div id="cuerpo">          
        <div id="principal">
            <?php            
            //mysql_connect("localhost","root","22922965j")or die("Ha fallado la conexión: " . mysql_error());
            $con = new mysqli("fdb19.awardspace.net","2644664_biomagnetismo","22922965j","2644664_biomagnetismo");
            if($con->errno>0)
              die ("Imposible conectar base de datos[". $con->error . "]");            
            //mysql_query("SET NAMES 'utf8'");
            $con->query("SET NAMES 'utf8'");
            //mysql_select_db("biomagnetismo")or die('Error al seleccionar la BD: ' . mysql_error());
            //end conexion
            //$ssql= mysql_query("Select * from `pares-biomagneticos` where pab_cod = " . $_GET['referencia']) or die(mysql_error());            
            $ssql = $con->query("Select * from `pares-biomagneticos` where pab_cod = " . $_GET['referencia']);
            //$row=mysql_fetch_object($ssql); 
            $row = $ssql->fetch_object();         
            //$ssql2 = mysql_query("Select * from imagenes where ima_cpb =" .  $row->pab_cod) or die(mysql_error());            
            $ssql2 = $con->query("Select * from imagenes where ima_cpb =" .  $row->pab_cod);
                 //while($row2=mysql_fetch_object($ssql2)) 
                  while($row2 = $ssql2->fetch_object())
				 {
				 ?>
                    <p>
                    <img src="imagenes/<?php echo $row2->ima_nom; ?>" width="300" height="400">
                    </p>
            <?php
			}                                         
            ?>           
            <table class="tabimpdet">
                <col></col>
                <tr>
                    <td><b>Polo1:</b></td>
                     <?php echo("<td>" . $row->pab_po1 . "</td>");?>
                </tr>
                <tr>                    
                   <td><b>Polo2:</b></td>
                   <?php echo("<td>" . $row->pab_po2 . "</td>");?>  
                </tr>
                <tr>
                    <td><b>Descripción Polo1:</b></td>
                    <?php echo("<td>" . $row->pab_p1d . "</td>");?>
                       
                </tr>
                    <td><b>Descripción Polo2:</b></td>
                    <?php echo("<td>" . $row->pab_p2d . "</td>");?>    
                <tr>
                    <td><b>Zona Polo1:</b></td>
                     <?php echo("<td>" . $row->pab_p1z . "</td>");?>                     
                </tr>
                <tr>
                    <td><b>Zona Polo2:</b></td>
                     <?php echo("<td>" . $row->pab_p2z . "</td>");?>      
                </tr>                
                <tr>
                    <td><b>Problema:</b></td>
                   <?php echo("<td>" .$row->pab_pro . "</td>");?>                   
                </tr>
                <tr>
                    <td><b>Tipo:</b></td>
                    <?php echo("<td>" . "Tipo".$row->pab_tip . "</td>");?>  
                </tr>
                <tr>
                    <td><b>Vía de transmisión:</b></td>                    
                    <?php echo("<td>" . $row->pab_vit . "</td>");?>
                    
                </tr>
                <tr>
                    <td><b>Patología:</b></td>
                    <?php echo("<td>" . $row->pab_pat . "</td>");?>
                </tr>
                <tr>
                    <td><b>Observaciones:</b></td>
                    <?php echo("<td>" . $row->pab_obs . "</td>");?>                    
                </tr>
                <tr>
                    <td><b>Recomendaciones:</b></td>
                    <?php echo("<td>" . $row->pab_rec . "</td>");?>
                </tr>
                <tr>
                   <td><b>Palabras claves:</b></td>
                  <?php echo("<td>" . $row->pab_pac . "</td>");?>
                  
                </tr>
                <tr>
                    <td><b>Pares</b></td>
                    <?php echo("<td>" . $row->pab_par . "</td>");?>
                </tr>
            </table>            
        </div>            
    </div>
   <div id="pie">
    La pantalla de impresión detalle  &copy;. Todos los derechos reservados.
   </div>
   </div>
</body>
</html>

