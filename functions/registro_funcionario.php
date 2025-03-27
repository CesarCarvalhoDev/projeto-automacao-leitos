<?php
include("../functions/conexao.php");

function sanitizar_entradas($nome, $tipo_prof, $telefone, $email, $senha, $cpf)
{
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


function validar_dados($dados)
{
    $erros = array();
    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Email inválido!';
    }
    if (!isset($dados['telefone']) || !ctype_digit($dados['telefone']) || strlen($dados['telefone']) != 11) {
        $erros[] = 'Telefone inválido';
    }
    if (!isset($dados['cpf']) || !ctype_digit($dados['cpf']) || strlen($dados['cpf']) != 11) {
        $erros[] = 'CPF inválido!';
    }
    if (!is_string($dados['nome']) || empty($dados['nome'])) {
        $erros[] = 'Nome de colaborador inválido';
    }
    if (!is_string($dados['tipo_prof']) || empty($dados['tipo_prof'])) {
        $erros[] = 'Tipo de profissional inválido';
    }
    if (!is_string($dados['senha']) || empty($dados['senha']) || strlen($dados['senha']) < 8) {
        $erros[] = 'Formato de senha inválido! A senha deve conter pelo menos 8 caracteres.';
    }

    return $erros;
}

function InsertDados($dados)
{
    global $mysqli;
    $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare('INSERT INTO profissionais (nome, tipo_prof, telefone, cpf, email, senha) VALUES (?,?,?,?,?,?)');
    $stmt->bind_param('ssssss', $dados['nome'], $dados['tipo_prof'], $dados['telefone'], $dados['cpf'], $dados['email'], $senha_hash);
    if ($stmt->execute()) {
        return 'Sucesso ao cadastrar colaborador';
    } else {
        return 'Erro ao cadastrar colaborador: '. $stmt->error;
    }
}

if (isset($_POST['btn-submit'])) {
    $primeiro_nome = $_POST['txt-primeiro_nome'];
    $sobrenome = $_POST['txt_sobrenome'];
    $nome = $primeiro_nome . ' ' . $sobrenome;
    $tipo_prof = $_POST['txt-tipo_profissional'];
    $telefone = $_POST['txt-telefone'];
    $cpf = $_POST['txt-cpf'];
    $email = $_POST['txt-email'];
    $senha = $_POST['txt-senha'];

    $dados = sanitizar_entradas($nome, $tipo_prof, $telefone, $email, $senha, $cpf);
    $erros = validar_dados($dados);
    if (empty($erros)) {
        $status_consulta = InsertDados($dados);
    } else {
        echo implode('<br>', $erros);
    }
}
