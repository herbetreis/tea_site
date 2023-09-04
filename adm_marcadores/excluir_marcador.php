<?php
// Conecte-se ao banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea_site";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

// Receba o ID do marcador a ser excluído do POST
$id_marcador = $_POST['id_marcador'];

// Execute a operação de exclusão no banco de dados
$sql = "DELETE FROM marcadores WHERE id = $id_marcador";

if ($conn->query($sql) === TRUE) {
    echo "Marcador excluído com sucesso!";
} else {
    echo "Erro ao excluir o marcador: " . $conn->error;
}

// Feche a conexão com o banco de dados
$conn->close();
?>
