<?php 
include("control_venta.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TEST KONECTA</title>
        <link href="css/styles.css"  type="text/css" media="screen" rel="stylesheet"  />
        <link href="js/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"  type="text/css" media="screen" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css"  type="text/css" media="screen" rel="stylesheet" />       
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="js/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <div class="container">
             <h1 class="text-center">VENTAS</h1>
            <div class="row">
                <div class="col-sm-3">
                    <div class="btn-group-vertical">
                        <a href="index.php" title="" class="btn btn-info btn-lg" ref="producto" role="button">Productos</a>
                        <a href="categoria.php" title="" class="btn btn-info btn-lg" ref="categoria" role="button">Categorias</a>
                        <a href="ventas.php" title="" class="btn btn-secondary btn-lg" ref="venta" role="button">Ventas</a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-bs-toggle="dropdown">Consultas</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item query" href="javascript:void(0);" rel="stock">Top Stock</a>
                                <a class="dropdown-item query" href="javascript:void(0);" rel="vendido">Top producto vendido</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <a class="btn btn-success btn-lg" href="#" title="Crear registro" data-bs-toggle="modal" data-bs-target="#addModal">Crear registro</a>
                    <div class="table-responsive">
                        <table id="main" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Cantidad</th>
                                    <th>Valor total</th>  
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <?php 
                            if(is_array($resVentas) && sizeof($resVentas) > 0){
                                echo "<tbody>";
                                foreach($resVentas as $key => $value){
                                   echo "
                                <tr>
                                    <td>" . $value["ID"] . "</td>
                                    <td>" . $value["producto"]  . "</td>
                                    <td>" . $value["categoria"]  . "</td>
                                    <td>" . $value["cantidad"]  . "</td>
                                    <td>" . $value["valor"]  . "</td>
                                    <td>" . $value["fecha"]  . "</td>
                                </tr>";
                                }
                                echo "</tbody>";
                            }
                            ?>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Cantidad</th>
                                    <th>Valor total</th>  
                                    <th>Fecha</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- The Modal -->
                    <div class="modal" id="addModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Crear registro</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="was-validated" id="frmaddVenta">
                                    <div class="mb-3">
                                        <label for="producto" class="form-label">Producto:</label>
                                        <select class="form-select" class="form-control" name="id_producto" id="id_producto" required>
                                            <option value="">Seleccione</option>
                                            <?php
                                            if(is_array($resProductos) && sizeof($resProductos) > 0){
                                                foreach($resProductos as $key => $value){
                                                echo "
                                                <option value='" . $value["ID"] . "'>" . $value["nombre"] . "</option>";
                                                }
                                            
                                            }
                                            ?>
                                        </select>
                                        <div class="valid-feedback">Valido</div>
                                        <div class="invalid-feedback">Campo esta vacio.</div>
                                    </div>                                    
                                    <div class="mb-3 mt-3">
                                        <label for="cantidad" class="form-label">Cantidad:</label>
                                        <input type="text" class="form-control" id="cantidad" placeholder="Ingrese la cantidad" name="cantidad" maxlength = "4" minlength = "1" pattern = "[0-9]*" required>
                                        <div class="valid-feedback">Valido</div>
                                        <div class="invalid-feedback">Campo esta vacio o no es numerico.</div>
                                    </div>
                                    <input type="hidden" name="action" value="add" />
                                    <button type="button" class="btn btn-primary" id="saveVenta">Guardar</button>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>

                            </div>
                        </div>
                    </div>                                   
                </div>
            </div>
        </div>
    </body>
</html>