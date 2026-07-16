<?php
if(!isset($_POST['submit'])){
    die('No autorizado'); 
}

//funcion para trabajar nuestras respuestas 
function json_output($status = 200, $msg ='ok', $data =[]){
    echo json_encode(['status' => $status, 'msg' => $msg, 'data' => '$data']); 
    die; 
}


if (empty($_POST['nombre'])){
    json_output(400, 'Ingrese un nombre válido'); 
} 


if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)){
    json_output(400, 'Ingrese un correo válido'); 
}

if (empty($_POST['telefono'])){
    json_output(400, 'Ingrese un teléfono válido'); 
}

if (empty($_POST['mensaje'])){
    json_output(400, 'Ingrese un mensaje válido'); 
}
        
//datos del formulario a enviar.  
$info['nombre'] = $_POST['nombre']; 
$info['correo'] = $_POST['correo'];
$info['telefono'] = $_POST['telefono'];
$info['mensaje'] = $_POST['mensaje'];
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['fecha'] = date('d, M, Y H:i:s');


//remitente y destinatario 
$para = $_POST['correo'];  

//debe ser un email del servidor local 
$de = $para; 
         
//asunto del mensaje 
$asunto = "nuevo mensaje - Piñatas lidia" ;

 // cabeceras que aparecen arriba del correo. 
$headers = "From: $de\r\n"; 
$headers .= "MIME-Version: 1.0 \r\n" ; 
$headers .= "Content-type: text/html;charset=utf-8 \r\n" ; 
        
//Mensaje del correo 
$mensaje =  "
        <html> 
        <body> 
        <h1> Tu mensaje ha sido enviado </h1> 
        <p><strong> Nombre: </strong> {$info['nombre']}</p>
        <p><strong> E-mail: </strong> {$info['correo']} </p> 
        <p><strong> Teléfono: </strong> {$info['telefono']} </p> 
        <p><strong> Mensaje: </strong> {$info['mensaje']} </p>
        <br> 

        <p><strong>IP </strong> {$info['ip']}</p> 
        <p><strong> fecha: </strong> {$info['fecha']} </p> 
        
        </body> 
        </html> 
        "; 
        

//Valida si se envía o no. 
$enviar = mail($para, $asunto, $mensaje, $headers); 
if (!$enviar) {
    json_output(400, "Hubo un error al enviar el mensaje. "); 
} 

json_output(200, "Mensaje enviado con éxito " , $mensaje); 

