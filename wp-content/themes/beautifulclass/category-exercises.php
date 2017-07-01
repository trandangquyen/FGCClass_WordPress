<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package beautifulclass
 */
get_header();
?>
<div id="main-contents" class="row main-contents">
    <div class="col-xs-8 ">
        <?php
        if (have_posts()):
            ?>
            <header>
                <?php 
                            the_archive_title('<h3 class="page-title"','</h3>');
                            the_archive_description();
                ?>
            </header>
            <?php
        endif;
        ?>

    </div>

    <div class="col-xs-3"><?php get_sidebar(); ?></div>
</div>



<?php
get_footer();
