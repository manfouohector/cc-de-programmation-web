// ================== INITIALISATION DES VARIABLES ==================

const tabs = document.querySelectorAll('.tab');
const forms = document.querySelectorAll('.form');
const switchToSignupLink = document.getElementById('switch-to-signup');

function switchTab(tabId) {
    tabs.forEach(t => t.classList.remove('active'));
    document.querySelector(`.tab[data-tab="${tabId}"]`).classList.add('active');
    
    forms.forEach(form => {
        form.classList.remove('active');
        if (form.id === `${tabId}-form`) {
            form.classList.add('active');
        }
    });
    
}

// Écouteurs d'événements pour les onglets
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const tabId = tab.getAttribute('data-tab');
        switchTab(tabId);
    });
});

// Lien "S'inscrire" dans le formulaire de connexion
switchToSignupLink.addEventListener('click', (e) => {
    e.preventDefault();
    switchTab('signup');
});

