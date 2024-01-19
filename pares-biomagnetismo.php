<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
    <title>Resultados de la búsqueda</title>
    <link rel="stylesheet" media="screen" href="estilos/estilo2.css" type="text/css">
   <style>
   #principal{
            margin-top:10px;
        }      
   </style>    
</head>

<body>
   <div id="contenedor">
    <div id="cabecera">
        <p align="center"><img src="imagenes/logo.png" width=340px height=73px ></p>
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
        ini_set('display_errors', 1);
        error_reporting(-1);

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
        
        //cadena de select
        $cadbusca = "SELECT * FROM `pares-biomagneticos`";
        
        //Realizo la consulta
        //$result= mysql_query($cadbusca) or die(mysql_error());
        $result= $con->query($cadbusca);?>        

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
        ?>
        </table>
        </div>        
    </div>
   <div id="pie">
    La pantalla de listado&copy;. Todos los derechos reservados.
   </div>
   </div>
</body>
</html>