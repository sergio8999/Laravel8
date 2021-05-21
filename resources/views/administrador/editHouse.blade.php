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
    <h2 class="text-center pt-3 mb-4">Editar alojamiento</h2>
    
    <form action="{{route('dashboard.update',$house)}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nombre:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nombre" value="{{old('name',$house['name'])}}" aria-label="Username" aria-describedby="basic-addon1" name="name">
                </div>
                @error('name')
                        <small class="error">*{{$message}}</small>
                @enderror
            </div>

            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Host:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Huésped" value="{{old('host',$house['host'])}}" aria-label="Username" aria-describedby="basic-addon1" name="host">
                </div>
                @error('host')
                        <small class="error">*{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Price:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Precio" value="{{old('price',$house['price'])}}" aria-label="Username" aria-describedby="basic-addon1" name="price">
                </div>
                @error('price')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div>
        </div>
        <h4>Imagen: </h4>   
        <div class="d-flex flex-column my-3">
            <div>
                <input type="file" value="{{old('image',$house['url'])}}" id="image" name="image">   
                @error('image')
                    <small class="error d-block">*{{$message}}</small>
                @enderror 
            </div>
            <div class="mt-2">
                <img src="/storage/{{$house['url']}}" id="img" class="image" alt="Imagen"/>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descripción: </span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" placeholder="Descripcion" name="description">{{old('description',$house['description'])}}</textarea>
                </div>
                @error('description')
                        <small class="error">*{{$message}}</small>
                @enderror
            </div>
        </div>      

        <div class="row mt-3">
            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Provincia</label>
                    </div>
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
            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect02">Categoria</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect02" name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category['id']}}" @if ($house['category_id'] == $category['id']) selected="selected" @endif>{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <small class="error">*{{$message}}</small>
                @enderror
            </div>
        </div>    

        <div>
            <h4>Servicios: </h4>   
            <div class="d-flex flex-column">
                <label for="wifi" class="mt-1">
                    <input id="wifi" type="checkbox" class="mr-2" value="1" {{ old('wifi') == '1' ? 'checked' : '' }} name="wifi" >Wifi
                </label>
                <label for="pool" class="mt-1">
                    <input id="pool" type="checkbox" class="mr-2" value="1" {{ old('pool') == '1' ? 'checked' : '' }} name="pool">Piscina
                </label>
            </div>
        </div> 
        
        <div class="row mt-3">
            <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect03">Huespedes</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect03" name="guest">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['guests'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect04">Dormitorios</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect04" name="bedrooms">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['bedrooms'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                    @error('bedrooms')
                        <br>
                        <small class="error">*{{$message}}</small>
                        <br>
                    @enderror
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect015">Camas</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect05" name="beds">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['beds'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                    @error('beds')
                        <br>
                        <small class="error">*{{$message}}</small>
                        <br>
                    @enderror
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect06">Baños</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect06" name="toilets">
                        @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}" @if ($detail['toilets'] == $i) selected="selected" @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>   

        <h4>Carousel:</h4>
        <div id="divCarousel" class="mt-2">
            @foreach ($carousel as $image)
                <div class="mt-2">
                    <img src="/storage/{{$image['url']}}" class="image" alt="Imagen"/>
                    <span id="{{$image['id']}}" class="btn btn-dark ml-2">Eliminar</span>
                </div>
            @endforeach
            <h4 class="mt-2">Imágenes a añadir:</h4>
            <div class="input-group mb-3">
                <input type="file" value="{{old('carousel')}}" id="carousel" name="carousel[]" multiple>
            </div>
            <div id="imagesSelected" class="mt-3">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="{{route('dashboard.edit',$house['id'])}}" class="btn btn-dark">Resetear</a>
            <input type="submit" class="btn bg-dark text-light" value="Actualizar casa"></input>
        </div>

    </form> 
   
@endsection

@section('back')
    <a class="btn btn-bg-primary ml-5 mt-3" href={{ route('dashboard.houses')}}><i class="fas fa-arrow-left"></i></a>
@endsection

@push('head')
<script src="{{ asset('js/components/edit.js')}}"></script>
@endpush