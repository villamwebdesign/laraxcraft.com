<?php if( is_active_sidebar( 'maxstore-footer-area' ) ) { ?>  				
  <div id="content-footer-section" class="row clearfix">    				
    <?php
      // Calling the header sidebar if it exists.
      dynamic_sidebar( 'maxstore-footer-area' );
    ?>  				
  </div>		
<?php } ?>         
<footer id="colophon" class="rsrc-footer" role="contentinfo">                
  <div class="row rsrc-author-credits">                    
    <p class="text-center">
			<?php printf( __( 'Theme: %1$s by %2$s', 'istore' ), '<a href="http://villamwebdesign.xyz" title="' . esc_attr__( 'Free WooCommerce WordPress Theme', 'istore' ) . '">Laraxcraft</a>', 'villamwebdesign.xyz' ); ?>
		</p>                
  </div>    
</footer>
<div id="back-top">  
  <a href="#top">
    <span></span>
  </a>
</div>
</div>
<!-- end main container -->
<?php wp_footer(); ?>
</body>
</html>