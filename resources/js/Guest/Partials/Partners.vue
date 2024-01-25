<script setup>
import {ref, onMounted, watch} from 'vue'
import { SwiperSlide } from 'swiper/vue';
import xSwiper from '@/Components/Swiper.vue'

const isLoading =  ref(true);
const props = defineProps({
    partners:Object,
});

onMounted(() => {
    isLoading.value = false;
})

</script>
<template>
    <div>
        <div v-if="isLoading" class="preloader">
            <div class="loader">
                <div class="sbl-half-circle-spin"></div>
            </div>
        </div>

        <section v-if="!isLoading" class="hospital-fun-facts-area">
            <div class="container">
                <div class="row">
                    <div class="section-title with-hospital-color">
                        <h2 style="color:white">Our Partners</h2>
                    </div>
                    <x-swiper :slidesPerView="3">
                        <swiper-slide v-for="(partner, index) in partners" :key="index">
                           
                            <!-- <div class="col-md-3 col-6 mb-4">
                                <img :src="'/storage/partner/cover_images/'+partner.cover_image" class="img-fluid partner-logo" alt="Partner 1">
                                <p class="text-center mt-3" style="color:white">{{partner.name}}</p>
                            </div> -->
                            <div class="d-flex flex-column align-items-center">
                                <img :src="'/storage/partner/cover_images/'+partner.cover_image" class="img-fluid partner-logo" alt="Partner 1">
                                <p class="text-center mt-3" style="color:white">{{partner.name}}</p>
                            </div>

                        </swiper-slide>
                    </x-swiper>
                </div>
            </div>
        </section>
    </div>
</template>
<style scoped>
  .partner-logo {
    width: 150px;
    height: 150px;
    object-fit: contain;
  }
</style>

