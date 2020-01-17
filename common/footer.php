<footer class="main-footer">
<!--    <strong>Copyright &copy; 2017-2018 <a href="#">MeadowAndPine</a>.</strong> All rights reserved.-->
</footer>
</div>
<!-- /.wrapper -->

<!-- Start Core Plugins
   =====================================================================-->
<!-- jQuery -->
<script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<!-- jquery-ui -->
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.simplePagination.js" type="text/javascript"></script>
<!-- lobipanel -->
<script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- Pace js -->
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">    </script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- CRMadmin frame -->
<script src="assets/dist/js/custom.js" type="text/javascript"></script>
<!-- End Core Plugins
   =====================================================================-->
<!-- Start Page Lavel Plugins
   =====================================================================-->
<!-- Counter js -->
<script src="assets/plugins/counterup/waypoints.js" type="text/javascript"></script>
<script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="assets/mdl/material.min.js" type="text/javascript"></script>
<!-- End Page Lavel Plugins
   =====================================================================-->
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/jquery.blockUI.js" type="text/javascript"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
<!-- Start Theme label Script
   =====================================================================-->
<!-- Dashboard js -->
<script type="text/javascript">
    function insertParam(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
	$(function() {
		"use strict"; // Start of use strict
		//back to top
		$('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
		$(window).on("scroll", function () {
			if ($(this).scrollTop() !== 0) {
				$('#toTop').fadeIn();
			} else {
				$('#toTop').fadeOut();
			}
		});
		$('#toTop').on("click", function () {
			$("html, body").animate({scrollTop: 0}, 600);
			return false;
		});

		//lobipanel
		$('.lobidrag').lobiPanel({
			sortable: true,
			editTitle: {
				icon: 'ti-pencil'
			},
			unpin: {
				icon: 'ti-move'
			},
			reload: {
				icon: 'ti-reload'
			},
			minimize: {
				icon: 'ti-minus',
				icon2: 'ti-plus'
			},
			close: {
				icon: 'ti-close'
			},
			expand: {
				icon: 'ti-fullscreen',
				icon2: 'ti-fullscreen'
			}
		});

		$('.lobidisable').lobiPanel({
			reload: false,
			close: false,
			editTitle: false,
			sortable: true,
			unpin: {
				icon: 'ti-move'
			},
			minimize: {
				icon: 'ti-minus',
				icon2: 'ti-plus'
			},
			expand: {
				icon: 'ti-fullscreen',
				icon2: 'ti-fullscreen'
			}
		});
		//search
		$('a[href="#search"]').on('click', function(event) {
			event.preventDefault();
			$('#search').addClass('open');
			$('#search > form > input[type="search"]').focus();
		});
		$('#search, #search button.close').on('click keyup', function(event) {
			if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
				$(this).removeClass('open');
			}
		});
		//Datepicker
		function datepic() {
			var date = $('#minMaxExample,#minMaxExample2');
			$(date).datepicker({
				language: 'en',
				minDate: new Date() // Now can select only dates, which goes after today
			});
		}
		datepic();
		//preloader
		// makes sure the whole site is loaded
		$( window ).on( "load", function() {
			// will first fade out the loading animation
			jQuery("#status").fadeOut();
			// will fade out the whole DIV that covers the website.
			jQuery("#preloader").delay(1000).fadeOut("slow");
		});

	});

</script>
<!-- End Theme label Script
   =====================================================================-->
</body>
</html>

