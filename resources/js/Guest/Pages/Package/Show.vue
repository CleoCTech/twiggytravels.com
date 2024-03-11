<template>
    <div>
  
      <Head title="Package Details" />
      <div v-if="isLoading" class="preloader">
        <div class="loader">
          <div class="sbl-half-circle-spin"></div>
        </div>
      </div>
  
      <div v-else>
        <!-- Banner Section -->
  
        <section class="banner bg-gray-700"
          v-bind:style="{ 'background-image': 'url(' + '/storage/packages/cover_images/' + cardData.cover_image + ')' }">
          <div class="container mx-auto flex items-center justify-start h-full py-20">
            <div class="text-white">
              <h5 class="text-base mb-2">Home > Packages</h5>
              <h1 class="text-3xl font-bold">{{cardData.title}}</h1>
            </div>
          </div>
        </section>
  
        <main class="main pt-0 ">
          <section class="curved-radius-top pt-3 bg-cblack -mt-10">
          </section>
  
          <section class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44">
            <!-- component -->
            <div class=" bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100">
              <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                  <div class="md:5/12 lg:w-5/12">
                    <!-- <img src="https://tailus.io/sources/blocks/left-image/preview/images/startup.png" alt="image" loading="lazy" width="" height=""> -->
                    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                      <div
                        class="absolute inset-0 bg-gradient-to-r from-amber-800 via-[#bce1ff] to-slate-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
                      </div>
                      <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                        <div class="max-w-md mx-auto">
                          <div>
                            <h1 class="text-2xl font-semibold">Booking Sheet</h1>
                          </div>
                          <div class="divide-y divide-gray-200">
                            <form @submit.prevent="book">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                              <div class="relative">
                                <input   v-model="form2.name" autocomplete="off" id="name" name="name" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 
                                        border-gray-300 text-gray-900 focus:outline-none 
                                        focus:borer-rose-600 rounded-md rounded-md" placeholder="Fullname" />
  
                                <label for="name" class="absolute left-2 -top-5 text-gray-600 
                                            text-sm peer-placeholder-shown:text-base 
                                            peer-placeholder-shown:text-gray-440 
                                            peer-placeholder-shown:top-2 transition-all 
                                            peer-focus:-top-5 peer-focus:text-gray-600 
                                            peer-focus:text-sm">
                                  Full Name
                                </label>
                                <div v-if="form2.errors.name" v-text="form2.errors.name" style="color:red"></div>
                              </div>
                              <div class="relative">
                                <input  v-model="form2.email" autocomplete="off" id="email" name="email" type="text"
                                  class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md"
                                  placeholder="Email address" />
                                <label for="email"
                                  class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Email
                                  Address</label>
                                  <div v-if="form2.errors.email" v-text="form2.errors.email" style="color:red"></div>
                              </div>
                              <div class="relative">
                                <input v-model="form2.phone_no" autocomplete="off" id="phone_no" name="phone_no" type="text"
                                  class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600  rounded-md"
                                  placeholder="+254 71 000 000" />
                                <label for="phone_no"
                                  class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Phone
                                  Number</label>
                                  <div v-if="form2.errors.phone_no" v-text="form2.errors.phone_no" style="color:red"></div>
                              </div>
  
                              <div class="flex items-center space-x-4 ">
                                <div class="flex flex-col">
                                  <label class="leading-loose">Start</label>
                                  <Datepicker v-model="form2.check_in" class=" border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" format="dd-MM-yyyy" type="date" :lowerLimit="new Date()" placeholder="Start Typing ..." textInput />
                                  <div v-if="form2.errors.check_in" v-text="form2.errors.check_in" style="color:red"></div>
                                </div>
                                <div class="flex flex-col">
                                  <label class="leading-loose">End</label>
                                  <Datepicker v-model="form2.check_out" class=" w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" format="dd-MM-yyyy" type="date" :lowerLimit="new Date()" placeholder="Start Typing ..." textInput />
  
                                  <div v-if="form2.errors.check_out" v-text="form2.errors.check_out" style="color:red"></div>
                                </div>
                              </div>
                          
                              <div class="relative mt-1">
                                <div class="flex flex-col">
                                  <label class="leading-loose">Country</label>
                                  <div class="relative focus-within:text-gray-600 text-gray-400">
                                   
                                    <Dropdown v-model="form2.resident_country" :options="countries" filter optionLabel="name" placeholder="Select a Country" class="mb-0 peer placeholder-transparent h-10 w-full border-2 border-gray-300 text-gray-900  focus:outline-none focus:border-blue-600 rounded-md">
                                      <template #value="slotProps">
                                          <div v-if="slotProps.value" class="flex align-items-center">
                                              <img :alt="slotProps.value.label" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`mr-2 flag flag-${slotProps.value.code.toLowerCase()}`" style="width: 18px" />
                                              <div>{{ slotProps.value.name }}</div>
                                          </div>
                                          <span v-else>
                                              {{ slotProps.placeholder }}
                                          </span>
                                      </template>
                                      <template #option="slotProps">
                                          <div class="flex align-items-center">
                                              <img :alt="slotProps.option.label" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`mr-2 flag flag-${slotProps.option.code.toLowerCase()}`" style="width: 18px" />
                                              <div>{{ slotProps.option.name }}</div>
                                          </div>
                                      </template>
                                    </Dropdown>
                                   
                                  </div>
                                </div>
                              </div>
  
                              <div class="relative -mt-2">
                                <div class="flex flex-col">
                                  <label class="leading-loose">No. of Adults</label>
                                  <div class="relative focus-within:text-gray-600 text-gray-400">
                                    <Dropdown v-model="form2.adults_no" :options="numbers" optionLabel="name" placeholder="Select" checkmark :highlightOnSelect="false" class="mb-0 px-2 peer placeholder-transparent h-10 w-full border-2 border-gray-300 text-gray-900  focus:outline-none focus:border-blue-600 rounded-md" />
                                  </div>
                                </div>
                                <div v-if="form2.errors.adults_no" v-text="form2.errors.adults_no" style="color:red"></div>
                              </div>
  
                              <div class="relative mt-1">
                                <div class="flex flex-col">
                                  <label class="leading-loose">No. of Kids</label>
                                  <div class="relative focus-within:text-gray-600 text-gray-400">
                                    <Dropdown v-model="form2.children_no" :options="numbers" optionLabel="name" placeholder="Select" checkmark :highlightOnSelect="false" class="mb-0 px-2 peer placeholder-transparent h-10 w-full border-2 border-gray-300 text-gray-900  focus:outline-none focus:border-blue-600 rounded-md" />
                                  </div>
                                </div>
                                <div v-if="form2.errors.children_no" v-text="form2.errors.children_no" style="color:red"></div>
                              </div>
  
                              
                              <div class="relative mt-1">
                                <label class="leading-loose">Describe Other details</label>
                                <textarea  v-model="form2.message"  data-error="Write your message" class="shadow appearance-none border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="review-text" rows="4" placeholder="Write your review here..." required></textarea>
                               
                              </div>
                              <div v-if="form2.errors.message" v-text="form2.errors.message" style="color:red"></div>
                              <div class="relative">
                                <div v-if="form2.processing" class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <button type="submit" :data-loading-text="form2.processing? 'Loading...' : ''" :class="form2.processing? 'not-allowed hidden' : ''"
                          :disabled="form2.processing" class="bg-cblack hover:bg-tbrown hover:text-white text-white rounded-md px-4 py-1">Book Now</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <div class="md:7/12 lg:w-6/12">
                    <div class="w-full  px-3 mb-6">
                        <div class="md:6/12 lg:w-8/12">
                            <img class="rounded-img" :src="'/storage/packages/cover_images/' + cardData.cover_image " alt="image" loading="lazy" width="" height="">
                        </div>
                      <div class="mb-4">
                        <h2 class="text-lg font-semibold">{{ cardData.title }}</h2>
                        <div class="flex justify-between items-center mb-2">
                          <ul>
                            <!-- <li v-for="(price, index) in prices" :key="index">
                              <p class="text-amber-700"> {{ price.price_category.name }} : KES.{{ price.price }}</p>
                            </li> -->
                          </ul>
                        
                        </div>
                        <div class="flex justify-between items-center">
                          <p class="text-sm">Validity: {{ cardData.validity }}</p>
                        </div>
                      </div>
                      <hr />
                      <div class="mb-4">
                        <p v-html="cardData.content" class="text-gray-600 text-sm"> </p>
                      </div>
                      <!-- Clients Review Section -->
  
                      <div>
                        <h3 class="text-lg font-semibold">Clients Review and Ratting's</h3>
                        <!-- Rating stars -->
                        <!-- Name and Email for review -->
                        <!-- Review submission form -->
                        <div>
                          <form @submit.prevent="submit">
                            <!-- Rating stars -->
                            <div class="flex items-center mb-4">
                              <div class="flex flex-col">
                                <Rating v-model="form.ratting" :cancel="false" />
                              </div>
                            
                            </div>
                            <!-- Name and Email for review -->
                            <div class="mb-4">
                              <label class="block text-gray-700 text-sm font-semibold mb-2" for="reviewer-name">Name</label>
                              <input v-model="form.name"
                                class="shadow appearance-none border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reviewer-name" type="text" placeholder="Name" required>
  
                                <div v-if="form.errors.name" v-text="form.errors.name" style="color:red"></div>
                            </div>
                            <div class="mb-4">
                              <label class="block text-gray-700 text-sm font-semibold mb-2"
                                for="reviewer-email">Email</label>
                              <input v-model="form.email"
                                class="shadow appearance-none border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="reviewer-email" type="email" placeholder="me@example.com" required>
                                <div v-if="form.errors.email" v-text="form.errors.email" style="color:red"></div>
                            </div>
                            <!-- Review submission form -->
                            <div class="mb-4">
                              <label class="block text-gray-700 text-sm font-semibold mb-2" for="review-text">Write your
                                review here...</label>
                              <textarea  v-model="form.review"
                                class="shadow appearance-none border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="review-text" rows="4" placeholder="Write your review here..." required></textarea>
                                <div v-if="form.errors.review" v-text="form.errors.review" style="color:red"></div>
                            </div>
                            <div class="flex items-center justify-between">
                              <button
                                class="bg-cblack hover:bg-tbrown hover:text-white text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit" :data-loading-text="form.processing? 'Loading...' : ''" :class="form.processing? 'not-allowed hidden' : ''"
                         :disabled="form.processing">
                                Submit Review
                              </button>
                            </div>
                          </form>
                        </div>
  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
  
        </main>
  
      </div>
    </div>
  </template>
    
  <script setup>
  import { onMounted } from 'vue'
  import axios from 'axios'
  import Datepicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css'
  import { useForm } from '@inertiajs/vue3'
  import { Head, Link } from "@inertiajs/vue3";
  import { ref, watch } from 'vue';
  
  import Rating from 'primevue/rating';
  import Carousel from 'primevue/carousel';
  import Dropdown from 'primevue/dropdown';
  // theme
  import 'Primevue/resources/themes/lara-light-blue/theme.css';
  
  const loading = ref(true);
  const props = defineProps({
    cardData: Object,
    pageTitle: String,
    headerImage: String,
    // tourType: String,
    // relatedOffers: Object,
    // url: String,
    // prices: Object,
  });
  
  let form = useForm({
    name: '',
    email: '',
    phone_no: '',
    check_in: '',
    check_out: '',
    country: '',
    adults: '',
    kids: '',
    message: '',
    review: '',
    ratting: 0,
    destination_id: '',
    value: '',
    start_date: '',
    end_date: '',
  
  });
  let form2 = useForm({
    name: '',
    email: '',
    phone_no: '',
    resident_country: '',
    destination_id: '',
    check_in: '',
    check_out: '',
    adults_no: '',
    children_no: '',
    message: '',
  });
  
  onMounted(() => {
    // form.destination_id = props.cardData.id;
    // form.destination_id = props.cardData.id;
    // form2.destination_id = props.cardData.id;
    // loading = false;
    // console.log(props.cardData.cover_image)
  })

  watch(() => loading.value, () => {
    // Set the loading state to false once the main content has finished loading
    loading.value = false;
  });
  
  const products = ref();
  
  const selectedCountry = ref();
  const countries = ref([
      { name: 'Australia', code: 'AU' },
      { name: 'Brazil', code: 'BR' },
      { name: 'China', code: 'CN' },
      { name: 'Egypt', code: 'EG' },
      { name: 'France', code: 'FR' },
      { name: 'Germany', code: 'DE' },
      { name: 'India', code: 'IN' },
      { name: 'Japan', code: 'JP' },
      { name: 'Spain', code: 'ES' },
      { name: 'United States', code: 'US' },
      { name: 'Kenya', code: 'KE' },
      { name: 'Other', code: 'OTHER' }
  ]);
  
  const numbers = ref([
      { name: '1', code: '1' },
      { name: '2', code: '2' },
      { name: '3', code: '3' },
      { name: '4', code: '4' },
      { name: '5', code: '5' },
      { name: '6', code: '7' },
      { name: '8', code: '8' },
      { name: '9', code: '9' },
      { name: '10', code: '10' },
  ]);
  
  let submit = () => {
    form.post('/customer-ratting');
  }
  let book = () => {
    form2.post('/customer-booking');
  }
  let value = '';
  
  function test(id) {
    // form.get('/test')
    var value2 = '';
    axios.get('/get-ratting/' + id)
      .then((response) => {
        value = JSON.stringify(response.data);
        // console.log(value)
        value2 = value;
        return value2;
      })
      .catch(error => console.log(error))
    console.log("Value 2:" + value2)
  
  }
  
  $(document).ready(function () {
    // let ratting = ''
    var self = this;
    var ratting2 = '';
    $(".review-ratting .bx").click(
      function () {
        if ($(this).hasClass("bxs-star")) {
          var min = $(this).attr('value');
          console.log(ratting2);
          for (let i = 1; i <= ratting2; i++) {
            var element = $('#' + i);
            element.removeClass("bxs-star");
            element.addClass("bx-star");
          }
          console.log("Min: " + min);
          for (let i = min; i >= 1; i--) {
            var element = $('#' + i);
            element.removeClass("bx-star");
            element.addClass("bxs-star");
          }
          ratting2 = min;
          form.ratting = min;
          $('#rating').val(min);
        } else {
          var max = $(this).attr('value');
          for (let i = 1; i <= max; i++) {
            var element = $('#' + i);
            element.removeClass("bx-star");
            element.addClass("bxs-star");
          }
          ratting2 = max;
          $('#rating').val(max);
          form.ratting = max;
          console.log(ratting2);
        }
  
      },
    );
  });
  </script>
    
  <style scoped>.not-allowed {
    cursor: not-allowed !important;
  }
  
  .hidden {
    display: none;
  }
  
  .inner-bg9 {
    /* background-image: url(../public/assets/img/banner2.jpeg); */
  }
  
  .review-ratting .bx:hover {}</style>
    