// Este código JavaScript preencherá a tabela com os dados do PHP e ativar o modal de edição/exclusão
document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("marcadoresTable");

    // Função para preencher a tabela com os dados
    function populateTable(data) {
        data.forEach(marcador => {
            const row = table.insertRow(-1);
            const idCell = row.insertCell(0);
            const nomeCell = row.insertCell(1);
            const descricaoCell = row.insertCell(2);
            const latitudeCell = row.insertCell(3);
            const longitudeCell = row.insertCell(4);
            const acoesCell = row.insertCell(5); // Adicione uma célula para ações (Editar/Excluir)

            idCell.textContent = marcador.id;
            nomeCell.textContent = marcador.nome;
            descricaoCell.textContent = marcador.descricao;
            latitudeCell.textContent = marcador.latitude;
            longitudeCell.textContent = marcador.longitude;

            // Adicione um botão de edição com um evento de clique para ativar o modal
            const editarButton = document.createElement("button");
            editarButton.textContent = "Editar";
            editarButton.classList.add("btn", "btn-primary");
            editarButton.addEventListener("click", function () {
                // Preencha o modal com os dados do marcador
                document.getElementById("editNome").value = marcador.nome;
                document.getElementById("editDescricao").value = marcador.descricao;
                document.getElementById("editLatitude").value = marcador.latitude;
                document.getElementById("editLongitude").value = marcador.longitude;

                // Configure o botão de exclusão para excluir este marcador
                const excluirMarcadorButton = document.getElementById("excluirMarcador");
                excluirMarcadorButton.addEventListener("click", function () {
                    // Adicione aqui a lógica para excluir o marcador (você precisará fazer uma solicitação AJAX para o servidor)
                    const marcadorId = marcador.id; // ID do marcador a ser excluído
                    // Faça uma solicitação AJAX para excluir o marcador
                    fetch("../tea_site/adm_marcadores/excluir_marcador.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded" // Altere o tipo de conteúdo para "application/x-www-form-urlencoded"
                        },
                        body: "id=" + encodeURIComponent(marcadorId) // Envie o ID como parte do corpo da solicitação
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            // Marcador excluído com sucesso, você pode atualizar a tabela ou fazer outras ações aqui
                            console.log("Marcador excluído com sucesso!");
                            // Feche o modal após a exclusão
                            const editarMarcadorModal = new bootstrap.Modal(document.getElementById("editarMarcadorModal"));
                            editarMarcadorModal.hide();
                        } else {
                            console.error("Erro ao excluir o marcador:", result.message);
                        }
                    })
                    .catch(error => console.error("Erro ao excluir o marcador:", error));
                });
                

                // Ative o modal de edição/exclusão
                const editarMarcadorModal = new bootstrap.Modal(document.getElementById("editarMarcadorModal"));
                editarMarcadorModal.show();
            });

            acoesCell.appendChild(editarButton);
        });
    }

    // Faça uma solicitação AJAX para buscar os dados dos marcadores do servidor
    fetch("conexão_adm_marcadores.php")
        .then(response => response.json())
        .then(data => {
            populateTable(data);
        })
        .catch(error => console.error("Erro ao buscar dados:", error));
});
