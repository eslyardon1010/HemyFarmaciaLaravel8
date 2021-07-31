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
                                <th class="table-th text-white">USUARIO</th>
                                <th class="table-th text-white text-center">TELEFONO</th>
                                <th class="table-th text-white text-center">EMAIL</th>
                                <th class="table-th text-white text-center">PERFIL</th>
                                <th class="table-th text-white text-center">STATUS</th>
                                <th class="table-th text-white text-center">IMAGEN</th>
                                <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td class="text-center">
                                    <h6>{{$r->name}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$r->phone}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$r->email}}</h6>
                                </td>
                                <td class="text-center uppercase">
                                    <h6>{{$r->profile}}</h6>
                                </td>
                                <td class="text-center">
                                   <span class="bagde {{ $r->status =='Active' ? 'badge-success' : 'badge-danger' }} text-uppercase">{{$r->status}}</span>
                                </td>
                              

                               
                                <td class="text-center">
                                    @if($r->image != null)
                                    <img src="{{ asset('storage/users/' . $r->image) }}" alt="IMAGE"  class="card-img-top img-fluid">
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="javascript::void(0)"
                                    wire:click="Edit({{$r->id}})"
                                     class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript::void(0)" 
                                    onclick="Confirm('{{$r->id}}')"
                                    class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 {{$data->links()}}

                </div>
            </div>


        </div>

    </div>
    @include('livewire.users.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('user-added', msg=>{
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('user-updated', msg=>{
            $('#theModal').modal('hide');
            noty(msg)
        })

        window.livewire.on('user-deleted', msg=>{
            noty(msg)
        })

        window.livewire.on('hide-modal', msg=>{
             $('#theModal').modal('hide');
        })

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('user-withsales', msg=>{
            noty(msg)
        })


    });

    function Confirm(id) {
        swal({
            title: 'CONFIRMAR',
            text: 'CONFIRMAS ELIMINAR UN USUARIO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#ff0000',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }
</script>