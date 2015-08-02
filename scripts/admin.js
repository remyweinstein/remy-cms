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
    return false;
}

function AddNewPropValue(pid) {
    var win = '<div id="popup_name" class="popup_block"><div style="padding:10px 30px 10px 0px;">Значение:&nbsp;<input type="text" name="newvalue" id="newvalue" value=""/>&nbsp;<button onclick="AddNewValue(' + pid + ', $(\'#newvalue\').val());">Добавить</button></div></div>';
    var popID = "popup_name";
    var popWidth = 700;
    $("body").append(win);
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" title="Закрыть" class="close"></a>');
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;
    $('#' + popID).css({ 
    'margin-top' : -popMargTop,
    'margin-left' : -popMargLeft
    });
    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
    
    return false;
}

function AddNewValue(pid, value) {
    if(value !== "") {
        $.ajax({
            type: "POST",
            url: "/ajax/addnewpropvalue",
            dataType: "text",
            data: "data=pid:" + pid + ":value:" + value,
            success: function(vid) {
                $("#prop_" + pid + " option:nth-last-child(2)").after($('<option value="' + vid + '">' + value + '</option>'));
                $('#newvalue').val('');
            }
        });
    }
    return false;
}

function AddNewProp(category) {
    var name = $('#newprop').val();
    var value = $('#newvalue').val();
    if(name !== "" && value !== "") {
        $.ajax({
            type: "POST",
            url: "/ajax/addnewprop",
            dataType: "text",
            data: "data=name:" + name + ":value:" + value,
            success: function(pid) {
                if(pid>0) {
                    $('#popup_block_list').append('<div id="div_prop_' + pid + '" style="padding:10px 30px 10px 0px;float:left;"><a href="#" onClick="AddPropToCat(' + pid + ', ' + category + ', \'' + name + '\');">' + name + '</a></div>');
                    $('#newprop').val('');
                    $('#newvalue').val('');
                }
            }
        });
    }
    return false;
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
    return false;
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


