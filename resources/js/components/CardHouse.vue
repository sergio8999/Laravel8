<template>
    <router-link :to="{name:'house',params:{id:house.id}}" >
        <div class="row p-2 shadowCards">
            <div class="col-12 col-lg-6">
                <img :src="`/images/${house.url}`"  :alt="house.name">
            </div>
            <div class="col-12 col-lg-6 d-flex flex-column justify-content-between mt-2 mt-lg-0">
                <div>
                    <h5><b>{{house.name}}</b></h5>
                    <div class="d-flex text-size">
                        <span class="ml-2">{{house.details.guests}} Huéspedes</span> 
                        <span class="ml-2">·</span>
                        <span class="ml-2">{{house.details.bedrooms}} dormitorio/s</span>
                        <span class="ml-2">·</span>
                        <span class="ml-2">{{house.details.beds}} cama/s</span>
                        <span class="ml-2">·</span>
                        <span class="ml-2">{{house.details.toilets}} baño/s</span>
                    </div>  
                </div>
                <div class="d-flex justify-content-around align-content-center mt-3 mt-lg-0">
                    <p>{{house.price}} €/h</p>
                </div>    
            </div>
        </div>
    </router-link>
</template>

<script>

export default ({
    name:'cardHouse',
    props: ['house'],
    setup() {
        
    },
})
</script>

<style scoped lang="scss">
@import '../../scss/app.scss';

    a{
        color:black;

        &:hover{
            text-decoration: none;
        }
    }

    img{
        width: 100%;
        height: 10rem;
        border-radius: 10px 10px;
        object-fit: cover;
        transition: all 1s 0s ease;
    }

    .shadowCards{
        box-shadow: 0 0 4px $color-grey;
        border-radius: 5px 5px;
    }

    .text-size{
        font-size: .7rem;
    }

    .btn-house{
        background-color: $color-grey;
        color: $color-white;
        border: 2px solid $color-grey;
        transition: all 1s ease;

        &:hover{
            background-color: $color-white;
            color: $color-grey;
        }
    }
</style>
