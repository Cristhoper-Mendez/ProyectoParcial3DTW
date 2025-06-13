self.onmessage = function(e) {
    try {
        const numbers = e.data;

        // Validación opcional
        if (!Array.isArray(numbers)) {
            throw new Error("Los datos recibidos no son un arreglo.");
        }

        // Ordenar los números
        numbers.sort((a, b) => a - b);

        // Enviar los primeros 50 números ordenados
        self.postMessage(numbers.slice(0, 50));
    } catch (error) {
        // Enviar el error al hilo principal
        self.postMessage({ error: error.message });
    }
};
