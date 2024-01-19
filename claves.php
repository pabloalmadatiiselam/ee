<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
    <title>Resultados de la búsqueda</title>
    <link rel="stylesheet" media ="screen" href="estilos/estilo2.css" type="text/css">
     <script language="javascript">
        function verificar_blanco(){      
           if(document.fbuscador.clave1.value.length == 0){
            if(document.fbuscador.clave2.value.length == 0){
               if(document.fbuscador.clave3.value.length == 0){
                  if(document.fbuscador.clave4.value.length == 0){
                    if(document.fbuscador.clave5.value.length == 0){
                       if(document.fbuscador.zp1.value.length == 0){
                          if(document.fbuscador.zp2.value.length == 0){                             
                                   alert("Ingrese un campo como minimo");
                                   return false;
                                 }
      }  }  } } } }   
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
                <form name="fbuscador" method="post" action="claves.php"  onSubmit="return verificar_blanco()">
                 <table class="tabfor">
                 <tr>
                  <td>Clave 1:</td>
                  <td><input type ="text" name="clave1"></td>
                 </tr> 
                 <tr>
                  <td>Clave 2:</td>
                  <td><input type ="text" name="clave2"></td>
                 </tr>
                 <tr>
                 <td>Clave 3:</td>
                 <td><input type ="text" name="clave3"></td>
                 </tr>
                 <tr>
                 <td>Clave 4:</td>
                 <td><input type ="text" name="clave4"></td>
                 </tr>
                 <tr>
                 <td>Clave 5:</td>
                 <td><input type ="text" name="clave5"></td>
                 </tr>
                 <tr>
                 <td>Zona Polo 1:</td>
                 <td><input type ="text" name="zp1">  </td>
                 </tr>
                 <tr>
                 <td>Zona Polo 2:</td>
                 <td><input type ="text" name="zp2">   </td> 
                 </tr>
                  <tr>
                   <td><input class="botonb" type="reset" value="Cancelar"></td>
                   <td><input class="botonb" type="submit" value="Buscar"></td>
                  </tr> 
                  </table>
                </form>
       </div>
        <?php
        }else{
        //ini_set('display_errors', 1);
        //error_reporting(-1);

        //cadena de conexion
        //mysql_connect("fdb19.awardspace.net","root","22922965j");
        $con = new mysqli("fdb19.awardspace.net","2644664_biomagnetismo","22922965j","2644664_biomagnetismo");
        if($con->errno>0)
            die ("Imposible conectar base de datos[". $con->error . "]");

        //para que funcione los acentos y la ñ
        //mysql_query("SET NAMES 'utf8'");
          $con->query("SET NAMES 'utf8'");

        //selecciona base de datos
        //mysql_select_db("biomagnetismo");
        
      //asigno a variables
            $clave1 = $_POST["clave1"];
            $clave2 = $_POST["clave2"];
            $clave3 = $_POST["clave3"];
            $clave4 = $_POST["clave4"];
            $clave5 = $_POST["clave5"];
            $zp1 = $_POST["zp1"];
            $zp2 =$_POST["zp2"];            
            
            //contatenar
            $criterio = $clave1." ".$clave2." ".$clave3." ".$clave4." ".$clave5." ".$zp1." ".$zp2;                                  
            
                      
         //debo preparar los textos que voy a buscar si la cadena existe
        if($criterio<>''){            
           // $trozos = explode($separador,$criterio);
            //$numero = count($trozos);
            $busqueda=trim($criterio);
            $busqueda = preg_replace("/ +/"," ",$busqueda);
            $trozos = explode(" ",$busqueda);
            $numero = count($trozos);
            //$numero=str_word_count($busqueda);           
                    
           
    
            if($numero == 1){
                //$busqueda = str_replace(' ', '', $criterio);
                //$busqueda=trim($criterio);
                //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCCION CON LIKE
                $cadbusca = "SELECT * FROM `pares-biomagneticos` WHERE pab_p1z LIKE '%$busqueda%' OR pab_p2z LIKE '%$busqueda%' OR pab_pac LIKE '%$busqueda%' ORDER BY pab_cod LIMIT 50 ";
        
            }elseif($numero > 1){
                //SI HAY UNA FRASE SE UTILIZA EL ALGORITMO DE BUSQUEDA AVANZADO DE MATCH AGAINST.
                //busqueda de frases con mas de una palabra y un algoritmo especializado
                
                $cadbusca = "SELECT * , MATCH (pab_pro,pab_tip,pab_po1,pab_po2,pab_p1d,pab_p2d,pab_vit,pab_pat,pab_par,pab_p1z,pab_p2z,pab_pac) AGAINST ( '$busqueda' ) AS Score FROM `pares-biomagneticos` WHERE MATCH (pab_pro,pab_tip,pab_po1,pab_po2,pab_p1d,pab_p2d,pab_vit,pab_pat,pab_par,pab_p1z,pab_p2z,pab_pac) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50";
            }              
            //$result= mysql_query($cadbusca) or die(mysql_error());
            $result = $con->query($cadbusca);
            //if (mysql_num_rows($result)==0) die ('<p>'.'La búsqueda no arrojo resultados.'.'</p>');
            if ($result->num_rows == 0) die ('<p>'.'La búsqueda no arrojo resultados.'.'</p>');
            ?>

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
    La pantalla de busqueda por campos claves&copy;. Todos los derechos reservados.
   </div>
   </div>
</body>
</html>