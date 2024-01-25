<script setup>
import {ref, onMounted, reactive} from 'vue'
import { SwiperSlide } from 'swiper/vue';
import xSwiper from '@/Components/Swiper.vue'
// import Geolocation from '@/Guest/Partials/Geolocation.vue';
import {useNotify} from "@/Composables/useNotify";

let {notification} = useNotify();

const isLoading = ref(true);
const welecomeSection = ref('')
const aboutSection = ref('')

const props = defineProps({
  name: String,
  localDestinations: Object, 
  packages: Object, 
  testmonies: Object,
  themedHolidays: Object,
  faqs: Object,
  companyInfo: Object,
  sectionImages:Object,
})

const formData  = reactive({
    name: null,
    email: null,
    date: null,
    service_uuid: null,
    timeslot_uuid: null,
    phone: null,
})

onMounted(() => {
  isLoading.value = false
  // initVariables()
  // $(document).ready(function() {
  //   $('select').niceSelect();
  // });
  // const lists = document.querySelectorAll('ul')
  // lists.forEach((list) => {
  //   list.classList.add('list')
  // })
  // isLoading.value =false
})
// watch(() => isLoading.value, () => {
//   // Set the loading state to false once the main content has finished loading
//   isLoading.value = false;

// })

function initVariables(){
  props.sectionImages.forEach(element => {
      if(element.area === 'Home-About Section'){
          aboutSection.value = element.cover_image;
      }
      if(element.area === 'Home-Welcome Section'){
          welecomeSection.value = element.cover_image;
      }
  });
}
async function bookAppointment() {
  console.log(formData);
  // return;
  isLoading.value = true
  if (formData.timeslot_uuid == '' || formData.name == '' || formData.email== '' || formData.service_uuid=='' || formData.date=='') {
    isLoading.value = false
    return notification('Kindly fill all the required fields', 'error')
  } 
   
  try {
    const response = await axios.post(`/book-appointment`,formData);
    if (response.data.error) {
      notification(response.data.error, 'error')
    } 
    if (response.data.success) {
      notification(response.data.success, 'success')
    } 
    formData.name = '';
    formData.email = '';
    formData.date = '';
    formData.service_uuid = '';
    formData.timeslot_uuid = '';
    formData.phone = '';
    
    isLoading.value = false
  } catch (error) {
    console.log(error.error);
    notification(error.error, 'error')
    isLoading.value = false
  }
}
</script>
<template>
  <div>
    <Head>
      <title>Home</title>
    </Head>

  <div v-if="isLoading" class="preloader">
      <div class="loader">
          <div class="sbl-half-circle-spin"></div>
      </div>
  </div>
  <div v-else>

    <section class="home">
        <video src="../../../assets/video3.mp4" class="video-slide active" autoplay muted loop></video>
        <video src="../../../assets/travel-video.mp4" class="video-slide" autoplay muted loop></video>
        <video src="../../../assets/video1.mp4" class="video-slide" autoplay muted loop></video>
        <video src="../../../assets/video2.mp4" class="video-slide" autoplay muted loop></video>
        <div class="content">
            <h1>Explore<br><span>Travel</span></h1>
            <p>The hotel and resort business is one of the best and loyal business in the global market. We are the agency that helps to book you a good room in a suitable palace at a reasonable price.</p>
            <a href="http://">Read More</a>
        </div>
        <div class="left-bar">
            <i class="fa-solid fa-arrow-down"></i>
            <br>
            <div class="dots"></div>
            <div class="dots"></div>
            <div class="dots"></div>
            <div class="dots"></div>
        </div>
        <div class="media-icons">
            <a href="http://"><i class="fab fa-facebook"></i></a>
            <a href="http://"><i class="fab fa-instagram"></i></a>
            <a href="http://"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>

    <main class="main pt-0 ">
        <section class="bg-gradient-to-r from-tbrown via-via to-tbrown"></section>
        
        <section class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44 mb-0">
            
            <h1 class="text-5xl font-bold text-center">Travel Across Africa with ease</h1>
            <p class="pt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit officiis possimus illo delectus consequatur eligendi nulla, adipisci iste similique ea reprehenderit, error corrupti, aperiam quasi quisquam ipsum assumenda. Provident, esse.</p>
            <div class="">
                <div class="flex justify-between items-center py-20 ">
                    <div class="w-1/2">
                        <h2 class="text-5xl font-semibold text-gray-800">Twiggy Travels. "It's our time. Let's explore."</h2>
                        <h3 class="text-xl font-semibold text-gray-600 mt-4">Twiggy travels is a tour and travel company based in Kenya.</h3>
                        <p class="text-gray-600 mt-4">The company offers unsurpassed and affordable tour services for groups, individuals, couples and corporates. Our general aim is to ensure that the clients get the best services and that their varied needs are equitably met. 
                            We do not have an excuse of not attaining the quality desired by our clients. Twiggy travels offers varied services ranging from tour, team building, valentine packages, SGR bookings to Hotel bookings across Kenya. 
                            The staff members are highly qualified with adequate skills necessary to steer and satisfy the needs of our clients. </p>
                    </div>
                    <div class="w-1/2">
                        <img src="https://www.emprenderconactitud.com/img/fidelizamas.png"  class="w-full h-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="300" height="300">
                            <!-- Moon -->
                
                            <!-- Stars -->
                            <g fill="#b56952">
                              <circle cx="30" cy="25" r="2" />
                              <circle cx="20" cy="40" r="1.5" />
                              <circle cx="60" cy="20" r="2" />
                              <circle cx="80" cy="35" r="1.5" />
                              <circle cx="45" cy="12" r="1.5" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="-mt-60 pt-20">
                <div class="py-16 bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100">  
                    <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                        <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                        <div class="md:5/12 lg:w-5/12">
                            <img class="rounded-img" src="ocean_bank_1658560210.jpeg" alt="image" loading="lazy" width="" height="">
                        </div>
                        <div class="md:7/12 lg:w-6/12">
                            <h2 class="text-2xl text-gray-900 font-bold md:text-4xl">Nuxt development is carried out by passionate developers</h2>
                            <p class="mt-6 text-gray-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum omnis voluptatem accusantium nemo perspiciatis delectus atque autem! Voluptatum tenetur beatae unde aperiam, repellat expedita consequatur! Officiis id consequatur atque doloremque!</p>
                            <p class="mt-4 text-gray-600"> Nobis minus voluptatibus pariatur dignissimos libero quaerat iure expedita at? Asperiores nemo possimus nesciunt dicta veniam aspernatur quam mollitia.</p>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="flex justify-between items-center py-20 ">
                    <div class="w-1/2 p-6 rounded-t-lg">
                        <img  src="ocean_bank_1658560210.jpeg" class="w-full h-auto rounded-img">
                    </div>         
                    <div class="w-1/2">
                        <h2 class="text-5xl font-semibold text-gray-800">Let's go with</h2>
                        <h3 class="text-xl font-semibold text-gray-600 mt-4">Twiggy travels is a tour and travel company based in Kenya.</h3>
                        <p class="text-gray-600 mt-4">The company offers unsurpassed and affordable tour services for groups, individuals, couples and corporates. Our general aim is to ensure that the clients get the best services and that their varied needs are equitably met. 
                            We do not have an excuse of not attaining the quality desired by our clients. Twiggy travels offers varied services ranging from tour, team building, valentine packages, SGR bookings to Hotel bookings across Kenya. 
                            The staff members are highly qualified with adequate skills necessary to steer and satisfy the needs of our clients. </p>
                    </div>
                </div> -->
            </div>
        </section>

        <!-- FAQ -->
        <section class="curved-radius-top pt-3 bg-cblack -mt-10"></section>
        <section class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44">
            <!-- component bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100  -->
            <div class="max-w-screen-xl faq">
                <h4 class="text-4xl font-bold text-gray-800 tracking-widest uppercase text-center">FAQ</h4>
                <p class="text-center text-gray-600 text-sm mt-2">Here are some of the frequently asked questions</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8  xl:gap-12 px-2 xl:px-12 mt-4">
                    <div class="flex space-x-8 mt-8">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="#b56952">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-700">What are Benefits of This Agency?</h4>
                            <p class="text-gray-600 my-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, dignissimos. Neque eos, dignissimos provident reiciendis debitis repudiandae commodi perferendis et itaque, similique fugiat cumque impedit iusto vitae dolorum. Nostrum, fugit!</p>
                            <a href="#" class="text-tbrown hover:text-cblack hover:underline capitalize" title="Read More">Read More</a>
                        </div>
                    </div>
                    
                    <div class="flex space-x-8 mt-8">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="#b56952">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-700">How will I make Payment on Booking?</h4>
                            <p class="text-gray-600 my-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, dignissimos. Neque eos, dignissimos provident reiciendis debitis repudiandae commodi perferendis et itaque, similique fugiat cumque impedit iusto vitae dolorum. Nostrum, fugit!</p>
                            <a href="#" class="text-tbrown hover:text-cblack hover:underline capitalize" title="Read More">Read More</a>
                        </div>
                    </div>

                    <div class="flex space-x-8 mt-8">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="#b56952">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-700">Neque eos, dignissimos provident reiciendis debitis?</h4>
                            <p class="text-gray-600 my-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, dignissimos. Neque eos, dignissimos provident reiciendis debitis repudiandae commodi perferendis et itaque, similique fugiat cumque impedit iusto vitae dolorum. Nostrum, fugit!</p>
                            <a href="#" class="text-tbrown hover:text-cblack hover:underline capitalize" title="Read More">Read More</a>
                        </div>
                    </div>

                    <div class="flex space-x-8 mt-8">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="#b56952">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-700">Repudiandae commodi perferendis et itaque?</h4>
                            <p class="text-gray-600 my-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, dignissimos. Neque eos, dignissimos provident reiciendis debitis repudiandae commodi perferendis et itaque, similique fugiat cumque impedit iusto vitae dolorum. Nostrum, fugit!</p>
                            <a href="#" class="text-tbrown hover:text-cblack hover:underline capitalize" title="Read More">Read More</a>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>

        <!-- Packages destinations -->
        <section class="curved-radius-top pt-3 bg-cblack -mt-10"></section>
        <div class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44  px-4 py-16 mx-auto sm:px-6 lg:px-8">
            <h4 class="text-4xl font-bold text-gray-800 tracking-widest uppercase text-center">Popular Packages</h4>
            <p class="text-center text-gray-600 text-sm mt-2 mb-6">Here are some of the frequently asked questions</p>
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- <x-swiper>
                    <swiper-slide v-for="(pakage,index) in packages" :key="index">
                        <div>
                            <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-80 max-w-sm mx-auto mt-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,0.2)]">
                                <img :src="'/storage/packages/cover_images/'+pakage.cover_image" alt="University of Southern California" class="absolute inset-0 h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                                <h3 class="z-10 mt-3 text-3xl font-bold text-white">{{ pakage.title }}</h3>
                                <div class="z-10 gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">City of love</div>
                                <div class="z-20 pt-2">
                                    <a href="#!" data-te-ripple-init data-te-ripple-color="light" class=" inline-block rounded bg-cblack px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-[#b56952] hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-[#b56952] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-[#b56952] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">Learn more</a>
                                </div>
                            </article>
                        </div>
                    </swiper-slide>
                </x-swiper> -->

                <div v-for="(pakage,index) in packages" :key="index" >
                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-80 max-w-sm mx-auto mt-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,0.2)]">
                        <img :src="'/storage/packages/cover_images/'+pakage.cover_image" alt="University of Southern California" class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                        <h3 class="z-10 mt-3 text-3xl font-bold text-white">{{ pakage.title }}</h3>
                        <div class="z-10 gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">City of love</div>
                        <div class="z-20 pt-2">
                            <a href="#!" data-te-ripple-init data-te-ripple-color="light" class=" inline-block rounded bg-cblack px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-[#b56952] hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-[#b56952] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-[#b56952] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">Learn more</a>
                        </div>
                    </article>
                </div>
                
            </div>
        </div>

        <!-- Popular destinations -->
        <section class="curved-radius-top pt-3 bg-cblack -mt-10"></section>
        <div class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44 px-4 py-16 mx-auto sm:px-6 lg:px-8">
            <h4 class="text-4xl font-bold text-gray-800 tracking-widest uppercase text-center">Popular Destinations</h4>
            <p class="text-center text-gray-600 text-sm mt-2 mb-6">Here are some of the frequently asked questions</p>
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                
                <div v-for="(localDestination,index) in localDestinations" :key="index">
                    <div class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(141,99,76,0.07),0_10px_20px_-2px_rgba(141,99,76,0.04)] dark:bg-tbrown">
                        <div class="relative overflow-hidden bg-cover bg-no-repeat" data-te-ripple-init data-te-ripple-color="light">
                            <img :src="'/storage/destinations/cover_images/'+localDestination.cover_image" class="w-full rounded-t-lg" />
                            <a href="#!">
                                <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,0.2)]"></div>
                            </a>
                            <svg class="absolute left-0 bottom-0 text-white dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="#b56952"
                                  d="M0,288L48,256C96,224,192,160,288,160C384,160,480,224,576,213.3C672,203,768,117,864,85.3C960,53,1056,75,1152,69.3C1248,64,1344,32,1392,16L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                                </path>
                            </svg>
                              
                        </div>
                        <div class="p-6">
                            <h5 class="mb-4 text-lg font-bold text-white">Camping travel</h5>
                            <p class="mb-6 text-gray-300">
                                {{ localDestination.title }}
                            </p>
                            <a href="#!" data-te-ripple-init data-te-ripple-color="light" class="inline-block rounded bg-cblack px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-[#b56952] hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-[#b56952] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-[#b56952] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="curved-radius-top pt-3 bg-cblack -mt-10"></section>
        <section class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44">
            <!-- component -->
            <div class=" bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100">  
                <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                    <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                    <div class="md:5/12 lg:w-5/12">
                        <img src="https://tailus.io/sources/blocks/left-image/preview/images/startup.png" alt="image" loading="lazy" width="" height="">
                    </div>
                    <div class="md:7/12 lg:w-6/12">
                        <h2 class="text-2xl text-gray-900 font-bold md:text-4xl">Nuxt development is carried out by passionate developers</h2>
                        <p class="mt-6 text-gray-600">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum omnis voluptatem accusantium nemo perspiciatis delectus atque autem! Voluptatum tenetur beatae unde aperiam, repellat expedita consequatur! Officiis id consequatur atque doloremque!</p>
                        <p class="mt-4 text-gray-600"> Nobis minus voluptatibus pariatur dignissimos libero quaerat iure expedita at? Asperiores nemo possimus nesciunt dicta veniam aspernatur quam mollitia.</p>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
  </div>
</div>
</template>
  
<style scoped>
.curved-radius-top{
    border-top-left-radius: 4.5rem !important;
    border-top-right-radius: 4.5rem !important; 
}
</style>