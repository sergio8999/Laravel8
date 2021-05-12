@extends('administrador.dashboard')
@section('content')
    <h2 class="text-center pt-3 mb-4">Editar casa</h2>
    
    <form {{-- action="{{route('')}}" --}} method="POST" enctype="multipart/form-data">

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
                        <small class="active">*{{$message}}</small>
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
                        <small class="active">*{{$message}}</small>
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
                    <small class="active">*{{$message}}</small>
                @enderror
            </div>
        </div>
        <h4>Imagen: </h4>   
        <div class="d-flex flex-column my-3">
            <div>
                <input type="file" value="{{old('image',$house['url'])}}" id="image" name="image">   
                @error('image')
                    <small class="active d-block">*{{$message}}</small>
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
                        <small class="active">*{{$message}}</small>
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
                        <option value="{{$location['id']}}" @if (old('guest') == $location['id']) selected="selected" @endif>{{$location['name']}}</option>
                        @endforeach                        
                    </select>
                </div>
                @error('location')
                    <small class="active">*{{$message}}</small>
                @enderror
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect02">Categoria</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect02" name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category['id']}}" @if (old('guest') == $category['id']) selected="selected" @endif>{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <small class="active">*{{$message}}</small>
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
                    <select class="custom-select" id="inputGroupSelect03" value="{{old('guest')}}" name="guest">
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect04">Dormitorios</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect04" value="{{old('bedrooms')}}" name="bedrooms">
                        <option value="1">1</option>
                    </select>
                    @error('bedrooms')
                        <br>
                        <small class="active">*{{$message}}</small>
                        <br>
                    @enderror
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect015">Camas</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect05" value="{{old('beds')}}" name="beds">
                        <option value="1">1</option>
                    </select>
                    @error('beds')
                        <br>
                        <small class="active">*{{$message}}</small>
                        <br>
                    @enderror
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect06">Baños</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect06" value="{{old('toilets')}}" name="toilets">
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
        </div>   

        <h4>Carousel:</h4>

        <div class="input-group mb-3">
            <input type="file" value="{{old('carousel')}}" id="carousel" name="carousel[]" multiple>
        </div>
        <div id="divCarousel" class="mt-2">
            @foreach ($carousel as $image)
            <div class="mt-2">
                <img src="/storage/{{$image['url']}}" id="img" class="image" alt="Imagen"/>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-between mt-4">
            <input type="reset" id="reset" class="btn bg-dark text-light" value="Resetear"></input>
            <input type="submit" class="btn bg-dark text-light" value="Añadir casa"></input>
        </div>
    </form> 
@endsection

@section('back')
    <a class="btn btn-dark ml-5 mt-3" href={{ route('dashboard.houses')}}><i class="fas fa-arrow-left"></i></a>
@endsection

@push('head')
<script src="{{ asset('js/components/editHouse.js')}}"></script>
@endpush