// Este código JavaScript preencherá a tabela com os dados do PHP
document.addEventListener("DOMContentLoaded", function () {
    fetch("adm_marcadores.php")
        .then(response => response.json())
        .then(data => {
            const table = document.getElementById("marcadoresTable");

            data.forEach(marcador => {
                const row = table.insertRow(-1);
                const idCell = row.insertCell(0);
                const nomeCell = row.insertCell(1);
                const descricaoCell = row.insertCell(2);
                const latitudeCell = row.insertCell(3);
                const longitudeCell = row.insertCell(4);

                idCell.textContent = marcador.id;
                nomeCell.textContent = marcador.nome;
                descricaoCell.textContent = marcador.descricao;
                latitudeCell.textContent = marcador.latitude;
                longitudeCell.textContent = marcador.longitude;
            });
        })
        .catch(error => console.error("Erro ao buscar dados:", error));
});
