<div id="mainslider_container" style="position: relative; top: 0px; left: 0px; width: 1200px; height: 400px;">
    <!-- Slides Container -->
    <div u="slides" style="position: absolute; overflow: hidden; left: 0px; top: 0px; width: 1200px; height: 400px;">
        <div><img u="image" src="<?=BASE_URL?>img/slider/img01.jpg" /></div>
        <div><img u="image" src="<?=BASE_URL?>img/slider/img02.jpg" /></div>
        <div><img u="image" src="<?=BASE_URL?>img/slider/img01.jpg" /></div>
        <div><img u="image" src="<?=BASE_URL?>img/slider/img02.jpg" /></div>
    </div>

    <!-- Arrow Left -->
	<span u="arrowleft" class="jssora22l" style="top: 123px; left: 8px;">
	</span>
	<!-- Arrow Right -->
	<span u="arrowright" class="jssora22r" style="top: 123px; right: 8px;">
	</span>
</div>

<!--#endregion Arrow Navigator Skin End -->

        <script src="<?=BASE_URL?>/js/jquery-1.9.1.min.js"></script>
		<script src="<?=BASE_URL?>/js/jssor.slider.mini.js"></script>
		<script>
    		jQuery(document).ready(function ($) {
        		var options = { 
        			$AutoPlay: true,
        			$SlideDuration: 1000,

        			$ArrowNavigatorOptions: {
                		$Class: $JssorArrowNavigator$,
                		$ChanceToShow: 2,
                		$AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    	$Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
            		}
        		 };
        		var mainslider = new $JssorSlider$('mainslider_container', options);
        		//responsive code begin
        		//you can remove responsive code if you don't want the slider scales
        		//while window resizes
        		function ScaleSlider() {
        		    var parentWidth = $('#mainslider_container').parent().width();
        		    if (parentWidth) {
        		        mainslider.$ScaleWidth(parentWidth);
        		    }
        		    else
        		        window.setTimeout(ScaleSlider, 30);
        		}
        		//Scale slider after document ready
        		ScaleSlider();
        		                                
        		//Scale slider while window load/resize/orientationchange.
        		$(window).bind("load", ScaleSlider);
        		$(window).bind("resize", ScaleSlider);
        		$(window).bind("orientationchange", ScaleSlider);
        		//responsive code end
    		});
		</script>