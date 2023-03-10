// Import jQuery
import $ from 'jquery';

window.$ = $;

// Require Foundation modules
require('foundation-sites/dist/js/plugins/foundation.core.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.keyboard.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.touch.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.nest.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.box.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.triggers.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.mediaQuery.min.js');
require('foundation-sites/dist/js/plugins/foundation.util.motion.min.js');
// require('foundation-sites/dist/js/plugins/foundation.util.imageLoader.min.js');
require('foundation-sites/dist/js/plugins/foundation.reveal.min.js');
require('foundation-sites/dist/js/plugins/foundation.accordion.min.js');
require('foundation-sites/dist/js/plugins/foundation.accordionMenu.min.js');
require('foundation-sites/dist/js/plugins/foundation.tooltip.min.js');
require('foundation-sites/dist/js/plugins/foundation.offcanvas.min.js');
require('foundation-sites/dist/js/plugins/foundation.drilldown.min.js');
require('foundation-sites/dist/js/plugins/foundation.sticky.min.js');
require('foundation-sites/dist/js/plugins/foundation.tabs.min.js');
require('foundation-sites/dist/js/plugins/foundation.dropdownMenu.min.js');
require('foundation-sites/dist/js/plugins/foundation.dropdown.min.js');
require('foundation-sites/dist/js/plugins/foundation.orbit.min.js');

// Launch Foundation
$(document).foundation();

// Import custom modules
import './modules/AjaxPosts';
import './modules/SmoothScroll';
import './modules/ObjectFitIE';
import './modules/MegaMenu';
import './modules/Search';
import './modules/Animation';
import './modules/Splide';
import './modules/Newsletter';
