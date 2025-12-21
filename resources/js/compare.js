import Chart from 'chart.js/auto';

let nav = document.querySelector('#navbarNav-about .general');

nav.classList.add('active');
let pokename1 = document.querySelector('#poke1-name').textContent;
let pokename2 = document.querySelector('#poke2-name').textContent;
const poke1 = {};
const poke2 = {};

document.querySelectorAll("#poke1 tr").forEach(tr => {
    const tds = tr.querySelectorAll("td");
    if (tds.length >= 2) {
        const key = tds[0].textContent.trim();
        const value = Number(tds[1].textContent.trim()); // convertit en nombre
        poke1[key] = value;
    }
});

document.querySelectorAll("#poke2 tr").forEach(tr => {
    const tds = tr.querySelectorAll("td");
    if (tds.length >= 2) {
        const key = tds[0].textContent.trim();
        const value = Number(tds[1].textContent.trim()); // convertit en nombre
        poke2[key] = value;
    }
});

const stat_canv = document.getElementById('stats');

new Chart(stat_canv, {
    type: 'radar',
    data: {
        labels: Object.keys(poke1),            // les clés deviennent les labels
        datasets: [{
            label:pokename1,
            data: Object.values(poke1),       // les valeurs deviennent les data
            borderColor: 'rgba(116, 142, 160, 0.5)'
        },
        {
            label:pokename2,
            data: Object.values(poke2),       // les valeurs deviennent les data
            borderColor: 'rgba(255, 129, 12, 0.5)'

        }

    ]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
            scales: {
                r: {
                    min: 5,
                    max: 260,
                    ticks: {
                        stepSize: 20,
                        display:false
                    }
                }
            }
        }
});
