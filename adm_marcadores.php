<?php
// Inicie a sessão
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['usuario_id'])) {
    // Se o usuário não estiver autenticado, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCADORES</title>
    <!-- Adicione os links para os arquivos CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="container.css">
</head>
<body>
    <br>
    <div class="row-head">
        <div class="col-12">
            <a href='./main.html' class="btn btn-primary">HOME</a>
            <a href='./cadastrar_marcadores.html' class="btn btn-primary">CADASTRAR MARCADORES</a>
            <a href='./adm_marcadores.php' class="btn btn-primary">GERENCIAR MARCADORES</a>
            <a href='./adm_marcadores.php' class="btn btn-primary">SABER MAIS</a>
            <a href='./cadastrar_marcadores.html' class="btn btn-success">LOGIN</a>
        </div>
    </div>

    <div class="container mt-5">
        <div class="container">

        <h1>MARCADORES CADASTRADOS</h1>

        <table class="table table-striped" id="marcadoresTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>LATITUDE</th>
                    <th>LONGITUDE</th>
                    <th>AÇÕES</th> <!-- Adicione uma coluna para ações (Editar/Excluir) -->
                </tr>
            </thead>
            <tbody>
                <!-- Os dados serão preenchidos aqui pelo JavaScript -->
            </tbody>
        </table>
        <br>

        <a href='./cadastrar_marcadores.html' class="btn btn-primary">CADASTRAR MARCADORES</a>
    </div>
    </div>

    <!-- Modal para editar/excluir marcador -->
    <div class="modal fade" id="editarMarcadorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Marcador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Adicione os campos de edição aqui (Nome, Descrição, Latitude, Longitude) -->
                    <form id="editForm">
                        <div class="form-group">
                            <label for="editNome">Nome:</label>
                            <input type="text" class="form-control" id="editNome">
                        </div>
                        <div class="form-group">
                            <label for="editDescricao">Descrição:</label>
                            <textarea class="form-control" id="editDescricao"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editLatitude">Latitude:</label>
                            <input type="text" class="form-control" id="editLatitude">
                        </div>
                        <div class="form-group">
                            <label for="editLongitude">Longitude:</label>
                            <input type="text" class="form-control" id="editLongitude">
                        </div>
                        <div class="form-group">
                <label for="editFotoPerfil">Foto de Perfil:</label>
                <input type="file" class="form-control-file" id="editFotoPerfil" name="editFotoPerfil">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="excluirMarcador">Excluir</button>
                    <button type="button" class="btn btn-primary" id="salvarEdicao">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclua o jQuery e os scripts do Bootstrap 5 no final do body -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclua o seu JavaScript personalizado para lidar com a edição/exclusão -->
    <script src="adm_marcadores.js"></script>
    
    <script>
        // Após a exclusão, redirecione para adm_marcadores.php
        document.getElementById("excluirMarcador").addEventListener("click", function() {
            window.location.href = "./adm_marcadores.php";
        });
    </script>
</body>
</html>
