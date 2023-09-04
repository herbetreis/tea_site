<?php
// Conecte-se ao banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea_site";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    $response = array("success" => false, "message" => "Erro de conexão com o banco de dados: " . $conn->connect_error);
    echo json_encode($response);
    exit;
}

// Receba o ID do marcador a ser excluído do POST
$id_marcador = $_POST['id'];

// Execute a operação de exclusão no banco de dados
$sql = "DELETE FROM marcadores WHERE id = $id_marcador";

if ($conn->query($sql) === TRUE) {
    $response = array("success" => true, "message" => "Marcador excluído com sucesso!");
    echo json_encode($response);
} else {
    $response = array("success" => false, "message" => "Erro ao excluir o marcador: " . $conn->error);
    echo json_encode($response);
}

// Feche a conexão com o banco de dados
$conn->close();
?>
