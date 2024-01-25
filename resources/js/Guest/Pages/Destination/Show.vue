<template>
  <div>
    <Head title="Tour Details" />
    <div v-if="isLoading" class="preloader">
        <div class="loader">
            <div class="sbl-half-circle-spin"></div>
        </div>
    </div>

    <div v-else>
      <!-- Banner Section -->
      
      <section class="banner">
          <div class="container mx-auto flex items-center justify-start h-full">
              <div class="text-white">
                  <h1 class="text-3xl font-bold">Blog > Article Title</h1>
              </div>
          </div>
      </section>

      <main class="main pt-0 ">
        <section class="curved-radius-top pt-3 bg-cblack -mt-10"></section>
        <section class="curved-radius-top bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100 -mt-44">
            <!-- component -->
            <div class=" bg-gradient-to-r from-gray-100 via-[#bce1ff] to-gray-100">  
                <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                    <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                    <div class="md:5/12 lg:w-5/12">
                        <!-- <img src="https://tailus.io/sources/blocks/left-image/preview/images/startup.png" alt="image" loading="lazy" width="" height=""> -->
                        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                          <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
                          </div>
                          <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                            <div class="max-w-md mx-auto">
                              <div>
                                <h1 class="text-2xl font-semibold">Booking Sheet</h1>
                              </div>
                              <div class="divide-y divide-gray-200">
                                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                  <div class="relative">
                                    <input autocomplete="off" id="name" name="name" 
                                      type="text" 
                                      class="peer placeholder-transparent h-10 w-full border-b-2 
                                      border-gray-300 text-gray-900 focus:outline-none 
                                      focus:borer-rose-600 rounded-md rounded-md" placeholder="Fullname" />
                                    
                                    <label for="name" 
                                      class="absolute left-2 -top-5 text-gray-600 
                                          text-sm peer-placeholder-shown:text-base 
                                          peer-placeholder-shown:text-gray-440 
                                          peer-placeholder-shown:top-2 transition-all 
                                          peer-focus:-top-5 peer-focus:text-gray-600 
                                          peer-focus:text-sm">
                                          Full Name
                                    </label>
                                  </div>
                                  <div class="relative">
                                    <input autocomplete="off" id="email" name="email" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md" placeholder="Email address" />
                                    <label for="email" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                  </div>
                                  <div class="relative">
                                    <input autocomplete="off" id="phone_no" name="phone_no" type="text" class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600  rounded-md" placeholder="+254 71 000 000" />
                                    <label for="phone_no" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Phone Number</label>
                                  </div>

                                  <div class="flex items-center space-x-4 mb-3">
                                    <div class="flex flex-col">
                                      <label class="leading-loose">Start</label>
                                      <div class="relative focus-within:text-gray-600 text-gray-400">
                                        <input type="text" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="25/02/2020">
                                        <div class="absolute left-3 top-2">
                                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="flex flex-col">
                                      <label class="leading-loose">End</label>
                                      <div class="relative focus-within:text-gray-600 text-gray-400">
                                        <input type="text" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="26/02/2020">
                                        <div class="absolute left-3 top-2">
                                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="relative">
                                    <input autocomplete="off" id="check_in" name="check_nin" type="date" class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600  rounded-md" placeholder="+254 71 000 000" />
                                    <label for="check_in" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">From</label>
                                  </div>
                                  <div class="relative">
                                    <input autocomplete="off" id="check_out" name="check_out" type="date" 
                                    class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md" placeholder="+254 71 000 000" />
                                    <label for="check_out" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">To</label>
                                  </div> -->

                                  <div class="relative mt-5">
                                    <select autocomplete="off" id="resident_country" name="resident_country" 
                                      class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md">
                                      <option value="">--Select--</option>
                                      <option value="Angola">Angola</option>
                                      <option value="Afghanistan">Afghanistan</option>
                                      <option value="Kenya">Kenya</option>
                                      <option value="UK">UK</option>
                                      <option value="US">US</option>
                                      <option value="Germany">Germany</option>
                                      <option value="Uganda">Uganda</option>
                                      <option value="Tanzania">Tanzania</option>
                                      <option value="Other">Other</option>
                                    </select>
                                    <label for="resident_country" class="absolute left-2 -top-6 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Country of Residency</label>
                                  </div>

                                  <div class="relative">
                                    <select autocomplete="off" id="adults_no" name="adults_no" class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md">
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                    <label for="adults_no" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Number of Adults</label>
                                  </div>

                                  <div class="relative">
                                    <select autocomplete="off" id="children_no" name="children_no" class="mb-3 peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md">
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                    <label for="children_no" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Number of Kids</label>
                                  </div>


                                  <div class="relative">
                                    <textarea name="" id="message" cols="30" rows="12" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600 rounded-md" placeholder="Write your message">

                                    </textarea>
                                    <label for="message" class="absolute left-2 -top-5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Any Other Details</label>
                                  </div>

                                  <div class="relative">
                                    <button class="bg-blue-500 text-white rounded-md px-2 py-1">Book Now</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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

<script setup>
import {onMounted} from 'vue'
import axios from 'axios'
// import Datepicker from '@vuepic/vue-datepicker';
// import '@vuepic/vue-datepicker/dist/main.css'
import { useForm } from '@inertiajs/vue3' 
import { Head, Link } from "@inertiajs/vue3";
import { ref, watch } from 'vue';

    const loading = ref(true);
    const props =  defineProps({
        cardData:Object,
        pageTitle: String,
        headerImage: String,
        tourType: String,
        relatedOffers: Object,
        url: String,
        prices: Object,
    });

    let form = useForm({
        name: '',
        email: '',
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
        form.destination_id = props.cardData.id;
        form.destination_id = props.cardData.id;
        form2.destination_id = props.cardData.id;
        // loading = false;
        // console.log(props.cardData.cover_image)
    })
    watch(() => loading.value, () => {
      // Set the loading state to false once the main content has finished loading
      loading.value = false;
    });
    let submit = () => {
        form.post('/customer-ratting');
    }
    let book = () => {
        form2.post('/customer-booking');
    }
    let value = '';

    function test(id){
        // form.get('/test')
        var value2 ='';
        axios.get('/get-ratting/'+id)
            .then((response)=>{
                value = JSON.stringify(response.data) ;
                // console.log(value)
                value2 = value;
                return value2;
            })
            .catch(error => console.log(error))
        console.log("Value 2:"+value2)

    }

    $(document).ready(function (){
      // let ratting = ''
      var self = this;
      var ratting2 = '';
      $(".review-ratting .bx").click(
        function () {
          if ($(this).hasClass("bxs-star")){
            var min = $(this).attr('value');
            console.log(ratting2);
            for (let i = 1; i <= ratting2; i++) {
              var element =  $('#'+i);
              element.removeClass("bxs-star");
              element.addClass("bx-star");
            }
            console.log("Min: "+min);
            for (let i = min; i >= 1; i--) {
              var element =  $('#'+i);
              element.removeClass("bx-star");
              element.addClass("bxs-star");
            }
           ratting2 = min;
           form.ratting=min;
           $('#rating').val(min);
          } else {
            var max = $(this).attr('value');
            for (let i = 1; i <= max; i++) {
              var element =  $('#'+i);
              element.removeClass("bx-star");
              element.addClass("bxs-star");
            }
            ratting2 = max;
            $('#rating').val(max);
            form.ratting=max;
            console.log(ratting2);
          }

        },
      );
    });
</script>

<style scoped>
    .not-allowed {
        cursor: not-allowed !important;
    }
    .hidden{
        display:none;
    }
    .inner-bg9 {
     /* background-image: url(../public/assets/img/banner2.jpeg); */
    }
    .review-ratting .bx:hover {

    }
</style>
