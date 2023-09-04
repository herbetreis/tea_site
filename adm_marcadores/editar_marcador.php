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

// Receba os dados do marcador do POST
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Insira os dados no banco de dados
$sql = "INSERT INTO marcadores (nome, descricao, latitude, longitude)
        VALUES ('$nome', '$descricao', '$latitude', '$longitude')";

if ($conn->query($sql) === TRUE) {
    echo "Marcador cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar o marcador: " . $conn->error;
}

// Feche a conexão com o banco de dados
$conn->close();
?>
