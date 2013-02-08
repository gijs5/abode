// vars
// var basepath is set in layouts/default.ctp
var loadingGif = '<img src="'+basepath+'img/ajax-loader.gif" />';


$(function() {
	init();
});

function init() {
	$('select, input, textarea, .tooltip').tooltip({
		position: { my: "left+15 center", at: "right center" },
		show: 500,
		hide: 500
	});
}

// page actions (example: projectsAdd is used on page projects/add)
function projectsAdd() {
	radio = $('input[name="data[Project][countrystate_id]"]');
	radio.change(function(){
		countrystate_id = $(this).val();
		url = 'councils/by_country_state/'+countrystate_id+'/Project';
		div_id = 'councilSelectBox';
		putAjaxIn(url, div_id);
	});
}

function projectphases() {
	// sort projectactions
	$("ul.droptrue").sortable({
		connectWith: "ul",
		placeholder: 'ui-state-highlight', 
		update: function(e, ui){
			$("#JQresult").html(loadingGif);
			data = $("ul.droptrue").serial();
			
            $.ajax({
                type: "POST",
                url: basepath+'projectactions/sort',
                data: data,
                error: function(msg){
                    $("#JQresult").html(msg);
                },
                success: function(msg){
                    $("#JQresult").html(msg);
                }
            });
		}
	});
	// sort projectphases
	$('#projectphases').sortable({ 
		items: 'div.projectphase-item', 
		placeholder: 'ui-state-highlight', 
		axis: 'y', 
		handle: '.handle',
		update: function(e, ui){
			$("#JQresult").html(loadingGif);
            $.ajax({
                type: "POST",
                url: basepath+'projectphases/sort',
                data: "itemId=&newOrder="+$('#projectphases').sortable('toArray'),
                error: function(msg){
                    $("#JQresult").html(msg);
                },
                success: function(msg){
                    $("#JQresult").html(msg);
                }
            });
		}
	});
}

// basic ajax load function
function putAjaxIn(url, div_id) {
	$('#'+div_id).html(loadingGif);
	$.post(basepath+url, function(data) {
		$('#'+div_id).html(data);
	});
}

// function to selected checkboxes in tab name
function showCheckboxAmountInTab(ele) {
	doShowCheckboxAmountInTab(ele);
	$(ele+' input[type="checkbox"]').change(function(){
		doShowCheckboxAmountInTab(ele);
	});
}
	function doShowCheckboxAmountInTab(ele) {
		$(ele+' ul li').each(function(index) {
			id = $(this).children('a').attr('href');
			count = $('div'+id+' input[type="checkbox"]:checked').length;
			$(this).children('a').children('span').html('('+count+')');
		});
	}

// function to create a sortable of a table
function createTableSortable(table, action) {
	$(table).sortable({ 
		placeholder: 'ui-state-highlight', 
		axis: 'y', 
		handle: '.handle',
		items: 'tr:not(.ui-state-disabled)',
		update: function(e, ui){
			$("#JQresult").html(loadingGif);
            $.ajax({
                type: "POST",
                url: basepath+action,
                data: "itemId=&newOrder="+$(table).sortable('toArray'),
                error: function(msg){
                    $("#JQresult").html(msg);
                },
                success: function(msg){
                    $("#JQresult").html(msg);
                }
            });
		}
	});
}

function tabs(ele) {
	$(ele).tabs();
}

function wysiwyg(ele, style) {
	if (style=='') {
		style = 'default';
	}
	$(ele).htmlarea({
		css: basepath+'css/jHtmlArea.Editor.'+style+'.css',
		toolbar: [
			"html",
			"|",
	        "bold", "italic", "underline",
	        "|",
	        "p", "h1", "h2", "h3",
	        "|",
	        "orderedList", "unorderedList",
	        "|",
	        "link", "unlink",
	        "|",
	        "image",
	        "|",
	        "horizontalrule",
	        "|",
	        "cut", "copy", "paste"
	    ]
	});
}

// function to serialize multiple lists
(function($) {
    $.fn.serial = function() {
        var array = [];
        var $elem = $(this);
        $elem.each(function(i) {
            var menu = this.id;
            $('li', this).each(function(e) {
                array.push(menu + '[' + e + ']=' + this.id);
            });
        });
        return array.join('&');
    }
})(jQuery);