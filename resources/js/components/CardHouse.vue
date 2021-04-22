<template>

               <div class="row p-2 shadowCards">
                <div class="col-12 col-lg-6">
                    <img :src="`/images/${house.url}`"  :alt="house.name">
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column justify-content-between mt-2 mt-lg-0">
                    <div>
                        <h5>{{house.name}}</h5>
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
                        <router-link :to="{name:'house',params:{id:house.id}}" class="btn btn-house">Ver casa</router-link>
                    </div>    
                </div>
            </div>
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

    img{
        width: 100%;
        height: 10rem;
        border-radius: 10px 10px;
        object-fit: cover;
        transition: all 2s 0s ease;
    }

    img:hover{
        transform: scale(1.1);

        @media (min-width: 960px) {
            transform: scale(1.2);
        }           
    }

    .shadowCards{
        box-shadow: 0 0 4px $color-grey;
        border-radius: 5px 5px;
    }

    .text-size{
        font-size: .6rem;
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
