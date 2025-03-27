<?php 
include("../functions/conexao.php");

function sanitizar_entradas($nome, $tipo_prof, $telefone, $email, $senha, $cpf) {
    $nome = trim($nome);
    $tipo_prof = trim($tipo_prof);
    $telefone = trim($telefone);
    $email = trim($email);
    $senha = trim($senha);
    $cpf = trim($cpf);

    $nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_prof = filter_var($tipo_prof, FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_var($telefone, FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $cpf = filter_var($cpf, FILTER_SANITIZE_NUMBER_INT);

    return [
        'nome' => $nome, 
        'tipo_prof' => $tipo_prof,
        'telefone' => $telefone,
        'email' => $email,
        'senha' => $senha,
        'cpf' => $cpf
    ];

}


function validar_dados($dados){
    $erros = [];
    if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL) || strlen($dados['email'] == 0)){
        $erros = 'Email inválido!';
    }
    if(!filter_var($dados['telefone'], FILTER_VALIDATE_INT) || strlen($dados['telefone'] == 0)){
        $erros = 'Telefone inválido';
    }
    if(!filter_var($dados['cpf'], FILTER_VALIDATE_INT) || strlen($dados['cpf']) != 11){
        $erros = 'CPF inválido!';
    }
    if(!is_string($dados['nome']) || strlen($dados['nome'] == 0)){
        $erros = 'Nome de colaborador inválido';
    }
    if(!is_string($dados['tipo_prof']) || strlen($dados['tipo_prof'] == 0)){
        $erros = 'Tipo de profissional inválido';
    }
    if(!is_string($dados['senha']) || strlen($dados['senha'])){
        $erros = 'Formato de senha inválido';
    }

}

if(isset($_POST['btn_enviar'])){
    $primeiro_nome = $_POST['txt_primeiro_nome'];
    $sobre_nome = $_POST['txt_sobre_nome'];
    $nome = $primeiro_nome + ' ' + $sobre_nome;

    $email = 
}


?>

