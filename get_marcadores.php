<?php
// Conecte-se ao banco de dados (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea_site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para selecionar todos os marcadores
$sql = "SELECT * FROM marcadores";
$result = $conn->query($sql);

$marcadores = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $marcadores[] = $row;
    }
}

// Feche a conexão com o banco de dados
$conn->close();

// Retorne os dados dos marcadores em formato JSON
echo json_encode($marcadores);
?>
