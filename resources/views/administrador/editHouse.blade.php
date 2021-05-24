@extends('administrador.dashboard')

@section('breadcrumb')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{route('administrador.home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.houses')}}">Alojamientos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar alojamiento</li>
    </ol>
</nav>

@endsection

@section('content')


<div class="row flex-column justify-content-center add-house">
    <div class="col-12 offset-lg-2 col-lg-8 form p-3">
        <h2 class="text-center">Editar alojamiento</h2>
        <div class="line my-3">

        </div>

        <form action="{{route('dashboard.update',$house)}}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Nombre" id="name" value="{{old('name',$house['name'])}}">
                </div>
                @error('name')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div>

            <div class="form-group row">
                <label for="host" class="col-sm-2 col-form-label">Host:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Huesped" id="host" value="{{old('host',$house['host'])}}">
                </div>
                @error('host')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div> 

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Precio:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Precio" id="price" value="{{old('price',$house['price'])}}">
                </div>
                @error('price')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div> 

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Imagen:</label>
                <div class="col-sm-10">
                    <input type="file" id="image" name="image">   
                    @error('image')
                        <small class="error d-block">*{{$message}}</small>
                    @enderror 
                </div>
            </div> 

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <div class="mt-2">
                        <img src="/storage/{{$house['url']}}" id="img" class="image" alt="Imagen"/>
                    </div>
                </div>
            </div> 

            

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Descripción:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" aria-label="With textarea" placeholder="Descripcion" name="description">{{old('description',$house['description'])}}</textarea>
                </div>
                @error('description')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div> 

            <div class="form-group row">
                <label for="province" class="col-sm-2 col-form-label">Provincia:</label>
                <div class="col-sm-10">
                    <select class="custom-select" id="inputGroupSelect01" name="location">
                        @foreach ($locations as $location)
                        <option value="{{$location['id']}}" @if ($house['location_id'] == $location['id']) selected="selected" @endif>{{$location['name']}}</option>
                        @endforeach                        
                    </select>
                </div>
                @error('location')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div> 

            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Categoria:</label>
                <div class="col-sm-10">
                    <select class="custom-select" id="category" name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category['id']}}" @if ($house['category_id'] == $category['id']) selected="selected" @endif>{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col-sm-2">Servicios:</div>
                <div class="col-sm-10">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="wifi" value="1" {{ old('wifi') == '1' ? 'checked' : '' }} name="wifi">
                    <label class="form-check-label" for="wifi">
                        Wifi
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="pool" value="1" {{ old('pool') == '1' ? 'checked' : '' }} name="pool">
                    <label class="form-check-label" for="pool">
                        Piscina
                    </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="guest">Huéspedes:</label>
                    <select class="custom-select" id="guest" name="guest">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['guests'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="bedrooms">Dormitorios:</label>
                    <select class="custom-select" id="bedrooms" name="bedrooms">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['bedrooms'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="beds">Camas:</label>
                    <select class="custom-select" id="beds" name="beds">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['beds'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="toilets">Baños:</label>
                    <select class="custom-select" id="toilets" name="toilets">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['toilets'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label for="carousel" class="col-sm-2 col-form-label">Carousel:</label>
                <div class="col-sm-10">
                    @foreach ($carousel as $image)
                    <div class="mt-2">
                        <img src="/storage/{{$image['url']}}" class="image" alt="Imagen"/>
                        <span id="{{$image['id']}}" class="btn btn-delete-carousel ml-2"><i class="fas fa-trash-alt lead btn-delete-carousel-icon"></i></span>
                    </div>
                @endforeach
                </div>
            </div> 

            <div class="form-group row mt-2">
                <label for="carousel" class="col-sm-2 col-form-label">Añadir imág.:</label>
                <div class="col-sm-10">
                    <input type="file" value="{{old('carousel')}}" id="carousel" name="carousel[]" multiple>
                </div>
            </div> 

            <div class="form-group row mt-2">
                <label for="carousel" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <div id="imagesSelected" class="mt-3">
                    </div>
                </div>
            </div> 

            <div class="d-flex justify-content-between mt-4">
                <a href="{{route('dashboard.edit',$house['id'])}}" class="btn bg-danger text-light">Resetear</a>
                <input type="submit" class="btn btn-bg-primary text-light" value="Actualizar casa"></input>    
            </div>
        </form> 
    </div>
</div>    
@endsection

@section('back')
    <a class="btn btn-bg-primary ml-5 mb-3" href={{ route('dashboard.houses')}}><i class="fas fa-arrow-left"></i></a>
@endsection

@push('head')
<script src="{{ asset('js/components/edit.js')}}"></script>
@endpush