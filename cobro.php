<?php
require_once("lib/Conekta.php");
require'conexion.php';	

$id_tarjeta= $_POST['idComprobante'];
$a=intval($id_tarjeta);

//var_dump($a);

$sql = $conn->prepare("SELECT noSerie FROM tarjeta WHERE id = $a "); 
$sql->execute();
$tarjeta = $sql ->fetch(PDO::FETCH_ASSOC);
$tar = $tarjeta['noSerie'];



//Recepción de variables
$nombreCompleto=$_POST['nombreCompleto'];//Recepción del nombre del usuario que hace la transacción
$nombreCompleto = strtoupper($nombreCompleto);
$importe=$_POST['importe'];//Recepcción del importe de la transacción
$fecha=$_POST['fecha']; //Recepción de la fecha
//Termina recepción de variables


//LLAVE PRIVADA
\Conekta\Conekta::setApiKey("key_kQoi5ydqoQktxy8yDykLHQ");
\Conekta\Conekta::setApiVersion("2.0.0");

$token_id=$_POST["conektaTokenId"];


try {
  $customer = \Conekta\Customer::create(
    array(   
      "name" => $nombreCompleto,
    "number" => "number",
      "email" => "fulanito@conekta.com",
     // "phone" => "+52181818181",
      "payment_sources" => array(
        array(
            "type" => "card",
            "token_id" => $token_id
        )
      )//payment_sources
    )//customer
  );
} 
catch (\Conekta\ProccessingError $error){
  echo $error->getMesage();
} catch (\Conekta\ParameterValidationError $error){
  echo $error->getMessage();
} catch (\Conekta\Handler $error){
  echo $error->getMessage();
}

// =======================================

try{
    //echo "RECARGA : ".$importe; 
    //echo "<br>";
 
  $order = \Conekta\Order::create(

  
      
    array(
      "line_items" => array(
        array(
          "name" => $nombreCompleto,
          "unit_price" => 1,
          "quantity" => 1
        )//first line_item
      ), //line_items
      "shipping_lines" => array(
        array(
          "amount" =>$importe*100, //EN CONEKTA PASAMOS NUESTRO PRECIO REAL MULTIPLICADO POR 100  ------- variable por 100
           "carrier" => "FEDEX"
        )
      ), //shipping_lines - physical goods only
      "currency" => "MXN",
      "customer_info" => array(
        "customer_id" => $customer->id
      ), //customer_info
      "shipping_contact" => array(
        "address" => array(
          "street1" => "Calle 123, int 2",
          "postal_code" => "06100",
          "country" => "MX"
        )//address
      ), //shipping_contact - required only for physical goods
      "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
      "charges" => array(
          array(
              "payment_method" => array(
                      "type" => "default"
              ) //payment_method - use customer's default - a card
                //to charge a card, different from the default,
                //you can indicate the card's source_id as shown in the Retry Card Section
          ) //first charge
      ) //charges
    
    )//order
  );
} catch (\Conekta\ProcessingError $error){
  echo $error->getMessage();
} catch (\Conekta\ParameterValidationError $error){
  echo $error->getMessage();
} catch (\Conekta\Handler $error){
  echo $error->getMessage();
}

?>

<!--Respuesta de la transacción-->

<html>
<head>
  <link rel="icon" href="img/logo.ico"/>
  <link rel="stylesheet" href="css/estilos.css"/>
</head>
  <br><br>
  <center>
    <h1>comprobante</h1>
    <table id="basofia">
      <tr>
        <td><?php echo "RECARGA : ".$importe; echo "<br>";?></td>
      </tr>
      <tr>
        <td><?php echo "ID:". $order->id;?></td>
      </tr>
      <tr>
        <td><?php echo "ESTADO DE PAGO: ". $order->payment_status;?></td>
      </tr>
      <tr>
        <td><?php echo "CODE:". $order->charges[0]->payment_method->auth_code;?></td>
      </tr>
      <tr>
        <td>
          <?php echo "Información de la tarjeta:".
          "- ". $nombreCompleto.
          "- ". $order->charges[0]->payment_method->last4 .
          "- ". $order->charges[0]->payment_method->brand .
          "- ". $order->charges[0]->payment_method->type;
          ?>  
        </td>
      </tr>
      <tr>
        <td>Fecha de la transacción: <?php echo $fecha ?></td>
      </tr>
    </table>
  </center>

<!--Termina respuesta de la transacción-->

<!--Intrucciones PHP "IMPORTANTE NO MODIFICAR"-->  
  <?php 
    session_start();//Inicio de sesión

    // $_SESSION['user_id'];//Recuperación del id de la sesión de usuario
    $id= $_SESSION['user_id'];//Asignación a la varible $id el id de la sesión en ejecución

    //Envio de datos a la tabla transacciones
    $centinela=0;
    
    $folio=$order->id;//Recuperación del folio de la transacción
    $noFolio=$folio;//Asignación a la variable $noFolio el folio recuperado de la transacción

    $estatus=$order->payment_status;//Recuperación del estado de la transacción
    $status=$estatus;//Asignación a la varible $status el estado de la transacción recuperado

    $codigo=$order->charges[0]->payment_method->auth_code;//Recuperación del codigo de la transacción
    $code=$codigo;//Asignación a la variable $code el codigo de la transacción recuperado 

    //Recuperación de datos para el campo cardInfo
    $a=$nombreCompleto;//Asignación a la variable $a el nombre del usuario que realiza la transacción
    $b=$order->charges[0]->payment_method->last4;//Recuperación de los ultimos cuatro digitos de la tarjeta de credito 
    $bb="-".$b;//Asignación a la variable $bb los ultimos cuatro digitos de la tarjeta recuperados
    $c=$order->charges[0]->payment_method->brand;//Recuperación de la compañia que habilita la transferencia (visa o otra)
    $cc="-".$c;//Asignación a la varible $cc el nombre de la compañia que habilita la transferencia(visa o otra) 
    $d=$order->charges[0]->payment_method->type;//Recuperación del tipo de tarjeta usado(credito o debito)
    $dd="-".$d;//Asignación a la variable $dd el tipo de tarjeta usado(credito o debito)  
    $suma=$a.$bb.$cc.$dd;//Asignación a la variable suma los valores de las variables antes descritas por medio de la concatenación

    $centinela++;

    //Envio de datos a la tabla tarjeta
    $a=intval($id_tarjeta);
    $sql3="UPDATE tarjeta SET saldo = saldo + '$importe', ultimaFecha='$fecha' WHERE noSerie='$id_tarjeta'";
    $result3=$conn->query($sql3);
    //Termina envio de datos a la tabla tarjeta

    //Envio de datos a la tabla basecentral
    $sql4="UPDATE basecentral SET `saldo`=`saldo` + '$importe',`ultimaFecha`= '$fecha' WHERE `noSerie`='$id_tarjeta'";
    $result4=$conn->query($sql4);
    //Termina envio de datos a la tabla basecentral

    $sql1 = "INSERT INTO `transacciones`(`noFolio`,`importe`, `status`, `code`, `cardInfo`, `fecha`, `noSerie`) VALUES('$noFolio','$importe','$status', '$code', '$suma', '$fecha','$id_tarjeta')";
    $result1=$conn->query($sql1);
    //Termina envio de datos a la tabla transacciones

    //Envio de datos a tabla intermedia usrtrans
    $sql2="INSERT INTO `usrtrans`(`idUsuario`,`noFolio`,`fecha`) VALUES ('$id','$noFolio','$fecha')";
    $result2=$conn->query($sql2);
    //Envio de datos a tabla intermedia usrtrans
    //echo $importe;
    
  ?>
  <!--Terminan instrucciones PHP-->

  <!--<pre>
    <?php //var_dump($order);?>
  </pre>-->

 </html>

<html>
  <center>

    <br><br>

    <div class="cancelar">
    <a class="cancelar-modificacion" href="index.php" >Volver al perfil</a>
    </div>

    <br><br>

    <a style="text-decoration:none; " HREF="http://localhost/An2Bus/comprobante.php" target="_blank" onclick="window.open(this.href,this.target,'width=900,height=500,top=200,left=200,toolbar=no,location=no,status=no,menubar=no');return false; location.href='comprobante.php'">Guardar en PDF</a>

    <!--<input type="button" value="Generar archivo PDF" onClick="location.href='comprobante.php'"/>-->

  </center>
</html>




