<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Worker Example</title>
</head>
<body>
    <h1>Ordenamiento con Web Worker</h1>
    <p>Presiona el botón para generar 100,000 números aleatorios y ordenarlos con Web Worker.</p>
    <button id="btnStart">Iniciar cálculo</button>
    <div id="resultado"></div>

    <script>
        document.getElementById("btnStart").addEventListener("click", () => {
            try {
                const worker = new Worker("/js/worker-sort.js");
                const numbers = Array.from({ length: 100000 }, () => Math.floor(Math.random() * 100000));

                worker.postMessage(numbers);

                worker.onmessage = function(event) {
                    if (event.data.error) {
                        document.getElementById("resultado").innerHTML = `<p>Error: ${event.data.error}</p>`;
                    } else {
                        document.getElementById("resultado").innerHTML =
                            `<h3>Primeros 50 números ordenados:</h3><p>${event.data.join(", ")}</p>`;
                    }
                };

                worker.onerror = function(err) {
                    document.getElementById("resultado").innerHTML = `<p>Error del Worker: ${err.message}</p>`;
                };
            } catch (error) {
                document.getElementById("resultado").innerHTML = `<p>Catch global: ${error.message}</p>`;
            }
        });
    </script>
</body>
</html>