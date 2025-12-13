const loader = document.querySelector('.loader');
setTimeout(() => loader.style.display = 'none', 500);
loader.style.display = 'flex';

// ---- PANIER ----
let panier = JSON.parse(localStorage.getItem("panier")) || [];

// Sélection boutons "Ajouter"
const addButtons = document.querySelectorAll('.add-btn');

// Ajouter un article au panier
addButtons.forEach(button => {
    button.addEventListener('click', () => {
        let nom = button.dataset.name;
        let prix = parseInt(button.dataset.price);

        ajouterAuPanier(nom, prix);
        
        // Animation de confirmation
        button.textContent = '✓ Ajouté';
        button.style.background = '#28a745';
        setTimeout(() => {
            button.textContent = 'Ajouter';
            button.style.background = '';
        }, 1500);
    });
});

// Fonction d'ajout au panier
function ajouterAuPanier(nom, prix) {
    let article = panier.find(item => item.nom === nom);

    if (article) {
        article.quantite++;
    } else {
        panier.push({ nom, prix, quantite: 1 });
    }

    sauvegarder();
    afficherPanier();
}
// Affichage panier modal
function afficherPanier() {
    const panierItems = document.getElementById('panier-items');
    
    if (!panierItems) return;
    
    panierItems.innerHTML = "";

    if (panier.length === 0) {
        panierItems.innerHTML = '<li style="text-align: center; color: #6c757d; padding: 40px;">Votre panier est vide</li>';
        calculerTotal();
        return;
    }
    panier.forEach((item, index) => {
        let li = document.createElement("li");
        li.innerHTML = `
            <strong>${item.nom}</strong>
            <div class="price-info">${item.prix.toLocaleString()} FCFA l'unité</div>
            
            <div class="item-controls">
                <label style="font-weight: 600; color: #495057;">Quantité:</label>
                <input type="number" 
                       value="${item.quantite}" 
                       min="1" 
                       max="99"
                       onchange="changerQuantiteInput(${index}, this.value)"
                       onclick="this.select()">
                <button class="delete-btn" onclick="supprimer(${index})">🗑️ Supprimer</button>
            </div>
            
            <span class="item-total">Total: ${(item.prix * item.quantite).toLocaleString()} FCFA</span>
            <hr>
        `;
        panierItems.appendChild(li);
    });
    calculerTotal();
}
// Changer quantité via input
function changerQuantiteInput(index, nouvelleQuantite) {
    nouvelleQuantite = parseInt(nouvelleQuantite);
    
    if (isNaN(nouvelleQuantite) || nouvelleQuantite < 1) {
        nouvelleQuantite = 1;
    }
    
    if (nouvelleQuantite > 99) {
        nouvelleQuantite = 99;
    }

    panier[index].quantite = nouvelleQuantite;

    sauvegarder();
    afficherPanier();
}
// Supprimer un article
function supprimer(index) {
    if (confirm('Voulez-vous vraiment supprimer cet article ?')) {
        panier.splice(index, 1);
        sauvegarder();
        afficherPanier();
    }
}
// Calcul du total
function calculerTotal() {
    let total = panier.reduce((s, item) => s + (item.prix * item.quantite), 0);

    let totalElement = document.getElementById('total-panier');
    if (!totalElement) {
        totalElement = document.createElement('h3');
        totalElement.id = "total-panier";
        document.querySelector('.panier-modal').appendChild(totalElement);
    }

    totalElement.textContent = "Total: " + total.toLocaleString() + " FCFA";
}
// Sauvegarde localStorage
function sauvegarder() {
    localStorage.setItem("panier", JSON.stringify(panier));
}
// Créer l'overlay si nécessaire
function creerOverlay() {
    let overlay = document.querySelector('.panier-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'panier-overlay';
        document.body.appendChild(overlay);
        
        overlay.addEventListener('click', fermerPanier);
    }
    return overlay;
}
// Ouvrir le panier
function ouvrirPanier() {
    const panierModal = document.querySelector('.panier-modal');
    const overlay = creerOverlay();
    const panierIcon = document.getElementById('panier-icon');
    
    panierModal.classList.add('open');
    overlay.classList.add('active');
    panierIcon.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    afficherPanier();
}
// Fermer le panier
function fermerPanier() {
    const panierModal = document.querySelector('.panier-modal');
    const overlay = document.querySelector('.panier-overlay');
    const panierIcon = document.getElementById('panier-icon');
    
    panierModal.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
    panierIcon.classList.remove('active');
    document.body.style.overflow = '';
}
// Event listeners pour ouvrir/fermer le panier
const closeBtn = document.getElementById('close-btn');
if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        fermerPanier();
    });
}
const panierIconBtn = document.getElementById('panier-icon');
if (panierIconBtn) {
    panierIconBtn.addEventListener('click', (e) => {
        e.preventDefault();
        ouvrirPanier();
    });
}
// Gestion du menu actif
document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll("nav a");
    const currentPage = window.location.pathname.split("/").pop();

    navLinks.forEach(link => {
        const linkPage = link.getAttribute("href");

        // Activer automatiquement le lien correspondant à la page
        if (linkPage === currentPage || 
            (currentPage === "" && linkPage === "client.html") ||
            (currentPage === "index.html" && linkPage === "client.html")) {
            link.classList.add("active");
        }

        // Effet immédiat au clic
        link.addEventListener("click", () => {
            navLinks.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
        });
    });
});