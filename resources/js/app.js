import './bootstrap';
import '../css/app.css';
// import '../css/style.css'

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

// CUSTOM
import { useNotification } from "@kyvg/vue3-notification";
import { createPinia } from 'pinia';
import VueSocialSharing from 'vue-social-sharing'

import Notifications from '@kyvg/vue3-notification'
// import { notify } from "@kyvg/vue3-notification";
import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import 'gitart-vue-dialog/dist/style.css'
import { GDialog } from 'gitart-vue-dialog'
import { plugin as dialogPlugin } from 'gitart-vue-dialog'
import { Icon } from '@iconify/vue';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

import $ from 'jquery';
window.$ = $;

import GuestBlankLayout from '@/Guest/Layouts/Blank.vue'
import GuestLayout from '@/Guest/Layouts/Default.vue'
import SystemLayout from '@/System/Layouts/AppLayout.vue'

// const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        return new Promise((resolve) => {
          if (name.startsWith('Guest/')) {
            import(`./${name}.vue` /* @vite-ignore */)
              .then((module) => {
                if (!module.default) {
                  console.error(`Module or module.default is undefined for page '${name}'.`);
                  resolve(null);
                } else {
                  if (name.startsWith('Guest/Auth/')) {
                    module.default.layout = GuestBlankLayout;
                  } else {
                    module.default.layout = GuestLayout;
                  }
                  resolve(module.default);
                }
              })
              .catch((error) => {
                console.error(`Error loading page component '${name}':`, error);
                resolve(null);
              });
          } else if (name.startsWith('Admin/')) {
            import(`./${name}.vue` /* @vite-ignore */)
              .then((module) => {
                if (!module.default) {
                  console.error(`Module or module.default is undefined for page '${name}'.`);
                  resolve(null);
                } else {
                  module.default.layout = SystemLayout;
                  resolve(module.default);
                }
              })
              .catch((error) => {
                console.error(`Error loading page component '${name}':`, error);
                resolve(null);
              });
          } else if (name.startsWith('System/')) {
            import(`./${name}.vue` /* @vite-ignore */)
              .then((module) => {
                if (!module.default) {
                  console.error(`Module or module.default is undefined for page '${name}'.`);
                  resolve(null);
                } else {
                  module.default.layout = SystemLayout;
                  resolve(module.default);
                }
              })
              .catch((error) => {
                console.error(`Error loading page component '${name}':`, error);
                resolve(null);
              }); 
          } else {
            // Handle other cases or return null as needed.
            resolve(null);
          }
        });
      },

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)

            .use(Notifications)
            .use(VueLoading)
            .component('loading',VueLoading)
            .component('Head',Head)
            .component('Link',Link)
            .component('GDialog', GDialog)
            .component('Icon', Icon)
            .use(createPinia())
            .use(VueSocialSharing, {
                //add custom network
                networks: {
                        linkedin: 'https://linkedin.com/share?url=@url&title=@title'
                }
            })

            .mount(el);
    },
    progress: {
        color: '#2563eb',
        showSpinner: true,
    },
});
