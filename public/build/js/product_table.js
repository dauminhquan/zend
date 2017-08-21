$(document).ready(
  $("#product_table").DataTable(),
    $("#product_table_filter").addClass("col-lg-12"),
    $('#product_table_filter > label > input').addClass('form-control'),
    $("#product_table_length").addClass("col-lg-12"),
    $("#show").click(function () {
        var checkbox = $("#product_table input[type='checkbox']");
        var data = [];
        for(var i=1;i<checkbox.length;i++)
        {
            if(checkbox[i].checked === true)
                data.push(checkbox[i].id.slice(9))
        }
        $.post(
            'product/delete',
            {
                value : data
            },
            function (result) {

                if(result['result'] === true)
                {
                    $("#product_table input[type='checkbox']:checked").parent().parent().parent().remove()
                }
                else
                {
                    console.log(result['result'])
                }
            },
            'json'
        )

    })


);


