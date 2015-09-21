function UnlinkPropFromCat(pid, category) { // Отвязываем PROP от категории
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

function UnlinkSkuFromGoods(sid) { // Удаляем SKU из товаров
    
    $('#sku' + sid).remove();
    // id="sku_varint_0
    return false;
}

function AddNewValue(pid, value) { // Добавляем новое значение PROP в категориях
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
function AddNewSkuName(){ // Добавляем новый SKU В ОКНО в товарах
    var name = $('#newskuname').val();
    if(name !== "") {
        $.ajax({
            type: "POST",
            url: "/ajax/addnewskuname",
            dataType: "text",
            data: "data=" + name,
            success: function(sid) {
                if(sid>0) {
                    $('#popup_block_list').append('<div id="div_sku_' + sid + '" style="padding:10px 30px 10px 0px;float:left;"><a href="#" onClick="AddSkuToGoods(' + sid + ', \'' + name + '\');">' + name + '</a></div>');
                    $('#newskuname').val('');
                }
            }
        });
    }
    return false;
}
function AddNewProp(category) { // Добавляем новый PROP В ОКНО в категориях
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
function AddSkuToGoods(sid, name) { // Добавляем новый SKU в товарах
    var data = 'sid:' + sid + ':name:' + name;
    $('#div_sku_' + sid).remove();
    $('#table-add-skus').append('<tr id="sku'+sid+'"><td>'+name+'&nbsp;<a href="#" onClick="AddSkuValueFromGoods('+sid+'); return false;" alt="Добавить значение" title="Добавить значение"><i class="glyphicon glyphicon-plus"></i></a>&nbsp;<a href="#" onClick="UnlinkSkuFromGoods('+sid+'); return false;" alt="Отвязать характеристику" title="Отвязать характеристику"><i class="glyphicon glyphicon-trash"></i></a></td></tr>');
    /*
    <tr class="variants" id="sku_varint_0"><td colspan="2">
                Артикул:&nbsp;<input type="text" name="variants_articul[0]" value="" style="width:150px;" />&nbsp;
                Цена:&nbsp;<input type="text" name="variants_price[0]" value="" style="width:60px;" />&nbsp;
                Старая цена:&nbsp;<input type="text" name="variants_price_old[0]" style="width:60px;" value="" />&nbsp;
                Вес:&nbsp;<input type="text" name="variants_weight[0]" value="" style="width:50px;" />&nbsp;
                Количество:&nbsp;<input type="text" name="variants_quantity[0]" value="" style="width:50px;" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="variants_skus[0]" value= "" />
    </td></tr>
     */
    return false;
}
function AddPropToCat(pid, category, name) { // Добавляем новый PROP в категориях
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
    //$('#sku_varint_0').remove();
    //if($(".variants").is("#sku_varint_0")){
    //    alert('yes');
    //}
    function AddSkuValueFromGoods(sid) { // Всплывающее окно добавления нового значения SKU
	var popID = "popup_name";
	var popWidth = 700;
        $.ajax({
            type: "POST",
            url: "/ajax/addnewvalueskutogoods",
            dataType: "text",
            data: "data=" + sid,
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
    }
    function AddNewPropValue(pid) { // Всплыващее окно добавления ЗНАЧЕНИЯ PROPS в категориях
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

    $('a.popup_goods').click(function() { // Всплыващее окно добавления SKU в товарах
	var popID = "popup_name";
        var item = $(this).attr('rel');
	var popWidth = 700;
        $.ajax({
            type: "POST",
            url: "/ajax/addskustogoods",
            dataType: "text",
            data: "data=" + item,
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
    
    $('a.popup_cats').click(function() { // Всплыващее окно добавления PROPS в категориях
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
    
    $(document).on('click', 'a.close, #fade', function() { // Закрываем всплывающее окно POPUP_NAME
        $('#popup_name').remove();
        $('#fade , .popup_block').fadeOut(function() {
            $('#fade, a.close').remove();
        });
        return false;
   });
   
});


