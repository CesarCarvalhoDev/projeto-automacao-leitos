<?php

define("HOST", "127.0.0.1");
define("USER", "root");
define("PASS", "");
define("DATABASE", "uni_hospital_session");

$mysqli = new mysqli("HOST","USER","PASS","DATABASE");

if($mysqli -> connect_error){
    echo "Erro de conexao";
}

?>