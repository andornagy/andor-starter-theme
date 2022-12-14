<?php
$id = get_the_ID();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php the_title(); ?></title>
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/css/theme-fonts.css'); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/css/custom.css?'); ?><?php echo filemtime(get_template_directory() . '/assets/css/custom.css'); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/assets/css/pdf.css?'); ?><?php echo filemtime(get_template_directory() . '/assets/css/pdf.css'); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/dist/main.css?'); ?><?php echo filemtime(get_template_directory() . '/dist/main.css'); ?>" type="text/css" media="all">

</head>

<body <?php body_class('pdf pdf-barrister'); ?>>
    <div class="grid-container">
        <!-- TOP BAR -->
        <header class="pdf-top grid-x grid-maring-x grid-padding-y margin-bottom-2">
            <div class="cell small-6">
                <div class="pdf-top__logo">
                    <?php echo do_shortcode('[site_logo]'); ?>
                </div>
            </div>
            <div class="cell small-6">
                <div class="pdf-top__chambers-contacts">
                    <?php echo do_shortcode('[chambers_contacts]'); ?>
                </div>
            </div>
        </header>
        <!-- INTRO -->
        <section class="pdf-intro grid-x grid-margin-x grid-padding-y margin-bottom-2">
            <div class=" cell small-6">
                <div class="pdf-intro__top">
                    <h1 class="pdf-intro__title"><?php echo get_the_title($id); ?></h1>
                </div>
            </div>
            <div class="cell small-6">
                <div class="pdf-img">
                    <?php
                    if (has_post_thumbnail($id)) {
                        echo get_the_post_thumbnail($id, 'medium');
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- PROFILE OVERVIEW -->
        <section class="grid-x grid-margin-x grid-padding-y">
            <div class="cell">
                <?php the_content(); ?>
            </div>
        </section>
    </div>
</body>

</html>
