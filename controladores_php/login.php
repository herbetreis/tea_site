<?php
// Configuração da conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea_site";

// Crie uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário de login
    $emailLogin = $_POST["emailLogin"]; // Endereço de Email
    $senhaLogin = $_POST["senhaLogin"]; // Senha

    // Consulta SQL para verificar o login
    $verificaLogin = "SELECT * FROM usuarios WHERE email = '$emailLogin'";
    $result = $conn->query($verificaLogin);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $senhaHashed = $row["senha"];

        // Verifique se a senha corresponde à senha armazenada no banco de dados
        if (password_verify($senhaLogin, $senhaHashed)) {
            // Senha correta, o usuário está autenticado com sucesso
            session_start();
            $_SESSION["usuario_id"] = $row["id"]; // Armazene informações do usuário na sessão, se necessário
            header("Location: /tea_site/main.html"); // Redirecione para a página principal após o login bem-sucedido
            exit();
        }
    }

    // Se chegou até aqui, o login falhou, redirecione de volta com mensagem de erro
    header("Location:  login.php?error=login");
    exit();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
