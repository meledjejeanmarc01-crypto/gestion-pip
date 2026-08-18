import Chart from 'chart.js/auto';

/**
 * Graphiques du tableau de bord + mise à jour en temps réel
 * via le canal "projets.suivi" (Laravel Echo / Reverb).
 */
document.addEventListener('DOMContentLoaded', () => {
    const couleurs = ['#0b3d2e', '#009e60', '#f77f00', '#0d6efd', '#dc3545', '#6c757d', '#fd7e14', '#20c997'];

    const graphRegions = new Chart(document.getElementById('graphRegions'), {
        type: 'bar',
        data: {
            labels: Object.keys(window.donneesGraphRegions || {}),
            datasets: [{
                label: 'Nombre de projets',
                data: Object.values(window.donneesGraphRegions || {}),
                backgroundColor: '#009e60',
            }],
        },
        options: { responsive: true, plugins: { legend: { display: false } } },
    });

    const graphSecteurs = new Chart(document.getElementById('graphSecteurs'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(window.donneesGraphSecteurs || {}),
            datasets: [{
                data: Object.values(window.donneesGraphSecteurs || {}),
                backgroundColor: couleurs,
            }],
        },
        options: { responsive: true },
    });

    // ----- Temps réel -----
    if (window.Echo) {
        window.Echo.channel('projets.suivi')
            .listen('.projet.mis-a-jour', (evenement) => {
                majKpiApresEvenement(evenement);
                majLigneProjet(evenement.projet);
            })
            .listen('.decaissement.enregistre', () => {
                // Rafraîchit discrètement les montants sans recharger la page
                fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            });
    }

    function majKpiApresEvenement(evenement) {
        if (evenement.action === 'creation') {
            const total = document.getElementById('kpi-total');
            total.textContent = parseInt(total.textContent, 10) + 1;
        }
    }

    function majLigneProjet(projet) {
        const table = document.getElementById('table-projets-recents');
        let ligne = table.querySelector(`tr[data-projet-id="${projet.id}"]`);

        if (!ligne) {
            ligne = document.createElement('tr');
            ligne.dataset.projetId = projet.id;
            table.prepend(ligne);
        }

        ligne.innerHTML = `
            <td>${projet.code}</td>
            <td>${projet.nom}</td>
            <td>${projet.region ?? '—'}</td>
            <td><span class="badge badge-statut-${projet.statut}">${projet.statut.replace('_', ' ')}</span></td>
            <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                    <div class="progress-bar" style="width: ${projet.avancement_physique}%"></div>
                </div>
            </td>`;
        ligne.classList.add('table-success');
        setTimeout(() => ligne.classList.remove('table-success'), 2500);
    }
});
