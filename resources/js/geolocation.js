/**
 * Funcionalidade de Geolocalização para visitantes (Guest Location).
 * Solicita acesso ao GPS do navegador e usa a API do OpenStreetMap para 
 * converter coordenadas geográficas em nome da rua/cidade.
 */
document.addEventListener('DOMContentLoaded', () => {
    const guestLocationButton = document.querySelector('[data-guest-location]');
    const locationStatus = document.querySelector('[data-location-status]');
    const locationCookieName = 'mecdonin_localizacao';

    function getCookie(name) {
        return document.cookie
            .split('; ')
            .find((row) => row.startsWith(`${name}=`))
            ?.split('=')[1];
    }

    function setLocationStatus(message) {
        if (locationStatus) {
            locationStatus.textContent = message;
        }
    }

    function getLocationLabel(address) {
        const street = address.road
            || address.pedestrian
            || address.residential
            || address.footway
            || address.neighbourhood
            || address.suburb;

        const city = address.city
            || address.town
            || address.village
            || address.municipality
            || address.county;

        if (street && city) {
            return `${street}, ${city}`;
        }

        if (city) {
            return city;
        }

        return null;
    }

    async function getAddressFromCoordinates(latitude, longitude) {
        const params = new URLSearchParams({
            format: 'jsonv2',
            addressdetails: '1',
            lat: latitude,
            lon: longitude,
            zoom: '18',
            'accept-language': 'pt-BR',
        });

        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?${params.toString()}`);

        if (!response.ok) {
            return null;
        }

        const data = await response.json();
        return getLocationLabel(data.address || {});
    }

    if (guestLocationButton) {
        const savedLocation = getCookie(locationCookieName);

        if (savedLocation) {
            try {
                const parsedLocation = JSON.parse(decodeURIComponent(savedLocation));
                setLocationStatus(parsedLocation.label || 'Localização salva neste dispositivo');
            } catch (error) {
                setLocationStatus('Localização salva neste dispositivo');
            }
        }

        guestLocationButton.addEventListener('click', (event) => {
            event.preventDefault();

            if (!navigator.geolocation) {
                setLocationStatus('Seu navegador não suporta localização');
                return;
            }

            setLocationStatus('Solicitando permissão de localização...');

            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    const localizacao = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    setLocationStatus('Buscando rua e cidade...');

                    try {
                        localizacao.label = await getAddressFromCoordinates(localizacao.lat, localizacao.lng);
                    } catch (error) {
                        localizacao.label = null;
                    }

                    document.cookie = `${locationCookieName}=${encodeURIComponent(JSON.stringify(localizacao))}; path=/; SameSite=Lax`;
                    setLocationStatus(localizacao.label || 'Localização salva neste dispositivo');
                },
                () => {
                    setLocationStatus('Permissão negada. Informe sua localização no pedido.');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 600000,
                },
            );
        });
    }
});
