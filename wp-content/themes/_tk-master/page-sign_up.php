/*
Template Name: Sign Up
Template Post Type: page
*/
<?php get_header(); ?>
  <section id="signup">
    <div class="container">
	<h1 class="sign-up__title">Sign Up</h1>
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
                <h4 class="signup__subhead">Sign up for Texts</h4>
                <h3 class="section-subheading text-muted"
                    style="margin-bottom: 20px;">
You will get up to 4 messages/month. Text STOP to quit anytime or HELP for more info. Standard message rates apply.</h3>
                <iframe id="embed79515" src="//app.cityzen.io/display/?projId=2177&embedId=79515" width="100%" height="425" frameborder="0" scrolling="yes"></iframe><script type="text/javascript">(function (c, i, t, y, z, e, n, x) { x = c.createElement(y), n = c.getElementsByTagName(y)[0]; x.async = 1; x.src = t; n.parentNode.insertBefore(x, n); })(document, window, "//app.cityzen.io/Link?embedId=79515", "script");</script>

            </div>
            <div class="col-lg-6">
                <h4 class="signup__subhead">Sign up for Emails</h4>
                <h3 class="section-subheading text-muted"
                    style="margin-bottom: 20px;">You will get no more than one email a week unless you opt in to receive emails more frequently.You can unsubscribe at time.</h3>
                <iframe id="embed56565" src="//app.cityzen.io/display/?projId=2176&embedId=56565" width="100%" height="425" frameborder="0" scrolling="yes"></iframe><script type="text/javascript">(function (c, i, t, y, z, e, n, x) { x = c.createElement(y), n = c.getElementsByTagName(y)[0]; x.async = 1; x.src = t; n.parentNode.insertBefore(x, n); })(document, window, "//app.cityzen.io/Link?embedId=56565", "script");</script>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>