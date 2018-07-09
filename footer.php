        </div><!--#container-->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        
        <!-- Bootstrap JS -->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->
		
		<!-- submission modal -->
        <div id="myModal" class="modal fade in" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Submissions</h4>
                </div>
                <div class="modal-body">
                    <p>Online submission is not open so please mail submissions to: <a href="mailto:ijme.editorial@gmail.com">ijme.editorial@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>
		<!-- submission modal -->
		
        <div class="footer">            
            <div class="scroll-to-top" style="display: block;">
                <!--<a href="#scroll-to-top"><img src="http://ijme.in/images/theme/scroll-to-top-btn.png"></a>-->
                <a href="#scroll-to-top"><img src="<?php echo THEME_URL; ?>/images/scroll-to-top-btn.png"></a>
                <!--<script src="http://ijme.in/js/custom.js"></script>-->
            </div>
            <div class="container">
			    <div class="footer-copys">
                &copy <?php echo date('Y'); ?>. All rights reserved | Designed &amp; Developed by <a class="company-link" href="http://www.z-aksys.com" target="_blank">Z-Aksys Solutions</a> | <a class="company-link" href="http://ijme.in/index.php/ijme/pages/view/disclaimer">Disclaimer</a>	
				</div>
				
				<div class="social-links">
				<a href="https://www.facebook.com/Indian-Journal-of-Medical-Ethics-364396217255084/" target="_blank" style="padding-right:10px;"><img src="<?php echo THEME_URL; ?>/images/facebook.png"></i></a>
				<a href="https://twitter.com/indjmedethics" target="_blank"><img src="<?php echo THEME_URL; ?>/images/twitter.png"></i></a>
				</div>
            </div>
        </div>
        <?php wp_footer(); ?>
        <script>
       /*  jQuery(document).ready(function($) {
            var owl = $("#carousel");
            owl.owlCarousel({
            autoPlay : 3000, //Set AutoPlay to 3 seconds
            items : 3,
            itemsDesktop : [1500, 3],
            itemsDesktopSmall : [980, 3],
            itemsTablet : [550, 3],
            itemsMobile : [400, 2],
            itemsMobileSmall : [310, 1],
            pagination : false
            });
        
        }); */
        </script>  
    </body>
</html>