<?php
define('VTR_TEMPLATE_DIR_URI', get_template_directory_uri());
define('VTR_TEMPLATE_DIR', get_template_directory());
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/includes/admin/' );
require ( VTR_TEMPLATE_DIR . '/includes/admin/options-framework.php' );
require ( VTR_TEMPLATE_DIR . '/includes/core/core-function.php' );
require ( VTR_TEMPLATE_DIR . '/includes/vtr-style.php' );
require ( VTR_TEMPLATE_DIR . '/includes/feature/vtr-function.php' );
require ( VTR_TEMPLATE_DIR . '/includes/feature/vtr-custom-post.php' );
require ( VTR_TEMPLATE_DIR . '/includes/feature/vtr-custom-page.php' );
require ( VTR_TEMPLATE_DIR . '/includes/feature/vtr-custom-meta.php' );
require ( VTR_TEMPLATE_DIR . '/includes/feature/vtr-widget.php' );