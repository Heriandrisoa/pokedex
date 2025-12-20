import Chart from 'chart.js/auto';

let nav = document.querySelector('#navbarNav-about .general');

nav.classList.add('active');
let pokename = document.querySelector('h1').textContent;

const dico = {};

// Construire le dictionnaire à partir du tableau HTML
document.querySelectorAll("tr").forEach(tr => {
    const tds = tr.querySelectorAll("td");
    if (tds.length >= 2) {
        const key = tds[0].textContent.trim();
        const value = Number(tds[1].textContent.trim()); // convertit en nombre
        dico[key] = value;
    }
});

console.log(dico);

const stat_canv = document.getElementById('stats');

// Créer le graphique Chart.js
new Chart(stat_canv, {
    type: 'radar',
    data: {
        labels: Object.keys(dico),            // les clés deviennent les labels
        datasets: [{
            label:pokename,
            data: Object.values(dico),       // les valeurs deviennent les data
            borderColor: 'rgba(54, 162, 235, 0.5)'
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
            scales: {
                r: {
                    min: 5,
                    max: 260,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
});
