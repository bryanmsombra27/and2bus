<?php 
$id=$_SESSION['user_id'];
//echo $id;

    include'layouts/header.php'; 

     require 'conexion.php';

      if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT * FROM usuario WHERE idUsuario = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (!empty($results)) {
          $user = $results;
        }
    }
?>

    <?php if(!empty($user)): ?>
<section class="contenedor ">
        <div class="contenedor-user">
            <div class="foto">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="informacion-user">
                <p class="nombre-user"><?=$user['nombre'];?> <?=$user['apellidoPaterno'];?> <?=$user['apellidoMaterno'];?></p>
                <p class="nombre-user"><?= $user['correoElectronico'];?></p>
            </div>
        </div>
</section>
<?php else: ?>
      <h1>Please Login or SignUp</h1>
     
      <a href="login.php">Login</a> o
      <a href="registro.php">SignUp</a>
      
    <?php endif; ?>

    <div class="sidebar" id="sidebar">
        <div class="toggle" onclick="toggle_div()"> </div>
                <h2 class="reg-card"><span>Registro</span> de tarjeta</h2>
                <form action="registrodetarjeta.php" method="POST">

                    <label for="noSerie"><span class="reg-card">Numero de serie:</span>
                        <input type="text" name="noSerie" id="noSerie" placeholder="000" minlength="14" maxlength="14" required/>
                    </label>

                    <div class="enviar">
                        <input class="btn" type="submit" value="Registrar">
                    </div>
                </form>
    </div>

    <h1>Tarjetas del Usuario</h1>

    <main>
        
        <div class="contenedor lista-tarjetas">
            <div class="color-tabla">
                <p>Número de Serie</p>
            </div>
            <div class="color-tabla">
                <p>Saldo Disponible</p>
            </div>
            <div class="color-tabla">
                <p>Última Fecha de Recarga</p>
            </div>
            <div class="color-tabla">
                <p>Recarga de Saldo</p>
            </div>
            <div class="color-tabla">
                <p>Eliminar Tarjeta</p>
            </div>
            <?php
$contador=-1;
$sql = $conn->prepare("SELECT noSerie,saldo,ultimaFecha FROM tarjeta WHERE idUsuario = $id order by idUsuario"); 
        $sql->execute();
// $tarjeta = $sql ->fetch(PDO::FETCH_ASSOC);

   
while(  $tarjeta = $sql ->fetch(PDO::FETCH_ASSOC)):
    
   
   
    $tar = $tarjeta['noSerie'];
    
    $_SESSION['contador'] = $contador;
  
    
    
  // $GLOBALS['contador'] = $contador;
   ?><div class="contendor-perfil">
<form action="formRecarga.php" method="POST" id="form-perfil">
            <div class="form">
            <?php $GLOBALS['tarjeta']['id'] = $tar;
            // echo "<pre>";
            // var_dump($GLOBALS);
            // echo "</pre>";
         //   die();
      
    ?>  
    <input type="hidden" value="<?php $_SESSION['contador'];?>" name="idtar">
    
    
         <p>  <input readonly type="text" value="<?php echo $tar;?>" name="tarjeta" class="mov"> </p>
            
          
        
          <p class="subir"></p><input readonly type="text" value="<?php echo $tarjeta['saldo'];?>" class="mov2">
          
        
            <input readonly type="text" value="<?php echo $tarjeta['ultimaFecha'];?>" class="mov3"/>
            
        
                <a href="formRecarga.php?id=<?=$tarjeta['id']; ?>" class="mov4">Recargar</a>
                <!-- <input  type="submit" value="RECARGAR"> -->
            
        
                <a href="eliminarTarjeta.php?id=<?=$tarjeta['id']; ?>" class="mov5">Eliminar</a>
            </div>            
<?php endwhile;
?>
    </form>  
    </div>
        </div>
        <br>
        <!--<a href="nuevatarjeta.php" class="enviar">REGISTRO DE TARJETAS</a>-->
    </main>

    <center>
            <?php
            require "funcion.php";
            //Recuperacion del mensaje "tarjeta perteneciente a otro usuario"
            if(isset($_SESSION['verificacion'])){
                echo $_SESSION['verificacion'];
            }
            verificacion();
            //Termina primer recuperación de mensaje

            //Recuperación del mensaje "eliminada"
            if(isset($_SESSION['delate']) && ($_SESSION['delatee'])){

                echo $_SESSION['delate']."<br><br>";
                echo $_SESSION['delatee'];
            }
            delate();
            //Termina segunda recuperación de mensaje

            //Recuperación del mensaje "tarjeta duplicada"
            if(isset($_SESSION['Dupp'])){
                echo $_SESSION['Dupp'];
            }
            Dupp();
            //Termina tercer recuperación de mensaje

            //Recuperación del mensaje "Registro exitoso"
            if(isset($_SESSION['registro'])){
                echo $_SESSION['registro'];
            }
            registro();
            //Termina cuarta recuperación de mensaje
            ?>
        </center>

<script src="js/toggle.js"></script>
<?php include 'layouts/footer.php'; ?>