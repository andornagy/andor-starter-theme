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
require('foundation-sites/dist/js/plugins/foundation.util.imageLoader.min.js');
require('foundation-sites/dist/js/plugins/foundation.reveal.min.js');
require('foundation-sites/dist/js/plugins/foundation.accordion.min.js');
require('foundation-sites/dist/js/plugins/foundation.accordionMenu.min.js');
require('foundation-sites/dist/js/plugins/foundation.tooltip.min.js');
require('foundation-sites/dist/js/plugins/foundation.offcanvas.min.js');
require('foundation-sites/dist/js/plugins/foundation.drilldown.min.js');
require('foundation-sites/dist/js/plugins/foundation.sticky.min.js');
require('foundation-sites/dist/js/plugins/foundation.tabs.min.js');
require('foundation-sites/dist/js/plugins/foundation.dropdownMenu.min.js');

// Launch Foundation
$(document).foundation();

// Import custom modules
import AjaxPosts from './modules/AjaxPosts';
import SmoothScroll from './modules/SmoothScroll';
import ObjectFitIE from './modules/ObjectFitIE';
import MegaMenu from './modules/MegaMenu';
import Search from './modules/Search';
import Animation from './modules/Animation';
import Splide from './modules/Splide';

// Launch custom modules
new AjaxPosts();
new SmoothScroll();
new ObjectFitIE();
new MegaMenu();
new Search();
new Animation();
new Splide();
