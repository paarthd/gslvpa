<?php
/**
 * The template for displaying front page pages.
 *
 */
?>
<?php get_header(); ?>  
<!--Start Slider Wrapper-->
<div class="slider_wrapper">
    <div id="featured">
        <!-- First Content -->
        <div id="fragment-1" class="ui-tabs-panel" style=""> 
            <?php if (infoway_get_option('infoway_slideimage1') != '') { ?>
                <a href="<?php echo infoway_get_option('infoway_slidelink1'); ?>" >
                    <img src="<?php echo infoway_get_option('infoway_slideimage1'); ?>"  alt="Slide 1"/>
                </a>
            <?php } else { ?>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" alt=""></a> 
            <?php } ?> 
        </div>
    </div>
    <div class="slider_shadow"></div>
    <div class="infotag"> 
        <?php if (infoway_get_option('infoway_main_heading') != '') { ?>
            <?php echo stripslashes(infoway_get_option('infoway_main_heading')); ?>
        <?php } else { ?>
            <p><?php _e('Welcome.', 'infoway'); ?></p>
        <?php } ?>
    </div>
</div>
<!--End Slider wrapper-->
<div class="clear"></div>
<div class="contentbox">
    <div class="grid_16 alpha">
        <div class="feturebox">
            <div class="featurebox_inner">
                <!-- <div class="grid_5 alpha">-->
                <div class="featurebox_desc first">
                    <?php if (infoway_get_option('infoway_firsthead') != '') { ?>
                        <h2><a href="<?php echo infoway_get_option('infoway_link1'); ?>"><?php echo stripslashes(infoway_get_option('infoway_firsthead')); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="#"><?php _e('Presidents Message', 'infoway'); ?></a></h2>
                    <?php } ?>
                    <?php if (infoway_get_option('infoway_firstdesc') != '') { ?>
                        <p><?php echo stripslashes(infoway_get_option('infoway_firstdesc')); ?></p>
                    <?php } else { ?>
                        <p><?php _e('We would like to proudly welcome everyone to Gujarati Samaj of Lehigh Valley (GSLV). We would like to give thanks to every member for letting us have a fantastic Navaratri Festival 2012. We would also like to thank you for joining our organization.', 'infoway'); ?></p>
                    <?php } ?>      

                    <a href="<?php echo infoway_get_option('infoway_link1'); ?>" class="readmore"><?php _e('Read More', 'infoway'); ?>&nbsp;<span class="button-tip"></span></a></div>
                <!--   </div>-->
                <!-- <div class="grid_5">-->
                <div class="featurebox_desc second">
                    <?php if (infoway_get_option('infoway_secondhead') != '') { ?>
                        <h2><a href="<?php echo infoway_get_option('infoway_link2'); ?>"><?php echo stripslashes(infoway_get_option('infoway_secondhead')); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="<?php echo infoway_get_option('infoway_link2'); ?>"><?php _e('Volunteer Information', 'infoway'); ?></a></h2>
                    <?php } ?>
                    <?php if (infoway_get_option('infoway_seconddesc') != '') { ?>
                        <p><?php echo stripslashes(infoway_get_option('infoway_seconddesc')); ?></p>
                    <?php } else { ?>
                        <p><?php _e('The Gujarati Samaj of Lehigh Valley is seeking volunteers to help plan and manage events throughout the year. Get involved in providing service to our community. Contribute to any area of your interest. Together we can make a difference!', 'infoway'); ?></p>
                    <?php } ?>      

                    <a href="<?php echo infoway_get_option('infoway_link2'); ?>" class="readmore"><?php _e('Read More', 'infoway'); ?>&nbsp;<span class="button-tip"></span></a></div>
                <!-- </div>-->
                <!-- <div class="grid_5 omega">-->
                <div class="featurebox_desc third">
                    <?php if (infoway_get_option('infoway_thirdhead') != '') { ?>
                        <h2><a href="<?php echo infoway_get_option('infoway_link3'); ?>"><?php echo stripslashes(infoway_get_option('infoway_thirdhead')); ?></a></h2>
                    <?php } else { ?>
                        <h2><a href="<?php echo infoway_get_option('infoway_link3'); ?>"><?php _e('Lehigh Valley', 'infoway'); ?></a></h2>
                    <?php } ?>
                    <?php if (infoway_get_option('infoway_thirddesc') != '') { ?>
                        <p><?php echo stripslashes(infoway_get_option('infoway_thirddesc')); ?></p>
                    <?php } else { ?>
                        <p><?php _e('The picturesque Lehigh Valley provides rich resources for the Indian Community. Lehigh Valley is home to numerous Gujarati professionals, businesses, and students. The Gujarati Samaj is proud to be part of the LV Indian Community.', 'infoway'); ?></p>
                    <?php } ?>      

                    <a href="<?php echo infoway_get_option('infoway_link3'); ?>" class="readmore"><?php _e('Read More', 'infoway'); ?>&nbsp;<span class="button-tip"></span></a></div>
                <!--</div>-->
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="grid_8 omega">
        <div class="signinwidgetarea">
            <?php if (is_active_sidebar('home-page-right-feature-widget-area')) : ?>
                <div class="signinformbox1 widget">
                    <?php dynamic_sidebar('home-page-right-feature-widget-area'); ?>
                </div>
            </div>
        <?php else : ?>
            <div class="signinformbox1">
                <div class="signupForm">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/widgit-area.png" />
                </div>
            </div>
        </div>	
    <?php endif; ?>
</div>	D				
</div>
<div class="testimonial">
    <div class="grid_24">
        <?php if (infoway_get_option('infoway_testimonial_head') != '') { ?>
            <h2><?php echo stripslashes(infoway_get_option('infoway_testimonial_head')); ?></h2>
        <?php } else { ?>
            <h2><?php _e('Stay Tuned', 'infoway'); ?></h2>
        <?php } ?>  	
        <?php if (infoway_get_option('infoway_testimonial_desc') != '') { ?>
            <p><?php echo stripslashes(infoway_get_option('infoway_testimonial_desc')); ?></p>
        <?php } else { ?>
            <p><?php _e('Navaratri-2012, Diwali-2012, Summer Picnic-2013,... many more exciting events to come! Become a member today!', 'infoway'); ?></p> 
        <?php } ?>          
    </div>
</div>
</div>
</div>
<?php get_footer(); ?>