<!DOCTYPE html>
<?php session_start();
require_once'conexion.php';


$id= $_SESSION['user_id'];
$id_tarjeta= $_SESSION['contador'];
//echo $id_tarjeta; 


 $_SESSION['id_tar'] = $_GET['id'];

 
//  echo"<pre>";
//  var_dump($_SESSION);
//  echo "</pre>"; die();
// echo $id." ";
date_default_timezone_set('America/Mexico_City'); //Declaracion de la zona horaria
$fecha=date("Y-m-d"); //Declaración del formato de recuperación de la fecha y hora
$sql =$conn->prepare( "SELECT * FROM tarjeta WHERE idUsuario = $id");
//$sql = $conn->prepare("SELECT noSerie FROM tarjeta WHERE id = $id_tarjeta AND idUsuario = $id "); 
        $sql->execute();
$tarjeta = $sql ->fetchAll(PDO::FETCH_ASSOC);
/*echo "<pre>";
var_dump($tarjeta);
echo "</pre>";*/
// $tar = $tarjeta['noSerie'];

//  $tar= $tarjeta[0]['noSerie'];
//     $tar ;
//     echo "<pre>";
//     var_dump($tar);
//     echo "</pre>";
// // die();


?>
<html>
<head>
    <title>
    Conekta
    </title>
    <link rel="icon" href="img/logo.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
    </head>
    <body>
 <!-- FORMULARIO TARJETA  -->
<center>
    <br><br><br><br>
<h1>RECARGAR TARJETA</h1>    
    <br><br><br>            
    
<form action="cobro.php" method="POST" id="card-form">


<input class="none" type="text" name="idComprobante" value="<?=$_SESSION['id_tar'] ; ?>">
  <span class="card-errors"></span>
  <div>
    <label>
      <span>Nombre y apellidos</span>
      <input type="text" size="20" data-conekta="card[name]" name="nombreCompleto" autocomplete="off">
    </label>
  </div>
  <div>
    <label>
      <span>Número de la tarjeta</span>
      <input type="number" size="20" data-conekta="card[number]" name="numeroTarjeta">
    </label>
  </div>
  <div>
    <label>
      <span>CVC</span>
      <input type="number" size="4" data-conekta="card[cvc]" name="cvc">
    </label>
  </div>
  <div>
    <label> 
      <span>Fecha de expiración (MM/AAAA)</span>
      <div class="topo">
      <input class="minimi" type="text" size="2" data-conekta="card[exp_month]" name="monthExp">
    </label>
    <span>/</span>
    <input type="text" size="4" data-conekta="card[exp_year]" name="yearExp" class="minimi">
    </div>
      <label>
      <span>Saldo a recargar $: </span>
    <input type="number" size="20" min="3" data-conekta="card[importe]" name="importe">
    </label><br>
    <label>
      <span>Fecha y hora de la transacción:</span>
        <input type="text" value="<?php echo $fecha?>" name="fecha" readonly/>
    </label>
  </div><br><br>
  <button class="btn centrado" type="submit">RECARGAR</button><br><br>
</form>  
<a href="index.php" style="text-decoration:none;">Cancelar operación</a>
</center>
        
<!-- SCRIPT DE TOKENIZACIÓN  -->
<script type="text/javascript" >
//LLAVE PUBLICA ========================================================================================
  Conekta.setPublicKey('key_Bjus9yvTyhMVPsEwaPBeuzw');

  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Inserta el token_id en la forma para que se envíe al servidor
     $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
    $form.get(0).submit(); //Hace submit
  };
//MANEJADOR DE RESPUESTA QUE NOS DICE SI TENEMOS ALGÚN DATO MAL    
  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $form.find(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false); //DESABILITA EL BOTON SI ALGÚN DATO ESTA MAL
  };

  //jQuery para que genere el token después de dar click en submit
  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);
      // Previene hacer submit más de una vez
      $form.find("button").prop("disabled", true); //EVITA QUE SE DE CLIC 2 VECES
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    });
  });
</script>        
    </body>
</html>