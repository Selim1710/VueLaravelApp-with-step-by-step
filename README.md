## Anik Vai Project:
https://github.com/Md-Anikul-Islam-Binju/job-portal

## Environment Setup :

1. Laravel project crete

2. If you need auth then as normal breeze (as project backend laravel and frontend vue3)

3. Step one: Server site setup
	3.1 composer require inertiajs/inertia-laravel

	3.2 crete file app.blade.php (resource/views/)
	  <html>
            <head>
              <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                @vite('resources/js/app.js')
                @inertiaHead
            </head>
            <body>
              @inertia
            </body>
          </html>
	3.3 php artisan inertia:middleware

	3.4 Go to app/Http/Kernel.php
	  'web' =>[
                    \App\Http\Middleware\HandleInertiaRequests::class,
                  ],
4. Step two: Client Side Setup
	4.1 npm i @inertiajs/inertia
	
	4.2 npm install @inertiajs/vue3@latest

	4.3 npm i @inertiajs/progress
	
	4.4 npm i vue-next

	4.5 npm i vue-loader

	4.6 npm install vite@latest
	   
		=>if error then : 4.7 npm install @vitejs/plugin-vue --save-dev --legacy-peer-deps

	4.8 npm install vue@latest
		=>if error then : 4.8.1 if given erro then use this (npm install vue@latest --legacy-peer-deps)

	4.9 update resource/js/app.js
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
        	const pages = import.meta.glob('./Pages/*/.vue', { eager: true });
        	return pages[./Pages/${name}.vue];
    	 },
    	 setup({ el, App, props, plugin }) {
        		createApp({ render: () => h(App, props) })
            		.use(plugin)
            		.component('Link', Link)
            		.mount(el);
    		},
	 });
	
	4.10 update on vite.config.js
	import { defineConfig } from 'vite';
	import laravel from 'laravel-vite-plugin';
	import vue from '@vitejs/plugin-vue';

	export default defineConfig({
    	plugins: [
        	laravel({
            		input: ['resources/js/app.js'],
            		refresh: true,
        		}),
        	vue({
            		template: {
                	transformAssetUrls: {
                   	 base: null,
                    	includeAbsolute: false,
                	},
            	    },
        	  }),
    		],
	});

	4.11 npm install
		4.11.1 if given error use(npm install --legacy-peer-deps)

	4.12 npm run dev


## Project work :