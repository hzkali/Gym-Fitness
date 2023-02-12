jQuery(document).ready(function($){
	$(".vc_ui-panel [name^='label'], .vc_ui-panel [name^='label_style'], .vc_ui-panel [name^='title'], .vc_ui-panel [name^='content']").parent().parent().css("display", "none");
	$(document).on("change", ".vc_ui-panel-content .vc_shortcode-param select[name='timeline_count']", function(event) {
		var self = $(this);
		$(".vc_ui-panel [name^='label'], .vc_ui-panel [name^='label_style'], .vc_ui-panel [name^='title'], .vc_ui-panel [name^='content']").parent().parent().css("display", "none");
		self.parent().parent().nextUntil('', ':lt(' + (self.val()*4) + ')').css("display", "block");
	});
});