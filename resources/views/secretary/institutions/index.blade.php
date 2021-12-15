@extends('layouts.app')

@section('title', 'Instituições')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    
    <form class="mb-2">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-fill">
                <input type="text" id="search" name="search" class="form-control w-50 mr-2" value="{{ $search }}" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
            <a href="{{ route('secretary.institution.create') }}" class="btn btn-primary">Nova instituição</a>
        </div>
    </form>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th class="text-center">ID</th>
                <th class="">Instituição</th>
                <th class=" align-middle text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($institutions as $institution)
                @if ($institution->type != "SECRETARY")
                    <tr>
                        <td class="align-middle text-center">{{ $institution->id }}</td>
                        <td class="align-middle">{{ $institution->name }}</td>
                        <td class="row justify-content-center">
                            <!-- <div class="d-flex d-block m-auto"  > -->
                                <a href="{{ route('secretary.institution.show', $institution->id) }}"
                                    class="btn btn-sm btn-info mr-2"
                                >
                                    <i class="fa fa-eye"></i>
                                </a>

                                <form
                                    action="{{ route('secretary.institution.destroy', $institution->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger confirm-submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>                    
                            <!--</div> -->
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    {{ $institutions->links() }}

@endsection

@push('js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.defaults.js') }}"></script>
    <!-- <script src="{{ asset('js/school/food_records/index.js') }}"></script> -->
    <script>
        $(document).on('click', '.confirm-submit', function(event) {
            event.preventDefault();

            const confirmation = confirm('Tem certeza que deseja excluir?');

            if(confirmation){
                const form = $(this).parent();
                form.trigger('submit');
            }
        });

        $(document).ready(function () {
            var noInstitution = <?php echo json_encode($noInstitution) ?>;
            
            function isEmpty( el ){
                return !$.trim(el.html());
            }
            //console.log();
            if(noInstitution){
                
                $('tbody').append('<tr>\
                    <td colspan=3 class="align-middle card-body bg-primary text-white rounded text-center">'+
                        '<i class="fa fa-fw fa-search fa-3x mb-2"></i>\
                        <p class="mb-0">Não há instituição registrada com a busca "'+$('#search').val()+'".'
                    +'</td>'+   
                '</tr>');
            }
        });
    </script>
@endpush