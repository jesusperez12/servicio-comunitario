<!DOCTYPE html>
<html>
 <head>

  
  <title>Certificado</title>
  
   

<body>
<table width="100%" border="0" bgborder="#000000">
<tr>
 <th>
        
        <img src="img/images.png" width="80px"></th>
  
     <th height="50" valign="top"> <font SIZE=3><div align="left">República Bolivariana de Venezuela <br>
        Ministerio del Poder Popular para la Educación Universitaria<br>
        Universidad Pedagógica Experimental Libertador <br>
        Secretaría - Control de Estudios
       
                        <br></div></font>
@if($userCertificado->Aprobado == 1)
                        <div align="right"> <b>Registro Nº: </b> <span style="border:0px;font-style: italic;text-align:center;">{{ $code }}</span></div>
@endif
                    </th>
      </tr>

  </table>

    <table style="width:100%;">
        <tr>
            <td width="33%"></td>
            <td width="33%" style="text-align:center;"><h1>CERTIFICADO</h1></td>
            <td width="33%"></td>
        </tr>
    </table>

    <p style="margin-top:15px;font-size:17px;line-height:22px;text-align:justify;">
        Que se otorga a: <b>{{ mb_strtoupper($nombre) }}</b>, Portador(a) de la Cédula de Identidad Nº <b>{{ $ci }}</b>, por haber cumplido con los 
        requisitos establecidos en la Ley de Servicio Comunitario de Estudiantes de Educación Superior en los artículos 04, 06, 07, 13 y el 
        Reglamento del Servicio Comunitario de Estudiantes de Pregrado del <b>{{$sedes->NombInstituto}}</b> en los artículos
        01, 11, 18, 29 y 30, como cursante de la Carrera de Profesor en la Especialidad: <b>{{ mb_strtoupper($especialidad->nombre) }}</b>.
    </p>
    <p style="font-size:17px;line-height:22px;">
        Fecha de realización: <b>Desde: </b> {{ date_format(new DateTime($pup_relations->created_at), "d/m/Y") }} <b>Hasta: </b> {{ date_format(new DateTime($pup_relations->finalized_at), "d/m/Y") }}. <b>Duración: </b>72 horas.
    </p>
    <p style="font-size:17px;line-height:22px;text-align:justify;">
        Título del Proyecto Servicio Comunitario: <b>{{ mb_strtoupper($proyecto->nombre_proyecto) }} DIRIGIDO A LA COMUNIDAD {{ mb_strtoupper($comunidad->nombre) }}, PARROQUIA
        {{ mb_strtoupper($comunidad->localidad) }}, MUNICIPIO {{ mb_strtoupper($comunidad->provincia) }}, {{ mb_strtoupper($comunidad->state) }}</b>.
    </p>
    <p style="font-size:17px;line-height:22px;">
        Elaborado el {{ $fechas}} y de conformidad firman la presente.
    </p>
    <table style="margin-top:50px;width:100%;">
        <tr>
            <td width="33%"></td>
            <td width="33%" style="text-align:center;">
                <br>
                <span style="border:0px;font-style: italic;text-align:center;">________________________________</span>
                <br>
                {{ $secretariaArea }}
                <br>
                <b style="font-size:15px;">Secretaria(o) del Instituto</b>
            </td>
            <td width="33%"></td>
        </tr>
    </table>
    <br><br>
    <table style="margin-top:-30px;width:100%;">
        <tr>
            <td width="33%" style="text-align:center;">
                <span style="border:0px;font-style: italic;text-align:center;">________________________</span>
                <br>
                    {{ $controlEstudioArea }}
                <br>
                <b style="font-size:15px;">Jefa(e) de Control de Estudios</b>
            </td>
            <td width="33%"></td>
            <br>
            <td width="33%" style="text-align:center;">
                <span style="border:0px;font-style: italic;text-align:center;">________________________</span>
                <br> 
                {{ $coordinacionArea }}
                <br>
                <b style="font-size:15px;">Coordinadora(or) Inst. Serv. Comunitario</b>
            </td>
        </tr>
    </table>
</body>


     <style>
        @page { 
            size: auto;
            margin-top: 2cm; 
            margin-left: 2cm; 
            margin-right: 2cm; 
            margin-bottom: 1cm;
            margin-header: 1.5cm;
            margin-footer: 1cm;
            header: html_Cabecera;
            footer: html_Pie; 
        }
        body {
            font-family:'OpenSans', Arial, sans-serif;
        }
        .header {width:100%;border-collapse:collapse;border-spacing:0;} 
        .header td{
            vertical-align:top;
            font-size: 13px;
            font-family:OpenSans, Arial, sans-serif;
            font-weight:bold;
            padding:2px 2px 1px 2px;
            border-style:solid;
            border-width:0px;
            border-color:#ccc;
            color:#000;
            background-color:#fff;
        }
    </style>
 </thead>
</html