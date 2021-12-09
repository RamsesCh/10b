<?php
    require("../conexion.php");
    // $conexion=mysqli_connect('localhost','root','','cuestionarios');

    session_start();
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imagenes/logo.png">
    <title>RESULTADO | DEPRESIÓN</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="../css/main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
  </head>
    
  <body> 
    <?php
        require("nav_admin.php");
    ?>
<section class="home-section">
    <div class="text">
        <h3>Resultados de los alumnos en el cuestionario Depresión</h3>
    </div>
     
    <!-- Ejemplo tabla con DataTables-->
    <div class="container tablaresultado">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered tablaresultado" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre completo</th>
                                <th>Puntuación general</th>
                                <th>Tipo de Rango en Depresión</th>
                                <th>Fecha en que se realizó</th>
                                <th>Observaciones</th>
                                <th>Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                        $sql="SELECT d.Id_depresion, d.Rango, d.Rango_numerico, d.Fecha, 
                                        d.Nombre AS Obse, u.Nombre, u.Apellido_paterno, u.Apellido_materno 
                                        FROM depresion d INNER JOIN usuarios u ON d.Id_usuario = u.Id_usuario";
                                        $result=mysqli_query($mysqli,$sql);
                                        
                                        while($mostrar=mysqli_fetch_array($result)){
                                            $bgColor = "secondary";
                                            
                                            if($mostrar['Rango'] == "Minima") {
                                                $bgColor =  "success";
                                            } elseif($mostrar['Rango'] == "Leve") {
                                                $bgColor =  "primary";
                                            } elseif($mostrar['Rango'] == "Moderada") {
                                                $bgColor =  "warning";
                                            } elseif($mostrar['Rango'] == "Grave") {
                                                $bgColor =  "danger";
                                            }
                                    ?>
                            <tr>
                                <td>
                                    <?php echo $mostrar['Id_depresion']?>
                                </td>
                                <td>
                                    <?php echo $mostrar['Nombre'].' '.$mostrar['Apellido_paterno'].' '.$mostrar['Apellido_materno']?>
                                </td>
                                <td>
                                    <?php echo $mostrar['Rango_numerico']?>
                                </td>
                                <td>
                                    <?php echo "<span class='bg-".$bgColor."' style='padding: 10px; border-radius: 30px'; padding: 10px; border-radius: 30px';'>{$mostrar['Rango']}</span>";?>
                                </td>
                                <td>
                                    <?php echo $mostrar['Fecha']?>
                                </td>
                                <td>
                                    <?php echo $mostrar['Obse']?>
                                </td>
                                <td>
                                    <a href="depresionmodificar.php?Id=<?php echo $mostrar['Id_depresion']; ?>"><img src="../imagenes/modificar.png" alt="Modificar"  width="50px";></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php 
                                    }
                                ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="../js/main.js"></script>  
    
    
  </body>
</html>
