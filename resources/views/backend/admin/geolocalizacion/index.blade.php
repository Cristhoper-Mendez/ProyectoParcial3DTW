@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
@stop

<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>

<div class="container mt-4">
    <h4>Ubicacion actual del usuario</h4>
    <p><strong>Latitud:</strong> <span id="lat"></span></p>
    <p><strong>Longitud:</strong> <span id="lng"></span></p>
    <button class="btn btn-primary mb-2" onclick="getLocation()">Actualizar Ubicacion</button>
    <div id="map"></div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')
    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        let map;
        document.addEventListener('DOMContentLoaded', function() {
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(mostrarMapa, mostrarError);
            } else {
                alert('La geolocalizacion no es compatible con tu navegador.');
            }
        }

        function mostrarMapa(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            document.getElementById('lat').textContent = lat;
            document.getElementById('lng').textContent = lng;

            if (!map) {
                map = L.map('map').setView([lat, lng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
            } else {
                map.setView([lat, lng], 13)
            }

            L.marker([lat, lng]).addTo(map)
                .bindPopup("Tu ubicación actual.")
                .openPopup();
        }

        function mostrarError(error) {
            console.error('Error al obtener ubicación', error);
            let msg = '';

            switch (error.code) {
                case error.PERMISSION_DENIED:
                    msg = 'Permiso denegado para acceder a la ubicación.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg = 'La ubicación no está disponible.';
                    break;
                case error.TIMEOUT:
                    msg = 'La solicitud de ubicación ha expirado.';
                    break;
                default:
                    msg = 'Error desconocido.';
                    break;
            }

            alert(msg);
        }
    </script>
@stop
