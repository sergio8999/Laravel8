<template>
        <div class="row p-5 footer-information d-flex justify-content-center">
            <div class="col-12 col-md-5 col-lg-3 d-flex flex-column mt-5 mt-md-0">
                <span><b> ACERCA DE</b></span>
                <span>¿Como funciona?</span>
                <span>Inversores</span>
                <span>Empleo</span>
            </div>
            <div class="col-12 col-md-5 col-lg-3 d-flex flex-column mt-5 mt-md-0">
                <span><b> COMUNIDAD</b></span>
                <span>Accebilidad</span>
                <span>Colaboradores</span>
                <span>Programa Alojamientos</span>
                <span>Invitaciones</span>
            </div>
            <div class="col-12 col-md-5 col-lg-3 d-flex flex-column mt-5 mt-lg-0">
                <span><b> ANFITRIÓN</b></span>
                <span>Ofrece tu alojamiento</span>
                <span>Ofrece una experiencia online</span>
                <span>Centro de recursos</span>
                <span>Centro de la comunidad</span>
            </div>
            <div class="col-12 col-md-5 col-lg-3 d-flex flex-column mt-5 mt-lg-0">
                <span><b> ASISTENCIA</b></span>
                <span>Nuestra respuesta ante la COVID-19</span>
                <span>Centro de ayuda</span>
                <span>Opciones de cancelación</span>
                <span>Confianza y seguridad</span>
            </div>
        </div>
        
        <div class="row px-5 py-2 footer-information d-flex justify-content-between">
            <div class="col-12 col-lg-6 d-flex mt-5 mt-md-0 footer-information-about justify-content-center justify-content-lg-start order-1 order-lg-0">
                <span>&copy;Sergio</span>
                <span class="ml-2">·</span>
                <span class="ml-2">Privacidad</span>
                <span class="ml-2">·</span>
                <span class="ml-2">Condiciones</span>
                <span class="ml-2">·</span>
                <span class="ml-2">Mapa del sitio</span>
                <span class="ml-2">·</span>
                <span class="ml-2">Datos de la empresa</span>
            </div>
            <div class="col-12 col-lg-4 d-flex mt-5 mt-md-0 mr-lg-5 footer-information-socialNetwork justify-content-center justify-content-lg-end order-0 order-lg-1">
                <span class="ml-2"><i class="pi pi-facebook icon mb-3 mr-2 icon"></i></span>
                <span class="ml-2"><i class="pi pi-twitter icon mb-3 mr-2 icon"></i></span>
                <span class="ml-2"><i class="pi pi-google icon mb-3 mr-2 icon"></i></span>
            </div>
        </div>
</template>

<script>

export default ({
    name:'TheFooter',
    data(){
        return {
                
        }
    },
    setup() {
        
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    .footer-information{
        background-color: $color-footer;
        width: 100%;
        margin:0;

        span{
            font-size: 1.1rem;
            margin-top: .5rem;
        }

        &-about{
            span{
                font-size: .9rem;
            }
        }

        &-socialNetwork{
            .icon{
                font-size: 1.3rem;
            }
            
        }
    }
</style>