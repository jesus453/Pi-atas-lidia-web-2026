<?php
if(isset($_POST)){
    if (
        empty($_POST['nombre']) ||
        empty($_POST['correo']) || 
        empty($_POST['mensaje'])
    ){
        header("Location: ../contacto.html?llena-todos-los-campos"); 
        exit(); 
    }
    else{
        //datos del formulario a enviar. 
        $info['nombre'] = $_POST['nombre']; 
        $info['correo'] = $_POST['correo'];
        if (empty($_POST['telefono'])) {
            $info['telefono'] = "No ingresó número" ; 
        } else{
            $info['telefono'] = $_POST['telefono'];
        }
        $info['mensaje'] = $_POST['mensaje'];
        $info['ip'] = $_SERVER['REMOTE_ADDR']; 
        $info['fecha'] = date('d, M, Y H:i:s');

        /*
        */
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
        

        /*
        envío real 
        */ 
        $para = "jesus.1.gonzalez@hotmail.com"; 
        $de = $para; 

        //asunto
        $asunto = "Hola, es mi primer correo - Piñatas lidia" ;

        // cabeceras que aparecen arriba del correo. 
        $headers = "From: $de\r\n"; 
        $headers .= "MIME-Version: 1.0 \r\n" ; 
        $headers .= "Content-type: text/html;charset=utf-8 \r\n" ; 

        //Mensaje del correo 
        //enviando el formulario 
        $enviar = mail($para, $asunto, $mensaje, $headers); 
        if ($enviar) {
            echo "Mensaje enviado =). " ; 
            
        }
        else{
            echo "No se ha enviado el mensaje deseado." ; 
            echo "<pre>" ; 
            var_dump($mensaje);
        }
    }
}
else{
    header("Location: ../contacto.html?error"); 
}



?> 

<br> 
<a href="../contacto.html"> Regresar </a>
