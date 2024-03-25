<?php

if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) {?>
        <div id="footer-widget" class="row m-0 <?php if(!is_theme_preset_active()){ echo 'bg-blue'; } ?>">
            <div class="container">
                <div class="row pt-3 pb-3">
                    <div class="col-12">
                        <div class="navbar-brand">
                            <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                                <a href="<?php echo esc_url( home_url( '/' )); ?>">
                                    <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                                </a>
                            <?php else : ?>
                                <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if ( is_active_sidebar( 'footer-newsletter' )) : ?>
                    <div id="elp-container" class="row pt-3 pb-3">
                        <div class="col-12 col-lg-6 offset-lg-3 text-center">
                                <?php dynamic_sidebar( 'footer-newsletter' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row pt-3 pb-3">
                    <?php if ( is_active_sidebar( 'footer-1' )) : ?>
                        <div class="col20"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'footer-2' )) : ?>
                        <div class="col20"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'footer-3' )) : ?>
                        <div class="col20"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                    <?php endif; ?>
                    <div class="col20 mobile-hidden"></div>
                    <?php if ( is_active_sidebar( 'footer-4' )) : ?>
                        <div class="col20"><?php dynamic_sidebar( 'footer-4' ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php }