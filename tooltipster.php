<?php
/**
 * Plugin Name: Tooltipster
 * Plugin URI: https://wordpress.org/plugins/Tooltipster/
 * Description: Tooltipster is a free wordpress tooltip plugin.
 * Version: 1.2
 * Author: Md Rukon Shekh
 * Author URI: https://www.odesk.com/o/profiles/users/_~01e2fb69b715750273/
 * License: GPL2
 */
function Tooltipster( $atts,$content ) {
	static $tooltipID = 0;
    $attrs = shortcode_atts( array(
        'text' => 'Your Tooltip Text Here',
        'title' => 'Tooltip Title',
        'position' => 'top',
        'trigger' => 'hover',
        'animation' => 'fade',
        'speed' => 350,
        'image' => '',
        'theme' => 'tooltipster-punk'

    ), $atts );
    $tooltipID++;
    $output ='<div class="tooltipster" id="tooltipster'.$tooltipID.'" title="">';
    $output .= $content;
    $output .='</div>';
    $image = $attrs['image'];
    $title = $attrs['title'];
    if($image){
    	$tooltipContent = '<span class="tooltipster_content"><img src="'.$image.'" /> <strong><b>'.$title.'</b>'.$attrs['text'].'</strong></span>';
    }
    else{
    	$tooltipContent = '<span class="tooltipster_content"><strong><b>'.$title.'</b>'.$attrs['text'].'</strong></span>';
    }
    
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
    		jQuery("<?php echo '#tooltipster'.$tooltipID; ?>").tooltipster({
				content: jQuery('<?php echo $tooltipContent; ?>'),
				animation: '<?php echo $attrs["animation"]; ?>',
				position: '<?php echo $attrs["position"]; ?>',
				theme: '<?php echo $attrs["theme"]; ?>',
				touchDevices: false,
				trigger: '<?php echo $attrs["trigger"]; ?>',
				speed: '<?php echo $attrs["speed"]; ?>',
				contentAsHTML: true
			});
    	})
    </script>
    <?php
    return $output;
}
add_shortcode( 'tooltip','Tooltipster' );
function TooltipsterScript() {
	wp_enqueue_script( 'jquery');
	wp_enqueue_style( 'tooltipster', plugin_dir_url( __FILE__ ).'css/tooltipster.css');
	wp_enqueue_script( 'tooltipster_js', plugin_dir_url( __FILE__ ) . 'js/jquery.tooltipster.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'tooltipster_active', plugin_dir_url( __FILE__ ) . 'js/tooltipster_active.js', array('tooltipster_js'), '', true );

}

add_action( 'wp_enqueue_scripts', 'TooltipsterScript' );
?>