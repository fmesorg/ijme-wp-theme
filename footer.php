        </div><!--#container-->

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
        <div id = "paymentFooterContainer">
            <div id="paymentFooter">[Text to be changed] Click here to support US &nbsp;
               <button class="btn" onclick="showCountryModal()" >Support Us</button></>
            </div>
<!--            <div id="footerClose" onclick="hideBox()">Close</div>-->
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
                &copy <?php echo date('Y'); ?>. All rights reserved | Designed &amp; Developed by <a class="company-link" href="/about-us/fmes/overview/" target="_blank">FMES</a> | <a class="company-link" href="http://ijme.in/index.php/ijme/pages/view/disclaimer">Disclaimer</a>
				</div>
				
				<div class="social-links">
				<a href="https://www.facebook.com/Indian-Journal-of-Medical-Ethics-364396217255084/" target="_blank" style="padding-right:10px;"><img src="<?php echo THEME_URL; ?>/images/facebook.png"></i></a>
				<a href="https://twitter.com/indjmedethics" target="_blank"><img src="<?php echo THEME_URL; ?>/images/twitter.png"></i></a>
				</div>
            </div>
        </div>
        <?php wp_footer(); ?>
        <script>
        </script>  
    </body>
</html>