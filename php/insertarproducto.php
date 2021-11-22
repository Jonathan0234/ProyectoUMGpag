<?php 
include "./conexion.php";
if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio'])&& isset($_POST['inventario'])) {

		$carpeta="../images/";
		$nombre=$_FILES['imagen']['name'];
		$temp=explode('.',$nombre);
		$extension=end($temp);
		$nombreFinal=time().'.'.$extension;
		if($extension=='jpg' || $extension=='png'){
			if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){
				$conexion->query("insert into productos (nombre,descripcion,imagen,precio,inventario) values
				(
				'".$_POST['nombre']."',
				'".$_POST['descripcion']."',
				'$nombreFinal',
				".$_POST['precio'].",
				'".$_POST['inventario']."'
				)")or die($conexion->error);
				echo 'Se insertó correctamente';
				header("Location: ../admin/productos.php?success");
			}else{
				header("Location: ../admin/productos.php?error=No se pudo subir la imagen");
			}
		}else{
			header("Location: ../admin/productos.php?error=Insertar una imagen valida");
		}
	}else{
		header("Location: ../admin/productos.php?error=Llenar todos los campos");
	}
 ?>