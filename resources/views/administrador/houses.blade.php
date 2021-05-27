@extends('administrador.dashboard')

@section('title', 'Houses')

@section('breadcrumb')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{route('administrador.home')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Alojamientos</li>
    </ol>
</nav>

@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alojamiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro de que desea eliminar el alojamiento?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="formDelete" action="{{route('dashboard.destroy')}}" method="POST">
                            @csrf
                            {{-- @method('delete') --}}
                            <input class="btn btn-danger" type="submit" value="Eliminar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-center mt-3">Casas</h1>   
        <a id="addHouse" href="{{route('dashboard.addHouse')}}" class="btn btn-bg-primary"><i class="fas fa-plus mr-2"></i> Nuevo alojamiento</a>


        <div class="row row-cols-1 row-cols-md-3 mt-3">
            @foreach ($houses as $house) 
            <div class="col mb-4">
              <div class="card h-100">
                  <div id="card-image">
                    <img src="/storage/{{$house['url']}}" alt="{{$house['name']}}" class="card-img-top">    
                  </div>
                <div class="card-body">
                  <h5 class="card-title"><b>{{$house['name']}}</b></h5>
                  <p class="card-text">{{$house['description']}}</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-around">
                        <a class="btn" href="{{route('dashboard.edit',$house)}}" tag="button"><i class="fas fa-edit lead btn-edit"></i></a>
                        <a class="btn" id="{{$house['id']}}" v-tooltip="'Eliminar'" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt lead btn-delete"></i></a>
                    </div>
                </div>
              </div>
            </div>
        {{-- <div class="row m-0 mt-2 mb-2 p-3 houses d-flex justify-content-center align-items-center">
               

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
            </div> --}}
        @endforeach
        </div>
    </div>

    {{-- <div class="d-flex justify-content-center align-items-start">
        <i class="fas fa-spinner mt-4" style="fontSize: 2rem"></i>
    </div> --}}
@endsection

@section('back')
    <a class="btn btn-bg-primary ml-5 my-3" href={{ route('administrador.home')}}><i class="fas fa-arrow-left"></i></a>
@endsection

@push('head')
<script src="{{ asset('js/components/houses.js')}}"></script>
@endpush