<?php

define('WEBSITE_NAME', 'Theme Settings');
define('WEBSITE_SLUG', 'theme-name');

require_once(get_theme_file_path('/functions/_init.php'));
require_once(get_theme_file_path('/functions/foundation.php'));
require_once(get_theme_file_path('/functions/enqueue-scripts.php'));
require_once(get_theme_file_path('/functions/helpers.php'));

require_once(get_theme_file_path('/functions/acf.php'));
require_once(get_theme_file_path('/functions/login.php'));

require_once(get_theme_file_path('/functions/query.php'));
require_once(get_theme_file_path('/functions/shortcodes.php'));
require_once(get_theme_file_path('/functions/navigation.php'));
require_once(get_theme_file_path('/functions/ajax.php'));
require_once(get_theme_file_path('/functions/images.php'));
// require_once(get_theme_file_path('/functions/icons.php'));

require_once(get_theme_file_path('/functions/wordpress.php'));

