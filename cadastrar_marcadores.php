<?php
// Inclua o arquivo de configuração do banco de dados
include_once "controladores_php/config.php";

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    
    // Verifique se um arquivo de imagem foi enviado
    if (isset($_FILES["fotoPerfil"]) && $_FILES["fotoPerfil"]["error"] === UPLOAD_ERR_OK) {
        $imagem_tmp = $_FILES["fotoPerfil"]["tmp_name"];
        $imagem_nome = $_FILES["fotoPerfil"]["name"];
        
        // Defina o diretório de destino para a imagem (você precisa definir o diretório de destino)
        $diretorio_destino = "C:\xampp\htdocs\tea_site\img\perfil\\";
        $caminho_destino = $diretorio_destino . $imagem_nome;
        
        if (move_uploaded_file($imagem_tmp, $caminho_destino)) {
            // O upload da imagem foi bem-sucedido
            // Agora você pode salvar o caminho da imagem no banco de dados
        } else {
            // Erro no upload da imagem
            $response["success"] = false;
            $response["message"] = "Erro no upload da imagem.";
            echo json_encode($response);
            exit();
        }
    }
    
    // Inserir os dados do marcador no banco de dados, incluindo o caminho da imagem
    $sql = "INSERT INTO marcadores (nome, descricao, latitude, longitude, foto_perfil) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssdds", $nome, $descricao, $latitude, $longitude, $caminho_destino);
        
        if ($stmt->execute()) {
            // Inserção do marcador no banco de dados foi bem-sucedida
            $response["success"] = true;
            $response["message"] = "Marcador cadastrado com sucesso!";
        } else {
            // Erro na execução da inserção do marcador no banco de dados
            $response["success"] = false;
            $response["message"] = "Erro ao cadastrar o marcador: " . $stmt->error;
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
