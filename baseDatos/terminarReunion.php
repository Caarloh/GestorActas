<?php  
    require 'conexion.php';

    $idReunion = $_POST['idReunion'];
    $estadoReunion = "Terminado";
    $existeReunion = "";
    $horaInicio = "";

    

    $nombreReunion = "";
    $fechaReunion = "";
    date_default_timezone_set("America/Santiago");
    $horaTermino = date("G:i");



    $consulta = "SELECT * FROM reunion WHERE id = '$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $existe=true;
        $nombreReunion = $columna["nombre"];
        $fechaReunion = $columna["fecha"];
        $horaInicio = $columna["horaInicio"];
        
    }

    
    if ($existe) {
        if($horaInicio == "" || $horaInicio==" "){
            echo 3;
        }
        else{
            $consulta = "UPDATE reunion SET horaTermino='$horaTermino', estado='$estadoReunion' WHERE id='$idReunion'";
            $result=mysqli_query($conexion,$consulta);
            include '../envio_de_correos/superiorenviarcorreo.php';
            //Contenido del correo
            $mail->isHTML(true);

            $consulta ="SELECT * FROM reunion WHERE id='$idReunion'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            $columna = mysqli_fetch_array( $resultado );

            $nombre = $columna['nombre'];
            $topico = "Informacion de la reunion: $nombre";                                  
            $mail->Subject = $topico;

            $linkreunion = $columna['linkReunion'];
            $fecha = $columna['fecha'];
            $horaIniciada = $columna['horaInicio'];

            $cuerpo = "
                <!DOCTYPE html>
                <html>
                <head>
                <title></title>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <style type='text/css'>
                    /* FONTS */
                    @media screen {
                        @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 400;
                        src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 700;
                        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                        }
                    }
                    
                    /* CLIENT-SPECIFIC STYLES */
                    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                    img { -ms-interpolation-mode: bicubic; }

                    /* RESET STYLES */
                    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                    table { border-collapse: collapse !important; }
                    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

                    /* iOS BLUE LINKS */
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }
                    
                    /* MOBILE STYLES */
                    @media screen and (max-width:600px){
                        h1 {
                            font-size: 32px !important;
                            line-height: 32px !important;
                        }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*='margin: 16px 0;'] { margin: 0 !important; }
                </style>

                </head>
                <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>

                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <!-- LOGO -->
                    <tr>
                        <td bgcolor='#3AA849' align='center'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
                                        <a href='http://litmus.com' target='_blank'>
                                            <img alt='Logo' src='http://litmuswww.s3.amazonaws.com/community/template-gallery/ceej/logo.png' width='40' height='40' style='display: block; width: 40px; max-width: 40px; min-width: 40px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- HERO -->
                    <tr>
                        <td bgcolor='#3AA849' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                    <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Reunion Finalizada</h1>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- COPY BLOCK -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>La reunión ".$nombre. " para el dia ".$fecha. " iniciada a las: ".$horaIniciada." y terminada a las ".$horaTermino." horas ha sido finalizada.</p><br>
                                <p style='margin: 0;'>Los temas tratados fueron:</p>
                    
                ";
                $consulta2 = "SELECT * FROM tema WHERE refreunion='$idReunion'";
                $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                while ($columna2 = mysqli_fetch_array( $resultado2 )){
                    $datos2 = $columna2["nombre"];
                    $cuerpo = "$cuerpo \n <p style='margin: 0;'> .- $datos2 </p>";
                }
                $cuerpo = "$cuerpo \n </tr>";
                $cuerpo="$cuerpo \n
                            
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Si tiene alguna duda, por favor consultar con el administrador Daniel Moreno .</p>
                                </td>
                            </tr>
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Daniel,<br>Comite Curricular,<br> Universidad de Talca, Curico</p>
                                </td>
                            </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- SUPPORT CALLOUT -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <!-- HEADLINE -->
                                <tr>
                                <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                    <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Utalca</h2>
                                    
                                </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- FOOTER -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                        
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- NAVIGATION -->
                            <tr>
                                <td bgcolor='#f4f4f4' align='left' style='padding: 30px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;' >
                                <p style='margin: 0;'>
                                    
                                </p>
                                </td>
                            </tr>
                            
                            </table>
                            
                        </td>
                    </tr>
                </table>
                    
                </body>
                </html>";

                
                $mail->Body    = $cuerpo;
            

            $consulta2 = "SELECT * FROM relacionreunioninvitado WHERE refid = '$idReunion'";
            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columna2 = mysqli_fetch_array( $resultado2 )){
                $correoDestinatario = $columna2['refcorreo'];
                $nombreDestinatario = "";

                $consulta3 = "SELECT * FROM invitado WHERE correo = '$correoDestinatario'";
                $resultado3 = mysqli_query($conexion, $consulta3) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                while ($columna3 = mysqli_fetch_array( $resultado3 )){
                    $nombreDestinatario = $columna3['nombre'];
                }

                //Enviar Correo invitados
                

                //Destinatario	
                $mail->addAddress($correoDestinatario, $nombreDestinatario);   

                
                
            }

            include '../envio_de_correos/inferiorenviarcorreo.php';

            include '../envio_de_correos/superiorenviarcorreo.php';	

            //Contenido del correo
            $mail->isHTML(true);
                
            $consulta ="SELECT * FROM reunion WHERE id='$idReunion'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            $columna = mysqli_fetch_array( $resultado );

            $nombre = $columna['nombre'];
            $topico = "Informacion de la reunion: $nombre";                                  
            $mail->Subject = $topico;

            $linkreunion = $columna['linkReunion'];
            $fecha = $columna['fecha'];
            $horaIniciada = $columna['horaInicio'];

            
            
            $cuerpo = "
            <!DOCTYPE html>
            <html>
            <head>
            <title></title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge' />
            <style type='text/css'>
                /* FONTS */
                @media screen {
                    @font-face {
                    font-family: 'Lato';
                    font-style: normal;
                    font-weight: 400;
                    src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                    }
                    
                    @font-face {
                    font-family: 'Lato';
                    font-style: normal;
                    font-weight: 700;
                    src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                    }
                    
                    @font-face {
                    font-family: 'Lato';
                    font-style: italic;
                    font-weight: 400;
                    src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                    }
                    
                    @font-face {
                    font-family: 'Lato';
                    font-style: italic;
                    font-weight: 700;
                    src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                    }
                }
                
                /* CLIENT-SPECIFIC STYLES */
                body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                img { -ms-interpolation-mode: bicubic; }

                /* RESET STYLES */
                img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                table { border-collapse: collapse !important; }
                body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

                /* iOS BLUE LINKS */
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }
                
                /* MOBILE STYLES */
                @media screen and (max-width:600px){
                    h1 {
                        font-size: 32px !important;
                        line-height: 32px !important;
                    }
                }

                /* ANDROID CENTER FIX */
                div[style*='margin: 16px 0;'] { margin: 0 !important; }
            </style>

            </head>
            <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>

            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <!-- LOGO -->
                <tr>
                    <td bgcolor='#3AA849' align='center'>
                        
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <tr>
                                <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
                                    <a href='http://litmus.com' target='_blank'>
                                        <img alt='Logo' src='http://litmuswww.s3.amazonaws.com/community/template-gallery/ceej/logo.png' width='40' height='40' style='display: block; width: 40px; max-width: 40px; min-width: 40px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;' border='0'>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
                <!-- HERO -->
                <tr>
                    <td bgcolor='#3AA849' align='center' style='padding: 0px 10px 0px 10px;'>
                        
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <tr>
                                <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Reunion Finalizada</h1>
                                </td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
                <!-- COPY BLOCK -->
                <tr>
                    <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                        
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                        <!-- COPY -->
                        <tr>
                            <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                            <p style='margin: 0;'>La reunión ".$nombre. " para el dia ".$fecha. " iniciada a las: ".$horaIniciada." y terminada a las ".$horaTermino." horas ha sido finalizada.</p><br>
                            <p style='margin: 0;'>Lo acordado en la reunión es lo siguiente:</p>
                            <p style='margin: 0;'>Temas:</p>
                
            ";
            $consulta2 = "SELECT * FROM tema WHERE refreunion='$idReunion'";
            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columna2 = mysqli_fetch_array( $resultado2 )){
                $datos2 = $columna2["nombre"];
                $cuerpo = "$cuerpo \n <p style='margin: 0;'> .- $datos2 </p>";
            }

            $cuerpo = "$cuerpo \n </tr>";

            $cuerpo = "$cuerpo \n
                        <tr>
                            <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                            <p style='margin: 0;'>Acciones a tomar</p>
                            ";
                            $consulta2 = "SELECT * FROM accion WHERE refreunion='$idReunion'";
                            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                            while ($columna2 = mysqli_fetch_array( $resultado2 )){
                                $datos2 = $columna2["nombre"];
                                $cuerpo = "$cuerpo \n <p style='margin: 0;'> .- $datos2 </p>";
                            }
                            $cuerpo = "$cuerpo \n
                            </td>
                        </tr>
            ";

            $cuerpo="$cuerpo \n
                        
                        <tr>
                            <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                            <p style='margin: 0;'>Si tiene alguna duda, por favor consultar con el administrador Daniel Moreno .</p>
                            </td>
                        </tr>
                        <!-- COPY -->
                        <tr>
                            <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                            <p style='margin: 0;'>Daniel,<br>Comite Curricular,<br> Universidad de Talca, Curico</p>
                            </td>
                        </tr>
                        </table>
                        
                    </td>
                </tr>
                <!-- SUPPORT CALLOUT -->
                <tr>
                    <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                        
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- HEADLINE -->
                            <tr>
                            <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Utalca</h2>
                                
                            </td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
                <!-- FOOTER -->
                <tr>
                    <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                    
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                        <!-- NAVIGATION -->
                        <tr>
                            <td bgcolor='#f4f4f4' align='left' style='padding: 30px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;' >
                            <p style='margin: 0;'>
                                
                            </p>
                            </td>
                        </tr>
                        
                        </table>
                        
                    </td>
                </tr>
            </table>
                
            </body>
            </html>";

            
            $mail->Body    = $cuerpo;

            $consulta2_2 = "SELECT * FROM consejo";
            $resultado2_2= mysqli_query($conexion, $consulta2_2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columna2_2 = mysqli_fetch_array( $resultado2_2 )){
                $correoDestinatario = $columna2_2['correo'];
                $nombreDestinatario = $columna2_2['nombre'];

                //Enviar Correo CC
                

                //Destinatario	
                $mail->addAddress($correoDestinatario, $nombreDestinatario);   

                
                
            }
            include '../envio_de_correos/inferiorenviarcorreo.php';
            echo $result;
            
        }
        
        
    }
    else{
        echo 6;
    }



?>