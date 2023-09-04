let map;
let userMarker;
let markers = [];

function initMap() {
  const mapOptions = {
    center: { lat: 0, lng: 0 }, // Centro do mapa inicial
    zoom: 15,
    styles: [
      {
        featureType: 'administrative',
        elementType: 'labels',
        stylers: [{ visibility: 'on' }]
    },
    {
        featureType: 'poi',
        elementType: 'labels',
        stylers: [{ visibility: 'off' }]
    },
    {
        featureType: 'road',
        elementType: 'labels',
        stylers: [{ visibility: 'on' }]
    },
    {
        featureType: 'transit',
        elementType: 'labels',
        stylers: [{ visibility: 'off' }]
    },
    {
        featureType: 'water',
        elementType: 'labels',
        stylers: [{ visibility: 'off' }]
    },
    {
        featureType: 'landscape',
        elementType: 'geometry',
        stylers: [{ color: '#f5f5f5' }]
    },
    {
        featureType: 'landscape.man_made',
        elementType: 'geometry',
        stylers: [{ visibility: 'off' }]
    },
    {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [{ color: '#ffffff' }]
    },
    {
        featureType: 'road',
        elementType: 'geometry.stroke',
        stylers: [{ color: '#e5e5e5' }]
    },
    {
        featureType: 'road',
        elementType: 'labels',
        stylers: [{ visibility: 'on' }]
    },
    {
        featureType: 'road',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#333333' }]
    },
    {
        featureType: 'road.highway',
        elementType: 'geometry',
        stylers: [{ color: '#ffffff' }]
    },
    {
        featureType: 'road.highway',
        elementType: 'geometry.stroke',
        stylers: [{ color: '#e5e5e5' }]
    },
    {
        featureType: 'road.highway',
        elementType: 'labels',
        stylers: [{ visibility: 'off' }]
    },
    {
        featureType: 'road.highway',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#333333' }]
    }
    ],
  };

  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  // Obtenha a localização do usuário e crie o marcador principal
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        const userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        // Crie um marcador para a localização do usuário
        userMarker = new google.maps.Marker({
          map: map,
          title: "Sua Localização",
          position: userLocation,
        });

        map.setCenter(userLocation);
      },
      function (error) {
        console.error("Erro ao obter a localização:", error);
      }
    );
  } else {
    console.error("Geolocalização não suportada no navegador.");
  }

  // Função para buscar marcadores do banco de dados e adicioná-los ao mapa
  function fetchMarkersFromDatabase() {
    // Use AJAX para obter os dados dos marcadores do arquivo get_marcadores.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var marcadores = JSON.parse(xhr.responseText);

        // Itere sobre os dados dos marcadores e adicione-os ao mapa
        marcadores.forEach(function (marcador) {
          var marker = new google.maps.Marker({
            position: { lat: parseFloat(marcador.latitude), lng: parseFloat(marcador.longitude) },
            map: map,
            title: marcador.nome,
            icon: './img/marcador.png', // Defina a imagem personalizada como ícone do marcador
          });


          // Adicione um evento de clique ao marcador
          marker.addListener("click", function () {
            // Crie uma janela de informações personalizada
            var infoWindow = new google.maps.InfoWindow({
              content: "<h3>" + marcador.nome + "</h3><p>" + marcador.descricao + "</p>",
            });

            // Abra a janela de informações no mapa
            infoWindow.open(map, marker);
          });
















          markers.push(marker);
        });
      }
    };
    xhr.open("GET", "get_marcadores.php", true);
    xhr.send();
  }

  // Chame a função para buscar marcadores do banco de dados
  fetchMarkersFromDatabase();

  const markerForm = document.getElementById("marker-form");
  markerForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Obtenha os dados do formulário
    const name = document.getElementById("name").value;
    const description = document.getElementById("description").value;
    const position = map.getCenter();

    // Crie um novo marcador
    const marker = new google.maps.Marker({
      map: map,
      title: name,
      position: position,
    });

    // Adicione o marcador ao array de marcadores
    markers.push(marker);

    // Salve o marcador no banco de dados (você precisará implementar essa parte)
    // saveMarkerToDatabase(name, description, position);

    // Limpe o formulário
    document.getElementById("name").value = "";
    document.getElementById("description").value = "";
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initMap();
});
