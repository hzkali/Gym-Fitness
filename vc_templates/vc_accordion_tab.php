<?php
$output = $title = '';

extract(shortcode_atts(array(
	'tab_id' => '',
	'title' => __("Section", "gymbase"),
	'subtitle' => ''
), $atts));

/*$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "gymbase") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";*/

$output .= "\n\t\t\t" . '<li>';
        $output .= "\n\t\t\t\t" . '<div id="accordion-' . (empty($tab_id) ? sanitize_title($title) : esc_attr($tab_id)) . '" class="template-arrow-vertical-4-after"><h5>' . $title . '</h5>' . (isset($subtitle) && $subtitle!="" ? '<p class="gb-subtitle">' . $subtitle . '</p>' : '') . '</div>';
		$output .= "\n\t\t\t\t" . '<div class="clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "gymbase") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
        //$output .= "\n\t\t\t\t" . '</div></div>';
        $output .= "\n\t\t\t" . '</li> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;