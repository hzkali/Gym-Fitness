jQuery(document).ready(function($){
	"use strict";
	$(document).on("click", ".widget-content [name$='[add_new_button]']", function(){
		$(this).parent().before($(this).parent().prev().clone().wrap('<div>').parent().html());
		$(this).parent().prev().find("input").val('');
		$(this).parent().prev().find("select").each(function(){
			$(this).val($(this).children("option:first").val());
		});
	});
	$(document).on("widget-added widget-updated", function(event, widget){
		//colorpicker
		if($(".color").length)
		{
			$(".color").ColorPicker({
				onChange: function(hsb, hex, rgb, el) {
					$(el).val(hex).trigger("change");
				},
				onSubmit: function(hsb, hex, rgb, el){
					$(el).val(hex).trigger("change");
					$(el).ColorPickerHide();
				},
				onBeforeShow: function (){
					var color = (this.value!="" ? this.value : $(this).attr("data-default-color"));
					$(this).ColorPickerSetColor(color);
				}
			}).on('keyup', function(event, param){
				$(this).ColorPickerSetColor(this.value);
			});
		}
    });
});