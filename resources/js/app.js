// jQuery
import '../../node_modules/jquery/dist/jquery.min.js';
import '../../node_modules/jquery-migrate/dist/jquery-migrate.min.js'

// Bootstrap
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';

// Appear
// import '../../node_modules/appear/dist/appear.js';

// Theme CSS
import '../css/theme/hs-mega-menu.css';

// Bootstrap icons
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';

// Vue / inertia components
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';


const styleCssPath = appearance === "dark" ? "../css/theme-dark.min.css" : "../css/theme.min.css";
import(styleCssPath/* @vite-ignore */);

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const VueApp = createApp({ render: () => h(app, props) });

        VueApp.use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' });

(function() {
    // INITIALIZATION OF BOOTSTRAP DROPDOWN
    // =======================================================
    HSBsDropdown.init()

    // INITIALIZATION OF MEGA MENU
    // =======================================================
    new HSMegaMenu('.js-mega-menu', {
    desktop: {
        position: 'left'
    }
    })
})()