<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
//import { useRouter } from 'vue-router'
// import { usePage } from '@inertiajs/vue3';

import { router } from '@inertiajs/vue3'

import SidebarLinkGroup from '@/Admin/Partials/SidebarLinkGroup.vue'
import SidebarLink from '@/Components/SidebarLink.vue'

const props = defineProps({
  sidebarOpen: Boolean
});

const trigger = ref(null);
const sidebar = ref(null);

const storedSidebarExpanded = localStorage.getItem('sidebar-expanded');
const sidebarExpanded = ref(storedSidebarExpanded === null ? false : storedSidebarExpanded === 'true');

// const $page = useRouter().$page.value;

// const { route } = usePage();
// const $page = route();

// close on click outside
const clickHandler = ({ target }) => {
  if (!sidebar.value || !trigger.value) return;
  if (!props.sidebarOpen || sidebar.value.contains(target) || trigger.value.contains(target)) return;
  emit('close-sidebar');
};

// close if the esc key is pressed
const keyHandler = ({ keyCode }) => {
  if (!props.sidebarOpen || keyCode !== 27) return;
  emit('close-sidebar');
};

onMounted(() => {
  document.addEventListener('click', clickHandler);
  document.addEventListener('keydown', keyHandler);
});

onUnmounted(() => {
  document.removeEventListener('click', clickHandler);
  document.removeEventListener('keydown', keyHandler);
});

watch(sidebarExpanded, () => {
  localStorage.setItem('sidebar-expanded', sidebarExpanded.value);
  if (sidebarExpanded.value) {
    document.querySelector('body').classList.add('sidebar-expanded');
  } else {
    document.querySelector('body').classList.remove('sidebar-expanded');
  }
});

</script>
<template>
 <div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="mr-5 fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true"></div>

    <!-- Sidebar -->
    <div
      id="sidebar"
      ref="sidebar"
      class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-80 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
    >

      <!-- Sidebar header -->
      <div class="flex justify-between mb-10 pr-3 sm:px-2">
        <!-- Close button -->
        <button
          ref="trigger"
          class="lg:hidden text-slate-500 hover:text-slate-400"
          @click.stop="$emit('close-sidebar')"
          aria-controls="sidebar"
          :aria-expanded="sidebarOpen"
        >
          <span class="sr-only">Close sidebar</span>
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
          </svg>
        </button>
        <!-- Logo -->
        <Link class="block" :href="route('admin.dashboard')">
          <img src="/assets/images/TwiggyLogo.svg" alt="logo" />
         
        </Link>
      </div>

      <!-- Links -->
      <div class="space-y-8">
        <!-- Pages group -->
        <div>
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Home</span>
          </h3>
          <ul class="mt-3">
            <!-- Dashboard -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="$page.url  === '/' || $page.url .includes('dashboard')">
              <a class="block text-slate-200 truncate transition duration-150" :class="($page.url  === '/' || $page.url .includes('dashboard')) ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="($page.url  === '/' || $page.url .includes('dashboard')) ? 'text-indigo-500' : 'text-slate-400'" d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                      <path class="fill-current" :class="($page.url  === '/' || $page.url .includes('dashboard')) ? 'text-indigo-600' : 'text-slate-600'" d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                      <path class="fill-current" :class="($page.url  === '/' || $page.url .includes('dashboard')) ? 'text-indigo-200' : 'text-slate-400'" d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />                      
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <template v-if="$page.props.auth.role === 'Administrator'">
                    <SidebarLink :href="route('admin.dashboard')" :active="$page.url == '/admin/dashboard'" >
                      <li class="mb-1 last:mb-0" :href="route('admin.dashboard')" :active="$page.url == '/admin/dashboard'">
                        <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                          <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Analytics</span>
                        </a>
                      </li>
                    </SidebarLink>
                  </template>
                  <template v-else-if="$page.props.auth.role === 'Student'">
                    <SidebarLink :href="route('student.dashboard')" :active="$page.url == '/student/dashboard'" >
                      <li class="mb-1 last:mb-0" :href="route('student.dashboard')" :active="$page.url == '/student/dashboard'">
                        <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                          <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Analytics</span>
                        </a>
                      </li>
                    </SidebarLink>
                  </template>
                    
                </ul>
              </div>
            </SidebarLinkGroup> 

            
            <!-- Destinations Management  -->
            <SidebarLinkGroup v-if="$page.props.auth.role == 'Administrator' || $page.props.auth.role == 'administrator' " v-slot="parentLink" :activeCondition="$page.url .includes('destination')">
              <a class="block text-slate-200 truncate transition duration-150" :class="$page.url .includes('destination') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="$page.url .includes('destination') ? 'text-indigo-300' : 'text-slate-400'" d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                      <path class="fill-current" :class="$page.url .includes('destination') ? 'text-indigo-600' : 'text-slate-700'" d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" />
                      <path class="fill-current" :class="$page.url .includes('destination') ? 'text-indigo-500' : 'text-slate-600'" d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" />                    
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Destinations </span>
                  </div>
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <SidebarLink :href="route('admin.destination')" :active="$page.url == '/admin/destination-category'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Destination Categories</span>
                      </a>
                    </li>
                  </SidebarLink>
                  <SidebarLink :href="route('admin.destination')" :active="$page.url == '/admin/destination'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Destination</span>
                      </a>
                    </li>
                  </SidebarLink>
                  
                </ul>
              </div>
            </SidebarLinkGroup>

            <!-- Package Management  -->
            <SidebarLinkGroup v-if="$page.props.auth.role == 'Administrator' || $page.props.auth.role == 'administrator' " v-slot="parentLink" :activeCondition="$page.url .includes('package')">
              <a class="block text-slate-200 truncate transition duration-150" :class="$page.url .includes('package') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="$page.url .includes('package') ? 'text-indigo-300' : 'text-slate-400'" d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                      <path class="fill-current" :class="$page.url .includes('package') ? 'text-indigo-600' : 'text-slate-700'" d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" />
                      <path class="fill-current" :class="$page.url .includes('package') ? 'text-indigo-500' : 'text-slate-600'" d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" />                    
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Package </span>
                  </div>
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <!-- <SidebarLink :href="route('admin.destination')" :active="$page.url == '/admin/destination-category'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Destination Categories</span>
                      </a>
                    </li>
                  </SidebarLink> -->
                  <SidebarLink :href="route('admin.package')" :active="$page.url == '/admin/package'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Package</span>
                      </a>
                    </li>
                  </SidebarLink>
                  
                </ul>
              </div>
            </SidebarLinkGroup>
         
          </ul>
        </div>

        <!-- Setup  -->
        <div v-if="$page.props.auth.role === 'Administrator' || $page.props.auth.role == 'administrator' " >
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Setup</span>
          </h3>
          <ul class="mt-3">
            <SidebarLinkGroup v-if="$page.props.auth.role == 'Administrator' || $page.props.auth.role == 'administrator' " v-slot="parentLink" :activeCondition="$page.url .includes('holiday') || $page.url .includes('price')">
              <a class="block text-slate-200 truncate transition duration-150" :class="$page.url .includes('holiday') || $page.url .includes('price') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="$page.url .includes('holiday') || $page.url .includes('price')  ? 'text-indigo-300' : 'text-slate-400'" d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                      <path class="fill-current" :class="$page.url .includes('holiday') || $page.url .includes('price') ? 'text-indigo-600' : 'text-slate-700'" d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" />
                      <path class="fill-current" :class="$page.url .includes('holiday') || $page.url .includes('price') ? 'text-indigo-500' : 'text-slate-600'" d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" />                    
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Setup </span>
                  </div>
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  
                  <SidebarLink :href="route('system.company')" :active="$page.url == '/system/company-information'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Company Information</span>
                      </a>
                    </li>
                  </SidebarLink>
                  <SidebarLink :href="route('system.social')" :active="$page.url == '/system/social-media'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Social Media</span>
                      </a>
                    </li>
                  </SidebarLink>
                  <SidebarLink :href="route('admin.section-images')" :active="$page.url == '/admin/sectionimage'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Section Images</span>
                      </a>
                    </li>
                  </SidebarLink>

                  <SidebarLink :href="route('admin.holiday')" :active="$page.url == '/admin/holiday'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Holiday Categories</span>
                      </a>
                    </li>
                  </SidebarLink>

                  <SidebarLink :href="route('admin.price')" :active="$page.url == '/admin/price'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Price Categories</span>
                      </a>
                    </li>
                  </SidebarLink>
                  
                </ul>
              </div>
            </SidebarLinkGroup>
          </ul>
        </div>

        <div v-if="$page.props.auth.role === 'Administrator'">
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <!-- <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span> -->
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">•••</span>
          </h3>
          <ul class="mt-3">
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="$page.url  === '/' || $page.url .includes('bookings')">
              <a class="block text-slate-200 truncate transition duration-150" :class="($page.url  === '/' || $page.url .includes('bookings')) ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="($page.url  === '/' || $page.url .includes('bookings'))  ? 'text-indigo-500' : 'text-slate-600'" d="M1 3h22v20H1z" />
                      <path class="fill-current" :class="($page.url  === '/' || $page.url .includes('bookings'))  ? 'text-indigo-300' : 'text-slate-400'" d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                    </svg>
                   
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bookings</span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <template v-if="$page.props.auth.role === 'Administrator'">
                    <SidebarLink :href="route('admin.bookings')" :active="$page.url == '/admin/bookings'" >
                      <li class="mb-1 last:mb-0" :href="route('admin.bookings')" :active="$page.url == '/admin/bookings'">
                        <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                          <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bookings</span>
                        </a>
                      </li>
                    </SidebarLink>
                  </template>
                    
                </ul>
              </div>
            </SidebarLinkGroup> 
            

          </ul>
        </div> 

        <div v-if="$page.props.auth.role === 'Administrator'">
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <!-- <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span> -->
            <!-- <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Utility</span> -->
          </h3>
          <ul class="mt-3">
            <!-- Messages -->
            <li class=" rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
              <SidebarLinkGroup class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                <div class="flex items-center justify-between">
                  <div class="grow flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-500' : 'text-slate-600'" d="M14.5 7c4.695 0 8.5 3.184 8.5 7.111 0 1.597-.638 3.067-1.7 4.253V23l-4.108-2.148a10 10 0 01-2.692.37c-4.695 0-8.5-3.184-8.5-7.11C6 10.183 9.805 7 14.5 7z" />
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-300' : 'text-slate-400'" d="M11 1C5.477 1 1 4.582 1 9c0 1.797.75 3.45 2 4.785V19l4.833-2.416C8.829 16.85 9.892 17 11 17c5.523 0 10-3.582 10-8s-4.477-8-10-8z" />
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">FAQ's</span>
                  </div>
                  <!-- Badge -->
                  <div class="flex flex-shrink-0 ml-2">
                    <span class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-indigo-500 px-2 rounded">1</span>
                  </div>
                </div>
              </SidebarLinkGroup>
            </li>
             <!-- Calendar -->
            <!-- <router-link to="/calendar" custom v-slot="{ href, navigate, isExactActive }"> -->
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-500' : 'text-slate-600'" d="M1 3h22v20H1z" />
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-300' : 'text-slate-400'" d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Calendar</span>
                  </div>
                </a>
              </li>
          </ul>
        </div> 

        <div v-if="$page.props.auth.role === 'Administrator'">
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <!-- <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span> -->
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Utility</span>
          </h3>
          <ul class="mt-3">
            <!-- Messages -->
            <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
              <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                <div class="flex items-center justify-between">
                  <div class="grow flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-500' : 'text-slate-600'" d="M14.5 7c4.695 0 8.5 3.184 8.5 7.111 0 1.597-.638 3.067-1.7 4.253V23l-4.108-2.148a10 10 0 01-2.692.37c-4.695 0-8.5-3.184-8.5-7.11C6 10.183 9.805 7 14.5 7z" />
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-300' : 'text-slate-400'" d="M11 1C5.477 1 1 4.582 1 9c0 1.797.75 3.45 2 4.785V19l4.833-2.416C8.829 16.85 9.892 17 11 17c5.523 0 10-3.582 10-8s-4.477-8-10-8z" />
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Messages</span>
                  </div>
                  <!-- Badge -->
                  <div class="flex flex-shrink-0 ml-2">
                    <span class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-indigo-500 px-2 rounded">1</span>
                  </div>
                </div>
              </a>
            </li>
             <!-- Calendar -->
            <!-- <router-link to="/calendar" custom v-slot="{ href, navigate, isExactActive }"> -->
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-500' : 'text-slate-600'" d="M1 3h22v20H1z" />
                      <path class="fill-current" :class="isExactActive ? 'text-indigo-300' : 'text-slate-400'" d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Calendar</span>
                  </div>
                </a>
              </li>
          </ul>
        </div> 

        <div>
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <!-- <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span> -->
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">SYSTEM SETTINGS</span>
          </h3>
          <ul class="mt-3">
            
            <!-- User  -->
           <SidebarLinkGroup v-if="$page.props.auth.role == 'Administrator'" v-slot="parentLink" :activeCondition="$page.url .includes('user')">
              <a class="block text-slate-200 truncate transition duration-150" :class="$page.url .includes('user') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current"  :class="$page.url .includes('user') ? 'text-indigo-500' : 'text-slate-600'" d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z" />
                      <path class="fill-current"  :class="$page.url .includes('user') ? 'text-indigo-300' : 'text-slate-400'" d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z" />
                    </svg>
                   
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">User Management </span>
                  </div>
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <SidebarLink :href="route('system.user')" :active="$page.url == '/system/user'" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Users</span>
                      </a>
                    </li>
                  </SidebarLink>
                  
                </ul>
              </div>
            </SidebarLinkGroup> 

            <!-- Settings -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="$page.url .includes('settings')">
              <a class="block text-slate-200 truncate transition duration-150" :class="$page.url .includes('settings') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="parentLink.handleClick(); sidebarExpanded = true">            
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="$page.url .includes('settings') ? 'text-indigo-500' : 'text-slate-600'" d="M19.714 14.7l-7.007 7.007-1.414-1.414 7.007-7.007c-.195-.4-.298-.84-.3-1.286a3 3 0 113 3 2.969 2.969 0 01-1.286-.3z" />
                      <path class="fill-current" :class="$page.url .includes('settings') ? 'text-indigo-300' : 'text-slate-400'" d="M10.714 18.3c.4-.195.84-.298 1.286-.3a3 3 0 11-3 3c.002-.446.105-.885.3-1.286l-6.007-6.007 1.414-1.414 6.007 6.007z" />
                      <path class="fill-current" :class="$page.url .includes('settings') ? 'text-indigo-500' : 'text-slate-600'" d="M5.7 10.714c.195.4.298.84.3 1.286a3 3 0 11-3-3c.446.002.885.105 1.286.3l7.007-7.007 1.414 1.414L5.7 10.714z" />
                      <path class="fill-current" :class="$page.url .includes('settings') ? 'text-indigo-300' : 'text-slate-400'" d="M19.707 9.292a3.012 3.012 0 00-1.415 1.415L13.286 5.7c-.4.195-.84.298-1.286.3a3 3 0 113-3 2.969 2.969 0 01-.3 1.286l5.007 5.006z" />                      
                    </svg>
                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
                  </div>
                  <div class="flex shrink-0 ml-2">
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" :class="parentLink.expanded && 'rotate-180'" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <SidebarLink href="#" >
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Account Settings</span>
                      </a>
                    </li>
                  </SidebarLink>
                  
                </ul>
              </div>
            </SidebarLinkGroup>  
          </ul>
        </div>

        <div>
           
        </div>

        <!-- More group -->
        <div>
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">More</span>
          </h3>
          <ul class="mt-3">
                     
          </ul>
        </div>
      </div>

      <!-- Expand / collapse button -->
      <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
        <div class="px-3 py-2">
          <button @click.prevent="sidebarExpanded = !sidebarExpanded">
            <span class="sr-only">Expand / collapse sidebar</span>
            <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
              <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
              <path class="text-slate-600" d="M3 23H1V1h2z" />
            </svg>
          </button>
        </div>
      </div>

    </div>
  </div>
</template>


