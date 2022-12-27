import './bootstrap';
import '../js/theme.min.js';
// import '../css/app.css';
import '../css/theme.min.css';
import '../css/theme-dark.min.css';
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';

import '../css/hs-mega-menu.css';
import '../js/hs-mega-menu.js';
import '../js/hs.theme-appearance.js';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
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
    (function () {
    // STYLE SWITCHER
    // =======================================================
    const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
    const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

    // Function to set active style in the dorpdown menu and set icon for dropdown trigger
    const setActiveStyle = function () {
        $variants.forEach($item => {
        if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
            $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
            return $item.classList.add('active')
        }

        $item.classList.remove('active')
        })
    }

    // Add a click event to all items of the dropdown to set the style
    $variants.forEach(function ($item) {
        $item.addEventListener('click', function () {
        HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
        })
    })

    // Call the setActiveStyle on load page
    setActiveStyle()

    // Add event listener on change style to call the setActiveStyle function
    window.addEventListener('on-hs-appearance-change', function () {
        setActiveStyle()
    })
    })()