<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-tittle">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript::void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: red">
                            <tr>
                                <th class="table-th text-white text-center">ID</th>
                                <th class="table-th text-white text-center">DESCRIPCION</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permisos as $permiso)
                            <tr>
                                <td>
                                    <h6 class="text-center">{{$permiso->id}}</h6>
                                </td>
                                <td>
                                    <h6 class="text-center">{{$permiso->name}}</h6>
                                </td>


                                <td class="text-center">
                                    <a href="javascript::void(0)" 
                                    wire:click="Edit({{$permiso->id}})"
                                    class="btn btn-dark mtmobile" title="Editar Registro">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="javascript::void(0)"
                                      onclick="Confirm('{{$permiso->id}}')",
                                      
                                      class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        </a>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$permisos->links()}}

                </div>
            </div>


        </div>

    </div>
@include('livewire.permisos.form')
</div>

@livewireScripts
<script>
    document.addEventListener('DOMContentLoaded', function() {
         window.livewire.on('permiso-added', msg =>{
             $('#theModal').modal(hide)
             noty(msg)
         })

         window.livewire.on('permiso-updated', msg =>{
             $('#theModal').modal(hide)
             noty(msg)
         })

         window.livewire.on('permiso-deleted', msg =>{
             noty(msg)
         })

         window.livewire.on('permiso-exists', msg =>{
             noty(msg)
         })
         
         window.livewire.on('permiso-error', msg =>{
             noty(msg)
         })

         window.livewire.on('hide-modal', msg =>{
             $('#theModal').modal(hide)
         })

         window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
    });

    function Confirm(id) {
        swal({
            title: 'CONFIRMAR',
            text: 'CONFIRMAS ELIMINAR UN REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#ff0000',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('destroy', id)
                swal.close()
            }
        })
    }
 

</script>