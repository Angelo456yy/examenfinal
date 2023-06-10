<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAMEN FINAL</title>
<style>
 .body{
    font-size: 20 ;

 }
    
</style>
</head>
<body>

<h2>Examen Final</h2>
    
     <?php


//  ABRIR BASE DE DATOS

        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $conexion = new PDO('mysql:host=localhost;dbname=final_0903236457', 'root', '',$pdo_options);

        if (isset($_POST["accion"])){
            // echo "Quieres " . $_POST["accion"];
            if ($_POST["accion"] == "Crear"){
                $insert = $conexion->prepare("INSERT INTO alumno(CARNET,NOMBRE,GRADO,TELEFONO) VALUES (:CARNET,:NOMBRE,:GRADO,:TELEFONO)");
                $insert->bindValue("CARNET", $_POST["CARNET"]);
                $insert->bindValue("NOMBRE", $_POST["NOMBRE"]);
                $insert->bindValue("GRADO", $_POST["GRADO"]);
                $insert->bindValue("TELEFONO", $_POST["TELEFONO"]);
                $insert->execute();
            }

                if ($_POST["accion"] == "Editado"){
                    $update = $conexion->prepare("UPDATE alumnos SET NOMBRE=:NOMBRE,GRADO=:GRADO,TELEFONO=:TELEFONO WHERE CARNET=:CARNET");
                    $update->bindValue("CARNET", $_POST["CARNET"]);
                    $update->bindValue("NOMBRE", $_POST["NOMBRE"]);
                    $update->bindValue("GRADO", $_POST["GRADO"]);
                    $update->bindValue("TELEFONO", $_POST["TELEFONO"]);
                    $update->execute();
                    header("Refresh: 0");
                }
        }

        
// ejecutamos la consulta
        $select = $conexion->query("SELECT CARNET,NOMBRE,GRADO,TELEFONO FROM alumno")
     ?>
      

     <?php  if(isset($_POST["accion"]) && $_POST["accion"] == "Editar"){ ?>
       <form method="POST">
          <input type="text" name="CARNET" value="<?php echo $_POST["CARNET"] ?>" placeholder="ingresa su carnet">
          <input type="text" name="NOMBRE" placeholder="ingresa su nombre">
          <input type="text" name="GRADO" placeholder="ingresa su grado">
          <input type="text" name="TELEFONO" placeholder="ingresa su telefono">
          <input type="hidden" name="accion" value="Editado">
          <BUTton type="submit">Guardar</BUTton> 
       </form>
    <?php  } else{ ?>
        <form method="POST">
          <input type="text" name="CARNET" placeholder="ingresa su carnet">
          <input type="text" name="NOMBRE" placeholder="ingresa su nombre">
          <input type="text" name="GRADO" placeholder="ingresa su grado">
          <input type="text" name="TELEFONO" placeholder="ingresa su telefono">
          <input type="hidden" name="accion" value="Crear">
          <BUTton type="submit">Crear</BUTton> 
       </form>
    <?php  } ?>    


     <table border="1" >
        <thead>
            <tr>
                <th>CARNET</th>
                <TH>NOMBRE</TH>
                <Th>GRADO</Th>
                <Th>TELEFONO</Th>
                <th>Acciones</th>
            </tr>
        </thead>
        <TBODY>
        <?php foreach($select->fetchAll() as $alumno) { ?>
            <tr>
                <td> <?php echo $alumno ["CARNET"] ?> </td>
                <td> <?php echo $alumno ["NOMBRE"] ?> </td>
                <td> <?php echo $alumno ["GRADO"] ?> </td>
                <td> <?php echo $alumno ["TELEFONO"] ?> </td>
                <td> <form method="POST" > 
                        <button type="submit">Editar</button>
                        <input type="hidden" name="accion" value="Editar">
                        <input type="hidden" name="CARNET" value="<?php echo  $alumno
                        ["CARNET"] ?>">
                     </form>
                </td>
            </tr>
        <?php }  ?>
        </TBODY>
     </table>

</body>
</html>