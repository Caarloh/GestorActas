<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>






                <!-- Begin Page Content -->


  






                <div class="container-fluid">




                    <center>
                        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users"></i>  Reuniones</h1>
                        
                    </center>

                    <br>

                

                    <br>



                            <div class="container">
                            <h6 class="m-0 font-weight-bold text-primary">Filtrar Reuniones</h6>
                            <h6 class="m-0 font-weight-bold text-primary">                 </h6>

                                <div class="row row-cols-3">
                                <div class="col">
                                        <input type="date" class="form-control" id="fechaReunionCalendar" requiered>
                                    </div>
                                    <div class="col">

                                    <a href="" class="button add" data-toggle="modal" data-target="#crearReunion"> Crear Reunion </a>
                        </div>
                                </div>
                              </div>
                   
                            <div class="grid-container">
                                    <?php
                                        $consulta = "SELECT * FROM reunion";
                                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                        while ($columna = mysqli_fetch_array( $resultado )){

                                            $datos = $columna["id"].'||'.$columna["tipoPredefinido"].'||'.$columna["fecha"].'||'.$columna["hora"].'||'.$columna["duracion"].'||'.$columna["tipoDuracion"].'||'.$columna["linkReunion"].'||'.$columna["nombre"];
                                            $usarFuncion = "formEditarReunionIndex('".$datos."')";

                                            $id = $columna['id'];
                                            $linkReunion = $columna['linkReunion'];
                                            $colorCard = "#4065FE";
                                            $horaReunion= $columna['hora'];
                                            $colorBoton = "buttonBlue";
                                            $fecha = $columna['fecha'];
                                            $estado = $columna['estado'];
                                            $fechaActual = date("Y-m-d");
                    
                                            if($estado == "Terminado"){
                                                $colorCard = "#58D68D";
                                                $colorBoton = "button";
                                            }
                                            else if($estado=="En Proceso"){
                                                $colorCard = "#FFC300";
                                                $colorBoton = "buttonYellow";

                                            }
                                            else if($estado=="En Espera"){
                                                $colorCard = "#FF3333";
                                                $colorBoton = "buttonRed";


                                            }

                                            echo '

                                            <div class="wrapper2"   style="background-color: '.$colorCard.'">
                                            ';
                                            if($estado == "Terminado"){

                                            }
                                            else{
                                                echo '
                                                <a id="btnEditarReunionIndex" class="'.$colorBoton.'  edit" style="width:60%" data-toggle="modal" data-target="#editarReunionIndex" onclick="'.$usarFuncion.'">Editar</a>
                                                ';
                                                
                                                
                                            }
                                        echo '
                                            
                                            <h2 class="upper">Reunion: '.$columna['tipoPredefinido'].'</h2>
                                            <h2 class="meetup">'.$columna['nombre'].'</h2>
                                            <br>
                                            <p class="details">
                                              <span class="row2">
                                                <i class="material-icons far fa-calendar"></i>
                                                <span class="row2-item">
                                                <time> '.$columna['fecha'].' a las  '.$columna['hora'].'</time>
                                                </span>
                                              </span>
                                            
                                              <span class="row2">
                                                <i class="material-icons fas fa-stopwatch"></i>
                                                <span class="row2-item">
                                                <strong>'.$columna['duracion'].' '.$columna['tipoDuracion'].'</strong>
                                                </span>
                                              </span>
                                            
                                              <span class="row2">
                                                <i class="material-icons fas fa-link"></i>
                                                
                                                <span class="row2-item">';
                                                if($linkReunion == "" || $linkReunion==" "){
                                                    echo ' <a href="" style="color: white">Link no disponible</a>
                                                    ';
                                                }
                                                else {
                                                    echo ' 
                                                    <a href="'.$linkReunion.'" style="color: white">Link Reunion</a>
                                                    ';
                                                }
                                               
                                                echo'
                                                
                                            
                                                </span>
                                            
                                                </span>
                                            
                                              <span class="row2">
                                                <i class="material-icons"></i>
                                                <span class="row2-item">';

                                                if($fechaActual < $fecha){

                                                    echo '


                                                    <a data-toggle="modal" data-id="'.$fecha.'" data-condicion="programado" data-reunion="'.$id.'"  data-horita="'.$horaReunion.'" title="Add this item" class="open-AddBookDialog '.$colorBoton.' play " href="#alerta"> Iniciar Reunion </a>';

                                                }
                                                else{

                                                    echo '
                                                    <a href="iniciarReunion.php?variable1='.$id.'" class="'.$colorBoton.' play"  > Inician Reunion </a>';
                                                }
                                                echo'
                                            
                                                </span>
                                            
                                                </span>
                                            
                                            </p>


                                                    
                                               


                                            </div>
                                            
                                                   
                                                ';



                                               
                     
                                        }
                                    
                                    
                                    
                                    ?>
                            </div>
 
 
 
 
 
 

<!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar usuario</h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Nombres:</span>
						<input type="text" style="width:350px;" class="form-control" id="efirstname">
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Apellidos:</span>
						<input type="text" style="width:350px;" class="form-control" id="elastname">
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Dirección:</span>
						<input type="text" style="width:350px;" class="form-control" id="eaddress">
					</div>					
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="button" class="button-verde"><span class="glyphicon glyphicon-edit"></span> </i> Actualizar</button>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->
 
 
 
 
 
 
        <!-- Modal alerta fecha -->
        <div class="modal fade" id="alerta" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ejecutar Reunion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                     
                    <div class="modal-body">La reunion esta planificada para el : <input type='text'  readonly="readonly"  style='width: 14% ; background-color: transparent; border-color: transparent' name="bookId" id="bookId" value=""  disabled> 
                       a las : <input type='text'  readonly="readonly"  style='width: 8% ; background-color: transparent; border-color: transparent' name="reunionHora" id="reunionHora" value=""  disabled>    ¿Esta seguro que desea abrirla? <input type='text' readonly="readonly" style='width: 14% ; background-color: transparent; border-color: transparent' name="idReunionCalendar" id="idReunionCalendar" value=""  required> 
                    </div>
                    <div class="modal-footer">
                        <form action="iniciarReunion.php" method="post">
                        <input type="hidden" name="idReunionCalendar" id="idReunionCalendar" value="" />
                        <input type="hidden" name="clausula" id="clausula" value="" />
                        <button  type="submit" class="button-azul">Ingresar a Reunion</a>
                        </form>
                        <form action="baseDatos/clonarReunion.php" method="post">
                            <input type="hidden" name="idReunionCalendar" id="idReunionCalendar" value="" />
                            <button type="submit" id="finalizado" class="button-amarillo">Clonar</button>
                        
                        </form>
                        
                        <button type="button" class="button-rojo" data-dismiss="modal" id="cerrar">No</button>

                    </div>
                </div>
            </div>
        </div>

                    <!-- Content Row -->

                    <div class="row">

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>

        <!-- End of Content Wrapper -->


        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>



















        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su
                        sesión
                        actual.</div>
                    <div class="modal-footer">
                        <button class="button-rojo" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="login.html">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Reunion -->
        <div class="modal fade" id="editarReunionIndex" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar Reunión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div hidden class="form-group">
                                <input type="text" class="form-control" id="idReunionEditar" readonly>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Nombre de la reunion</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nombreReunionEditar" requiered>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Tipo Reunión</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="tipoReunionEditar">
                                            <option value="Seleccionar">Seleccionar Tipo Reunión</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Extraordinaria">Extraordinaria</option>
                                            <option value="Consejo de Escuela">Consejo de Escuela</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Fecha Reunión</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" id="fechaReunionEditar" requiered>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Hora de Inicio Reunión</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="horaEditar">
                                            <?php
                                            echo '<option value="Seleccionar">Seleccionar Hora Reunion</option>';
                                            
                                            for($i =0; $i<=23; $i++){
                                                if($i<10){
                                                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                

                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <select class="form-control" id="minutoEditar">
                                            <?php
                                            echo '<option value="Seleccionar">Seleccionar Minuto Reunion</option>';
                                            
                                            for($i=0; $i<=60; $i++){
                                                if($i<10){
                                                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                

                                            }
                                        ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Duracion Reunión</label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" id="duracionReunionEditar" requiered>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="tipoDuracionEditar">
                                            <option value="Seleccionar">Seleccionar Tipo Duración</option>
                                            <option value="Minutos">Minutos</option>
                                            <option value="Horas">Horas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Link de Reunión</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="linkReunionEditar">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-rojo" data-dismiss="modal" id="cerrar">Cerrar</button>
                        <button type="button" class="button-azul" id="btnGurdarEditarIndex">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Crear Reunion -->
        <div class="modal fade" id="crearReunion" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nueva Reunión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <?php
                            $idReunion = 0;
                            $existe = false;
                            
                            do{
                                $idReunion = rand();
                                $consulta = "SELECT * FROM reunion WHERE id='$idReunion'";
                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna = mysqli_fetch_array( $resultado )){
                                    $existe=true;
                                }
                            }while($idReunion==0 || $existe);
                        ?>
                            <div class="form-group">
                                <input type="text" class="form-control" id="idReunion" value="<?php echo $idReunion;?>"
                                    readonly>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Nombre de la reunion (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nombreReunion" requiered>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Tipo Reunión (*)</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="tipoReunion">
                                            <option value="Seleccionar">Seleccionar Tipo Reunión</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Extraordinaria">Extraordinaria</option>
                                            <option value="Consejo de Escuela">Consejo de Escuela</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Fecha Reunión (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" id="fechaReunion" requiered>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Hora de Inicio Reunión (*)</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="hora">
                                            <?php
                                            echo '<option value="Seleccionar">Seleccionar Hora Reunion</option>';
                                            
                                            for($i =0; $i<=23; $i++){
                                                if($i<10){
                                                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                

                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <select class="form-control" id="minuto">
                                            <?php
                                            echo '<option value="Seleccionar">Seleccionar Minuto Reunion</option>';
                                            
                                            for($i=0; $i<=60; $i++){
                                                if($i<10){
                                                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                

                                            }
                                        ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Duracion Reunión (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" id="duracionReunion"
                                            placeholder="Duración Reunión" requiered>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="tipoDuracion">
                                            <option value="Seleccionar">Seleccionar Tipo Duración</option>
                                            <option value="Minutos">Minutos</option>
                                            <option value="Horas">Horas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Link de Reunión</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="linkReunion"
                                            placeholder="Link de la Reunión">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                         <a class = "buttonRed delete" data-dismiss="modal" id="cerrar">Cerrar </a>
                         <a class = "button next" data-dismiss="modal" id="siguientePaso"> Siguiente Paso </a>
                    </div>
                </div>
            </div>
        </div>


        

</div>


<?php require_once "vistas/parteinferior.php"?>