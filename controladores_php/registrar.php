<?php
// ... código de conexão com o banco de dados ...
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea_site";

// Obtenha os dados do formulário de registro
$nomeCompleto = $_POST["nomeCompleto"]; // Nome Completo
$emailRegistro = $_POST["emailRegistro"]; // Endereço de Email
$senhaRegistro = $_POST["senhaRegistro"]; // Senha
$senhaConfirmacao = $_POST["senhaConfirmacao"]; // Confirmação de Senha

// Verifique se a senha e a confirmação de senha coincidem
if ($senhaRegistro !== $senhaConfirmacao) {
    // As senhas não coincidem, redirecione de volta com mensagem de erro
    header("Location: registro.php?error=senha");
    exit();
}

// Hash da senha para armazenamento seguro no banco de dados
$senhaHashed = password_hash($senhaRegistro, PASSWORD_DEFAULT);

// Verifique se o email já está em uso
$verificaEmail = "SELECT * FROM usuarios WHERE email = '$emailRegistro'";
$result = $conn->query($verificaEmail);

if ($result->num_rows > 0) {
    // O email já está em uso, redirecione de volta com mensagem de erro
    header("Location: registro.php?error=email");
    exit();
} else {
    // Insira os dados do usuário no banco de dados
    $insereUsuario = "INSERT INTO usuarios (nome_completo, email, senha) VALUES ('$nomeCompleto', '$emailRegistro', '$senhaHashed')";

    if ($conn->query($insereUsuario) === TRUE) {
        // Registro bem-sucedido, redirecione para a página de login com mensagem de sucesso
        header("Location: login.php?success=1");
        exit();
    } else {
        echo "Erro ao cadastrar o usuário: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
