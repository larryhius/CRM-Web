import '../css/app.css'; 
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';


// App name can be customized
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Inertia setup
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`, 
            import.meta.glob('./Pages/**/*.vue') // Vue pages are in 'Pages' folder
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue) // Allows usage of Ziggy (for routing)
            .mount(el);
    },
    progress: {
        color: '#4B5563', // Custom progress bar color
    },
});
