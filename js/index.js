var ctx = document.getElementById("myChart").getContext("2d");

// Définir les données pour le diagramme
var data = {
    labels: ["Product1", "Product2", "Product3", "Product4"],
    datasets: [
        {
            data: [40, 30, 20, 10],
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