<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/js/demo.js') }}"></script>
{{-- toast --}}
<script src="{{ asset('template/toast/dist/jquery.toast.min.js') }}"></script>

<script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>



<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('form').append('{{csrf_field()}}');

    $('.button-destroy').on('click', function(e){
        e.stopPropagation();
        e.preventDefault();
        var a = $(this);
        var _token = $('meta[name="csrf-token"]').attr('content');
        swal.fire({   
            title: a.data('trans-title'),
            text: a.data('trans-subtitle'),
            icon: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",
            confirmButtonText: a.data('trans-button-confirm'), 
            cancelButtonText: a.data('trans-button-cancel'), 
        }).then( (result) =>{
            if (result.isConfirmed) {
                var form = 
                $('<form>', {
                    'method': 'POST',
                    'action': a.attr('href')
                });

                var token = 
                $('<input>', {
                    'name': '_token',
                    'type': 'hidden',
                    'value': _token
                });

                var hiddenInput =
                $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': a.data('method')
                });

                form.append(token, hiddenInput).appendTo('body').submit();
            }
        })
    })

    $(document).on('click','.deleteCartProduct',function(e){
        e.preventDefault();
        var uuid = $(this).data('produuid');
        $.ajax({
            type: "POST",
            url: "/menu/deleteProductCarrito/",
            data: {uuid} ,
            dataType: 'json',
            success: function (data) {
                $("#loader").removeClass("is-active");
                if (data.statusCode == 100) {
                    $('.cartCount').html(data.data.length)
    
                    var html = ``;
                    $.each(data.data,function(k,prod){
                        var variantes = ``;
                        $.each(prod.options,function(j,opt){
                            variantes += `${opt.name} /`
                        })
                        html += `<a href="#" class="dropdown-item" data-prodUuid="${prod.uuid}">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="${prod.image}" alt="" class="img-thumbnail">
                                            </div>
                                            <div class="col-7">
                                                <p>${prod.name}</p>
                                                <p style="font-size:.75rem ">${variantes}</p>
                                            </div>
                                            <div class="col-1">
                                                <i class="fas fa-times deleteCartProduct" data-prodUuid="${prod.uuid}"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>`
                    })

                    $('.cartCount').html(data.data.length)
                    $('#cartProducts').html(html);

                    $.toast({
                        heading: 'Producto eliminado',
                        text: 'Producto eliminado correctamente.',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'success',
                        hideAfter: 1500
                    
                    });
                }else{
                    $.toast({
                        heading: 'Error',
                        text: 'Error al eliminar el produto.',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                }
        
            },
            error: function () {
                $("#loader").removeClass("is-active");
                $.toast({
                    heading: 'Error',
                    text: 'Error al eliminar el produto.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500
                
                });
            }
        });
    })

    $(function(){
        getGarrito()
        getSucursales();
    })
})

function getGarrito(){
    // $("#loader").addClass("is-active");
    
    $.ajax({
        type: "GET",
        url: "/menu/getCarrito/",
        data: {} ,
        dataType: 'json',
        success: function (data) {
            $("#loader").removeClass("is-active");
            $('.cartCount').html(data.length)

            var html = ``;
            $.each(data,function(k,prod){
                var variantes = ``;
                $.each(prod.options,function(j,opt){
                    variantes += `${opt.name} /`
                })
                 html += `<a href="#" class="dropdown-item" data-prodUuid="${prod.uuid}">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="${prod.image}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-7">
                                        <p>${prod.name}</p>
                                        <p style="font-size:.75rem ">${variantes}</p>
                                    </div>
                                    <div class="col-1">
                                        
                                        <i class="fas fa-times deleteCartProduct" data-prodUuid="${prod.uuid}"></i>
                                    </div>

                                </div>
                            </a>
                            <div class="dropdown-divider"></div>`
            })
            html += `<a href="{{url('menu/showOrder')}}" class="dropdown-item">Cerrar orden</a>`;
            $('#cartProducts').html(html);
        },
        error: function () {
            
        }
    });
}


function getSucursales(){
    // $("#loader").addClass("is-active");
    
    $.ajax({
        type: "GET",
        url: "/menu/getFilials/",
        data: {} ,
        dataType: 'json',
        success: function (data) {
            $("#loader").removeClass("is-active");
            var html = ``;
            $.each(data,function(k,filial){

                html += `<li><a href="#" class="dropdown-item"> ${filial.name} </a></li>`;
            })
            $('#lstFilials').html(html);
        },
        error: function () {
            
        }
    });
}

</script>