<?php /* Template Name: Blog Posts */ ?>

<?php get_header(); ?>

<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
<div class="blog-posts">
    <div class="space-header"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-9 content-padder">

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <div class="entry-content">

                                <div class="image-block" style="background-image:url('<?php echo get_the_post_thumbnail_url() ?>');">
                                </div>

                                <div class="content-block" id="my-content">
                                    <div class="content">

                                        <h1 class="page-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h1>
                                        <p class="short-description"><?php echo get_the_content(); ?></p>
                                        <div class="button">
                                            <a href="<?php the_permalink(); ?>">Read More</a>
                                        </div>
                                    </div>

                                    <?php _tk_link_pages(); ?>
                                </div>


                            </div>

                        </article><!-- #post-## -->


                    <?php endwhile; ?>

                    <?php // _tk_content_nav( 'nav-below' ); ?>
                    <?php _tk_pagination(); ?>
                <?php else : ?>

                    <?php get_template_part('no-results', 'archive'); ?>

                <?php endif; ?>

            </div><!-- .content-padder -->
        </div>
    </div>
</div>

<?php get_footer(); ?>
