@extends('administrador.dashboard')

@section('content')
<h2 class="text-center pt-3 mb-4">Nueva casa</h2>

    <form action="{{route('dashboard.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-12 col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nombre:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" name="name">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Host:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Huésped" aria-label="Username" aria-describedby="basic-addon1" name="host">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Price:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Precio" aria-label="Username" aria-describedby="basic-addon1" name="price">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <input type="file" name="image">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descripción: </span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" placeholder="Descripcion" name="description"></textarea>
                </div>
            </div>
        </div>      

         <div class="row mt-3">
            <div class="col-12 col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Provincia</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="location">
                        @foreach ($locations as $location)
                        <option value="{{$location['id']}}">{{$location['name']}}</option>
                        @endforeach                        
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect02">Categoria</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect02" name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>    

        <div>
            <h4>Servicios: </h4>   
            <div class="d-flex flex-column">
                <label for="wifi" class="mt-1">
                    <input id="wifi" type="checkbox" class="mr-2" name="wifi" >Wifi
                </label>
                <label for="pool" class="mt-1">
                    <input id="pool" type="checkbox" class="mr-2" name="pool">Piscina
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
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect04">Dormitorios</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect04" name="bedrooms">
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect015">Camas</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect05" name="beds">
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
                <div class="col-12 col-lg-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect06">Baños</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect06" name="toilets">
                        <option value="1">1</option>
                    </select>
                </div>
            </div>
        </div>   

        <h4>Carousel:</h4>

        <div class="input-group mb-3">
            <input type="file" name="carousel[]" multiple>
        </div>

        <input type="submit" class="btn bg-dark text-light mt-4" value="Añadir casa"></input>
    </form> 
@endsection