<?php
// Inclua o arquivo de configuração do banco de dados
include_once "config.php";

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupere os dados do formulário
    $nomeCompleto = $_POST["nomeCompleto"];
    $emailRegistro = $_POST["emailRegistro"];
    $senhaRegistro = $_POST["senhaRegistro"];
    $senhaConfirmacao = $_POST["senhaConfirmacao"];
    $id_do_usuario = $_SESSION["usuario_id"]; // Recupere o ID do usuário da sessão

    // Verifique se as senhas coincidem
    if ($senhaRegistro !== $senhaConfirmacao) {
        $response["success"] = false;
        $response["message"] = "As senhas não coincidem.";
        echo json_encode($response);
        exit();
    }

    // Hash da senha
    $senhaHash = password_hash($senhaRegistro, PASSWORD_DEFAULT);

    // Atualize os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome_completo = ?, email = ?, senha = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssi", $nomeCompleto, $emailRegistro, $senhaHash, $id_do_usuario);

        if ($stmt->execute()) {
            // A atualização foi bem-sucedida
            $response["success"] = true;
            $response["message"] = "Perfil do usuário atualizado com sucesso!";
        } else {
            // Erro na execução da atualização
            $response["success"] = false;
            $response["message"] = "Erro ao atualizar o perfil do usuário: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Erro na preparação da consulta SQL
        $response["success"] = false;
        $response["message"] = "Erro na preparação da consulta SQL: " . $conn->error;
    }
} else {
    // Requisição não é POST, retorne um erro
    $response["success"] = false;
    $response["message"] = "Método de requisição inválido.";
}

// Feche a conexão com o banco de dados
$conn->close();

// Retorne a resposta como JSON
header("Content-Type: application/json");
echo json_encode($response);
?>
