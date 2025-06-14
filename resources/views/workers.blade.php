@extends('backend.menus.superior')
@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
@stop

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Ordenamiento con Web Worker</h1>
        <p class="lead">
            Presiona el botón para generar 100,000 números aleatorios y ordenarlos usando un Web Worker.
        </p>
    </div>

    <div class="d-flex justify-content-center mb-4">
        <button id="btnStart" class="btn btn-primary btn-lg">
            Iniciar cálculo
        </button>
    </div>

    <div id="resultado" class="alert alert-secondary" role="alert" style="white-space: pre-wrap;"></div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')

    <script>
        document.getElementById("btnStart").addEventListener("click", () => {
            try {
                const worker = new Worker("/js/worker-sort.js");
                const numbers = Array.from({
                    length: 100000
                }, () => Math.floor(Math.random() * 100000));

                document.getElementById("resultado").innerHTML = "<em>Calculando, por favor espera...</em>";

                worker.postMessage(numbers);

                worker.onmessage = function(event) {
                    if (event.data.error) {
                        document.getElementById("resultado").className = "alert alert-danger";
                        document.getElementById("resultado").innerHTML =
                            `<strong>Error:</strong> ${event.data.error}`;
                    } else {
                        document.getElementById("resultado").className = "alert alert-success";
                        document.getElementById("resultado").innerHTML =
                            `<h5>Primeros 50 números ordenados:</h5><p>${event.data.slice(0, 50).join(", ")}</p>`;
                    }
                };

                worker.onerror = function(err) {
                    document.getElementById("resultado").className = "alert alert-danger";
                    document.getElementById("resultado").innerHTML =
                        `<strong>Error del Worker:</strong> ${err.message}`;
                };
            } catch (error) {
                document.getElementById("resultado").className = "alert alert-danger";
                document.getElementById("resultado").innerHTML = `<strong>Catch global:</strong> ${error.message}`;
            }
        });
    </script>
@stop