@extends('administrador.dashboard')

@section('title', 'Houses')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Casa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro de que desea eliminar la casa?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="formDelete" action="{{route('dashboard.destroy')}}" method="POST">
                            @csrf
                            {{-- @method('delete') --}}
                            <input class="btn btn-primary" type="submit" value="Eliminar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-center mt-3">Casas</h1>   
        <a href="{{route('dashboard.addHouse')}}" class="btn btn-dark"><i class="fas fa-plus mr-2"></i> Nueva casa</a>

        @foreach ($houses as $house) 
        <div class="row m-0 mt-2 mb-2 p-3 houses d-flex justify-content-center align-items-center">
               

                <div class="col-3">
                    <img src="/storage/{{$house['url']}}" alt="{{$house['name']}}">
                </div>
                <div class="col-6">
                    <h3 class="text-center">{{$house['name']}}</h3>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                    <a class="btn" href="{{route('dashboard.edit',$house)}}" tag="button"><i class="fas fa-edit lead btn-edit"></i></a>
                    <a class="btn" id="{{$house['id']}}" v-tooltip="'Eliminar'" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt lead btn-delete"></i></a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- <div class="d-flex justify-content-center align-items-start">
        <i class="fas fa-spinner mt-4" style="fontSize: 2rem"></i>
    </div> --}}
@endsection

@section('back')
    <a class="btn btn-dark ml-5 my-3" href={{ route('administrador.home')}}><i class="fas fa-arrow-left"></i></a>
@endsection

@push('head')
<script src="{{ asset('js/components/houses.js')}}"></script>
@endpush