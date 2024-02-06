var data = {};
$.ajax({
    url: '../php/fetch.php',
    type: 'post',
    data: data,
    success: function (data) {
        if (!Array.isArray(data)) {
            try {
                data = JSON.parse(data);
            } catch (e) {
                console.error('Erreur de parsing JSON:', e);
            }
        }
        console.log(data);
        if (Array.isArray(data)) {
            var ctx = document.getElementById("myChart").getContext("2d");

            // Définir les données pour le diagramme
            var data = {
                labels: data.map(function (item) { return item.ProdName; }),
                datasets: [
                    {
                        data: data.map(function (item) { return item.percentage; }),
                        backgroundColor: ["#ff6384", "#36a2eb", "#ffce56"],
                        borderColor: "#fff",
                        borderWidth: 2
                    }
                ]
            };

            // Créer le diagramme circulaire
            var myChart = new Chart(ctx, {
                type: "pie",
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: "right"
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function (
                                    previousValue,
                                    currentValue,
                                    currentIndex,
                                    array
                                ) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor((currentValue / total) * 100 + 0.5);
                                return percentage + "%";
                            }
                        }
                    }
                }
            });

        }
    }
});