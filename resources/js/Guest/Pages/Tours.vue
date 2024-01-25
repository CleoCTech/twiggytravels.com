<template>
  <div>
    <Head title="Tours" />
    <div v-if="loading.value">
      <div class="preloader">
        <div class="d-table">
          <div class="d-table-cell">
            <div class="sk-cube-area">
              <div class="sk-cube1 sk-cube"></div>
              <div class="sk-cube2 sk-cube"></div>
              <div class="sk-cube4 sk-cube"></div>
              <div class="sk-cube3 sk-cube"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="inner-banner "
    v-bind:style="{ 'background-image': 'url(' + '/storage/sectionimages/cover_images/'+form.image + ')' }"
    >
      <div class="container">
        <div class="inner-title">
          <ul>
            <li>
              <Link :href="route('home')" >
                Home
              </Link>
            </li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li><a :href=" route('tours')">Tours</a></li>
          </ul>
          <h3 v-if="Object.keys( theme ).length == 0">Tours</h3>
          <h3 v-if="Object.keys( theme ).length != 0">{{ theme.name }} Tours</h3>
        </div>
      </div>
    </div>
    <div class="room-area pt-100 pb-70">
      <div class="container">
        <div class="row pt-45">
          <div v-for="(tour, index) in tours.data" :key="index" class="col-lg-4 col-md-6">
            <div class="room-card">
              <Link v-if="tour.destination_category.name.includes('Local') " :href="'/local-destination/'+tour.title.replace(/ /g,'-').toLowerCase()" style="height: 294px;" >
                <img :src="'/storage/destinations/cover_images/'+tour.cover_image" alt="Images" />
              </Link>
              <Link v-if="tour.destination_category.name.includes('Inter') " :href="'/local-destination/'+tour.title.replace(/ /g,'-').toLowerCase()" style="height: 294px;">
                <img :src="'/storage/destinations/cover_images/'+tour.cover_image" alt="Images" />
              </Link>
              <div class="content">
                <h3>
                  <Link v-if="tour.destination_category.name.includes('Local') " :href="'/local-destination/'+tour.title.replace(/ /g,'-').toLowerCase()">
                    {{ tour.title }}
                  </Link>
                  <Link v-if="tour.destination_category.name.includes('Inter') " :href="'/international-destination/'+tour.title.replace(/ /g,'-').toLowerCase()">
                    {{ tour.title }}
                  </Link>
                   
                </h3>
                <ul>
                  <li v-html="tour.extra_info"></li>
                </ul>
                <!-- <div class="rating">
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star"></i>
                  <i class="bx bxs-star-half"></i>
                </div> -->
                  <Link v-if="tour.destination_category.name.includes('Local') " :href="'/local-destination/'+tour.title.replace(/ /g,'-').toLowerCase()" class="default-btn btn-bg-one border-radius-5">
                    Book
                  </Link>
                  <Link v-if="tour.destination_category.name.includes('Inter') " :href="'/international-destination/'+tour.title.replace(/ /g,'-').toLowerCase()" class="default-btn btn-bg-one border-radius-5">
                    Book
                  </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Paginator -->
    <Pagination :links ="tours.links" class="mt-6 mb-3" />
  </div>
</template>

<script setup>
import {onMounted} from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from '@/Guest/Partials/Pagination'
import {useForm} from '@inertiajs/inertia-vue3'
import { ref, watch } from 'vue';

const loading = ref(true);
const props = defineProps({
  tours: Object,
  sectionImages: Object,
  theme: Object,
});

let form = useForm({
    image: '',
});
watch(() => loading.value, () => {
      // Set the loading state to false once the main content has finished loading
      loading.value = false;
    });
onMounted(() => {
     getImage()
    // console.log(props.tours.data);
})
function getImage()
{
    props.sectionImages.forEach(element => {
        if(element.area === 'Banner Area->[Tours Page]'){
            // form.image= "/storage/sectionimages/cover_images/"+element.cover_image;
            form.image= element.cover_image;
        }
    });
}
</script>

<style scoped>
    .text-gray {
        color:rgb(185, 183, 183);
    }
</style>
