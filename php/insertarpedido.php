 <?php
session_start();
include './conexion.php';
if(!isset($_SESSION['carrito'])){
  header("Location: ../index.php");}
$arreglo= $_SESSION['carrito'];
$total=0;
for ($i=0; $i <count($arreglo) ; $i++) { 
  $total=$total+($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']);
}
$password="";
if(isset($_POST['c_account_password'])){
  if($_POST['c_account_password']!=""){
    $password= $_POST['c_account_password'];
  }
}
$conexion ->query("insert into usuario(nit,nombre,telefono,email,password,img_perfil,nivel)
  values(
  '".$_POST['nit']."',
  '". $_POST['nombre']." ".$_POST['apellido']."',
  '".$_POST['telefono']."',
  '".$_POST['correo']."',
  '".sha1($password)."',
  'defaul.jpg',
  'cliente'
  )
  ")or die($conexion ->error);

  $id_usuario = $conexion ->insert_id;

  $fecha = date("Y-m-d h:m:s");
  $conexion -> query("insert into ventas(id_usuario,total,fecha) values($id_usuario,$total,'$fecha')") or die($conexion -> error);
  $id_venta =$conexion->insert_id;

for ($i=0; $i <count($arreglo) ; $i++) { 

  $total=$total+($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']);
  $conexion -> query("insert into productos_venta(id_venta,id_producto,cantidad,precio,subtotal)
    values(
    $id_venta,
    ".$arreglo[$i]['Id'].",
    ".$arreglo[$i]['Cantidad'].",
    ".$arreglo[$i]['Precio'].",
    ".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio'].")")or die($conexion -> error);
  $conexion->query("update productos set inventario =inventario -".$arreglo[$i]['Cantidad']." where id=".$arreglo[$i]['Id'])
   or die($conexion -> error);
}
$conexion ->query("insert into envios(departamento,direccion,id_venta)values
  (
  '".$_POST['departamento']."',
  '".$_POST['direccion']."',
    $id_venta

  )
  ")or die($conexion -> error);
include './php/mail.php';
unset($_SESSION['carrito']);
header("Location: ./pagar.php?id_venta=".$id_venta);
?>