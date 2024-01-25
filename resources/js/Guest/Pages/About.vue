<script setup>
import {onMounted, ref, watch } from 'vue'
import Testmonial from '@/Guest/Partials/Testmonial.vue';
import Services from '@/Guest/Partials/Services.vue';
import Partners from '@/Guest/Partials/Partners.vue';
import Geolocation from '@/Guest/Partials/Geolocation.vue';

const isLoading = ref(true)
const aboutContent = ref('')
const aboutHeader = ref('')
const props =  defineProps({
    testmonials:Object,
    services:Object,
    partners:Object,
    companyInfo:Object,
    sectionImages:Object,
})

onMounted(() => {
    initVariables()
    const lists = document.querySelectorAll('ul')
    lists.forEach((list) => {
        list.classList.add('list')
    })
    isLoading.value = false;
})
// watch(() => isLoading.value, () => {
//     isLoading.value = false;
// })
function initVariables(){
  props.sectionImages.forEach(element => {
      if(element.area === 'About-Header Section'){
          aboutHeader.value = element.cover_image;
      }
      if(element.area === 'About-Content Section'){
          aboutContent.value = element.cover_image;
      }
  });
}

</script>
<template>
     <Head>
      <title>About Us</title>
    </Head>
    <div>
        <div v-if="isLoading" class="preloader">
            <div class="loader">
                <div class="sbl-half-circle-spin"></div>
            </div>
        </div>
        <div v-else >
            <div class="hospital-page-banner-area"
            v-bind:style="{ 'background-image': 'url(' + '/storage/sectionimages/cover_images/'+aboutHeader+ ')' }"
            >
            <div class="container">
                <div class="hospital-page-banner-content">
                <h3>About</h3>
                <ul class="list">
                    <li>
                    <Link :href="route('home')">Home</Link>
                    </li>
                    <li>About Us</li>
                </ul>
                </div>
            </div>
            </div>
            <div class="hospital-about-area-without-color ptb-100">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="hospital-about-image">
                        <img :src="'/storage/sectionimages/cover_images/'+aboutContent" alt="image" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="hospital-about-content">
                            <span>Our Medical</span>
                            <div v-html="companyInfo.about">

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <Services :services="services" />
            <Partners :partners="partners" />
            <Testmonial :testmonials="testmonials"/>
            <Geolocation />
        </div>
    </div>
</template>


