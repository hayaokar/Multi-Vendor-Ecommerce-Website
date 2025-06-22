$("#search").on('keyup',function (){
    if(($(this).val()).length>2){
        let serach = $(this).val()
        $.ajax({
            type:"POST",
            datatype: "JSON",
            url:"/search-ajax",
            data:{
                "search":serach
            },
            success: function (data){
                console.log(data)

                if(data.length){
                    html = ''
                    $.each(data,function (key,value){
                        html +=  '<a href="'+baseUrl+'/product/details/'+value.id+'/'+value.product_slug+'">'+
                            '<div class="list border-bottom">'+
                                '<div class="row">'+

                                    '<div class="col-md-2">'+

                                        '<img src="'+baseUrl+'/'+value.product_thambnail+'" style="width:40px; height:40px">'+
                                    '</div>'+
                                    '<div class="col-md-10">'+
                                       ' <div class="d-flex flex-column ml-5">'+
                                           ' <span>'+value.product_name+'</span> <small>$'+value.selling_price+'</small>'+

                                        '</div>'+
                                    '</div>'+

                               ' </div>'+
                            '</div>'+
                        '</a>'
                    });
                }else{
                    html = '<span class="text-center text-muted">No products found</span>'
                }
                $('#result-info').html(html)

            }

            })
    }
});
