function UnlinkPropFromCat(pid, category) {
    var data = 'pid:' + pid + ':category:' + category;
    $.ajax({
        type: "POST",
        url: "/ajax/unlinkpropfromcat",
        dataType: "text",
        data: "data=" + data,
        success: function() {
            $('#prop' + pid).remove();
        }
    });
    return true;
}

function AddPropToCat(pid, category, name) {
    var data = 'pid:' + pid + ':category:' + category;
    $('#div_prop_' + pid).remove();
    $.ajax({
        type: "POST",
        url: "/ajax/addproptocat",
        dataType: "text",
        data: "data=" + data,
        success: function() {
            $('#table-add-props').append('<tr id="prop'+pid+'"><td>'+name+'&nbsp;<a href="#" onClick="UnlinkPropFromCat('+pid+','+category+'); return false;" alt="Отвязать характеристику" title="Отвязать характеристику"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
        }
    });
    return true;
}

$(document).ready(function(){
    $('a.poplight[href^=#]').click(function() {
	var popID = "popup_name";
        var category = $(this).attr('rel');
	var popWidth = 700;
        $.ajax({
            type: "POST",
            url: "/ajax/addpropstocat",
            dataType: "text",
            data: "data=" + category,
            success: function(data) {
                $("body").append(data);
                $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" title="Закрыть" class="close"></a>');
                var popMargTop = ($('#' + popID).height() + 80) / 2;
                var popMargLeft = ($('#' + popID).width() + 80) / 2;
                $('#' + popID).css({ 
                    'margin-top' : -popMargTop,
                    'margin-left' : -popMargLeft
                });
            }
        });
	$('body').append('<div id="fade"></div>');
	$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
        
 	return false;
    }); 
    $(document).on('click', 'a.close, #fade', function() {
        $('#popup_name').remove();
        $('#fade , .popup_block').fadeOut(function() {
            $('#fade, a.close').remove();
        });
        return false;
   });
});


