<template>
    <Head title="Dashboard" />

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <WelcomeBanner
        :name = "$page.props.auth.user.name"
        :salutation="salutation" 
         />
         <!-- <div  class="grid grid-cols-3 gap-4 bg-gray-900">
            <div class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Pageviews</h2>
                <p class="text-4xl font-bold ">{{statistics.totalViews}}</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Unique visitors</h2>
                <p class="text-4xl font-bold">5,000</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Time on site</h2>
                <p class="text-4xl font-bold">2:30</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Bounce rate</h2>
                <p class="text-4xl font-bold">25%</p>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Referral sources</h2>
                <ul class="list-disc list-inside">
                <li>Google: 60%</li>
                <li>Twitter: 20%</li>
                <li>Facebook: 10%</li>
                <li>Other: 10%</li>
                </ul>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Demographics</h2>
                <ul class="list-disc list-inside">
                <li>Age: 25-34</li>
                <li>Gender: Female</li>
                <li>Location: United States</li>
                </ul>
            </div>
            <div v-if="$page.props.auth.user.user_category == 100" class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Conversion rates</h2>
                <p class="text-4xl font-bold">5%</p>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Popular posts</h2>
                <ol class="list-decimal list-inside">
                <li>10 Ways to Increase Your Blog Traffic</li>
                <li>The Importance of SEO for Your Blog</li>
                <li>5 Tips for Writing Engaging Blog Posts</li>
                </ol>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg text-gray-300">
                <h2 class="text-2xl font-bold mb-4">Engagement</h2>
                <ul class="list-disc list-inside">
                <li>Comments: 50</li>
                <li>Shares: 100</li>
                <li>Likes: 200</li>
                </ul>
            </div>
        </div> -->

    </div>

</template>
<script setup>
import { ref, provide, getCurrentInstance, onMounted  } from 'vue'
import WelcomeBanner from '@/Admin/Partials/Dashboard/WelcomeBanner.vue'
import DashboardCard1 from '@/Components/Dashboard/DashboardCard.vue'
import StatsCard from '@/Components/Dashboard/StatsCard.vue'

import FilterButton from '@/Components/Mosaic/DropdownFilter.vue'
import Datepicker from '@/Components/Mosaic/Datepicker.vue'

import 'primevue/resources/themes/aura-dark-blue/theme.css'

import Chart from 'primevue/chart';
 

const salutation = ref('');
const context = getCurrentInstance()?.appContext.config.globalProperties;

const setSalutation = () => {
  const currentTime = new Date();
  const currentHour = currentTime.getHours();

  if (currentHour >= 5 && currentHour < 12) {
    salutation.value = 'Good morning';
  } else if (currentHour >= 12 && currentHour < 18) {
    salutation.value = 'Good afternoon';
  } else {
    salutation.value = 'Good evening';
  }
};


onMounted( async () => {
    context.$showLoading()
    setSalutation();
    setTimeout(() => {
        context.$hideLoading()
    }, 3000);

    // chartData.value = setChartData();
    // chartOptions.value = setChartOptions();
    // chartData2.value = setChartData2();
    // chartOptions2.value = setChartOptions2();

    
    // isLoading.value = false;
})

</script>
