import $ from 'jquery'; // Import jQuery and assign it to `$`
window.$ = window.jQuery = $; // Make jQuery available globally

import 'bootstrap'; // Import Bootstrap (required for AdminLTE)
import 'admin-lte'; // Import AdminLTE (depends on jQuery and Bootstrap)
import bootbox from 'bootbox'; // Import Bootbox (depends on jQuery)

// Import AlpineJS (if used in your project)
// import './bootstrap';
// import Alpine from 'alpinejs';

// window.Alpine = Alpine;
// Alpine.start();
