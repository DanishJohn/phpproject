function hasSelected(){
    if($("#searchBox").val().trim().length == 0){
        return false;
    }
    if($(".showProductSearch").hasClass("selected")){
        return false;
    }
    return true;
}

$(document).ready(function(){
    $("#searchBox").keyup(function(event){
        var txt = $(this).val();
        if(txt.length <= 1){
            $("#result").empty();
        }
        else{
            if(event.which != 32 && event.which != 38 && event.which != 39 && event.which != 40 && event.which!=37 && event.which != 13){
                $("#result").html('');
                $.ajax({
                    url: "quick_search.php",
                    method: "post",
                    data:{search:txt},
                    dataType:"text",
                    success:function(data){
                        $("#result").html(data);
                    }
                });
            }
            else{
                if(event.which == 40){
                    if(!$(".showProductSearch").hasClass("selected")){
                        $(".showProductSearch").eq(0).addClass("selected");
                    }
                    else{
                        var $index = $(".showProductSearch").filter(".selected").index();
                        $(".showProductSearch").eq($index).removeClass("selected");
                        if($index != $(".showProductSearch").length-1){
                            $(".showProductSearch").eq($index+1).addClass("selected");
                        }
                    }
                }
                if(event.which == 38){
                    if(!$(".showProductSearch").hasClass("selected")){
                        $(".showProductSearch").eq($(".showProductSearch").length - 1).addClass("selected");
                    }
                    else{
                        var $index = $(".showProductSearch").filter(".selected").index();
                        $(".showProductSearch").eq($index).removeClass("selected");
                        if($index != 0){
                            $(".showProductSearch").eq($index-1).addClass("selected");
                        }
                    }
                }
                if(event.which == 13){
                    if($(".showProductSearch").hasClass("selected")){
                        var href = $(".selected").children("a").attr("href");
                        location.href = href;
                    }
                }
            }
        }
    }); 
    showSort();
});
