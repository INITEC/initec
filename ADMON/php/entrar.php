<?php
    include_once 'conexion.php';

    $pdoconexion= new conexion(); 
    $pdoconexion->abrir();
# INICIO DE SESION #
 if (isset($_REQUEST['login'])) {
 	 

    $documento= $_POST['usuario'];
    $pass= sha1($_POST['password']);

    $sql = "SELECT * from usuarios where email = :id";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->bindParam(':id', $documento);
    $stmt->execute();
      $cont = $stmt->rowCount();
      if($cont == 1){
 	      $resp=$stmt->fetch(PDO::FETCH_ASSOC);
          extract($resp);{
                $documento = $cod_user;
            }
 	$sql="SELECT * from inicio_sesion,usuarios where  inicio_sesion.cod_user_sesion = usuarios.cod_user and inicio_sesion.cod_user_sesion = ? and password = ?";
    $result=$pdoconexion->consulta($sql);
    $result->bindParam(1,$documento);
    $result->bindParam(2,$pass);
    

    $result->execute();
    $res=$result->fetchAll();
    if (!empty($res)) {
    	foreach ($res as $row) {
            $_SESSION['cod']=$row['cod_user_sesion'];
    		$_SESSION['idUsu']=$row['nomb_user'].' '.$row['apellido_user'];
    		header('location:?option=home');
    	}
    }else{
    	echo "<div class='list-group alert alert-warning col-xs-12'><strong>Aviso!</strong>Contraseña y/o documento invalido";
 	 }
    }
    else
    {
        echo "<div class='list-group alert alert-danger col-xs-12'><strong>Aviso!</strong>El usuario no se encuentra registrado en el sistema.";
    }
}

# FIN INICIO DE SESION #

#ROL DEL USUARIO #

if(isset($_POST['oprol'])){
    $ses = $_POST['sesion'];

    $sql = "SELECT * FROM roles,user_rol,usuarios WHERE usuarios.cod_user = user_rol.cod_user_rol AND roles.id_roles = user_rol.cod_rol_user AND cod_user_rol = :cod";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':cod',$ses);
    $result->execute();
    $cont = $result->rowCount();
    if($cont > 0){
        $dat = $result->fetchAll();
            echo "<option value=''>Seleccionar</option>";
        foreach($dat as $rows){
            echo "<option value='".$rows['id_roles']."'>".$rows['desc_rol']."</option>";
        }
    }
    else
    {
        echo "No se encontraron registros".$ses;
    }
}

#FIN ROL DEL USUARIO #


#CARGAR ROLES AL USUARIO #

if(isset($_POST['opRol'])){
    $opRol = $_POST['opRol'];
    $sql= "SELECT * FROM cont_rol, cont_opc WHERE cont_rol.cod_cont_rol = cont_opc.cod_opc and cont_rol.id_rol = :rol";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->bindParam(':rol',$opRol);
    $stmt->execute();
    $co = $stmt->rowCount();
    if($co > 0){
        $dat = $stmt->fetchAll();
        foreach ($dat as $row) {
            # code...
            ?>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#<?php echo $row['cod_opc'];?>"><?php echo " ".$row['desc_contenido']; ?> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="<?php echo $row['cod_opc'];  ?>" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                    </ul>
                </li>
                
            <?php
        }
    }
}

#FIN CARGAR ROLES AL USUARIO #


#OBTENER RUTA REDIRRECION OPCIONES #
if(isset($_POST['redi'])){
    $ruta = $_POST['redi'];
    $sql = "SELECT * FROM redireccion,url_opc WHERE redireccion.id_red = url_opc.id_url_opc AND url_opc.id_opc_url = ?";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->bindParam(1,$ruta);
    $stmt->execute();
    $cant = $stmt->rowCount();
    if($cant == 1){
        $dat=$stmt->fetch(PDO::FETCH_ASSOC);
        extract($dat);
        echo $url_red;
    }
    else{
        echo "Eror en la consulta";
    }
}

#FIN OBTENER RUTA REDIRECCION OPCIONES #

#LISTAR CURSOS - PROFESOR #
if (isset($_POST['cursos_pro'])) {
    $cur = $_POST['cursos_pro'];

    $sql= "SELECT * FROM curso_usuario, version_curso, curso WHERE curso_usuario.id_curso = version_curso.cod_version AND version_curso.id_curso = curso.id_curso AND curso_usuario.id_user = :cod";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->execute(array('cod' => $cur));
    $c_c = $stmt->rowCount();
    if($c_c >0){
        $reg = $stmt->fetchAll();
        foreach ($reg as $row) {
            ?>
            <tr>
                <td  data-label="Codigo"><?php echo $row['cod_version'];  ?></td>
                <td data-label="Nombre"><?php echo $row['nomb_curso'];  ?></td>
                <td data-label="Inicio"><?php echo $row['fecha_ini'];  ?></td>
                <td data-label="Finalización"><?php echo $row['fecha_fin'];  ?></td>
                <td data-label="Detalles"><button class="label label-success" id='<?php echo $row["cod_version"]; ?>' >Ver lista</button>
                </td>                                       
            </tr>
            <?php
        }
    }
    else{
        echo "No se encuentran cursos asociados";
    }
}

#FIN LISTAR CURSOS PROFESOR #


#LISTAR USUARIOS - PROFESOR #
if(isset($_POST['list_user'])){
    $ti = 'Usuario';
    $red = $_POST['redi'];
    $sql="SELECT * FROM usuarios, user_rol, roles WHERE usuarios.cod_user = user_rol.cod_user_rol AND roles.id_roles = user_rol.cod_rol_user and user_rol.cod_user_rol = :user and roles.desc_rol = :des";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->execute(array('user' => $red, 'des' => $ti));
    $ct = $stmt->rowCount();
    if($ct > 0){
        
    }
    else{
        echo "No se encontraron usuarios";
    }
}

#FIN LISTAR USUARIOS PROFESOR #

#CAMBIO CONTRASEÑA USUARIO #

if(isset($_POST['cambio'])){
    $user = $_POST['user'];
    $act = sha1($_POST['act']);
    $new1 = sha1($_POST['new1']);

    $sql = "SELECT * FROM inicio_sesion WHERE cod_user_sesion = :user and password = :pass";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':user',$user);
    $result->bindParam(':pass',$act);
    $result->execute();
    $num=$result->rowCount();
    if ($num==1) {
            $sql="UPDATE inicio_sesion SET password = :new WHERE cod_user_sesion = :user";
            $result=$pdoconexion->consulta($sql);
            $result->execute(array('new' => $new1,'user' => $user));
            $num=$result->rowCount();
            if ($num==1) {
                echo "El dato se actualizo";
            }
            else
            {
                echo "El dato no se actualizo";
            }
        }
        else{
            echo "Contraseña actual incorrecta";
        }    
}

#FIN CAMBIO DE CONTRASEÑA USUARIO #
 ?>
