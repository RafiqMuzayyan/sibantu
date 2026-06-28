const mapElement = document.getElementById('map');

if (mapElement) {

    const lat = mapElement.dataset.lat;
    const lng = mapElement.dataset.lng;

    const map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    L.marker([lat, lng]).addTo(map);
}