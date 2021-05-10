<template>
    <h1 class="text-center">Bienvenido al panel de admnistrador!</h1>
        <h3 class="mt-5">¿Que desea hacer?</h3>
        <div class="d-flex align-items-center p-2 select">
            <span ><i class="fas fa-plus mr-2 lead"></i></span>
            <router-link to="/dashboard/addHouse"> Nueva casa</router-link>
        </div>
        <div class="d-flex align-items-center p-2 select" >
            <span><i class="fas fa-edit mr-2 lead"></i></span>
            <router-link to="/dashboard/editHouses"> Editar casa</router-link>
        </div>
</template>

<script>
export default {
name:'HomeDashboard',

}
</script>

<style lang="scss">
@import '../../scss/app.scss';

    .select{
            width: 20rem;
            cursor: pointer;
            transition: all .3s ease;
            color: black;

            &:hover, &:hover a{
                color: $color-blue;
            }

            a{
                color: black;
                text-decoration: none;

                &:hover{
                    text-decoration: none;
                    color: $color-blue;
                }
            }

            span:hover + a{
                color: $color-blue;
            }
        }
</style>