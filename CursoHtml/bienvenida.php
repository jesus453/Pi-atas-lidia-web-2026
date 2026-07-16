<?php

session_start(); 
if(isset($_SESSION["verificado"]) && $_SESSION["verificado"] == true){
    header('Location: index.html'); 
    die; 
}

if(isset($_GET["verificado"]) && $_GET["verificado"] == true){
    $_SESSION["verificado"] = true ; 
    header('Location: index.html'); 
    die; 
}

echo '<h1> Bienvenido a Piñatas Lidia </h1>' ; 
echo '<a href="index.html?verificado=true"> Iniciar sesión </a>' ; 

