@extends('administrador.dashboard')

@section('content')
<h1 class="text-center">Bienvenido al panel de admnistrador!</h1>
<h3 class="text-center mt-5">¿Que desea hacer?</h3>
@endsection

{{-- @section('toast')
@if(Session::has('message'))
<script>
    console.log('entra')
    /* toastr.success("{{ Session::get('message') }}"); */
    alert({{ Session::get('message') }})
</script>
@endif
@endsection --}}