<template>
  <div v-if="!isLoading" >
    <header class="top-header top-header-bg">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-2 pr-0">
            <div class="language-list">
              <select class="language-list-item">
                <option>English</option>
              </select>
            </div>
          </div>
          <div class="col-lg-9 col-md-10">
            <div class="header-right">
              <ul>
                <li>
                  <i class="bx bx-home-alt"></i>
                  <a href="#">{{ topBarData.companyInfo.location }}</a>
                </li>
                <li>
                  <i class="bx bx-phone-call"></i>
                  <a :href="'tel:'+topBarData.companyInfo.phone_numbers">{{ topBarData.companyInfo.phone_numbers }}</a>
                </li>
                <li>
                  <i class="bx bx-envelope"></i>
                  <a :href="'mailto:'+topBarData.companyInfo.emails"
                    ><span
                      class="__cf_email__"
                      data-cfemail="5038353c3c3f1031243f3c397e333f3d"
                      >{{ topBarData.companyInfo.emails }}</span
                    >
                  </a>
                </li>
              </ul>
              <ul>
                <li v-for="(socialMedia, index) in topBarData.socialMedias" :key="index">
                        <a v-if="socialMedia.name.includes('Facebook') " :href="socialMedia.link" target="_blank">
                            <i class="bx bxl-facebook"></i>
                        </a>
                        <a v-if="socialMedia.name.includes('Twitter')" :href="socialMedia.link" target="_blank">
                            <i class="bx bxl-twitter"></i>
                        </a>
                        <a v-if="socialMedia.name.includes('Insta')" :href="socialMedia.link" target="_blank">
                            <i class="bx bxl-instagram"></i>
                        </a>
                        <a v-if="socialMedia.name.includes('Pinte')" :href="socialMedia.link" target="_blank">
                            <i class="bx bxl-pinterest-alt"></i>
                        </a>
                        <a v-if="socialMedia.name.includes('Youtube')" :href="socialMedia.link" target="_blank">
                            <i class="bx bxl-youtube"></i>
                        </a>
                        <a v-if="socialMedia.name.includes('Linked')" :href="socialMedia.link" target="_blank">
                            <i class="bx bxl-linkedin"></i>
                        </a>
                  </li>
                  <li>
                        <a href="https://wa.me/254111280938" target="_blank">
                            <i class="bx bxl-whatsapp"></i>
                        </a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    export default{
            components:{Link},
            data(){
                return{
                    topBarData:{},
                    isLoading:true,
                }
            },
            mounted(){
                this.getData();
            },
            methods:{
                getData(){
                    axios.get('/topbar-data').then(response => {
                        this.topBarData = response.data;
                        this.isLoading = false;
                    }).catch((error) => {
                        this.isLoading = false;
                    })
                }
            }
    }
</script>

<!-- <script setup> -->
// import {onMounted} from 'vue'
// import axios from 'axios'
// import { Link } from '@inertiajs/inertia-vue3'
// import {useForm} from '@inertiajs/inertia-vue3'

// //  const props = defineProps({
// //   topBarData: Object,
// //   isLoading: Boolean,
// //   name: String,
// // });
// let companyInfo = {}
// let form = useForm({
//     topBarData:{},
//     companyInfo:{},
//     isLoading: true,
//     name: '',
// });
// // let self = this;
// onMounted(() => {
//     form.isLoading = true;
//     getData();
//     console.log(companyInfo);
//     console.log(form.name)
// })

// form.name = 'Her';

// function getData(){
//     console.log('hey');
//     axios.get('/topbar-data').then(response => {
//         // console.log(response.data.companyInfo)
//         companyInfo = response.data.companyInfo;
//         form.isLoading = false;
//     }).catch((error) => {
//         form.isLoading = false;
//     })
// }

<!-- </script> -->

<style scoped>
</style>
