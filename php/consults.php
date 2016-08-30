<?php
    include_once 'conexion.php';

    $pdoconexion= new conexion(); 
    $pdoconexion->abrir();

 if (isset($_REQUEST['login'])) {
 	 

    $tipoiden= $_POST['sel']; 
    $documento= $_POST['usuario'];
    $pass= sha1($_POST['password']);

    $sql = "SELECT * from inicio_sesion where identificacion = :id";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->bindParam(':id', $documento);
    $stmt->execute();
      $cont = $stmt->rowCount();
      if($cont == 1){
 	
 	$sql="SELECT * from inicio_sesion,usuarios where  inicio_sesion.identificacion = usuarios.identificacion and tipo_documento = ?  and inicio_sesion.identificacion = ? and password = ?";
    $result=$pdoconexion->consulta($sql);
    $result->bindParam(1,$tipoiden);  
    $result->bindParam(2,$documento);
    $result->bindParam(3,$pass);
    

    $result->execute();
    $res=$result->fetchAll();
    if (!empty($res)) {
    	foreach ($res as $row) {
            $_SESSION['cod']=$row['identificacion'];
    		$_SESSION['idUsu']=$row['nombres'].' '.$row['primerApellido'];
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

if(isset($_POST['oprol'])){
    $ses = $_POST['sesion'];

    $sql = "SELECT * FROM roles,rolusuario,usuarios WHERE usuarios.identificacion = rolusuario.iden_user AND roles.id_rol = rolusuario.id_rol AND iden_user = :cod";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':cod',$ses);
    $result->execute();
    $cont = $result->rowCount();
    if($cont > 0){
        $dat = $result->fetchAll();
            echo "<option value=''>Seleccionar</option>";
        foreach($dat as $rows){
            echo "<option value='".$rows['id_rol']."'>".$rows['desc_rol']."</option>";
        }
    }
    else
    {
        echo "No se encontraron registros";
    }
}

if(isset($_POST['cambio'])){
    $user = $_POST['user'];
    $act = sha1($_POST['act']);
    $new1 = sha1($_POST['new1']);

    $sql = "SELECT * FROM inicio_sesion WHERE identificacion = :user and password = :pass";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':user',$user);
    $result->bindParam(':pass',$act);
    $result->execute();
    $num=$result->rowCount();
    if ($num==1) {
            $sql="UPDATE inicio_sesion SET password = :new WHERE identificacion = :user";
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

if(isset($_POST['op'])){

    $op = $_POST['op']; 

    if ($op==1) {
    
        $sql = "SELECT * FROM detalle_programa";
        $insert = $pdoconexion->consulta($sql);
        $insert->execute();
        $con = $insert->rowCount();
        if($con>0){
            $fichas = $insert->fetchAll();

            echo "<option>Select..</option>";
            foreach ($fichas as $row) {
                echo "<option value='".$row['Cod_ficha']."'>".$row['Cod_ficha']."</option>";
            }
        }
        else{
            echo "No se encuetran datos";
        }
    }


    if ($op==2) {


        $sql = "SELECT * FROM regional";
        $insert = $pdoconexion->consulta($sql);
        $insert->execute();

        $fichas = $insert->fetchAll();

        echo "<option>Select..</option>";
        foreach ($fichas as $row) {
            echo "<option value='".$row['id_reg']."'>".$row['nomb_regional']."</option>";
        }

    }

    if ($op==3) {

        $regional = $_POST['regional'];

        $sql = "SELECT * FROM centro_formacion WHERE id_reg = ?";
        $insert = $pdoconexion->consulta($sql);
        $insert->bindParam(1,$regional);
        $insert->execute();

        $centros = $insert->fetchAll();
        echo "<option>Select..</option>";

        foreach ($centros as $row) {
            echo "<option value='".$row['id_centro']."'>".$row['nomb_centro']."</option>";
        }

    
    }

    if ($op == 4){

    $codf = $_POST['codf'];
    $centroform = $_POST['centroform'];
    $regional = $_POST['regional'];
    $nombreup = $_POST['nombreup'];
    $programaResp = $_POST['programaResp'];
    $ubicacion = $_POST['ubicacion'];
    $proyectobys = $_POST['proyectobys'];
    $nombrePro = $_POST['nombrePro'];
    $emppartc = $_POST['emppartc'];
    $palaclaves = $_POST['palabrasClaves'];
    $tiempoeje = $_POST['tiempoeje'];
    $liderup = $_POST['liderup'];
    

    $sql = 'INSERT INTO unidad_productiva(cod_ficha, centro_formacion, regional, nombre_up, programa_responde, ubicacion_up, proyecto_ByS, nombre_Proyecto, emp_participantes, palabras_Clave , tiempo_ejecucion, lider_up) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
    $insert = $pdoconexion->consulta($sql);
        
        $insert->bindParam(1,$codf);
        $insert->bindParam(2,$centroform);
        $insert->bindParam(3,$regional);
        $insert->bindParam(4,$nombreup);
        $insert->bindParam(5,$programaResp);
        $insert->bindParam(6,$ubicacion);
        $insert->bindParam(7,$proyectobys);
        $insert->bindParam(8,$nombrePro);
        $insert->bindParam(9,$emppartc);
        $insert->bindParam(10,$palaclaves);
        $insert->bindParam(11,$tiempoeje);
        $insert->bindParam(12,$liderup);
        $insert->execute();
        $a=$insert->rowCount();
        if($a ==1 ){
            echo "registro ingresado";

        }

        else{
            echo "Error";
        }


    
    }


    if ($op==5) {
    
        $ficha= $_POST['ficha'];

        $sql = "SELECT * FROM programaap , usuarios WHERE programaap.identificacion = usuarios.identificacion AND programaap.cod_ficha = ?";
        $insert = $pdoconexion->consulta($sql);
        $insert->bindParam(1,$ficha);
        $insert->execute();

        $fichas = $insert->fetchAll();
        echo "<option>Select..</option>";

        foreach ($fichas as $row) {
            echo "<option value='".$row['identificacion']."'>".$row['identificacion']."- ".$row['nombres']." ".$row['primerApellido']."</option>";
        }

    }

    //* insert new user 
     if ($op==8) {
    
        $nis= $_POST['nis'];
        $sql="SELECT * FROM usuarios WHERE nis = ?";
        $consult = $pdoconexion->consulta($sql);
        $consult->bindParam(1,$nis);
        $consult->execute();
        $a=$consult->rowCount();
        if($a == 0  ){
           $nom= $_POST['nom'];
           $prap= $_POST['prap'];
           $segap= $_POST['segap'];
           $tipdoc= $_POST['tipdoc'];
           $ident= $_POST['ident'];
           $fnac= $_POST['fnac'];
           $sex= $_POST['sex'];
           $tel= $_POST['tel'];
           $direcc= $_POST['direcc'];
           $email= $_POST['email'];
           $rh= $_POST['rh'];
           $est= $_POST['est'];

           $sqli="INSERT INTO usuarios VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
           $insert = $pdoconexion->consulta($sqli);
           $insert->bindParam(1,$nis);
           $insert->bindParam(2,$nom);
           $insert->bindParam(3,$prap);
           $insert->bindParam(4,$segap);
           $insert->bindParam(5,$tipdoc);
           $insert->bindParam(6,$ident);
           $insert->bindParam(7,$fnac);
           $insert->bindParam(8,$sex);
           $insert->bindParam(9,$tel);
           $insert->bindParam(10,$direcc);
           $insert->bindParam(11,$email);
           $insert->bindParam(12,$rh);
           $insert->bindParam(13,$est);
           $insert->execute();
           $b=$insert->rowCount();
           echo $nis;
            if($b == 1 )
            {
                 echo "<div class='panel panel-succes'>El usuario fue registrado exitosamente </div>";
            }
            else
            {
                echo "<div class='panel panel-danger'>Error al registrar el usuario </div>";
            }
        }
        else
        {
            echo "<div class='panel panel-danger'>El usuario ya se encuentra registrado </div>";
        }
    }
}

if(isset($_POST['opRol'])){
    $opRol = $_POST['opRol'];

    if($opRol == 1){
        #Aprendiz
        ?>
        <li id="informacion">
            <a href="#"><i class="fa fa-fw fa-info-circle"></i> Información</a>
        </li>
        <li id="estructura">
            <a href="#"><i class="fa fa-fw fa-list"></i> Estructura</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#Admon"><i class="fa fa-fw fa-sitemap"></i> Administración <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="Admon" class="collapse">
                <li id="constitucion">
                    <a href="#">Constitución empresarial</a>
                </li>
                <li id="DOFA">
                    <a href="#">Matriz DOFA</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#Mercadeo"><i class="fa fa-fw fa-line-chart"></i> Mercadeo <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="Mercadeo" class="collapse">
                <li id="demanda">
                    <a href="#">Demanda</a>
                </li>
                <li id="ana-comp">
                    <a href="#">Analisis Competencia</a>
                </li>
                <li id="est-merc">
                    <a href="#">Estrategias Mercado</a>
                </li>
            </ul>
        </li>
        <li id="operacion">
            <a href="#"><i class="fa fa-fw fa-pie-chart"></i> Operación</a>
        </li>
        <li id="evidencias">
            <a href="#"><i class="fa fa-fw fa-eye"></i> Evidencias</a>
        </li>
        <li id="aprovechamiento">
            <a href="#"><i class="fa fa-fw fa-file-word-o"></i> Aprovechamiento TIC</a>
        </li>
        <?php
    }
    elseif($opRol == 2){
        #Instructor
        ?>
        <li class="cons-fic">
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Consultar Fichas</a>
        </li>
        <?php
    }
    elseif($opRol == 3){
        #Unidades Productivas
        ?>
        <li id="reg-up">
            <a href="#"><i class="fa fa-fw fa-plus"></i> Registrar UP</a>
        </li>
        <li id="reg-program">
            <a href="#"><i class="fa fa-fw fa-plus"></i> Registrar Programa</a>
        </li>
        <li id="reg-ficha">
            <a href="#"><i class="fa fa-fw fa-plus"></i> Registrar Ficha</a>
        </li>
        <li id="reg-user">
            <a href="#"><i class="fa fa-fw fa-user"></i> Registrar Usuario</a>
        </li>
        <li id="add-rol">
            <a href="#"><i class="fa fa-fw fa-plus"></i> Asignar Roles</a>
        </li>
        <li id="add-rol">
            <a href="#"><i class="fa fa-fw fa-search"></i> Listar aprendices</a>
        </li>

        <?php
    }
}
if (isset($_POST['form'])) {
    
    $cod_pro=$_POST['cod_pro'];
    $ver_pro=$_POST['ver_pro'];
    $nom_pro=$_POST['nom_pro'];
    $niv_pro=$_POST['niv_pro'];

    $sql="INSERT INTO programa(cod_programa,version_programa,nombre_programa,nivel_programa) VALUES(?,?,?,?)";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(1, $cod_pro);
    $result->bindParam(2, $ver_pro);
    $result->bindParam(3, $nom_pro);
    $result->bindParam(4, $niv_pro);

    $result->execute(); 
    $cont= $result->rowCount();
    if ($cont==1) {
        echo "Dato Insertado";
    }
    else
    {
        echo "Dato No Insertado";
    }
}

if(isset($_POST['num']))
{
    $num = $_POST['num'];
    if ($num==1) 
    {
        $sql="SELECT * FROM programa group by cod_programa";
        $result=$pdoconexion->consulta($sql);
        $result->execute();
        $result=$result->fetchAll();

        foreach ($result as $row) 
        {
            echo "<option value='".$row['cod_programa']."'>".$row['cod_programa']."</option>";
        }
    }

    if ($num==2) 
    {
        $id=$_POST['id'];
        $sql="SELECT * FROM programa where cod_programa=:id";
        
        $result=$pdoconexion->consulta($sql);
        $result->bindParam(":id",$id);
        $result->execute();
        if($result->rowCount()>0)
        {
        $result=$result->fetchAll();
            foreach ($result as $row) 
            {
                echo "<option value='".$row['version_programa']."'>".$row['version_programa']."</option>";
            }
        }
        else
        {
            echo "Sin Datos";           
        }
    }

    if ($num==3) 
    {
        $codficha=$_POST['codficha'];
        $codprograma=$_POST['codprograma'];
        $verprograma=$_POST['verprograma'];
        $fechainicio=$_POST['fechainicio'];
        $fechafin=$_POST['fechafin'];

        $sql="INSERT INTO detalle_programa(Cod_ficha, cod_programa, version_programa, fecha_inicio, fecha_fin) values (:codficha, :codprograma, :verprograma, :fechainicio, :fechafin)";
        
        $result=$pdoconexion->consulta($sql);
        $result->bindParam(":codficha",$codficha);
        $result->bindParam(":codprograma",$codprograma);
        $result->bindParam(":verprograma",$verprograma);
        $result->bindParam(":fechainicio",$fechainicio);
        $result->bindParam(":fechafin",$fechafin);
        $result->execute();
        if($result->rowCount()>0)
        {
            echo "se inserto correctamente";
        }
        else
        {
            echo "no se ha podido insertar";            
        }
    }
}

 ?>
