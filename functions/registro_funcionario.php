<?php 
include("../functions/conexao.php");

function sanitizar_dados($id, $nome, $tipo_prof, $crm_correlato,$telefone,$email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
        $email_valido = true;
    }
    if (filter_var($telefone, FILTER_VALIDATE_INT) && strlen($telefone) >= 10 && strlen($telefone) <= 11 ){
        $telefone_valido = true;
    }
    
}


?>
