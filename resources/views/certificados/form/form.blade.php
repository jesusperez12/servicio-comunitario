<table id="example" class="table table-bordered">
      <thead>
    
                         <tr>
                            <th>Selección</th>
                            <th >Cédula</th>
                            <th>N°Certificado</th>
                            <th>Instituto/ Extensión</th>
                            <th>Especialidad</th>
                            <th>Nombre y Apellido</th>
                            <th>Proyecto</th>
                            <th>Fecha</th>
                            <th>Condición</th>  
                        </tr>


                  </thead>
                  <tbody>
     

                            @foreach($userCertificado as $oferta)
    <tr>
       <td> 
       <input data-id="{{ $oferta->id }}" class="mi_checkbox" name="aprobacion[]" type="checkbox" data-toggle="toggle" data-on="Aprobado" data-off="Denegado" data-onstyle="outline-success" data-offstyle="outline-danger" {{ $oferta->Aprobado ? 'checked' : '' }}>

        <!-- <input type="checkbox" value="{{$oferta->id}}" name="aprobacion[]" onclick="btTutorial.disabled = !this.checked">-->
</td>
                    <td>{{$oferta->ci}} </td>
                     <td >{{$oferta->certificados}} </td>
                     <td>{{$oferta->NombInstituto}} </td>
                     <td >{{$oferta->nombre}} </td>
                    <td>{{$oferta->firstname}}   {{$oferta->primary_lastname}} </td>                 
                   <td >{{$oferta->nombre_proyecto}} </td>
                  <td >{{ \Carbon\Carbon::parse($oferta->created_at)->translatedFormat('d/M/Y') }}</td>
                      <td id="resp{{ $oferta->id }}"> 
                        @if($oferta->Aprobado == 1) 
                      <label class="badge badge-success">Aprobado</label>
                       @else
                             <label class="badge badge-danger">En_Espera</label>
                            @endif
                      
                    </td>
    </tr>
@endforeach
                  </tbody>
    </table>