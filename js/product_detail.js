 
    $("#quality_input").keydown(function(event){
        if(event.which == 8){
            if($(this).val().length <= 1){
                if($(this).val() !== "1"){
                    $(this).val("1");
                }
                event.preventDefault();
            }
        }
        else{
            if($(this).val().length == 0){
                $(this).val("1");
            }
        }
    });
    $(".list-group-item img").hover(function(){
        var src = $(this).attr("src");
        $(".detail-image-child-container img").attr('src', src);

    });

    $(".list-group-item img").click(function(){
        if($(".list-group-item img").hasClass("selected-item-img")){
            $(".list-group-item img").removeClass("selected-item-img");
        }
        $(this).addClass("selected-item-img");
        // Instantiate new modal
        var modal = new Custombox.modal({
          content: {
            effect: 'fadein',
            target: '.selected-item-img'
          }
        });
        modal.open();
    });

    $(".detail-image-child-container img").click(function(){
        $(this).addClass("selected-detail-image-child-container");
        // Instantiate new modal
        var modal_ = new Custombox.modal({
          content: {
            effect: 'fadein',
            target: '.selected-detail-image-child-container'
          }
        });
        modal_.open();
    });


    $(".relate-left-nav").click(function(){
        if($(".relate-left-hide").length >= 4){
            $length = $(".relate-left-hide").length;
            for($i = $length-1, $indexofend= $(".relate-show").length-1; $i >= $length-4; $i--){
                $relate_left_hide = $(".relate-left-hide").length-1;
                $(".relate-show").eq($indexofend).addClass("relate-right-hide");
                $(".relate-show").eq($indexofend).removeClass("relate-show");
                $(".relate-left-hide").eq($relate_left_hide).addClass("relate-show");
                $(".relate-left-hide").eq($relate_left_hide).removeClass("relate-left-hide");
            }

            for($i =  $(".relate-right-hide").length - 1; $i >= 0; $i--){
                $(".relate-right-hide").eq($i).css({"position":"absolute", "top":"0","left":"-100%"});
            }

            for($i =3, $count = 1; $i >= 0; $i--, $count++){
                $(".relate-right-hide").eq($i).css({"position":"absolute", "left":""+($i*25)+"%", "top":"0"});
                $(".relate-show").eq($i).css({"position":"absolute", "left":""+($count*(-25))+"%"});
            }

            for($i = 3; $i >= 0; $i--){
                $(".relate-right-hide").eq($i).animate({
                    left:""+(100+($i*25))+"%",
                }, {duration:200, queue: false});
            }

            for($i = 3; $i >= 0; $i--){
                $(".relate-show").eq($i).animate({
                    left: ""+($i*24.4)+"%"
                }, {duration:200, queue: false});
            }
        }   
        else{
            if($(".relate-left-hide").length != 0){
                $length = $(".relate-left-hide").length;
                for($i = $length-1, $indexofend= $(".relate-show").length-1; $i >= 0; $i--){
                    $relate_left_hide = $(".relate-left-hide").length-1;
                    $(".relate-show").eq($indexofend).addClass("relate-right-hide");
                    $(".relate-show").eq($indexofend).removeClass("relate-show");
                    $(".relate-left-hide").eq($relate_left_hide).addClass("relate-show");
                    $(".relate-left-hide").eq($relate_left_hide).removeClass("relate-left-hide");
                }

                for($i = $length-1, $index = 0; $i >= 0; $i--, $index++){
                    $(".relate-right-hide").eq($i).css({"position":"absolute", "left":""+((3-$index)*25)+"%", "top":"0"});
                    $(".relate-right-hide").eq($i).animate({
                        left:"100%",
                    }, {duration:200, queue: false});                    
                }

                //Sap xep relate-show
                for($i = 3, $index = $length; $i >= 0; $i--, $index++){
                    $(".relate-show").eq($i).css({"position":"absolute", "left":""+((3-$index)*25)+"%"});
                    $(".relate-show").eq($i).animate({
                        left: ""+((3-$index+$length)*24.4)+"%"
                    }, {duration:200, queue: false});
                }
            }
        }
    });

    $(".relate-right-nav").click(function(){
        if($(".relate-right-hide").length >= 4){
            for($i = 0; $i < 4; $i++){
                $(".relate-show").eq(0).addClass("relate-left-hide");
                $(".relate-show").eq(0).removeClass("relate-show");
                $(".relate-right-hide").eq(0).addClass("relate-show");
                $(".relate-right-hide").eq(0).removeClass("relate-right-hide");
            }

            for($i = 0; $i < $(".relate-right-hide").length; $i++){
                $(".relate-right-hide").css({"position":"absolute", "right":"100%", "top":"0"});
            }

            for($i = $(".relate-left-hide").length - 4, $index = 0, $count = 4; $i < $(".relate-left-hide").length; $i++, $index++, $count--){
                $(".relate-left-hide").eq($i).css({"position":"absolute", "top":"0", "left":""+($index*25)+"%"});
                $(".relate-left-hide").eq($i).animate({
                    left: "-100%"
                }, {duration:200, queue: false});   
            }

            for($i = 0; $i < 4; $i++){
                $(".relate-show").eq($i).css({"position":"absolute", "top":"0", "left":""+(($i+4)*25)+"%"});
                $(".relate-show").eq($i).animate({
                    left: ""+($i*24.4)+"%"
                }, {duration:200, queue: false});
            }
        }   
        else{
            if($(".relate-right-hide").length != 0){
                $length = $(".relate-right-hide").length;
                $position = 0;
                $new_relate_show = 0;
                //$new_relate_show = 3 (co 3 phan tu ben phai can dich chuyen)
                //thay the 3 phan tu ben phai doi ten thanh show 
                //3 phan tu hien tai tinh tu phan tu xuat hien 0->2 thanh left 0 1 2 
                for($i = 0; $i < $length; $i++){
                    $(".relate-show").eq(0).addClass("relate-left-hide");
                    $(".relate-show").eq(0).removeClass("relate-show");
                    $(".relate-right-hide").eq(0).addClass("relate-show");
                    $(".relate-right-hide").eq(0).removeClass("relate-right-hide");
                    $new_relate_show++;
                }
                
                /* 
                    $length = 3 (phan tu ben phai)
                    Lap lai 3 lan duyet 3 phan tu cuoi trong list relate-left-hide va dat giu vi tri' ban dau (chua di chuyen sang ben trai)
                    relate-show la nhung phan tu ben phai (chua dich chuyen sang trai de hien thi)                   

                */
                for($i = $(".relate-left-hide").length - $length; $i < $(".relate-left-hide").length; $i++){
                    $(".relate-left-hide").eq($i).css({"position":"absolute", "top":"0", "left":""+$position+"%"});
                    $position += 25;
                }

                //Dat vi tri nhung phan tu show dang hien thi tai man hinh va nhung phan tu chua hien thi o man hinh (phan tu chua hien thi nam ben phai)
                //$count de tinh vi tri cac phan tu show va $length la so phan tu ben phai ban dau
                for($i = 0, $count = $length; $i < 4; $i++, $count++){
                    $(".relate-show").eq($i).css({"position":"absolute", "top":"0", "left":""+($count*25)+"%"});
                    $(".relate-show").eq($i).animate({
                        left: ""+(($count-$length)*24.4)+"%"
                    }, {duration:200, queue: false});
                }

                $(".relate-left-hide").animate({
                    left: "-100%"
                }, {duration:300, queue: false});

            }
        }
    });

    $(".icon-review i").hover(function(){
        for($i = 0; $i <= $(this).index(); $i++){
            $(".icon-review i").eq($i).removeClass("fa-star-o");
            $(".icon-review i").eq($i).addClass("fa-star");
        }
        for($i = ($(this).index()+1); $i < $(".icon-review i").length; $i++){
            $(".icon-review i").eq($i).removeClass("fa-star");
            $(".icon-review i").eq($i).addClass("fa-star-o");
        }
    }, function(){
        for($i = 0; $i <= $(this).index(); $i++){
            $(".icon-review i").eq($i).removeClass("fa-star");
            $(".icon-review i").eq($i).addClass("fa-star-o");
        }
        if(typeof($(".active-star")) != "undefined" && $(".active-star") !== null) {
            for($i = 0; $i < $(".active-star").length; $i++){
                $(".active-star").eq($i).removeClass("fa-star-o");
                $(".active-star").eq($i).addClass("fa-star");
            }
        }
        
    });

    $(".icon-review i").click(function(){
        for($i = 0; $i <= $(this).index(); $i++){
            $(".icon-review i").eq($i).addClass("active-star");
        }
        for($i = 0; $i <= $(this).index(); $i++){
            $(".icon-review i").eq($i).removeClass("fa-star-o");
            $(".icon-review i").eq($i).addClass("fa-star");    
        }
        for($i = $(this).index()+1; $i < $(".icon-review i").length; $i++){
            $(".icon-review i").eq($i).removeClass("active-star");
            $(".icon-review i").eq($i).removeClass("fa-star");
            $(".icon-review i").eq($i).addClass("fa-star-o");
        }
    });
 
