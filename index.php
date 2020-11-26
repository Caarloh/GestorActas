<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>






                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <center>
                        <h1 class="h3 mb-0 text-gray-800">Reuniones</h1>
                        
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
                        <button class="button1 fa fa-plus" data-toggle="modal"data-target="#crearReunion">Crear Reunion</button>
                        </div>
                                </div>
                              </div>
                   
                            <div class="grid-container">
                                    <?php
                                        $consulta = "SELECT * FROM reunion";
                                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                        while ($columna = mysqli_fetch_array( $resultado )){
                                            $id = $columna['id'];
                                            $linkReunion = $columna['linkReunion'];
                                            $colorCard = "bg-create";
                                            $colorBoton = "btn-primary";
                                            $fecha = $columna['fecha'];
                                            $estado = $columna['estado'];
                                            $fechaActual = date("Y-m-d");
                                            if($estado == "Terminado"){
                                                $colorCard = "bg-success";
                                                $colorBoton = "btn-success";
                                            }
                                            else if($estado=="En Proceso"){
                                                $colorCard = "bg-info";
                                                $colorBoton = "btn-info";

                                            }
                                            else if($estado=="En Espera"){
                                                $colorCard = "bg-danger";
                                                $colorBoton = "btn-danger";


                                            }




                                            
                                            echo '


                                            
                                                    <div class="card text-white '.$colorCard.' mb-3">

                                                        <div class="card-body">
                                                        
                                                            <h6 class="m-b-20">Reunión: '.$columna['tipoPredefinido'].'</h6>
                                                            
                                                            <h5 class="card-title"><i class="far fa-calendar"></i> '.$columna['fecha'].'</h5>
                                                            <h5 class="card-title"><i class="far fa-clock"></i> '.$columna['hora'].'</h5>
                                                            <h5 class="card-title"><i class="fas fa-stopwatch"></i> '.$columna['duracion'].' '.$columna['tipoDuracion'].'</h5>';
                                                            
                                                            if($linkReunion == "" || $linkReunion==" "){
                                                                echo '<h5 class="card-title"><i class="fas fa-link"></i><a class="btn '.$colorBoton.'" href=""></a></h5>';
                                                            }
                                                            else {
                                                                echo ' 
                                                                       <a href="'.$linkReunion.'" class="btn '.$colorBoton.'" id="copy-button" data-clipboard-target="#G'.$id.'"><i class="fas fa-chevron-right"></i>Link Reunion</a>';
                                                            }
                                                           
                                                            echo'

                                                           

                                                            
                                                        
                                                        </div>';
                                                        if($fechaActual < $fecha){

                                                            echo '
                                                            <a data-toggle="modal" data-id="'.$fecha.'" data-condicion="programado" data-reunion="'.$id.'" title="Add this item" class="open-AddBookDialog btn '.$colorBoton.'" href="#alerta"></i>Ingresar a Reunion</a>';

                                                        }
                                                        else{
        
                                                            echo '



                                                            
                                                            <a href="actas.php?variable1='.$id.'" class="btn '.$colorBoton.'"><i class="fas fa-chevron-right"></i>Ingresar a Reunion</a>';
                                                        }
                                                        echo'
                                                
                                                            
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
                        ¿Esta seguro que desea abrirla? <input type='text' readonly="readonly" style='width: 14% ; background-color: transparent; border-color: transparent' name="idReunionCalendar" id="idReunionCalendar" value=""  required> 
                    </div>
                    <div class="modal-footer">
                        <form action="actas.php" method="post">
                        <input type="hidden" name="idReunionCalendar" id="idReunionCalendar" value="" />
                        <input type="hidden" name="clausula" id="clausula" value="" />
                        <button  type="submit" class="button-azul">Ingresar a Reunion</a>
                        </form>
                        <button type="button" id="finalizado" class="button-amarillo">Clonar</button>
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

        <!-- Modal Crear Reunion -->
        <div class="modal fade" id="crearReunion" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Tema</h5>
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
                                        <label>Tipo Reunión</label>
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
                                        <label>Fecha Reunión</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" id="fechaReunion" requiered>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Hora de Inicio Reunión</label>
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
                                        <label>Duracion Reunión</label>
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
                        <button type="button" class="button-rojo" data-dismiss="modal" id="cerrar">Cerrar</button>
                        <button type="button" class="button-azul" id="siguientePaso">Siguiente Paso</button>
                    </div>
                </div>
            </div>
        </div>


        

</div>


<?php require_once "vistas/parteinferior.php"?>