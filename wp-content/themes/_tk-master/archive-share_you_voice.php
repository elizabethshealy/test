<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="cat-title"><?php post_type_archive_title(); ?></div>

            <div class="tax-wrap">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                    get_template_part( 'include/tax-item' );
                endwhile;
                    get_template_part('include/pagination');
                endif; ?>
            </div><!-- /tax-wrap -->

        </div><!-- /col-md-12 -->
    </div><!-- /row -->
</div><!-- /container -->