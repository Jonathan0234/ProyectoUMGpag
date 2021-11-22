<?php 
session_start();
if(!isset($_SESSION['carrito'])){
  header('Location: ./index.php');
}
$arreglo  = $_SESSION['carrito'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '5c75a9ccd82c3bd559804c1ea172adbc742bab4a';
    window.smartsupp||(function(d) {
      var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
      s=d.getElementsByTagName('script')[0];c=d.createElement('script');
      c.type='text/javascript';c.charset='utf-8';c.async=true;
      c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
    </script>
    <title>Mimi's Cakes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head> 
  <body>
      
  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?> 
 <form action="./php/insertarpedido.php" method="post">
    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
          </div>
        </div>
        <div class="row">
         
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Detalles de facturación</h2>
            <div class="p-3 p-lg-5 border">
              <div class="form-group">
                <label for="c_country" class="text-black">Departamento <span class="text-danger">*</span></label>
                <select id="c_country" class="form-control" name="departamento">
                  <option value="1">Seleccione departamento</option>    
                  <option value="2">Guatemala</option>    
                  <option value="3">El Progreso</option>    
                  <option value="4">Jalapa</option>    
                  <option value="5">Jutiapa</option>    
                  <option value="6">Escuintla</option>    
                  <option value="7">Huehuetenango</option>    
                  <option value="8">Zacapa</option>    
                  <option value="9">Chiquimula</option>    
                </select>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="apellido" class="text-black">Nombre<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="col-md-6">
                  <label for="apellido" class="text-black">Apellido<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="apellido" name="apellido">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="nit" class="text-black">NIT</label>
                  <input type="text" class="form-control" id="nit" name="nit">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="direccion" class="text-black">Dirección <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
              </div>



              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="correo" class="text-black">Correo electrónico<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="correo" name="correo">
                </div>
                <div class="col-md-6">
                  <label for="telefono" class="text-black">Teléfono <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
              </div>

              <div class="form-group">
                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> ¿Crear una cuenta?</label>
                <div class="collapse" id="create_an_account">
                  <div class="py-2">
                    <p class="mb-3">Cree una cuenta ingresando la información</p>
                    <div class="form-group">
                      <label for="c_account_password" class="text-black">Contraseña</label>
                      <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                    </div>
                  </div>
                </div>
              </div>


                

              <div class="form-group">
                <label for="c_order_notes" class="text-black">Notas para la orden </label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Escribe aqui"></textarea>
              </div>

            </div>
          </div>
        
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Tu Orden</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Productos</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                       <?php
                        $total = 0; 
                        for($i=0;$i<count($arreglo);$i++){
                          $total =$total+ ($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']);
                        
                      ?>
                        <tr>
                          <td><?php echo $arreglo[$i]['Nombre'];?> </td>
                          <td>Q<?php echo  number_format($arreglo[$i]['Precio'], 2, '.', '');?></td>
                        </tr>
                    
                        <?php 
                          }
                        ?>
                        <tr>
                          <td>Orden Total</td>
                          <td>Q<?php echo number_format($total, 2, '.', '');?></td>
                        </tr>
                        <tr>
                          <td class="text-success">
                            Descuento
                          </td>
                          <td id="tdTotal">0</td>
                        </tr>
                        <tr>
                          <td> <b>Total Final</b>  </td>
                          <td id="tdTotalFinal" 
                            data-total="<?php echo $total;?>">Q<?php echo number_format($total, 2, '.', '');?></td>
                        </tr>
                      <tr>
                    
                    </tbody>
                  </table>

                 

                  <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">Realizar pago mediante Paypal</p>
          
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Realizar Pedido</button>
                  </div>

                </div>
              </div>
            </div>

          </div>
          
        </div>

      </div>
    </div>
</form>
    <?php include("./layouts/footer.php"); ?> 
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  </body>
</html>