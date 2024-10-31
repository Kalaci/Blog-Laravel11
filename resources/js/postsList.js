import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.getElementById('addPostBtn').onclick = function() {
    window.location = this.getAttribute('data-url');
};


