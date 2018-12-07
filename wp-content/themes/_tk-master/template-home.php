<?php
/**
 * Template Name: HomePage
 *
 */

get_header(); ?>
<div class="masthead"
     style="background-image: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .3)), url(<?php the_field('background_header_image'); ?>);">
    <div class="container">
        <div class="intro-text">
            <div class="intro-heading"><?php the_field('intro_heading'); ?></div>

            <div class="intro-lead-in"><?php the_field('intro_subheading'); ?></div>
            <!-- <div class="intro-lead-in" style="font-size:1em;margin:0;">A project of EducationNC</div> -->


            <a class="btn btn-primary btn-xl js-scroll-trigger"
               href="<?php the_field('intro_buttons_link'); ?>"><?php the_field('intro_button'); ?></a>
        </div>
    </div>
</div>

<!-- About -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 text-center">
                <h2 class="section-heading"><?php the_field('about_heading'); ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php the_field('about_text'); ?>
                </h3>
                <div class="col-lg-2"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if (have_rows('about_timeline')): ?>
                    <ul class="timeline">
                        <?php while (have_rows('about_timeline')): the_row(); ?>
                            <li>
                                <div class="timeline-image">
                                    <i class="fa <?php the_sub_field('timeline_image'); ?> fa-3x fa-inverse"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="subheading"><?php the_sub_field('timeline_panel'); ?></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted"><?php the_sub_field('ttimeline_body'); ?></p>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- Conversations -->
<section id="conversations">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" style="color:white;"><?php the_field('conversations_title'); ?></h2>
                <h3 class="section-subheading text-muted"><?php the_field('conversations_subheading'); ?></h3>
            </div>
        </div>
        <?php $arg = array(
            'post_type' => 'conversations', /*<-- Enter name of Custom Post Type here*/
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => 3
        );
        $the_query = new WP_Query($arg);
        if ($the_query->have_posts()) : ?>
            <div class="row text-center">
                <?php while ($the_query->have_posts()) :
                $the_query->the_post();
                $do_not_duplicate = $post->ID;
                    $keyword = $post->post_title;
                    $tempURL = "http://api.publicinput.com/Api/HighlightedComments?key=ser31d0ood0jne967olxy0wwyqng9chf&set={$keyword}";
                    $json = file_get_contents($tempURL);
                    $data = json_decode($json, true);
		   $pollname = $data[0]['project']['name'];
     		   $question = get_the_content();
                ?>
<div class="col-md-4">
                 <h4 class="service-heading"><?php echo $question; ?></h4>
                    <a class="btn btn-primary btn-lg portfolio-link" data-toggle="modal"
                       href="/sign-up">Join the conversation</a>

                    <div class="feed">
                        
			<?php
                  	for ($x = 0; $x <= (count($data)-1); $x++) {
				echo "<div class='feed__quote_box'>
                                  <h4 class='feed__quote'>{$data[$x]['comment']}</h4>
                                </div>";	
			} ?>
                    </div>
                </div>
               

                <?php endwhile; ?><!-- END of Post -->
            </div>
        <?php endif;
        wp_reset_query(); ?>

    </div>
</section>

<!-- Community -->
<section class="bg-light" id="community">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 text-center">
                <h2 class="section-heading"><?php the_field('community_title'); ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php the_field('community_description'); ?>
                </h3>
            </div>
            <div class="col-lg-2"></div>
        </div>

        <?php $arg = array(
            'post_type' => 'post', /*<-- Enter name of Custom Post Type here*/
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => 6
        );
        $the_query = new WP_Query($arg);
        if ($the_query->have_posts()) : ?>
            <div class="row">
                <?php while ($the_query->have_posts()) :
                $the_query->the_post();
                $do_not_duplicate = $post->ID;
                $categories = get_the_category($post->ID);
                foreach ($categories as $category) {
                    ?>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a class="portfolio-link"
                           href="<?php the_permalink(); ?>">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" src="<?php the_post_thumbnail_url(); ?>" alt="">
                        </a>
                        <div class="portfolio-caption">
                            <h4><?php the_title(); ?></h4>
                            <p class="text-muted"><?php echo $category->cat_name; ?></p>
                        </div>
                    </div>
                <?php } ?>
                <?php endwhile; ?><!-- END of Post -->
            </div>
        <?php endif;
        wp_reset_query(); ?>

    </div>
</section>


<!-- Technology -->
<section id="tech">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 text-center">
                <h2 class="section-heading"><?php the_field('technology_title'); ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php the_field('technology_subtitle'); ?>
                </h3>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <?php if (have_rows('technology_blocks')): ?>
                    <div class="row">
                        <?php while (have_rows('technology_blocks')): the_row(); ?>
                            <div class="col-lg-4 text-center text-muted">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa  <?php the_sub_field('technology_fa-icon'); ?> fa-stack-1x fa-inverse"></i>
                      </span>
                                <p><?php the_sub_field('technology_text'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</section>

<!-- Sign Up -->
<section id="signup">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>

            <div class="col-lg-8 text-center">
                <h2 class="section-heading"><?php the_field('sign_up_tilte'); ?></h2>
                <h3 class="section-subheading text-muted" style="font-size: 22px;
            line-height: 35px;color:#868e96!important;">
                    <?php the_field('sign_up_subtitle'); ?>
                </h3>
            </div>

            <div class="col-lg-2"></div>
        </div>
	
        <div class="row">
            <div class="col-lg-6">
                <h4 class="signup__subhead"> <?php the_field('sign_up_left_form_title'); ?></h4>
                <h3 class="section-subheading text-muted"
                    style="margin-bottom: 20px;"> <?php the_field('sign_up_left_form_subtitle'); ?></h3>
                <iframe id="embed79515" src="//app.cityzen.io/display/?projId=2177&embedId=79515" width="100%" height="425" frameborder="0" scrolling="yes"></iframe><script type="text/javascript">(function (c, i, t, y, z, e, n, x) { x = c.createElement(y), n = c.getElementsByTagName(y)[0]; x.async = 1; x.src = t; n.parentNode.insertBefore(x, n); })(document, window, "//app.cityzen.io/Link?embedId=79515", "script");</script>

            </div>
            <div class="col-lg-6">
                <h4 class="signup__subhead"> <?php the_field('sign_up_right_form_title'); ?></h4>
                <h3 class="section-subheading text-muted"
                    style="margin-bottom: 20px;"> <?php the_field('sign_up_right_form_subtitle'); ?></h3>
                <iframe id="embed56565" src="//app.cityzen.io/display/?projId=2176&embedId=56565" width="100%" height="425" frameborder="0" scrolling="yes"></iframe><script type="text/javascript">(function (c, i, t, y, z, e, n, x) { x = c.createElement(y), n = c.getElementsByTagName(y)[0]; x.async = 1; x.src = t; n.parentNode.insertBefore(x, n); })(document, window, "//app.cityzen.io/Link?embedId=56565", "script");</script>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="bg-light" id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php the_field('team_title'); ?></h2>
                <h3 class="section-subheading text-muted">
                    <?php the_field('team_subtitle'); ?>
                </h3>
            </div>
        </div>
        <?php $arg = array(
            'post_type' => 'bios', 
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => 3
        );
        $the_query = new WP_Query($arg);
        if ($the_query->have_posts()) : ?>
            <div class="row">
                <?php while ($the_query->have_posts()) :
                $the_query->the_post();
                $do_not_duplicate = $post->ID; ?>
                    <div class="col-sm-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="<?php the_post_thumbnail_url(); ?>" alt="">
                            <h4><?php the_title(); ?></h4>
                            <p class="text-muted"><?php the_excerpt(); ?></p>
                            <p class="text-muted"><?php the_content(); ?></p>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif;
        wp_reset_query(); ?>
    </div>
</section>

<!-- Clients -->
<section class="py-5">
    <div class="container">
        <?php if (have_rows('partners_images')): ?>
            <div class="row">
                <?php while (have_rows('partners_images')): the_row(); ?>
                    <div class="col-md-3 col-sm-6">
                        <a href="<?php the_sub_field('partners_href'); ?>" target="_blank">
                            <img class="img-fluid d-block mx-auto" src="<?php the_sub_field('partners_img'); ?>" alt="">
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12" style="display: flex;
            justify-content: flex-end;
            margin-top: 3%;">
                <a href="#partnersModal" data-toggle="modal"> <?php the_field('partners_text'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<!-- Partners Modal -->
<div class="portfolio-modal modal fade" id="partnersModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2><?php the_field('partners_title'); ?></h2>
                            <?php if (have_rows('partners_content_paragraf')): ?>
                                <?php while (have_rows('partners_content_paragraf')): the_row(); ?>
                                    <p class="text-muted"><?php the_sub_field('partners_paragraf'); ?></p>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>