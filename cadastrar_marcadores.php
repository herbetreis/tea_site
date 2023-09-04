<?php
// Conecte-se ao banco de dados MySQL (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tea_site";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
} else {
    echo "Conexão com o banco de dados estabelecida com sucesso.";
}

// Obtenha os dados do formulário
$nome = $_POST["nome"]; // Nome do Marcador
$descricao = $_POST["descricao"]; // Descrição do Endereço
$latitude = $_POST["latitude"]; // Latitude
$longitude = $_POST["longitude"]; // Longitude

// Insira os dados do marcador no banco de dados
$sql = "INSERT INTO marcadores (nome, descricao, latitude, longitude) VALUES ('$nome', '$descricao', '$latitude', '$longitude')";

if ($conn->query($sql) === TRUE) {
    echo "Marcador cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar o marcador: " . $conn->error;
}

// Feche a conexão com o banco de dados
$conn->close();
?>
