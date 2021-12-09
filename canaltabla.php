<?php
    require("conexion.php");
    // $conexion=mysqli_connect('localhost','root','','cuestionarios');

    session_start();
    if(@!$_SESSION['Id']) {
        header("location:index.html");
    }   
    $id =  $_SESSION['Id'];
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/logo.png">
    <script src="grafica/Chart.js"></script>
    <title>RESULTADO | CANAL</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="css/main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
  </head>
    
  <body> 
    <?php
        require("nav_alumno.html");
    ?>
<section class="home-section">
    <div class="text">
        <h3>Resultado Canal de Aprendizaje</h3>
    </div>
     
    <!-- Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered tablaresultado" style="width:100%">
                        <thead>
                            <tr>
                                <th>Canal de aprendizaje Visual</th>
                                <th>Canal de aprendizaje Auditivo</th>
                                <th>Canal de aprendizaje Kinestésico</th>
                                <th>Fecha en que se realizó</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                        $sql="SELECT * from canal_aprendizaje WHERE Id_usuario = $id";
                                        $result=mysqli_query($mysqli,$sql);
                                        
                                        while($mostrar=mysqli_fetch_array($result)){
                                            // $bgColor = "secondary";
                                            
                                            // if($mostrar['Rango'] == "Minima") {
                                            //     $bgColor =  "success";
                                            // } elseif($mostrar['Rango'] == "Leve") {
                                            //     $bgColor =  "primary";
                                            // } elseif($mostrar['Rango'] == "Moderada") {
                                            //     $bgColor =  "warning";
                                            // } elseif($mostrar['Rango'] == "Grave") {
                                            //     $bgColor =  "danger";
                                            // }
                                    ?>
                            <tr>
                                <td>
                                    <?php echo number_format($mostrar['Visual'], 2).'%'?>
                                </td>
                                <td>
                                    <?php echo number_format($mostrar['Audi'], 2).'%'?>
                                </td>
                                <td>
                                    <?php echo number_format($mostrar['Kines'], 2).'%'?>
                                </td>
                                <td>
                                    <?php echo $mostrar['Fecha']?>
                                </td>
                                <td>
                                    <?php echo $mostrar['Nombre']?>
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

    <br>

    <div style="width: 40%; margin-left: 30%;">
        <canvas id="canvas" height="450" width="600"></canvas>
    </div>

    <script>
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
        
        var barChartData = {
            labels : [
                <?php
                    $sql="SELECT * from canal_aprendizaje_";
                    $result=mysqli_query($mysqli,$sql);

                    while($mostrar=mysqli_fetch_array($result)) { 
                        ?>
                        '<?php echo $mostrar["Categoria"] ?>',
                        <?php
                    }
                ?>
            ],
            datasets : [
                {
                    fillColor : "rgba(151,187,205,0.5)",
                    strokeColor : "rgba(151,187,205,0.8)",
                    highlightFill : "rgba(151,187,205,0.75)",
                    highlightStroke : "rgba(151,187,205,1)",
                    data : 
                    <?php  
                        $sql="SELECT * from canal_aprendizaje WHERE Id_usuario = $id";
                        $result=mysqli_query($mysqli,$sql);
                    ?>
                    [<?php while($mostrar=mysqli_fetch_array($result)) {
                        ?>
                        <?php echo $mostrar["Visual"] ?>,
                        <?php echo $mostrar["Audi"] ?>,
                        <?php echo $mostrar["Kines"] ?>,
                    <?php } ?>]
                }
            ]
        }   

        window.onload = function(){
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx).Bar(barChartData, {
                responsive : true
            });
        }
	</script>
</section>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="js/main.js"></script>  
    
    
  </body>
</html>
