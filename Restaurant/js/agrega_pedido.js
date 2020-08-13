function agrega_pedido(codigo, cantidad){
    var parametros = {
        "codigo" : codigo,
        "cantidad" : cantidad
    };
    $.ajax({
        data: {parametros:parametros},
        url : "agregar_pedido.php",
        type: "POST",
        typedata:text,
        success: function(text){
            alert(text);
        }
    });
}

/*$(document).ready(function(){
    $('#agregar').click(function(){

        var cantidad = $('#cantidad').val();
        var nombre = $('#nombre').val();
        
        $.ajax({
            type:"POST",
            url:"agregar_pedido.php",
            data:{cantidad:cantidad,nombre:nombre}
            typedata:text,
            success: function(text){
                alert(text);
                }
            })
        });
    });*/