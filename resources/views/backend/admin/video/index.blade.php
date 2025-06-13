@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
@stop

<div class="container mt-4">
    <div class="card mb-5">
        <div class="card-header">
            Cámara en Vivo
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-3">
                    <video id="video" width="100%" height="auto" autoplay class="border rounded"></video>
                </div>

                <div class="col-md-6 text-center mb-3">
                    <img id="capturedImage" class="rounded border img-fluid" style="display:none; max-width: 100%; height: auto;" />
                </div>
            </div>

            <div class="text-center mt-3">
                <button id="captureBtn" class="btn btn-primary">Tomar Foto</button>
                <a id="downloadBtn" class="btn btn-success ms-2" style="display:none;" download="captura.png">Descargar Foto</a>
            </div>

            <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
        </div>
    </div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            try {
                const video = document.getElementById('video');
                const canvas = document.getElementById('canvas');
                const captureBtn = document.getElementById('captureBtn');
                const capturedImage = document.getElementById('capturedImage');
                const downloadBtn = document.getElementById('downloadBtn');

                // Intentar acceder a la cámara
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(stream => {
                        try {
                            video.srcObject = stream;
                        } catch (streamError) {
                            console.error("Error al mostrar el stream de la cámara:", streamError);
                            alert("No se pudo mostrar el video de la cámara.");
                        }
                    })
                    .catch(camError => {
                        console.error("Permiso denegado o error al acceder a la cámara:", camError);
                        alert("No se pudo acceder a la cámara. Verifica permisos del navegador.");
                    });

                // Evento para capturar imagen
                captureBtn.addEventListener('click', () => {
                    try {
                        const context = canvas.getContext('2d');
                        if (!context) throw new Error("No se pudo obtener el contexto del canvas");

                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const imageDataURL = canvas.toDataURL('image/png');
                        if (!imageDataURL) throw new Error("No se pudo generar la imagen");

                        capturedImage.src = imageDataURL;
                        capturedImage.style.display = 'block';

                        downloadBtn.href = imageDataURL;
                        downloadBtn.style.display = 'inline-block';
                    } catch (captureError) {
                        console.error("Error al capturar la imagen:", captureError);
                        alert("Hubo un problema al capturar la imagen.");
                    }
                });

            } catch (generalError) {
                console.error("Error general en la inicialización:", generalError);
                alert("Ocurrió un error inesperado al iniciar la aplicación.");
            }
        });
    </script>
@stop
