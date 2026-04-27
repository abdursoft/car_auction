import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h, DefineComponent } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy';

createInertiaApp({
    resolve: (name: string) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', {
            eager: true,
        });
        const page = pages[`./pages/${name}.vue`];

        if (!page) {
            throw new Error(`Page not found: ${name}`);
        }

        return page;
    },

    setup({ el, App, props, plugin }) {
        // 1. Create the Vue instance
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, {
                ...Ziggy,
                location:
                    typeof window !== 'undefined'
                        ? window.location.href
                        : props.initialPage.url,
            });

        // 3. Only mount if 'el' exists (this runs only in the browser)
        if (el) {
            app.mount(el);
        }

        // 4. Return the app instance (required for SSR)
        return app;
    },

    // Optional: add progress bar configuration if needed
    progress: {
        color: '#1c62c4',
    },
});
