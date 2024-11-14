import './bootstrap'; 
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';  // Import Link here
import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init();

createInertiaApp({
    resolve: name => {
        // Correct glob pattern to match .vue files inside Pages
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        
        // Correct template literal usage to dynamically return the correct page component
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .mount(el);
    },
});
