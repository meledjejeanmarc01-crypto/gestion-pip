import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

/**
 * Carte interactive de la Côte d'Ivoire (Leaflet + tuiles OpenStreetMap).
 * Un marqueur circulaire par région : rayon = nb de projets,
 * couleur = avancement moyen (rouge -> orange -> vert).
 * Les marqueurs se mettent à jour en direct via Laravel Echo / Reverb.
 */
document.addEventListener('DOMContentLoaded', () => {
    const carte = L.map('carte-ci').setView([7.54, -5.55], 7); // centre approx. de la Côte d'Ivoire

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; contributeurs OpenStreetMap',
        maxZoom: 12,
        minZoom: 6,
    }).addTo(carte);

    const marqueurs = {};

    function couleurAvancement(pct) {
        if (pct >= 70) return '#198754';
        if (pct >= 40) return '#f77f00';
        return '#dc3545';
    }

    function rayon(nbProjets) {
        return Math.min(10 + nbProjets * 4, 40);
    }

    function ajouterOuMajMarqueur(region) {
        const cle = region.id;
        if (marqueurs[cle]) {
            carte.removeLayer(marqueurs[cle]);
        }
        if (!region.nb_projets) return;

        const marqueur = L.circleMarker([region.lat, region.lng], {
            radius: rayon(region.nb_projets),
            fillColor: couleurAvancement(region.avancement_moyen),
            color: '#0b3d2e',
            weight: 1,
            fillOpacity: 0.75,
        }).addTo(carte);

        marqueur.bindPopup(`
            <strong>${region.nom}</strong><br>
            Projets : ${region.nb_projets}<br>
            Avancement moyen : ${region.avancement_moyen}%<br>
            Budget total : ${Number(region.budget_total).toLocaleString('fr-FR')} FCFA<br>
            ${region.en_retard > 0 ? `<span style="color:#dc3545">${region.en_retard} en retard</span>` : ''}
        `);

        marqueurs[cle] = marqueur;
    }

    (window.donneesCarteRegions || []).forEach(ajouterOuMajMarqueur);

    // ----- Temps réel : recalcule le marqueur concerné à chaque mise à jour de projet -----
    if (window.Echo) {
        window.Echo.channel('projets.suivi').listen('.projet.mis-a-jour', (evenement) => {
            const p = evenement.projet;
            if (!p.region_id || !p.latitude || !p.longitude) return;

            let region = (window.donneesCarteRegions || []).find(r => r.id === p.region_id);
            if (!region) {
                region = { id: p.region_id, nom: p.region, lat: p.latitude, lng: p.longitude, nb_projets: 0, avancement_moyen: 0, budget_total: 0, en_retard: 0 };
                window.donneesCarteRegions.push(region);
            }
            if (evenement.action === 'creation') region.nb_projets += 1;
            region.avancement_moyen = p.avancement_physique;
            if (p.statut === 'en_retard') region.en_retard += 1;

            ajouterOuMajMarqueur(region);
        });
    }
});
