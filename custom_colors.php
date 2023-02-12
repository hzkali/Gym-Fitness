<?php global $theme_options; ?>
<?php if($theme_options["header_background_color"]!=""): ?>
.header-container
{
	background-color: #<?php echo $theme_options["header_background_color"]; ?>;
}
<?php endif; 
if($theme_options["body_background_color"]!=""): ?>
body
{
	background-color: #<?php echo $theme_options["body_background_color"]; ?>;
}
<?php endif; 
if($theme_options["footer_background_color"]!=""): ?>
.footer-container
{
	background-color: #<?php echo $theme_options["footer_background_color"]; ?>;
}
<?php endif;
if($theme_options["body_headers_color"]!=""): ?>
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
.woocommerce ul.cart_list li a,
.woocommerce ul.product_list_widget li a
<?php
endif;
?>
{
	color: #<?php echo $theme_options["body_headers_color"]; ?>;
}
<?php endif; 
if($theme_options["body_headers_border_color"]!=""): ?>
.box-header::after
{
	<?php if($theme_options["body_headers_border_color"]=="none"): ?>
	background: none;
	<?php else: ?>
	background: #<?php echo $theme_options["body_headers_border_color"] ?>;
	<?php endif; ?>
}
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li a.selected, 
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce-checkout .woocommerce h2
{
	<?php if($theme_options["body_headers_border_color"]=="none"): ?>
	border-bottom: none;
	<?php else: ?>
	border-bottom-color: #<?php echo $theme_options["body_headers_border_color"] ?>;
	<?php endif; ?>
}
<?php
endif;
endif; 
if($theme_options["body_text_color"]!=""): ?>
body,
p
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce p,
.woocommerce .woocommerce-error,
.woocommerce .woocommerce-info,
.woocommerce .woocommerce-message,
.woocommerce table.shop_table,
.woocommerce-cart .cart-collaterals .cart_totals table,
li.payment_method_cod label
<?php
endif;
?>
{
	color: #<?php echo $theme_options["body_text_color"]; ?>;
}
<?php endif; 
if($theme_options["body_text2_color"]!=""): ?>
.gb-subtitle,
.wpb_text_column.gb-subtitle p,
.scrolling-list li .number,
.home-box-container:nth-child(3n+1) .message,
.home-box-container.white .message,
.share-box label,
.post-footer-details li,
#comments-list .comment-details .post-footer-details li:first-child span,
.bypostauthor,
.gb-comment-form .flex-box label,
.gb-contact-form .flex-box label,
.wp-block-audio figcaption, .blocks-gallery-caption, .wp-block-embed figcaption, .wp-block-image figcaption
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce div.product .woocommerce-tabs ul.tabs li a,
.woocommerce .posted_in,
.woocommerce .woocommerce-result-count,
.woocommerce-page .woocommerce-result-count,
.woocommerce .widget_price_filter .price_slider_amount .price_label,
.woocommerce ul.products li.product .price,
.woocommerce div.product p.price,
.woocommerce #review_form_wrapper .comment-form-rating label,
.woocommerce div.product span.price,
.woocommerce .widget_top_rated_products .amount,
.woocommerce ul.products li.product .price del,
.woocommerce .widget_top_rated_products del,
.woocommerce ul.products li.product .price ins,
.woocommerce .widget_top_rated_products ins,
.woocommerce form .form-row label
<?php
endif;
?>
{
	color: #<?php echo $theme_options["body_text2_color"]; ?>;
}
<?php endif; 
if($theme_options["footer_headers_color"]!=""): ?>
.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6,
.footer h1 a, .footer h2 a, .footer h3 a, .footer h4 a, .footer h5 a, .footer h6 a
{
	color: #<?php echo $theme_options["footer_headers_color"]; ?>;
}
<?php endif; 
if($theme_options["footer_headers_border_color"]!=""): ?>
.footer .box-header::after
{
	<?php if($theme_options["footer_headers_border_color"]=="none"): ?>
	background: none;
	<?php else: ?>
	background: #<?php echo $theme_options["footer_headers_border_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["footer_text_color"]!=""): ?>
.footer-container,
.footer-container p,
.copyright-area-container,
.footer .widget .contact-data li .value
{
	color: #<?php echo $theme_options["footer_text_color"]; ?>;
}
<?php endif; 
if($theme_options["timeago_label_color"]!=""): ?>
.timeago, .trainers .value
{
	color: #<?php echo $theme_options["timeago_label_color"]; ?>;
}
<?php endif; 
if($theme_options["sentence_color"]!=""): ?>
blockquote,
blockquote p
{
	color: #<?php echo $theme_options["sentence_color"]; ?>;
}
<?php endif;
if($theme_options["sentence_author_color"]!=""): ?>
blockquote label,
blockquote p label,
.has-gutenberg-blocks .wp-block-quote cite,
.wp-block-pullquote cite
{
	color: #<?php echo $theme_options["sentence_author_color"]; ?>;
}
<?php endif;
if($theme_options["logo_first_part_text_color"]!=""): ?>
.logo-left
{
	color: #<?php echo $theme_options["logo_first_part_text_color"]; ?>;
}
<?php endif; 
if($theme_options["logo_second_part_text_color"]!=""): ?>
.logo-right
{
	color: #<?php echo $theme_options["logo_second_part_text_color"]; ?>;
}
<?php endif;
if($theme_options["body_button_color"]!="" || $theme_options["body_button_background_color"]!=""): ?>
.more,
.pagination li a.more,
.scrolling-list-control-left,
.scrolling-list-control-right,
.widget_archive li a,
.widget_tag_cloud a,
.ui-tabs-nav li a,
.tabs-navigation li a
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce ul.products li.product .button,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.altm,
.woocommerce .widget_product_search form input[type='submit'],
.woocommerce .widget_product_search form button,
.woocommerce .cart .coupon input.button,
.woocommerce .product-categories li a,
.woocommerce .woocommerce-pagination ul.page-numbers li a,
.woocommerce .woocommerce-pagination ul.page-numbers li span,
.woocommerce .woocommerce-pagination ul.page-numbers li a:focus,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce .posted_in a,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce div.product form.cart .button.single_add_to_cart_button,
.woocommerce .cart input.button,
.woocommerce #payment #place_order
<?php
endif;
?>
{
	<?php if($theme_options["body_button_color"]!=""): ?>
	color: #<?php echo $theme_options["body_button_color"]; ?>;
	<?php endif;
	if($theme_options["body_button_background_color"]!=""): ?>
	background-color: #<?php echo $theme_options["body_button_background_color"]; ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["body_button_hover_color"]!="" || $theme_options["body_button_hover_background_color"]!=""): ?>
.more:hover,
.pagination li a.more:hover,
.scrolling-list-control-left:hover,
.scrolling-list-control-right:hover,
.widget_archive li a:hover,
.widget_tag_cloud a:hover,
.ui-tabs-nav li a:hover,
.ui-tabs-nav:not(.tt_tabs_navigation) li.ui-tabs-active a,
.tabs-navigation li a:hover,
.tabs-navigation li a.selected,
.cost-calculator-box.cost-calculator-sum.white .cost-calculator-more[type="submit"]
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce .product-categories li.current-cat a,
.woocommerce .product-categories li a:hover,
.woocommerce ul.products li.product .button:hover,
.woocommerce-cart .woocommerce .wc-proceed-to-checkout a.checkout-button:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .widget_product_search form input[type='submit']:hover,
.woocommerce .widget_product_search form button:hover,
.woocommerce div.product form.cart .button.single_add_to_cart_button:hover,
.woocommerce #review_form #respond .form-submit input:hover,
.woocommerce #payment #place_order:hover,
.woocommerce .cart input.button:hover,
.woocommerce .button.wc-forward:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce .cart .coupon input.button:hover,
.woocommerce .woocommerce-pagination ul.page-numbers li a:hover,
.woocommerce .woocommerce-pagination ul.page-numbers li a.current,
.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
.woocommerce .posted_in a:hover
<?php
endif;
?>
{
	<?php if($theme_options["body_button_hover_color"]!=""): ?>
	color: #<?php echo $theme_options["body_button_hover_color"]; ?>;
	<?php endif;
	if($theme_options["body_button_hover_background_color"]!=""): ?>
	background-color: #<?php echo $theme_options["body_button_hover_background_color"]; ?>;
	<?php endif; ?>
}
<?php endif;
if($theme_options["body_button_border_color"]!=""): ?>
.more,
.scrolling-list-control-left,
.scrolling-list-control-right,
.pagination li span,
.scrolling-list li .number,
.widget_archive li a,
.widget_tag_cloud a,
.ui-tabs-nav li a,
.tabs-navigation li a
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce .product-categories li a,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce .woocommerce-pagination ul.page-numbers li a,
.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
.woocommerce .woocommerce-pagination ul.page-numbers li a:focus,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
.woocommerce .widget_price_filter .price_slider_amount .button, 
.woocommerce .widget_product_search form input[type='submit'],
.woocommerce .widget_product_search form button,
.woocommerce div.product form.cart .button.single_add_to_cart_button, 
.woocommerce #review_form #respond .form-submit input,
.woocommerce #payment #place_order, 
.woocommerce .cart input.button,
.woocommerce .button.wc-forward,
.woocommerce .posted_in a,
.woocommerce #respond input#submit,
.woocommerce a.button, .woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.altm,
.woocommerce .cart .coupon input.button
<?php
endif;
?>
{
	border-color: #<?php echo $theme_options["body_button_border_color"]; ?>;
}
<?php endif;
if($theme_options["body_button_border_hover_color"]!=""):?>
.more:hover,
body .scrolling-list-control-left:hover,
body .scrolling-list-control-right:hover,
.widget_archive li a:hover,
.widget_tag_cloud a:hover,
.scrolling-list li a:hover .number,
.pagination li a:hover,
.pagination li.selected a,
.pagination li.selected span,
.ui-tabs-nav li a:hover,
.ui-tabs-nav li.ui-tabs-active a,
.tabs-navigation li a:hover,
.tabs-navigation li a.selected,
.cost-calculator-box.cost-calculator-sum.white .cost-calculator-more[type="submit"]
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce .product-categories li.current-cat a,
.woocommerce .product-categories li a:hover
.woocommerce ul.products li.product .button:hover,
.woocommerce-cart .woocommerce .wc-proceed-to-checkout a.checkout-button:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .widget_product_search form input[type='submit']:hover,
.woocommerce .widget_product_search form button:hover,
.woocommerce div.product form.cart .button.single_add_to_cart_button:hover,
.woocommerce #review_form #respond .form-submit input:hover,
.woocommerce #payment #place_order:hover,
.woocommerce .cart input.button:hover,
.woocommerce .button.wc-forward:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce .cart .coupon input.button:hover,
.woocommerce .woocommerce-pagination ul.page-numbers li a:hover,
.woocommerce .woocommerce-pagination ul.page-numbers li a.current,
.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
.woocommerce .posted_in a:hover
<?php
endif;
?>
{
	border-color: #<?php echo $theme_options["body_button_border_hover_color"]; ?>;
}
<?php endif;
if($theme_options["footer_button_color"]!="" || $theme_options["footer_button_background_color"]!=""): ?>
.footer .more,
.footer .pagination li a.more,
.footer .scrolling-list-control-left,
.footer .scrolling-list-control-right,
.footer .widget_archive li a,
.footer .widget_tag_cloud a,
.footer .ui-tabs-nav li a,
.footer .tabs-navigation li a
{
	<?php if($theme_options["footer_button_color"]!=""): ?>
	color: #<?php echo $theme_options["footer_button_color"]; ?>;
	<?php endif;
	if($theme_options["footer_button_background_color"]!=""): ?>
	background-color: #<?php echo $theme_options["footer_button_background_color"]; ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["footer_button_hover_color"]!="" || $theme_options["footer_button_hover_background_color"]!=""): ?>
.footer .more:hover,
.footer .pagination li a.more:hover,
.footer .scrolling-list-control-left:hover,
.footer .scrolling-list-control-right:hover,
.footer .widget_archive li a:hover,
.footer .widget_tag_cloud a:hover,
.footer .ui-tabs-nav li a:hover,
.footer .ui-tabs-nav li.ui-tabs-active a,
.footer .tabs-navigation li a:hover,
.footer .tabs-navigation li a.selected
{
	<?php if($theme_options["footer_button_hover_color"]!=""): ?>
	color: #<?php echo $theme_options["footer_button_hover_color"]; ?>;
	<?php endif;
	if($theme_options["footer_button_hover_background_color"]!=""): ?>
	background-color: #<?php echo $theme_options["footer_button_hover_background_color"]; ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["footer_button_border_color"]!=""): ?>
.footer .more,
.footer .scrolling-list-control-left,
.footer .scrolling-list-control-right,
.footer .pagination li span,
.footer .scrolling-list li .number,
.footer .widget_archive li a,
.footer .widget_tag_cloud a,
.footer .ui-tabs-nav li a,
.footer .tabs-navigation li a
{
	border-color: #<?php echo $theme_options["footer_button_border_color"]; ?>;
}
<?php endif;
if($theme_options["footer_button_border_hover_color"]!=""):?>
.footer .more:hover,
body .footer .scrolling-list-control-left:hover,
body .footer .scrolling-list-control-right:hover,
.footer .widget_archive li a:hover,
.footer .widget_tag_cloud a:hover,
.footer .scrolling-list li a:hover .number,
.footer .pagination li a:hover,
.footer .pagination li.selected a,
.footer .pagination li.selected span,
.footer .ui-tabs-nav li a:hover,
.footer .ui-tabs-nav li.ui-tabs-active a,
.footer .tabs-navigation li a:hover,
.footer .tabs-navigation li a.selected
{
	border-color: #<?php echo $theme_options["footer_button_border_hover_color"]; ?>;
}
<?php endif;
if($theme_options["menu_link_color"]!=""): ?>
.sf-menu li a, .sf-menu li a:visited
{
	color: #<?php echo $theme_options["menu_link_color"] ?>;
}
<?php endif; 
if($theme_options["menu_active_color"]!=""): ?>
.sf-menu li.selected a, .sf-menu li.current-menu-item a, .sf-menu li.current-menu-ancestor a
{
	color: #<?php echo $theme_options["menu_active_color"] ?>;
}
<?php endif;
if($theme_options["menu_hover_color"]!=""): ?>
.sf-menu li:hover a
{
	color: #<?php echo $theme_options["menu_hover_color"] ?>;
}
<?php endif; 
if($theme_options["submenu_background_color"]!=""): ?>
.sf-menu li:hover ul a,
.sf-menu>li.menu-item-has-children:hover ul a,
.sf-menu>li.menu-item-has-children:hover ul li.menu-item-type-custom a,
.sf-menu>li.menu-item-has-children:hover ul li.selected ul li a,
.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li a,
.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.menu-item-type-custom a,
.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.current-menu-item ul li a,
.sf-menu li ul li.menu-item-type-custom a
{
	background-color: #<?php echo $theme_options["submenu_background_color"] ?>;
}
<?php endif; 
if($theme_options["submenu_color"]!=""): ?>
.sf-menu li:hover ul a,
.sf-menu>li.menu-item-has-children:hover ul a,
.sf-menu>li.menu-item-has-children:hover ul li.menu-item-type-custom a,
.sf-menu>li.menu-item-has-children:hover ul li.selected ul li a,
.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li a,
.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.menu-item-type-custom a,
.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.current-menu-item ul li a,
.sf-menu li ul li.menu-item-type-custom a
{
	color: #<?php echo $theme_options["submenu_color"] ?>;
}
<?php endif; 
if($theme_options["submenu_hover_color"]!=""): ?>
.sf-menu li ul li a:hover, .sf-menu li ul li.selected a, .sf-menu li ul li.current-menu-item a,
.sf-menu>li.menu-item-has-children ul li a:hover, .sf-menu>li.menu-item-has-children:hover ul li.selected a, .sf-menu>li.menu-item-has-children:hover ul li.current-menu-item a, .sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.current-menu-item a, .sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.current-menu-item ul li a:hover,
.sf-menu>li.menu-item-has-children:hover ul li.selected ul li a:hover,.sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li a:hover, .sf-menu>li.menu-item-has-children:hover ul li ul li.selected a, .sf-menu>li.menu-item-has-children:hover ul li ul li.current-menu-item a, .sf-menu>li.menu-item-has-children:hover ul li.selected ul li.selected a, .sf-menu>li.menu-item-has-children:hover ul li.selected ul li.current-menu-item a,
.sf-menu>li.menu-item-has-children:hover ul li.menu-item-type-custom a:hover, .sf-menu li ul li.menu-item-type-custom a:hover, .sf-menu>li.menu-item-has-children:hover ul li.current-menu-item ul li.menu-item-type-custom a:hover
{
	color: #<?php echo $theme_options["submenu_hover_color"] ?>;
}
<?php endif;
if($theme_options["mobile_menu_link_color"]!=""): ?>
.mobile-menu>ul li a,
.mobile-menu>ul li.current-menu-ancestor ul a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent ul a
{
	color: #<?php echo $theme_options["mobile_menu_link_color"] ?>;
}
<?php endif;
if($theme_options["mobile_menu_link_hover_color"]!=""): ?>
.mobile-menu>ul li a:hover,
.mobile-menu>ul li.current-menu-ancestor ul a:hover,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul a:hover,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent ul a:hover
{
	color: #<?php echo $theme_options["mobile_menu_link_hover_color"] ?>;
}
<?php endif;
if($theme_options["mobile_menu_position_background_color"]!=""): ?>
.mobile-menu-container,
.mobile-menu > ul li a,
.mobile-menu>ul li.current-menu-ancestor ul a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent ul a
{
	background-color: #<?php echo $theme_options["mobile_menu_position_background_color"] ?>;
}
<?php endif;
if($theme_options["mobile_menu_active_link_color"]!=""): ?>
.mobile-menu>ul li.current-menu-item>a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-item a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-item a,
.mobile-menu>ul li.current-menu-ancestor a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent a,
.mobile-menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent a
{
	color: #<?php echo $theme_options["mobile_menu_active_link_color"] ?>;
}
<?php endif;
if($theme_options["dropdownmenu_background_color"]!=""): ?>
.tabs-box-navigation.sf-menu .tabs-box-navigation-selected
{
	background-color: #<?php echo $theme_options["dropdownmenu_background_color"] ?>;
}
<?php endif; 
if($theme_options["dropdownmenu_hover_background_color"]!=""): ?>
.tabs-box-navigation.sf-menu .tabs-box-navigation-selected:hover
{
	background-color: #<?php echo $theme_options["dropdownmenu_hover_background_color"] ?>;
}
<?php endif;
if($theme_options["dropdownmenu_text_color"]!=""): ?>
.tabs-box-navigation.sf-menu .tabs-box-navigation-selected
{
	color: #<?php echo $theme_options["dropdownmenu_text_color"] ?>;
}
<?php endif; 
if($theme_options["dropdownmenu_hover_text_color"]!=""): ?>
.tabs-box-navigation.sf-menu .tabs-box-navigation-selected:hover
{
	color: #<?php echo $theme_options["dropdownmenu_hover_text_color"] ?>;
}
<?php endif;
if($theme_options["form_hint_color"]!=""): ?>
input[type='text'].hint,
textarea.hint
{
	color: #<?php echo $theme_options["form_hint_color"]; ?>;
}
::-webkit-input-placeholder
{
	color: #<?php echo $theme_options["form_hint_color"]; ?>;
}
:-moz-placeholder
{
	color: #<?php echo $theme_options["form_hint_color"]; ?>;
}
::-moz-placeholder
{
	color: #<?php echo $theme_options["form_hint_color"]; ?>;
}
:-ms-input-placeholder
{
	color: #<?php echo $theme_options["form_hint_color"]; ?>;
}
<?php endif; 
if($theme_options["form_field_text_color"]!=""): ?>
.search .search-input:focus,
input, textarea
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce .widget_product_search form .search-field,
.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code,
.woocommerce form .form-row input.input-text,
.woocommerce form .form-row textarea,
.woocommerce #review_form_wrapper .comment-form-comment #comment
<?php
endif;
?>
{
	color: #<?php echo $theme_options["form_field_text_color"]; ?>;
}
<?php endif;
if($theme_options["form_field_label_color"]!=""): ?>
.gb-comment-form .flex-box label,
.gb-contact-form .flex-box label
{
	color: #<?php echo $theme_options["form_field_label_color"]; ?>;
}
<?php
endif;
if($theme_options["form_field_border_color"]!=""): ?>
.search input,
.gb-comment-form input, .gb-comment-form textarea,
.gb-contact-form input, .gb-contact-form textarea
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce .widget_product_search form .search-field,
.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code,
.woocommerce form .form-row input.input-text,
.woocommerce form .form-row textarea,
.woocommerce #review_form_wrapper .comment-form-comment #comment,
.woocommerce .quantity .qty,
.woocommerce .quantity .plus,
.woocommerce .quantity .minus
<?php
endif;
?>
{
	<?php if($theme_options["form_field_border_color"]=="none"): ?>
	border: none;
	<?php else: ?>
	border: 1px solid #<?php echo $theme_options["form_field_border_color"] ?>;
	<?php endif; ?>
}
<?php endif;
if($theme_options["link_color"]!=""): ?>
a,
.post-footer-details li a,
.footer a
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
,
.woocommerce-message a,
.woocommerce-info a,
.woocommerce-error a,
.woocommerce-review-link,
.woocommerce-checkout #payment .payment_method_paypal .about_paypal
<?php
endif;
?>
{
	color: #<?php echo $theme_options["link_color"]; ?>;
}
<?php
if(is_plugin_active('woocommerce/woocommerce.php')):
?>
.woocommerce a.remove
{
	color: #<?php echo $theme_options["link_color"]; ?> !important;
}
.woocommerce a.remove:hover
{
	background-color: #<?php echo $theme_options["link_color"]; ?>;
}
<?php
endif;
?>
<?php endif; 
if($theme_options["link_hover_color"]!=""): ?>
a:hover,
.post-footer-details li a:hover,
.footer a:hover
{
	color: #<?php echo $theme_options["link_hover_color"]; ?>;
}
<?php endif; 
if($theme_options["link_hover_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
?>
.woocommerce a.remove:hover
{
	background-color: #<?php echo $theme_options["link_hover_color"]; ?>;
}
<?php
endif;
if($theme_options["date_box_color"]!="" || $theme_options["date_box_text_color"]!="") : ?>
.comment-box .first-row
{
	<?php if($theme_options["date_box_color"]!=""): ?>
	background-color: #<?php echo $theme_options["date_box_color"]; ?>;
	<?php endif;
	if($theme_options["date_box_text_color"]!=""): ?>
	color: #<?php echo $theme_options["date_box_text_color"]; ?>;
	<?php endif; ?>
}
<?php endif;
if($theme_options["date_box_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
?>
.woocommerce span.onsale,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce mark,
.cart_items_number
{
	background-color: #<?php echo $theme_options["date_box_color"]; ?>;
}
<?php
endif;
if($theme_options["date_box_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
?>
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .woocommerce-error,
.woocommerce .woocommerce-info,
.woocommerce .woocommerce-message
{
	border-color: #<?php echo $theme_options["date_box_color"]; ?>;
}
<?php
endif;
if($theme_options["date_box_comments_number_text_color"]!=""): ?>
.comment-box .comments-number
{
	color: #<?php echo $theme_options["date_box_comments_number_text_color"]; ?>;
}
<?php endif; 
if($theme_options["date_box_comments_number_border_color"]!=""): ?>
.comment-box .comments-number
{
	<?php if($theme_options["date_box_comments_number_border_color"]=="none"): ?>
	border: none;
	<?php else: ?>
	border-bottom: 1px solid #<?php echo $theme_options["date_box_comments_number_border_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["date_box_comments_number_hover_border_color"]!=""): ?>
.comment-box .comments-number:hover
{
	<?php if($theme_options["date_box_comments_number_hover_border_color"]=="none"): ?>
	border: none;
	<?php else: ?>
	border-bottom: 1px solid #<?php echo $theme_options["date_box_comments_number_hover_border_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["gallery_box_color"]!=""): ?>
.gb-gallery li .description
{
	background-color: #<?php echo $theme_options["gallery_box_color"]; ?>;
}
<?php endif; 
if($theme_options["gallery_box_text_first_line_color"]!=""): ?>
.gallery-box h4
{
	color: #<?php echo $theme_options["gallery_box_text_first_line_color"]; ?>;
}
<?php endif; 
if($theme_options["gallery_box_text_second_line_color"]!=""): ?>
.gb-gallery li .gb-subtitle
{
	color: #<?php echo $theme_options["gallery_box_text_second_line_color"]; ?>;
}
<?php endif; 
if($theme_options["gallery_box_hover_color"]!=""): ?>
.gb-gallery li:hover .description,
.gallery-item-details-list .image-box:hover .description
{
	background-color: #<?php echo $theme_options["gallery_box_hover_color"]; ?>;
}
<?php endif; 
if($theme_options["gallery_box_hover_text_first_line_color"]!=""): ?>
.gallery-box:hover h4
{
	color: #<?php echo $theme_options["gallery_box_hover_text_first_line_color"]; ?>;
}
<?php endif; 
if($theme_options["gallery_box_hover_text_second_line_color"]!=""): ?>
.gb-gallery li:hover .gb-subtitle
{
	color: #<?php echo $theme_options["gallery_box_hover_text_second_line_color"]; ?>;
}
<?php endif; 
if($theme_options["timetable_box_color"]!=""): ?>
.timetable tr .event
{
	background-color: #<?php echo $theme_options["timetable_box_color"]; ?>;
}
<?php endif; 
if($theme_options["timetable_box_hover_color"]!=""): ?>
.timetable .event:hover,
.timetable .event.tooltip:hover
{
	background-color: #<?php echo $theme_options["timetable_box_hover_color"]; ?>;
}
<?php endif;
if($theme_options["featured_icon_color"]!=""): ?>
.feature-item .icon::before
{
	color: #<?php echo $theme_options["featured_icon_color"]; ?>;
}
.footer-banner-box:nth-child(3n+1) .footer-box .icon::after,
.border-columns .feature-item.feature-item-hover-background:hover .icon.white::after
{
	background-color: #<?php echo $theme_options["featured_icon_color"]; ?>;
}
<?php endif; 
if($theme_options["counter_box_progress_bar_color"]!=""): ?>
.counter-box .progress-bar
{
	background: #<?php echo $theme_options["counter_box_progress_bar_color"]; ?>;
}
<?php endif;
if($theme_options["counter_box_border_color"]!=""): ?>
.counters-group .counter-box,
body .theme-page .counters-group
{
	border-color: #<?php echo $theme_options["counter_box_border_color"]; ?>;
}
<?php endif;
if($theme_options["item_list_icon_color"]!=""): ?>
.items-list li[class^="template-"]::before,
.items-list li[class*=" template-"]::before,
.footer .menu li a::before
{
	color: #<?php echo $theme_options["item_list_icon_color"]; ?>;
}
<?php endif;
if($theme_options["pricing_box_price_color"]!=""): ?>
.cost-calculator-box.cost-calculator-sum.white .cost-calculator-more[type="submit"]:hover
{
	background: #<?php echo $theme_options["pricing_box_price_color"]; ?>;
	border-color: #<?php echo $theme_options["pricing_box_price_color"]; ?>;
}
.cost-calculator-box.cost-calculator-sum.gray .cost-calculator-summary-price,
.cost-calculator-box.cost-calculator-sum.white .cost-calculator-summary-price
{
	color: #<?php echo $theme_options["pricing_box_price_color"]; ?>;
}
<?php endif;
if($theme_options["pricing_box_price_color"]!=""): ?>
.theme-page .border-columns,
.theme-page .vc_row.border-columns div.wpb_column:last-child,
.theme-page .vc_row.border-columns:not(.counters-group) .wpb_column
{
	border-color: #<?php echo $theme_options["pricing_box_price_color"]; ?>;
}
<?php endif;
if($theme_options["testimonials_icon_color"]!=""): ?>
.testimonials li blockquote::before
{
	color: #<?php echo $theme_options["testimonials_icon_color"]; ?>;
}
<?php endif;
if($theme_options["testimonials_border_color"]!=""): ?>
.border-container,
.caroufredsel-wrapper-testimonials+.controls
{
	border-color: #<?php echo $theme_options["testimonials_border_color"]; ?>;
}
<?php endif;
if($theme_options["gallery_details_box_border_color"]!=""): ?>
.gallery-item-details-list .title-box
{
	<?php if($theme_options["gallery_details_box_border_color"]=="none"): ?>
	border-top: none;
	<?php else: ?>
	border-top-color: #<?php echo $theme_options["gallery_details_box_border_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["bread_crumb_border_color"]!=""): ?>
.bread-crumb li.separator
{
	background-color: #<?php echo $theme_options["bread_crumb_border_color"] ?>;
}
<?php endif; 
if($theme_options["accordion_item_border_color"]!=""): ?>
.accordion .ui-accordion-header,
.ui-accordion-header
{
	<?php if($theme_options["accordion_item_border_color"]=="none"): ?>
	border-bottom: none;
	<?php else: ?>
	border-bottom-color: #<?php echo $theme_options["accordion_item_border_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["accordion_item_border_hover_color"]!=""): ?>
.accordion .ui-accordion-header.ui-state-hover,
.ui-accordion-header.ui-state-hover
{
	<?php if($theme_options["accordion_item_border_hover_color"]=="none"): ?>
	border-bottom: none;
	<?php else: ?>
	border-bottom-color: #<?php echo $theme_options["accordion_item_border_hover_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["accordion_item_border_active_color"]!=""): ?>
.accordion .ui-accordion-header.ui-state-active,
.ui-accordion-header.ui-state-active
{
	<?php if($theme_options["accordion_item_border_active_color"]=="none"): ?>
	border-bottom: none;
	<?php else: ?>
	border-bottom-color: #<?php echo $theme_options["accordion_item_border_active_color"] ?>;
	<?php endif; ?>
}
<?php endif; 
if($theme_options["copyright_area_border_color"]!=""): ?>
.copyright-area-container
{
	background-color: #<?php echo $theme_options["copyright_area_border_color"] ?>;
}
<?php endif;
if($theme_options["top_hint_background_color"]!=""): ?>
.top-hint
{
	background-color: #<?php echo $theme_options["top_hint_background_color"]; ?>;
}
<?php endif;
if($theme_options["top_hint_text_color"]!=""): ?>
.top-hint
{
	color: #<?php echo $theme_options["top_hint_text_color"]; ?>;
}
<?php endif;
if($theme_options["comment_reply_button_color"]!=""): ?>
#comments-list .reply-button
{
	color: #<?php echo $theme_options["comment_reply_button_color"]; ?>;
}
<?php endif;
if($theme_options["post_author_link_color"]!=""): ?>
.post-footer-details .post-footer-author a,
#comments-list .comment-details .post-footer-details li:first-child,
#comments-list .comment-details .post-footer-details li:first-child a
{
	color: #<?php echo $theme_options["post_author_link_color"]; ?>;
}
<?php endif;
if($theme_options["contact_details_box_background_color"]!=""): ?>
.contact_details_about
{
	background-color: #<?php echo $theme_options["contact_details_box_background_color"]; ?>;
}
<?php endif;
if($theme_options["header_font"]!=""): $header_font_explode = explode(":", $theme_options["header_font"]); ?>
h1, h2, h3, h4, h5,
.header_left a, .logo_left, .logo_right	
{
	font-family: '<?php echo $header_font_explode[0]; ?>';
}
<?php endif;
if($theme_options["subheader_font"]!=""): $subheader_font_explode = explode(":", $theme_options["subheader_font"]); ?>
.sentence,
.info_green, .info_white,
.page_header h4,
.home_box h3,
.accordion .ui-accordion-header h5,
.gallery_box .description h5,
.gallery_item_details_list .details_box .subheader,
.footer_banner_box h3
{
	font-family: '<?php echo $subheader_font_explode[0]; ?>';
}
<?php endif; ?>