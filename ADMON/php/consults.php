<?php 
	include_once 'conexion.php';

    $pdoconexion= new conexion(); 
    $pdoconexion->abrir();


    if (isset($_POST['user_up'])) {
 	 
    	$doc = $_POST['user_up'];

    $sql = "SELECT * FROM regional,centro_formacion,unidad_productiva,rupap WHERE rupap.identificacion = :user";
    $stmt = $pdoconexion->consulta($sql); 
    $stmt->bindParam(':user',$doc);
    $stmt->execute();
      $cont = $stmt->rowCount();
      if($cont >0){ 
          $dat = $stmt->fetch(PDO::FETCH_ASSOC);
          extract($dat);
      ?>
      	<tr>
          <th class="col-sm-2">Centro de Formación</th>
          <th class="col-sm-5"><?php echo $nomb_centro;?> </th>
          <th class="col-sm-2">Regional</th>
          <th class="col-sm-5" colspan="2"><?php echo $nomb_regional; ?></th>
        </tr>
        <tr>
          <th class="col-sm-3">Nombre de la Unidad Productiva</th>
          <th colspan="4" class="codigo" id="<?php echo $cod_up; ?>"><?php echo $nombre_up; ?></th>
        </tr>
        <tr>
          <th class="col-sm-4">Programa de formación al que dá respuesta</th>
          <th colspan="4"><?php echo $programa_responde; ?></th>
        </tr>
        <tr>
          <th class="col-sm-4">Tiempo estimado de ejecucion de la U. P. (meses)</th>
          <th colspan="4"><?php echo $tiempo_ejecucion; ?></th>
        </tr>
        <tr>
          <th class="col-sm-4">Empresas o instituciones que participan en su formación o financiación (Si existe)</th>
          <th colspan="4"><?php echo $emp_participantes; ?></th>
        </tr>
        <tr>
          <th class="col-sm-3" rowspan="2">Lider de la Unidad Productiva</th>
          <?php
            $lid = $lider_up;
            $sql = "SELECT * FROM usuarios,unidad_productiva WHERE usuarios.identificacion = :lid";
            $result = $pdoconexion->consulta($sql);
            $result->execute(array('lid' => $lid));
            $num = $result->rowCount();
            if($num == 1){
              $dts = $result->fetchAll();
              foreach ($dts as $row) {
                # code...
              
          ?>
          <th class="col-sm-1">Nombre Completo</th>
          <th class="col-sm-1">Identificación</th>
          <th class="col-sm-5">Dirección Residencia y Teléfono</th>
          <th class="col-sm-5">Correo Electronico</th>
        </tr>
        <tr>
          <th><?php echo $row['nombres']." ".$row['primerApellido']." ".$row['segundoApellido']; ?></th> 
          <th><?php echo $row['identificacion']; ?></th>
          <th><?php echo $ubicacion_up; ?></th>
          <th><?php echo $row['email']; ?></th>
        </tr>
      <?php
              }
            } 
            else
            {
              echo "Error en la consulta";
            }
      }
      else
      {
      	echo "Hay un error en la consulta";
      }
}

if(isset($_POST['num_apr'])){
  $ses = $_POST['num_apr'];
  $sql = "SELECT * FROM unidad_productiva,rupap WHERE rupap.identificacion = :user";
    $stmt = $pdoconexion->consulta($sql); 
    $stmt->bindParam(':user',$ses);
    $stmt->execute();
      $cont = $stmt->rowCount();
      if($cont >0){ 
          $dat = $stmt->fetch(PDO::FETCH_ASSOC);
          extract($dat);
          $id_up = $cod_up;
          $sql = "SELECT * FROM rupap WHERE cod_up = :id";
          $result = $pdoconexion->consulta($sql);
          $result->execute(array('id' => $id_up));
          $num = $result->rowCount();
          echo $num;
      }
  

}
if(isset($_POST['structure'])){
  $ficha = $_POST['ficha'];
  $plant = $_POST['plant'];
  $justi = $_POST['justi'];
  $
  $sql = "INSERT INTO rup_estructura (cod_up, plan_problema,justificacion_up,obj_general,obj_esp,grado_innovacion,num_instructores,num_aprendices) VALUES (:cod,:plan,:justi,:obj_g,:obj_e,:inno,:inst,:apr)";
  $result->pdoconexion->consulta($sql);
  $result->execute(array('cod' => $ficha ,'plan' => $plant ,'justi' => $just ,'obj_g' => $general ,'obj_e' => $esp ,'inno' => $innov ,'inst' => $int ,'apr' => $aprend));
  $cont = $result->rowCount();
  if($cont > 0){
   /*   for(var i=0; i<4;i++){
         $sql = "INSERT INTO impactos () Values()";
      }*/
  }
  else
  {
    echo "Error al realizar el registro";
  }
}

  
  // $val=2;

if(isset($_POST['val'])){
  
  $val=$_POST['val'];
if ($val == 1) 
{
  $a=$_POST['yolo'];

  $sql="SELECT * FROM programa, detalle_programa, unidad_productiva, inst_asoc WHERE programa.version_programa=detalle_programa.version_programa and programa.cod_programa=detalle_programa.cod_programa AND unidad_productiva.cod_up=inst_asoc.cod_up and detalle_programa.Cod_ficha=unidad_productiva.cod_ficha AND inst_asoc.ident_inst=:ident";
  $result=$pdoconexion->consulta($sql);
  $result->bindParam(":ident",$a);
  $result->execute();

  if ($result->rowCount()>0) 
  {
    $res=$result->fetchAll();
    foreach ($res as $rows) 
    {
      echo "<tr>";
      echo "<td>".$rows['cod_programa']."</td>";
      echo "<td>".$rows['version_programa']."</td>";
      echo "<td>".$rows['nombre_programa']."</td>";
      echo "<td>".$rows['nivel_programa']."</td>";
      echo "<td>".$rows['Cod_ficha']."</td>";
      echo "<td>".$rows['fecha_inicio']."</td>";
      echo "<td>".$rows['fecha_fin']."</td>";
      echo "<td><button id='".$rows['Cod_ficha']."' class='btnver'>Ver U.P </button></td>";
      echo "</tr>";
    }

  }
  else
  {
    echo "no hay datos";
  }
}

if ($val == 2) 
{
  $b=$_POST['yolo2'];

  $sql="SELECT unidad_productiva.cod_up, unidad_productiva.nombre_up, unidad_productiva.lider_up, usuarios.nombres FROM unidad_productiva, usuarios WHERE usuarios.identificacion=unidad_productiva.lider_up AND cod_ficha=:cod";
  $result=$pdoconexion->consulta($sql);
  $result->bindParam(":cod",$b);
  $result->execute();

  if ($result->rowCount()>0) 
  {
    $res=$result->fetchAll();
    foreach ($res as $row) 
    {
      echo "<tr>";
      echo "<td>".$row['cod_up']."</td>";
      echo "<td>".$row['nombre_up']."</td>";
      echo "<td>".$row['nombres']."</td>";
      echo "<td><button id='".$row['cod_up']."' class='btnver'>VER F09</button></td>";
      echo "</tr>";
    }
  }
  else
  {
    echo "no hay datos";
  }
    
  }
}
?> 