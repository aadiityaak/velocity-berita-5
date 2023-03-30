<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="index-wrapper">

    <div class="container-home-first container p-3 bg-dark">

        <div class="row">
            <div class="col-md">
                <?php
                // The Query
                $posts_query = new WP_Query(
                    array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 5,
                    )
                );
                // The Loop
                $nm = 1;
                if ($posts_query->have_posts()) {
                    echo '<div id="carouselHome" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                    echo '<div class="carousel-inner">';
                    while ($posts_query->have_posts()) {
                        $posts_query->the_post();
                ?>
                        <div class="slideshow-post-item carousel-item  <?php echo ($nm == 1 ? 'active' : ''); ?>">
                            <a class="d-block position-relative" href="<?php echo get_the_permalink(); ?>">

                                <div class="ratio ratio-16x9 bg-light overflow-hidden">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        echo '<img class="w-100" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy">';
                                    } else {
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                    } ?>
                                </div>

                                <div class="carousel-caption text-md-start text-center">
                                    <span class="bg-dark d-inline-block p-2" style="--bs-bg-opacity: 0.90;">
                                        <?php echo get_the_title(); ?>
                                    </span>
                                </div>

                            </a>
                        </div>
                <?php
                        $nm++;
                    }
                    $nm = 0;
                    echo '</div>';
                    echo '<div class="carousel-indicators">';
                    while ($posts_query->have_posts()) {
                        $posts_query->the_post();
                        echo '<button type="button" data-bs-target="#carouselHome" data-bs-slide-to="' . $nm . '" ' . ($nm == 0 ? 'class="active"' : '') . ' aria-current="true" aria-label="Slide ' . $nm . '"></button>';
                        $nm++;
                    }
                    echo '</div>';
                    echo '</div>';
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
            </div>
            <div class="col-md-4 ps-md-0 pt-4 pt-md-0">
                <?php get_berita_iklan('iklan_home_1'); ?>
            </div>
            <div class="col-md-12 part_carousel_home">
                <?php
                $carousel_cat = velocitytheme_option('cat_carousel_home');
                if ($carousel_cat !== 'disable') {
                    echo '<div class="part-carousel-home pt-3">';
                    module_vdposts(array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 6,
                        'cat'               => $carousel_cat,
                    ), 'carousel');
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <div class="col-md">

                <main class="site-main col order-2" id="main">

                    <?php
                    $post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                    $post1_cat      = velocitytheme_option('cat_posts_home_1');
                    ?>
                    <div class="widget part_posts_home_1">
                        <h3 class="widget-title d-flex align-items-center justify-content-between">
                            <span><?php echo $post1_title; ?></span>
                            <?php if ($post1_cat && $post1_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post1_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="part-post-home-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post1_cat,
                                        'posts_per_page' => 1,
                                    );
                                    module_vdposts($post1_args, 'posts1');
                                    ?>
                                </div>
                                <div class="col-md">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post1_cat,
                                        'posts_per_page' => 5,
                                        'offset' => 1,
                                    );
                                    module_vdposts($post1_args, 'posts2');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post2_title    = velocitytheme_option('title_posts_home_2', 'Recent Posts');
                    $post2_cat      = velocitytheme_option('cat_posts_home_2');
                    ?>
                    <div class="widget part_posts_home_2">
                        <h3 class="widget-title d-flex align-items-center justify-content-between">
                            <span><?php echo $post2_title; ?></span>
                            <?php if ($post2_cat && $post2_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post2_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="part-post-home-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post2_cat,
                                        'posts_per_page' => 1,
                                    );
                                    module_vdposts($post2_args, 'posts1');
                                    ?>
                                </div>
                                <div class="col-md">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post2_cat,
                                        'posts_per_page' => 5,
                                        'offset' => 1,
                                    );
                                    module_vdposts($post2_args, 'posts2');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="part-home-2">
                        <div class="row">
                            <div class="col-md-6">
                                <?php get_berita_iklan('iklan_home_2'); ?>

                                <?php
                                $post3_title    = velocitytheme_option('title_posts_home_3', 'Recent Posts');
                                $post3_cat      = velocitytheme_option('cat_posts_home_3');
                                ?>
                                <div class="widget part_posts_home_3 bg-color-theme p-3 shadow">
                                    <h3 class="widget-title p-0 d-flex align-items-center justify-content-between">
                                        <span><?php echo $post3_title; ?></span>
                                        <?php if ($post3_cat && $post3_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post3_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-3 mt-4">
                                        <div class="col-post-first">
                                            <?php
                                            $post3_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post3_cat,
                                                'posts_per_page' => 1,
                                            );
                                            module_vdposts($post3_args, 'homespecial');
                                            ?>
                                        </div>
                                        <div class="col-post">
                                            <?php
                                            $post3_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post3_cat,
                                                'posts_per_page' => 5,
                                                'offset' => 1,
                                            );
                                            module_vdposts($post3_args, '');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <?php
                                $post4_title    = velocitytheme_option('title_posts_home_4', 'Recent Posts');
                                $post4_cat      = velocitytheme_option('cat_posts_home_4');
                                ?>
                                <div class="widget part_posts_home_4">
                                    <h3 class="widget-title d-flex align-items-center justify-content-between">
                                        <span><?php echo $post4_title; ?></span>
                                        <?php if ($post4_cat && $post4_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post4_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-4">
                                        <div class="col-posts-first">
                                            <?php
                                            $post4_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post4_cat,
                                                'posts_per_page' => 2,
                                            );
                                            module_vdposts($post4_args, 'posts3');
                                            ?>
                                        </div>
                                        <div class="col-posts">
                                            <?php
                                            $post4_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post4_cat,
                                                'posts_per_page' => 3,
                                                'offset' => 2,
                                            );
                                            module_vdposts($post4_args, 'posts4');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $post5_title    = velocitytheme_option('title_posts_home_5', 'Recent Posts');
                                $post5_cat      = velocitytheme_option('cat_posts_home_5');
                                ?>
                                <div class="widget part_posts_home_5">
                                    <h3 class="widget-title d-flex align-items-center justify-content-between">
                                        <span><?php echo $post5_title; ?></span>
                                        <?php if ($post5_cat && $post5_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post5_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-5">
                                        <div class="col-posts">
                                            <?php
                                            $post5_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post5_cat,
                                                'posts_per_page' => 5,
                                            );
                                            module_vdposts($post5_args, 'posts5');
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                </main><!-- #main -->

            </div>

            <div class="col-md-4">
                <?php
                require_once(get_stylesheet_directory() . '/inc/part-sidebar.php');
                ?>
            </div>

        </div><!-- .row -->

        <div class="row">
            <div class="col-md-6">
                <?php get_berita_iklan('iklan_home_bawah_1'); ?>
            </div>
            <div class="col-md-6">
                <?php get_berita_iklan('iklan_home_bawah_2'); ?>
            </div>
        </div>

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
