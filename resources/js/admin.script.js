function OpenImageEdit(imaga) {
    var id = imaga.attr("id");
    if(id=="") {
        imaga.attr("id", randomNumber(100000,999999));
        id = imaga.attr("id");
        }
    OpenPopupWindow('modal_form_edit_image', 'Свойства изображения', '<br>Выравнивание: <select name="align" id="selector_image"><option value="none">Нет</option><option value="left">Слева</option><option value="right">Справа</option><option value="absmiddle">Посередине</option></select><br>Отступ сверху: <input style="width:30px;" type="text" name="t" id="selector_image_top" value=""><br>Отступ справа: <input style="width:30px;" type="text" name="r" id="selector_image_right" value=""><br>Отступ снизу: <input style="width:30px;" type="text" name="b" id="selector_image_bottom" value=""><br>Отступ слева: <input style="width:30px;" type="text" name="l" id="selector_image_left" value=""><br>Ширина: <input style="width:30px;" type="text" name="l" id="selector_image_width" value=""><br>Высота: <input style="width:30px;" type="text" name="l" id="selector_image_height" value=""><br><br><div style="width:100%;text-align:center;"><input type="button" value="Сохранить" onClick="SaveImage('+id+');"></div>');
    $("#selector_image option[value='"+imaga.attr("align")+"']").attr("selected", "selected");
    $("#selector_image_top").val(parseInt(imaga.css("margin-top")));
    $("#selector_image_right").val(parseInt(imaga.css("margin-right")));
    $("#selector_image_bottom").val(parseInt(imaga.css("margin-bottom")));
    $("#selector_image_left").val(parseInt(imaga.css("margin-left")));
    $("#selector_image_width").val(parseInt(imaga.attr("width")));
    $("#selector_image_height").val(parseInt(imaga.attr("height")));
    }
    
function SaveImage(id) {
    var imaga = $("#"+id);
    imaga.attr("align", $("#selector_image").val());
    imaga.css("margin-top", $("#selector_image_top").val()+"px");
    imaga.css("margin-right", $("#selector_image_right").val()+"px");
    imaga.css("margin-bottom", $("#selector_image_bottom").val()+"px");
    imaga.css("margin-left", $("#selector_image_left").val()+"px");
    imaga.attr("width", $("#selector_image_width").val());
    imaga.attr("height", $("#selector_image_height").val());
    ClosePopupWindow();
    }

function randomNumber(m,n) {
    m = parseInt(m);
    n = parseInt(n);
    return Math.floor( Math.random() * (n - m + 1) ) + m;
    }

function ChangeThisEdit() {
    var nowselected = $("#thisedit").val();
    if(nowselected!="content") {
        $(".editModuleBlock").hide();
        $("#edit_gallery").show();
        } else $(".editModuleBlock").hide();
    }
    
$("#gallery_upload").click( function(e){
    e.stopPropagation();
    OpenPopupWindow('modal_form_gallery', 'Загрузка изображения', '<form action="" method="POST" enctype="multipart/form-data"><input type="file" name="module_gallery_new_picture" /><br>Название: <input type="text" name="module_gallery_title" /><br><br<br><input type="submit" value="Загрузить" /></form>');
    });
 
$("#mainContent").click(function (e) {
    $(".editModuleBlock").hide();
    $("#status").hide();
    $("#editContentBlock").show();
    e.stopPropagation();
});

$(".bold").click(function() { document.execCommand("bold", false, null); });

$(".italic").click(function() { document.execCommand("italic", false, null); });

$(".underline").click(function() { document.execCommand("underline", false, null); });

$(".createLink").click(function() {
    window.savedSel = saveSelection();
    OpenPopupWindow('add_link', 'Добавить ссылку', '<br><br>Url: <input type="text" id="add_link_url" name="add_link_url" value="" /><br><br<br><input type="button" value="Добавить" onClick="AddLink();" />');
    });

function AddLink() {
    var url = $("#add_link_url").val();
    restoreSelection(window.savedSel);
    document.execCommand("createLink", false, url);
    ClosePopupWindow();
    }
    
$(".justifyleft").click(function() { document.execCommand("JustifyLeft", false, null); });

$(".unsortedlist").click(function() { document.execCommand("InsertUnorderedList", false, null); });

$(document).click(function() {
    //$(".editModuleBlock").hide();
});

function saveSelection() {
    if(window.getSelection) {
        sel = window.getSelection();
        if(sel.getRangeAt && sel.rangeCount) {
            var ranges = [];
            for(var i=0, len=sel.rangeCount; i<len; ++i) {
                ranges.push(sel.getRangeAt(i));
                }
            return ranges;
            }
        } else if(document.selection && document.selection.createRange) {
                    return document.selection.createRange();
                    }
    return null;
    }

function restoreSelection(savedSel) {
    if(savedSel) {
        if(window.getSelection) {
            sel = window.getSelection();
            sel.removeAllRanges();
            for(var i=0, len=savedSel.length; i<len; ++i) {
                sel.addRange(savedSel[i]);
                }
            } else if(document.selection && savedSel.select) {
                        savedSel.select();
                        }
        }
    }

$("#module_gallery > div").click(function (e) {
    var id = this.id;
    id = id.replace("module_gallery_image_", "");
    var title = $("#"+this.id+" > span").text();
    OpenPopupWindow(this.id, 'Свойства изображения', '<form action="" method="POST"><input type="hidden" name="gallery_image_id" value="' + id + '" /><br>Название: <input type="text" name="module_gallery_title" value="' + title + '" /><br><br<br><input type="submit" value="Сохранить" /></form><form action="" method="POST"><input type="hidden" name="gallery_image_delete" value="' + id + '"><input type="submit" value="Удалить" /></form>');
    });

$("#save_content").click(function (e) {
    var content = $("#mainContent").html();
        $.ajax({
            url: "/engine/ajax/save_content.php",
            type: "POST",
            data: {
            id: window.PageId,
            content: content
            },
            success:function (data) {
                if (data == "1") {
                    $("#status")
                        .addClass("success")
                        .html("Все изменения сохранены.")
                        .fadeIn("slow")
                        .delay(3000)
                        .fadeOut("slow");
                    } else {
                        $("#status")
                            .addClass("error")
                            .html(data)
                            .fadeIn("slow")
                            .delay(3000)
                            .fadeOut("slow");
                        }
                }
            });
    $("#editContentBlock").hide();
    });

function OpenPopupWindow(id, title, content) {
    $("#popup_dialogs").append('<div id="' + id + '" class="modal_form"><div class="modal_title">' + title + '<div class="modal_close" onClick="ClosePopupWindow();"></div></div><div class="modal_content">' + content + '</div></div>');
       $(".hide-layout").fadeIn(400,
        function(){
            $("#"+id) 
                .css("display", "block")
                .animate({opacity: 1, top: "50%"}, 200);
            });            
    }

function ClosePopupWindow() {
    $(".modal_form")
    .animate({opacity: 0, top: "45%"}, 200,
        function(){
            $(".modal_form").css("display", "none");
            $(".hide-layout").fadeOut(400);
            });
    }

function insertHTML(html) {
    try {
        var selection = window.getSelection(),
            range = selection.getRangeAt(0),
            temp = document.createElement('div'),
            insertion = document.createDocumentFragment();
        temp.innerHTML = html;
        while (temp.firstChild) {
            insertion.appendChild(temp.firstChild);
            }
        range.deleteContents();
        range.insertNode(insertion);
        } catch (z) {
            try {
                document.selection.createRange().pasteHTML(html);
                } catch (z) {}
            }
    }

function displayFiles(files) {
    var imageType = /image.*/;
    var num = 0;
    $.each(files, function(i, file) {
        if (file.size > window.max_size_content_image) {
            OpenPopupWindow('modal_form_gallery', 'Ошибка', 'Размер файла не должен превышать ' + Math.round(window.max_size_content_image/1048576) + 'Мб');
            return true;
            }
        if (!file.type.match(imageType)) {
            OpenPopupWindow('modal_form_gallery', 'Ошибка', 'Выбранный вами файл не является изображением');
            return true;
            }
        num++;
        $("#mainContent").trigger('focus');
        var newid = randomNumber(10000000,99999999);
        insertHTML("<img id=\""+newid+"\" onClick=\"OpenImageEdit($(this));\" />");
        var img = $("#"+newid);
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) {
                aImg.attr('src', e.target.result);
                imgCount++;
                imgSize += file.size;
                };
            })(img);
        reader.readAsDataURL(file);
        });
    }

function LoadPicture(imaga) {
    displayFiles(imaga.files);
    }
