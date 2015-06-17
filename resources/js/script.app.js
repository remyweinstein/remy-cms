
function openWindowGallery(id) {
    var temp = arrImages[id].split(';');
    var url = '/uploads/'+temp[0];
    var title = temp[1];
    itg = parseInt(id);
    var tempItg = itg + 1;
    $(".popup_image").css("display","block");
    $(".hide-layout").fadeIn(400,
        function(){
            $(".popup_image").append('<div class="view_image_from_gallery"><div style="position:absolute;left:-20px;top:45%;width:50px;"><a href="#" onClick="prevWindowGallery(' + itg + ');"><img src="/engine/images/arrows-left.png" /></a></div><div style="width:100%"><img src="' + url + '" /></div><div style="width:100%"><span style="float:left;"><strong>' + tempItg + '</strong>&nbsp;&nbsp;&nbsp;' + title + '</span><span style="float:right;"><a href="#" onClick="closeWindowGallery();"><img src="/engine/images/close.png" /></a></span></div><div style="position:absolute;right:-20px;top:45%;width:50px;"><a href="#" onClick="nextWindowGallery(' + itg + ');"><img src="/engine/images/arrows-right.png" /></a></div></div>');
            var img = $(".view_image_from_gallery > div > img");
            changeSizeImage(img);
            });
    e.stopPropagation();
    }

function changeSizeImage(img) {
    img.one('load',function(){
        var CurImg = $(this);
        var width  = CurImg.width();
        var height = CurImg.height();
        var doc_w = $(window).width();
        var doc_h = $(window).height();
        if(width > (doc_w - 80)) var width = doc_w - 80;
        $(".view_image_from_gallery > div > img").css("width", width);
        var h_height = CurImg.height() + 50;
        //$(".view_image_from_gallery").css("height", height);//margin: -125px 0 0 -125px;
        var sdvig = -1*Math.round((width+20)/2);
        $(".view_image_from_gallery").css("height", h_height);
        $(".view_image_from_gallery").css("margin-left", sdvig+"px");
        }).each(function(){
            if(this.complete) $(this).trigger('load');
            });
    }
    
function nextWindowGallery(id) {
    itg = parseInt(id) + 1;
    if((itg+1)>countArrImages) itg = 0;
    $(".view_image_from_gallery").remove();
    openWindowGallery(itg);
    }

function prevWindowGallery(id) {
    itg = parseInt(id) - 1;
    if(itg<0) itg = countArrImages - 1;
    $(".view_image_from_gallery").remove();
    openWindowGallery(itg);
    }

function closeWindowGallery() {
    $(".view_image_from_gallery").remove();
    $(".hide-layout").fadeOut(400);
    $(".popup_image").css("display","none");
    return false;
    }

function OpenPopupSystem(idForm, title, content) {
    $("#popup_feedback").append('<div id="' + idForm + '" class="modal_form"><div class="modal_title">' + title + '<div class="modal_close" onClick="ClosePopupSystem(\'' + idForm + '\');"></div></div><div class="modal_content">' + content + '</div></div>');
       $(".hide-layout").fadeIn(400,
        function(){
            $("#" + idForm) 
                .css("display", "block")
                .animate({opacity: 1, top: "50%"}, 200);
            });            
    }

function ClosePopupSystem(idForm) {
    $(".hide-layout").fadeOut(400,
    function(){
        $("#" + idForm).remove();
        });
    }
