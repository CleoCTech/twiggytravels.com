<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted  } from 'vue';

import {useNotify} from "@/Composables/useNotify";

const {notification} = useNotify();

const footerData = ref({});
const isLoading = ref(true);
const showBookAppointment  = ref(false)
const showMenu  = ref(false)

let clickHandler = (event) => {
  if (!event.target.closest('.meanmenu-reveal')) {
    showMenu.value = false;
  }
}
let clickHandler2 = (event) => {
  if (!event.target.closest('.dot-menu')) {
    showBookAppointment.value = false;
  }
}

onMounted(() => {
    getFooterData();
    document.addEventListener('click', clickHandler);
    document.addEventListener('click', clickHandler2);
});

function toggleBookMenu(){
  showBookAppointment.value = !showBookAppointment.value;
}
function toggleMenu(){
  showMenu.value = !showMenu.value;
}
function getFooterData(){
  axios.get('/footer-data')
    .then(response => {
      // console.log(response.data)
      footerData.value = response.data
      isLoading.value = false;
    })
    .catch(error => {
      console.error(error)
      notification(error, 'error');
      isLoading.value = false;
    })
}

onUnmounted(() => {
  // Clean up resources, remove event listeners, etc.
  document.removeEventListener('click', clickHandler);
  document.removeEventListener('click', clickHandler2);
  // document.removeEventListener('click', clickHandlerMobile);
});
</script>
<template>
<div>
    <div v-if="isLoading" class="preloader">
      <div class="loader">
        <div class="sbl-half-circle-spin"></div>
      </div>
    </div>

    <!-- <header v-else class="header-area hospital-header">
      <div class="top-area hospital-top-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
              <ul class="top-optional-wrap">
                <li v-for="(media, index) in footerData.socialMedias" :key="index">
                  <a :href="media.link" target="_blank"
                    ><i :class="media.svg"></i
                  ></a>
                </li>
                
              </ul>
            </div>
            <div class="col-lg-8 col-md-12">
              <ul class="top-information-wrap">
                <li>
                  <i class="bx bxs-phone"></i>
                  <a :href="'tel:'+footerData.companyInfo.phone_numbers">{{footerData.companyInfo.phone_numbers }}</a>
                </li>
                <li>
                  <i class="bx bx-envelope"></i>
                  <a :href="'tel:'+footerData.companyInfo.emails"
                    ><span class="__cf_email__">{{footerData.companyInfo.emails}}</span></a
                  >
                </li>
                <li>
                  <i class="bx bxs-map"></i>
                  {{footerData.companyInfo.location}}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="navbar-area hospital-navbar-area">
        <div class="main-responsive-nav">
          <div class="container">
            <div class="main-responsive-menu mean-container">
              <div class="mean-bar">
                  <a @click="toggleMenu" href="#nav" class="meanmenu-reveal" style="background:;color:;right:0;left:auto;">
                    <span><span><span></span></span></span>
                  </a>
                  <nav class="mean-nav">
                    <ul v-show="showMenu"  class="navbar-nav ms-auto" >
                      <li class="nav-item">
                        <Link :href="route('home')" class="nav-link"> Home </Link>
                      </li>
                      <li class="nav-item">
                        <Link :href="route('about-us')" class="nav-link"> About Us </Link>
                      </li>
                      <li class="nav-item">
                        <Link :href="route('services')" class="nav-link active">
                          Services
                        </Link>
                      </li>
                      <li class="nav-item">
                        <Link :href="route('blog')" class="nav-link"> Blog </Link>
                      </li>
                      
                    </ul>
                    <div class="others-options d-flex align-items-center">
                      <div class="option-item">
                        <div class="navbar-btn">
                          <Link :href="route('home')+'#appointment'" class="default-btn">Book Appointment</Link>
                        </div>
                      </div>
                    </div>
                 </nav>
              </div>
              <div class="logo">
                <Link :href="route('home')">
                  <img
                    :src="'/storage/companyInfo/images/'+footerData.companyInfo.logo"
                    class="main-logo"
                    alt="logo"
                  />
                  <img
                  :src="'/storage/companyInfo/images/'+footerData.companyInfo.logo"
                    class="white-logo"
                    alt="logo"
                  />
                 
                </Link>
              </div>
            </div>
          </div>
        </div>
        <div class="main-navbar">
          <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
              <Link class="navbar-brand flex" :href="route('home')">
                <img
                    :src="'/storage/companyInfo/images/'+footerData.companyInfo.logo"
                    class="main-logo -mt-3"
                    alt="logo"
                  />
                Dentistry Now
              </Link>
              <div class="navbar-collapse mean-menu">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <Link :href="route('home')" class="nav-link active"> Home </Link>
                  </li>
                  <li class="nav-item">
                    <Link :href="route('about-us')" class="nav-link"> About Us </Link>
                  </li>
                  <li class="nav-item">
                    <Link :href="route('services')" class="nav-link"> Services </Link>
                  </li>
                  
                  <li class="nav-item">
                    <Link :href="route('blog')" class="nav-link"> Blog </Link>
                  </li>
                  
                </ul>
                <div class="others-options d-flex align-items-center">
                  <div class="option-item">
                    <div class="navbar-btn">
                      <Link :href="route('home')+'#appointment'"  class="default-btn"
                        >Book Appointment</Link
                      >
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
        
        <div class="others-option-for-responsive">
          <div class="container">
            <div class="dot-menu" @click="toggleBookMenu">
              <div class="inner">
                <div class="circle circle-one"></div>
                <div class="circle circle-two"></div>
                <div class="circle circle-three"></div>
              </div>
            </div>
            <div class="container" v-bind:class="showBookAppointment ? 'active' : ''">
              <div class="option-inner">
                <div class="others-options d-flex align-items-center">
                  <div class="option-item">
                    <div class="navbar-btn">
                      <Link :href="route('home')+'#appointment'" class="default-btn"
                        >Book Appointment</Link
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header> -->

    <header v-else >
        <a href="http://" class="brand">Twiggy Travels</a>
        <div class="menu-btn"></div>
        <div class="navigation">
            <div class="navigation-items">
                <a href="http://">Home</a>
                <a href="http://">About</a>
                <a href="http://">Explore</a>
                <a href="http://">Gallery</a>
                <a href="http://">Contact</a>
            </div>
        </div>
    </header>

</div>
</template>
