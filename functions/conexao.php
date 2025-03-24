<?php

define("HOST", "127.0.0.1");
define("USER", "root");
define("PASS", "");
define("DATABASE", "uni_hospital_session");

$conn = mysqli_connect(HOST,USER,PASS,DATABASE);

if($conn -> connect_error){
    echo "Erro de conexao";
}

?>