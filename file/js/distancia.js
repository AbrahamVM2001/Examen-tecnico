function actualizarDistancia() {
    const distanciaInput = document.getElementById('Distancia');
    const planetaEnvio = document.getElementById('inputState').value;
    const planetaDestino = document.getElementById('inputStates').value;

    const distancias = {
        'Marte': 100000,
        'Mercurio': 115000,
        'Jupiter': 200000,
        'Nepturno': 250000,
        'Venus': 99000,
        'Saturno': 500000,
        'Urano': 620000,
        'Tierra': 0
    };

    const distanciaEntrePlanetas = Math.abs(distancias[planetaDestino] - distancias[planetaEnvio]);

    distanciaInput.value = distanciaEntrePlanetas;

    const tiempoEstimado = calcularTiempoEstimado(planetaEnvio, planetaDestino);
    const fechaEnvio = new Date(document.getElementById('fecha').value + 'T' + document.getElementById('hora').value);
    const fechaEntregaEstimada = new Date(fechaEnvio.getTime() + tiempoEstimado);

    document.getElementById('fechaentrega').valueAsDate = fechaEntregaEstimada;
    document.getElementById('horaentrega').value = fechaEntregaEstimada.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});

    document.getElementById('fechaentrega').setAttribute('disabled', true);
    document.getElementById('horaentrega').setAttribute('disabled', true);
}

function calcularTiempoEstimado(planetaEnvio, planetaDestino) {
    const tiemposEstimados = {
        'Marte': 30 * 24 * 60 * 60 * 1000,
        'Mercurio': (30 + 7) * 24 * 60 * 60 * 1000,
        'Jupiter': 2 * 30 * 24 * 60 * 60 * 1000,
        'Nepturno': (2 * 30 + 2 * 7 + 3) * 24 * 60 * 60 * 1000,
        'Venus': 3 * 7 * 24 * 60 * 60 * 1000,
        'Saturno': 5 * 30 * 24 * 60 * 60 * 1000,
        'Urano': (6 * 30 + 2 * 7) * 24 * 60 * 60 * 1000,
        'Tierra': 0
    };

    return tiemposEstimados[planetaDestino] - tiemposEstimados[planetaEnvio];
}

actualizarDistancia();