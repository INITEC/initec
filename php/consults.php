<?php 
 
include_once 'conexion.php';

$pdoconexion= new conexion(); 
$pdoconexion->abrir();
# INICIO DE SESION #
if (isset($_REQUEST['inicia'])) {


    $documento= $_POST['email'];
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
            $_SESSION['cod_Us']=$row['cod_user_sesion'];
            $_SESSION['idUsuVid']=$row['nomb_user'].' ';
            header('location:?option=home&x=2');
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

# CARGA SLIDE SHOW DEL HOME #

if (isset($_POST['slider'])) {
    $es = 'activo';
    $sql = "SELECT * FROM slider where estado = ?";
    $result=$pdoconexion->consulta($sql);
    $result->bindParam(1,$es);
    $result->execute();
    $cant=$result->rowCount();
    if($cant > 0){
        $dat=$result->fetchAll();
        $max = $cant;
        if(!empty($dat)){
           foreach ($dat as $row) {
               if($cant == $max){
                   echo '<div class="item active" id="'.$max.'">';
                   echo '<a href=""><img src="'.$row['img_slider'].'" alt="" class="slider"></a>';
                   echo '<div class="hero">';
                   echo '<hgroup>';
                   echo '<h1>'.$row['titulo'].'</h1>';
                   echo '<p>'.$row['contenido'].'</p>';
                   echo '</hgroup>';
                   echo '</div>';
                   echo '</div>';   
                   $max=$max-1;
               }
               else{
                    echo '<div class="item" id="'.$max.'">';
                    echo '<a href=""><img src="'.$row['img_slider'].'" alt="" class="slider"></a>';
                    echo '<div class="hero">';
                    echo '<hgroup>';
                    echo '<h1>'.$row['titulo'].'</h1>';
                    echo '<p>'.$row['contenido'].'</p>';
                    echo '</hgroup>';
                    echo '</div>';
                    echo '</div>';  
                    $max=$max-1;
                }

            } 
        }


    }
    else{
        echo $cant;
    }
}
# FIN CARGA DEL SLIDE SHOW DEL HOME #

#CARGA TIPO CURSO HOME (PRE-INCUBA-ACELERA) #

if (isset($_POST['tipo_curso'])) {
    $sql = "SELECT * FROM tipo_programa";
    $result = $pdoconexion->consulta($sql);
    $result->execute();
    $cue=$result->rowCount();
    if($cue > 0){
        $data=$result->fetchAll();
        if (!empty($data)) {
            foreach ($data as $row) {
                ?>
                    <div class="col-xs-12 col-md-4 col-sm-12">
                        <img src="<?php echo $row['img_tipo_curso']; ?>" class="  inter" alt="IMAGEN <?php echo $row['desc_tipo']; ?>">
                        <a class="cont_program" href="<?php echo $row['redi']; ?>" id="<?php echo $row['cod_tipo']; ?>"><h3 class="tittle"><?php echo $row['desc_tipo']; ?></h3></a>
                        <div class="raya"></div>
                        <div class="content">
                            <?php echo $row['explica_tipo']; ?>
                        </div>
                    </div>

                <?php
            }
        }
    }
    
}

#FIN CARGA TIPO CURSO HOME (PRE-INCUBA-ACELERA) #

# CARGA DE ALIADOS ESTRATEGICOS #
if (isset($_POST['aliados'])) {
    $sql="SELECT * FROM aliados";
    $stmt=$pdoconexion->consulta($sql);
    $stmt->execute();
    $cue=$stmt->rowCount();
    if($cue > 0){
        $dat=$stmt->fetchAll();
        if (!empty($dat)) {
            foreach ($dat as $row) {
                ?>
                
                    
                      <div class="col-md-3">
                        <a class="" href="#"><img class="allies-init" alt="" src="<?php echo $row['logo']; ?>"></a>
                      </div>                            

                <?php            
            }        
        }
    }
}
# FIN ALIADOS ESTRATEGICOS #



if(isset($_POST['videos'])){
    $estado = '0';
    $cod = $_POST['videos'];
    $sql = "SELECT * FROM videos WHERE programa = :cod and estado = :est";
    $stmt=$pdoconexion->consulta($sql);
    $stmt->execute(array('cod' => $cod,'est'=>$estado));
    $cant=$stmt->rowCount();
    if ($cant>0) {
        $dat = $stmt->fetchAll();
        if (!empty($dat)) {
            foreach ($dat as $row) {
                ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 vid">
                        <?php echo $row['url_video']; ?>
                        <h3 class="text-center tittle"><?php echo $row['titulo']; ?></h3>
                        <p class="text-center msj-vid"><?php echo $row['descripcion'] ?></p>
                    </div>

                <?php
            }
        }
    }
}
if(isset($_POST['galeria'])){
    $est = 0;
    $cod = $_POST['galeria'];
    $sql= "SELECT * FROM galeria WHERE programa = :gal AND estado = :std  limit 5";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':gal',$cod);
    $result->bindParam(':std',$est);
    $result->execute();
    $cont = $result->rowCount();
    if($cont>0){
        $dat=$result->fetchAll();
        $n=$cont;
        if(!empty($dat)){
            foreach ($dat as $key) {
                if($cont==$n){
              ?>
                
                    <div class="col-xs-12 col-sm-7">
                        <img class="gale enc" src="<?php echo $key['src_img']; ?>" alt="">
                    </div>
                    <?php
                    $n=$n-1;
                }
                elseif(($cont-1)==$n)
                {
                ?>
                    <div class="col-xs-12 col-sm-5">
                        <img class="gale" src="<?php echo $key['src_img']; ?>" alt="">
                    </div>
                <?php 
                $n=$n-1;
                }
                else{
                    ?>
                    <div class="col-xs-12 col-md-4">
                        <img class="gale" src="<?php echo $key['src_img']; ?>" alt="">
                    </div>
                <?php
                }  
            }
        }
    }

}

if (isset($_POST['infograma'])) {
    $id = $_POST['infograma'];
    $sql = "SELECT * FROM infogramas WHERE tipo_program = :cod";
    $stmt = $pdoconexion->consulta($sql);
    $stmt->execute(array('cod' =>$id));
    $con = $stmt->rowCount();
    if($con == 1){
        $dat = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($dat);
            echo '<img src="'.$url_info.'" class="infog" alt="Infograma">';
    }
}

if (isset($_POST['cursos'])) {
    $desc=2;
    $id=$_POST['cursos'];
    $sql="SELECT * FROM curso, rol_curso, tipo_programa, version_curso WHERE version_curso.rol_curso = rol_curso.cod_rol AND version_curso.tipo_curso = tipo_programa.cod_tipo AND version_curso.id_curso = curso.id_curso AND  rol_curso.cod_rol = :des AND version_curso.tipo_curso = :cod ";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':des',$desc);
    $result->bindParam(':cod',$id);
    $result->execute();
    $cant=$result->rowCount();
    if($cant>0){
        $dat = $result->fetchAll();
        if (!empty($dat)) {
            foreach ($dat as $key) {
                $ds=$key['id_curso'];
                ?>
                <table class="table">
                    <thead class="conte">
                        <th class=" btn-success text-center "><a href="?option=video"><?php echo $key['nomb_curso']; ?></a></th>
                    </thead>
                    <tbody class="text-center ">
                        <?php 
                        $sql = "SELECT * FROM temas,curso WHERE curso.id_curso = temas.id_curso AND temas.id_curso = :code";
                        $stmt = $pdoconexion->consulta($sql);
                        $stmt->bindParam(':code',$ds);
                        $stmt->execute();
                        $ct=$stmt->rowCount();
                        if($ct>0){
                                $dat = $stmt->fetchAll();
                                foreach ($dat as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nomb_tema']; ?></td>
                                </tr>
                                <?php
                            }    
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
                <?php
            }
        }
    }
}

if (isset($_POST['complementarios'])) {
    $desc=3;
    $id=$_POST['complementarios'];
    $sql="SELECT * FROM curso, rol_curso, tipo_programa, version_curso WHERE version_curso.rol_curso = rol_curso.cod_rol AND version_curso.tipo_curso = tipo_programa.cod_tipo AND version_curso.id_curso = curso.id_curso AND  rol_curso.cod_rol = :des AND version_curso.tipo_curso = :cod ";
    $result = $pdoconexion->consulta($sql);
    $result->bindParam(':des',$desc);
    $result->bindParam(':cod',$id);
    $result->execute();
    $cant=$result->rowCount();
    if($cant>0){
        $dat = $result->fetchAll();
        if (!empty($dat)) {
            foreach ($dat as $key) {
                $ds=$key['id_curso'];
                ?>
                <table class="table">
                    <thead class="conte">
                        <th class=" btn-success text-center "><a href="?option=informacion"><?php echo $key['nomb_curso']; ?></a></th>
                    </thead>
                    <tbody class="text-center ">
                        <?php 
                        $sql = "SELECT * FROM temas,curso WHERE curso.id_curso = temas.id_curso AND temas.id_curso = :code";
                        $stmt = $pdoconexion->consulta($sql);
                        $stmt->bindParam(':code',$ds);
                        $stmt->execute();
                        $ct=$stmt->rowCount();
                        if($ct>0){
                                $dat = $stmt->fetchAll();
                                foreach ($dat as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nomb_tema']; ?></td>
                                </tr>
                                <?php
                            }    
                        }
                        
                        ?>
                        
                    </tbody>
                </table>
                <?php
            }
        }
    }
}

if(isset($_POST['head'])){
    $cod = $_POST['head'];
    $sql="SELECT * FROM tipo_programa where cod_tipo = :img";
    $result=$pdoconexion->consulta($sql);
    $result->bindParam(':img',$cod);
    $result->execute();
    $ct=$result->rowCount();
    if ($ct>0) {
        $dat=$result->fetch(PDO::FETCH_ASSOC);
        extract($dat);
        ?>
        <img src="<?php echo $img_tipo_curso ?>" class="banner" alt="Programas de preincubación">
        <div class="hero_pro">
            <hgroup>
                <h1 class="ini"><?php echo $desc_tipo ?></h1>        
                
                <p><?php echo $explica_tipo ?></p>
                <button class="btn btn-info">Inscribirme</button> 
                <button class="btn btn-info">Más información</button>
            </hgroup>

        </div> 
        <?php
    }
}


?>