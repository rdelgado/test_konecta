$(document).ready(function () {
    $('#main').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron registros",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron registros",
            "infoFiltered": "(Filtrado de _MAX_ registros)",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            },
            "search": "Buscar:"
        }
    } );

    //producto transact
    $('#saveProducto').on("click", function(){
        $.ajax({
            type: "POST",
            url: "control_producto.php",
            cache:false,
            data: $('#frmaddProducto').serialize(),
            success: function(response){       
                alert(response) ;        
                $("#addModal form")[0].reset();
                $("#addModal").modal('hide');
                location.reload(true);
            }
        });
    });

    $("#addModal").on('hide.bs.modal', function () {
        $("#addModal form")[0].reset();
    });

    $('.editProducto').on("click", function(){
        var id_producto = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: "control_producto.php",
            cache:false,
            data: "ID=" + id_producto + "&action=edit",
            success: function(response){     
                var result = $.parseJSON(response);  
               
                $('#frmupdProducto #nombre').val(result['nombre']);
                $('#frmupdProducto #id_categoria').val(result['id_categoria']);
                $('#frmupdProducto #referencia').val(result['referencia']);
                $('#frmupdProducto #precio').val(result['precio']);
                $('#frmupdProducto #peso').val(result['peso']);
                $('#frmupdProducto #stock').val(result['stock']);
                $('#frmupdProducto #ID').val(result['ID']);
            }
        });
    });

    $('#updProducto').on("click", function(){
        $.ajax({
            type: "POST",
            url: "control_producto.php",
            cache:false,
            data: $('#frmupdProducto').serialize(),
            success: function(response){       
                alert(response);         
                $("#editModal form")[0].reset();
                $("#editModal").modal('hide');
                location.reload(true);
            }
        });
    });

    $('.delProducto').on("click", function(){
        var id_producto = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: "control_producto.php",
            cache:false,
            data: "action=delete&ID=" + id_producto,
            beforeSend: function() {
                // setting a timeout
                return confirm('Realmente desea eliminar el registro?');
            },
            success: function(response){ 
                alert(response);
                location.reload(true);
            }
        });
    });

    //categoria transact
    $('#saveCategoria').on("click", function(){
        $.ajax({
            type: "POST",
            url: "control_categoria.php",
            cache:false,
            data: $('#frmaddCategoria').serialize(),
            success: function(response){       
                alert(response) ;        
                $("#addModal form")[0].reset();
                $("#addModal").modal('hide');
                location.reload(true);
            }
        });
    });

    $("#addModal").on('hide.bs.modal', function () {
        $("#addModal form")[0].reset();
    });

    $('.editCategoria').on("click", function(){
        var id_categoria = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: "control_categoria.php",
            cache:false,
            data: "ID=" + id_categoria + "&action=edit",
            success: function(response){     
                var result = $.parseJSON(response);  
               
                $('#frmupdCategoria #nombre').val(result['nombre']);
                $('#frmupdCategoria #ID').val(result['ID']);
            }
        });
    });

    $('#updCategoria').on("click", function(){
        $.ajax({
            type: "POST",
            url: "control_categoria.php",
            cache:false,
            data: $('#frmupdCategoria').serialize(),
            success: function(response){       
                alert(response);       
                $("#editModal form")[0].reset();
                $("#editModal").modal('hide');
                location.reload(true);
            }
        });
    });

    $('.delCategoria').on("click", function(){
        var id_categoria = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: "control_categoria.php",
            cache:false,
            data: "action=delete&ID=" + id_categoria,
            beforeSend: function() {
                // setting a timeout
                return confirm('Realmente desea eliminar el registro?');
            },
            success: function(response){ 
                alert(response);
                location.reload(true);
            }
        });
    });

    //venta transact
    $('#saveVenta').on("click", function(){
        $.ajax({
            type: "POST",
            url: "control_venta.php",
            cache:false,
            data: $('#frmaddVenta').serialize(),
            success: function(response){       
                alert(response) ;        
                $("#addModal form")[0].reset();
                $("#addModal").modal('hide');
                location.reload(true);
            }
        });
    });

    $("#addModal").on('hide.bs.modal', function () {
        $("#addModal form")[0].reset();
    });

     //venta transact
     $('.query').on("click", function(){
        $.ajax({
            type: "POST",
            url: "control_query.php",
            cache:false,
            data: 'query=' + $(this).attr('rel'),
            success: function(response){       
                alert(response);
            }
        });
    });

});