import '@jquery'
import '@bootstrap';
import '@select2';
import '@chartjs';

import Chart from '@chartjs';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Obtener datos de la API
async function fetchData(url) {
    const response = await fetch(url);
    return response.json();
}

function getRandomColor() {
    const r = Math.floor(Math.random() * 255);
    const g = Math.floor(Math.random() * 255);
    const b = Math.floor(Math.random() * 255);
    return `rgba(${r}, ${g}, ${b}, 0.2)`;
}

// Crear gráficos
async function createCharts() {
    const ventasData = await fetchData('/ventas');
    const ciudadesData = await fetchData('/ciudades');
    const metodosPagoData = await fetchData('/metodosPago');
    const pedidosData = await fetchData('/pedidos');
    const usuariosData = await fetchData('/users');

    // Procesar datos para los gráficos

    // Gráfico de Ventas
    const ventasLabels = ventasData.map(venta => venta.fecha_venta);
    const ventasValues = ventasData.map(venta => venta.valor_total);

    const ventasChartCtx = document.getElementById('ventasChart').getContext('2d');
    new Chart(ventasChartCtx, {
        type: 'line',
        data: {
            labels: ventasLabels,
            datasets: [{
                label: 'Ventas Totales',
                data: ventasValues,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Ciudades
    // Filtrar las ciudades para excluir las que tienen id 1 y 2
    const filteredCiudadesData = ciudadesData.filter(ciudad => ciudad.id !== 1 && ciudad.id !== 2);

    const ciudadesLabels = filteredCiudadesData.map(ciudad => ciudad.nombre);
    const ciudadesValues = filteredCiudadesData.map(ciudad => {
        return ventasData.filter(venta => venta.ciudad_id === ciudad.id).length;
    });


    const ciudadesChartCtx = document.getElementById('ciudadesChart').getContext('2d');
    new Chart(ciudadesChartCtx, {
        type: 'bar',
        data: {
            labels: ciudadesLabels,
            datasets: [{
                label: 'Ventas por Ciudad',
                data: ciudadesValues,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Métodos de Pago
    const metodosPagoLabels = metodosPagoData.map(metodo => metodo.nombre);
    const metodosPagoValues = metodosPagoData.map(metodo => {
        return ventasData.filter(venta => venta.metodo_pago_id === metodo.id).length;
    });

    const metodosPagoChartCtx = document.getElementById('metodosPagoChart').getContext('2d');
    new Chart(metodosPagoChartCtx, {
        type: 'pie',
        data: {
            labels: metodosPagoLabels,
            datasets: [{
                label: 'Métodos de Pago',
                data: metodosPagoValues,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Pedidos
    const pedidosDataFiltered = usuariosData.filter(usuario => usuario.rol === 'Administrador' || usuario.rol === 'Aliado');
    const estadosPedidos = ['Procesando', 'Preparando', 'Transito', 'Entregado'];
    const datasetsPedidos = estadosPedidos.map(estado => {
        const dataValues = pedidosDataFiltered.map(usuario => {
            return usuario.pedidos.filter(pedido => pedido.estado === estado).length;
        });
    
        return {
            label: `Pedidos ${estado}`,
            data: dataValues,
            backgroundColor: getRandomColor(), // función para generar colores aleatorios
            borderColor: getRandomColor(),
            borderWidth: 1
        };
    });
    const pedidosLabels = pedidosDataFiltered.map(usuario => usuario.name);
    const pedidosChart = document.getElementById('pedidosChart').getContext('2d');
    new Chart(pedidosChart, {
        type: 'bar',
        data: {
            labels: pedidosLabels,
            datasets: datasetsPedidos
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de Usuarios
    const usuariosDataFiltered = usuariosData.filter(usuario => usuario.rol === 'Administrador' || usuario.rol === 'Vendedor');

    const usuariosLabels = usuariosDataFiltered.map(usuario => usuario.name);
    const usuariosValues = usuariosDataFiltered.map(usuario => usuario.ventas.length);

    const usuariosChartCtx = document.getElementById('usuariosChart').getContext('2d');
    new Chart(usuariosChartCtx, {
        type: 'bar',
        data: {
            labels: usuariosLabels,
            datasets: [{
                label: 'Ventas por Usuario',
                data: usuariosValues,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
}

$(function() {
    createCharts();
    
    $('#ControlSelect2Cities').select2({
        placeholder: "Seleccione las ciudades en las que esta disponible",
        allowClear: true
    });

    $('#ControlSelect2Categories').select2({
        placeholder: "Seleccione las categorias a la que pertenece",
        allowClear: true
    });

    $('#customFile').on('change', function(event) {
        const selectedImage = $('#selectedAvatar');
        const fileInput = event.target;
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                selectedImage.attr('src', e.target.result);
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    });

});
