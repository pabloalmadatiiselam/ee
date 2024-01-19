<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
    <title>Resultados de la búsqueda</title>
    <link rel="stylesheet" media="screen" href="estilos/estilo2.css" type="text/css">
     <script language="javascript">
        function verificar_blanco(){      
           if(document.fbuscador.problema.value.length == 0){
            if(document.fbuscador.tipo.value.length == 0){
               if(document.fbuscador.polo1.value.length == 0){
                  if(document.fbuscador.polo2.value.length == 0){
                    if(document.fbuscador.dp1.value.length == 0){
                       if(document.fbuscador.dp2.value.length == 0){
                          if(document.fbuscador.via.value.length == 0){
                             if(document.fbuscador.patologia.value.length == 0){
                                if(document.fbuscador.par.value.length == 0){
                                   alert("Ingrese un campo como minimo");
                                   return false;
                                 }
      }  }  } } } }   } }
       return true;}    
     </script>
     <style>
       #principal{
            margin-top:10px;
        }  
      .tabfor{
       border:1px black solid;
       margin:auto;
       margin-top:7px;       
       }
       p{
       text-align: center;
       font-size: 15pt;
       color: #ff0000;
       font-weight:bold;
       }      
     </style>
     
</head>

<body>
   <div id="contenedor">
    <div id="cabecera">
        <p align="center"><img src="imagenes/logo.png" width=340px height=67px ></p>
    </div>
    <div id="cuerpo">
         <div id="navegador">
                <a class="enlacenav" href="index.php">INICIO|</a>
                <a class="enlacenav" href="pares-biomagnetismo.php">LISTADO|</a>
                <a class="enlacenav" href="listaimp.php">LISIMP|</a>
                <a class="enlacenav" href="palabras.php">BUSCARPAL|</a>
                <a class="enlacenav" href="claves.php">BUSCARCLA</a>              
        </div>       
        <div id="principal">         
        <?php
        
        if(!$_POST){ ?>
        <div id="buscador">
                <form name="fbuscador" method="post" action="palabras.php" onSubmit="return verificar_blanco()">
                 <table class="tabfor">
                 <tr>
                 <td>Problema:</td> 
                 <td>
                 <input type ="text" name="problema"></td>
                 </tr>
                 <tr>                  
                 <td>Tipo:</td>                  
                 <td>
                 <input type ="text" name="tipo"></td>
                 </tr>
                 <tr>
                 <td> Polo1:</td> 
                 <td>
                 <input type ="text" name="polo1"></td>
                 </tr>
                <tr>
                 <td>Polo2:</td>
                 <td>
                 <input type ="text" name="polo2"></td>
                </tr>
                <tr>
                 <td>Descripcion polo1:</td>
                 <td><input type ="text" name="dp2"></div> </td>
                </tr>
                <tr>
                 <td>Descripcion polo2:</td>
                 <td><input type ="text" name="dp1"></div></td>
                </tr>
                 <tr>
                  <td>Via de transmisión:</td>
                  <td><input type ="text" name="via"></div></td>
                 </tr>
                 <tr>
                  <td>Patologia:</td>
                  <td><input type ="text" name="patologia"></div></td>
                 </tr>
                 <tr>
                  <td>par</td>
                  <td><input type ="text" name="par"></div></td>
                 </tr>                  
                 <tr>
                 <td><input class="botonb" type="reset" value="Cancelar"></div></td>
                 <td><input class="botonb" type="submit" value="Buscar"></div></td>
                 </tr>         
                 </table>
                 </form>
       </div>
        <?php
        }else{
        //ini_set('display_errors', 1);
        //error_reporting(-1);

        //cadena de conexion
        //mysql_connect("localhost","root","22922965j");
        $con = new mysqli("fdb19.awardspace.net","2644664_biomagnetismo","22922965j","2644664_biomagnetismo");
        if($con->errno>0)
            die ("Imposible conectar base de datos[". $con->error . "]");

        
        //para que funcione los acentos y la ñ
        //mysql_query("SET NAMES 'utf8'");
        $con->query("SET NAMES 'utf8'");
          
        //selecciona base de datos
        //mysql_select_db("biomagnetismo");
        
      //asigno a variables
            $problema = $_POST["problema"];
            $tipo = $_POST["tipo"];
            $polo1 = $_POST["polo1"];
            $polo2 = $_POST["polo2"];
            $pd1 = $_POST["dp1"];
            $pd2 = $_POST["dp2"];
            $via =$_POST["via"];
            $patologia =$_POST["patologia"];
            $par = $_POST["par"];
            
            //contatenar
            $criterio = $problema." ".$tipo." ".$polo1." ".$polo2." ".$pd1." ".$pd2." ".$via." ".$patologia." ".$par;
                      
         //elimino espacios sobrantes de mi cadena y cuento las palabras de mi cadena
        if($criterio<>''){            
            $busqueda=trim($criterio);
            $busqueda = preg_replace("/ +/"," ",$busqueda);
            $trozos = explode(" ",$busqueda);
            $numero = count($trozos);
            //$numero=str_word_count($busqueda);      
                              
    
            if($numero == 1){
                //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCCION CON LIKE
                $cadbusca = "SELECT * FROM `pares-biomagneticos` WHERE pab_pro LIKE '%$busqueda%' OR pab_tip LIKE '%$busqueda%' OR pab_po1 LIKE '%$busqueda%' OR pab_po2 LIKE '%$busqueda%' OR pab_p1d LIKE '%$busqueda%' OR pab_p2d LIKE '%$busqueda%' OR pab_vit LIKE '%$busqueda%' OR pab_pat LIKE '%$busqueda%' OR pab_par LIKE '%$busqueda%' ORDER BY pab_cod LIMIT 50 ";
        
            }elseif($numero > 1){
                //SI HAY UNA FRASE SE UTILIZA EL ALGORITMO DE BUSQUEDA AVANZADO DE MATCH AGAINST.
                //busqueda de frases con mas de una palabra y un algoritmo especializado       
                $cadbusca = "SELECT * , MATCH (pab_pro,pab_tip,pab_po1,pab_po2,pab_p1d,pab_p2d,pab_vit,pab_pat,pab_par,pab_p1z,pab_p2z,pab_pac) AGAINST ( '$busqueda' ) AS Score FROM `pares-biomagneticos` WHERE MATCH (pab_pro,pab_tip,pab_po1,pab_po2,pab_p1d,pab_p2d,pab_vit,pab_pat,pab_par,pab_p1z,pab_p2z,pab_pac) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50";
            }              
            //$result= mysql_query($cadbusca) or die(mysql_error());
            $result = $con->query($cadbusca);
            //if (mysql_num_rows($result)==0) die ('<p>'.'La búsqueda no arrojo resultados. '.'</p>');
            if ($result->num_rows == 0) die ('<p>'.'La búsqueda no arrojo resultados. '.'</p>');?>

            <table class="tablis">
            <thead><tr><th>Codigo</th><th>Descripción</th><th>Problema</th><th>Tipo</th><th>Detalle</th></tr></thead>
            <?php
            //while($row = mysql_fetch_object($result)){
            while($row = $result->fetch_object()){
                 $refer = $row->pab_cod;
                //mostramos los pares biomagneticos
                echo ("<tr>"."<td>".$row->pab_cod . "</td>" . "<td>".$row->pab_des ."</td> " . "<td>".$row->pab_pro . "</td>". "<td>".$row->pab_tip . "</td>");     
                echo "<td>"."<a href='mostrar-detalle.php?referencia=$refer'>detalle</a>" .  "</td>";
                echo ("</tr>");
            }      
        
        }
        }
        ?>
      </table> 
      </div>                 
      </div>        
   
   <div id="pie">
    La pantalla de busqueda por campos multiples&copy;. Todos los derechos reservados.
   </div>
   </div>
</body>
</html>