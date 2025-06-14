<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>API Canvas - Dibujo Libre</title>
    <style>
        /* Estilos generales para centrar y mejorar la apariencia */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.8rem;
        }

        #canvas {
            border: 2px solid #444;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            cursor: crosshair;
            border-radius: 8px;
            background: white;
            display: block;
            margin-bottom: 20px;
        }

        #saveBtn {
            padding: 12px 24px;
            font-size: 1.1rem;
            font-weight: 600;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            box-shadow: 0 3px 6px rgba(0,123,255,0.4);
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        #saveBtn:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 10px rgba(0,86,179,0.6);
        }

        #saveBtn:active {
            background-color: #004494;
            box-shadow: 0 2px 4px rgba(0,68,148,0.8);
        }
    </style>
</head>
<body>

    <h2>Dibuja aquí:</h2>
    <canvas id="canvas" width="600" height="400"></canvas>
    <button id="saveBtn">Guardar imagen JPG</button>

    <script>
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        // Poner fondo blanco para evitar fondo negro al guardar JPG
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        let drawing = false;
        let lastX = 0;
        let lastY = 0;

        // Configurar estilo del trazo
        ctx.strokeStyle = 'black';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';

        // Iniciar dibujo
        canvas.addEventListener('mousedown', (e) => {
            drawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        });

        // Dibujar mientras el mouse se mueve
        canvas.addEventListener('mousemove', (e) => {
            if (!drawing) return;
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];
        });

        // Detener dibujo
        canvas.addEventListener('mouseup', () => {
            drawing = false;
        });

        canvas.addEventListener('mouseout', () => {
            drawing = false;
        });

        // Guardar canvas como imagen JPG
        document.getElementById('saveBtn').addEventListener('click', () => {
            const image = canvas.toDataURL('image/jpeg', 1.0);
            const link = document.createElement('a');
            link.href = image;
            link.download = 'mi_dibujo.jpg';
            link.click();
        });
    </script>

</body>
</html>
