const mapElement = document.getElementById('map');

if (mapElement) {

    const map = L.map('map').setView([5.1801, 97.1507], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    let marker;

    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');

    if (latInput.value && lngInput.value) {

        marker = L.marker([
            parseFloat(latInput.value),
            parseFloat(lngInput.value)
        ]).addTo(map);

        map.setView([
            parseFloat(latInput.value),
            parseFloat(lngInput.value)
        ], 13);
    }

    map.on('click', async function (e) {

        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        latInput.value = lat;
        lngInput.value = lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);

        try {

            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
            );

            const data = await response.json();

            document.querySelector('#lokasi').value =
                data.display_name ?? '';

        } catch (error) {
            console.error(error);
        }
    });
}