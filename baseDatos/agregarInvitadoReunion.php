<?php

    require 'conexion.php';
    
    $idReunion = $_POST['idReunion'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $crear = true;
    
    $consulta = "SELECT * FROM invitado WHERE correo='$correo'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $crear=false;
        $nombre = $columna['nombre'];
    }
    
    if ($crear) {
        $contrasenaInvitado = 0;
        $existeContra = false;
        
        do{
            $contrasenaInvitado = rand();
            $consulta = "SELECT * FROM invitado WHERE codigoAcceso='$contrasenaInvitado'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columna = mysqli_fetch_array( $resultado )){
                $existeContra=true;
            }
        }while($contrasenaInvitado==0 || $existeContra);

        $consulta = "INSERT INTO invitado (correo, nombre, codigoAcceso) VALUES ('$correo', '$nombre','$contrasenaInvitado')";
        mysqli_query($conexion,$consulta);

        /*Enviar Correo*/
        include '../envio_de_correos/superiorenviarcorreo.php';
        //Destinatario
        $mail->addAddress($correo, $nombre);     

        //Contenido del correo
        $mail->isHTML(true);

        $topico = "Bienvenido al Gestor De Actas";                                  
        $mail->Subject = $topico;
        
        $cuerpo = "Hola $nombre, se ha creado una cuenta para el correo $correo con la siguiente contraseña $contrasenaInvitado";
        $mail->Body    = $cuerpo;
        
        include '../envio_de_correos/inferiorenviarcorreo.php';


    }

    $copiarInvitado = true;
    $consulta = "SELECT * FROM relacionreunioninvitado WHERE refcorreo='$correo' AND refid='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $copiarInvitado=false;
        
    }

    if($copiarInvitado){
        $consulta = "INSERT INTO relacionreunioninvitado (refcorreo, refid) VALUES ('$correo', '$idReunion')";
        echo $result=mysqli_query($conexion,$consulta);

        //Contenido del correo
        $mail->isHTML(true);

        $topico = "Invitacion a reunion $idReunion";                                  
        $mail->Subject = $topico;
        
        $consulta ="SELECT * FROM reunion WHERE id='$idReunion'";
        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
        $columna = mysqli_fetch_array( $resultado );

        $nombre = $columna['nombre'];
        $topico = "Invitacion a reunion $nombre";                                  
        $mail->Subject = $topico;

        $linkreunion = $columna['linkReunion'];
        $fecha = $columna['fecha'];
        $hora = $columna['hora'];

        
        
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
                            <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Hola!</h1>
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
                        <p style='margin: 0;'>Has sido invitad@ a la reunión ".$columna['nombre']. " para el dia ".$columna['fecha']. " con una duracion estimada de ".$columna['duracion']. " horas.</p><br>
                        <p style='margin: 0;'>Los temas a tratar:</p>
            
        ";
        $consulta2 = "SELECT * FROM tema WHERE refreunion='$idReunion'";
        $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
        while ($columna2 = mysqli_fetch_array( $resultado2 )){
            $datos2 = $columna2["nombre"];
            $cuerpo = "$cuerpo \n <p style='margin: 0;'> .- $datos2 </p>";
        }

        $cuerpo = "$cuerpo \n </tr>";

        if (empty($linkreunion)){
            $cuerpo = "$cuerpo \n <br>";
        }else{
            $cuerpo = "$cuerpo \n 
            <!-- BULLETPROOF BUTTON -->
            <tr>
                <td bgcolor='#ffffff' align='left'>
                <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                    <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 60px 30px;'>
                        <table border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td align='center' style='border-radius: 3px;' bgcolor='#3AA849'>
                                <a href='".$columna['linkReunion']. "' target='_blank' style='font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #3AA849; display: inline-block;'>
                                    
                                Enlace a reunión
                                </a>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
                </td>
            </tr>
            <!-- COPY -->
            <tr>
                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                <p style='margin: 0;'>Si no funciona, copiar y pegar el siguiente enlace en su navegador:</p>
                </td>
            </tr>
            <!-- COPY -->
                <tr>
                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #3AA849; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                    <p style='margin: 0;'><a href='".$columna['linkReunion']. "' target='_blank' style='color: #3AA849;'>".$columna['linkReunion']. "</a></p>
                </td>
                </tr>
            <!-- COPY -->";
        }

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
        
        include '../envio_de_correos/inferiorenviarcorreo.php';
    }
    else{
        echo 6;
    }


  
  
?>