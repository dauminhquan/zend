$(document).ready(
    $(".list_item").bind('input',function () {//sự kiện chạy khi text thay đổi
        $(this).parent().find("div.input-group-addon").addClass("open")
        $(this).parent().find("div.input-group-addon > a").attr("aria-expanded",true)
        search($(this).val())
    })
)
function search(text) {
    var menu_size = $(".menu-size > li > a")
    $('.new-size > a').html("")
    menu_size.attr("style","display:block")
    var data = [];
    for(var i=0;i<menu_size.length;i++)
    {
        if(menu_size[i].text.toUpperCase().search(text.toUpperCase()) == -1) {
            data.push(i)
        }
    }
    for(i=0;i<data.length;i++)
    {
        menu_size.eq(data[i]).attr("style","display:none")
    }
    if(data.length == menu_size.length )
    {
        $('.new-size > a').attr('style', 'display:block')
        $('.new-size > a').html("Thêm mới : "+text)
    }

}