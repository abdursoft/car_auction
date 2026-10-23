
import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';
import type { DefineComponent } from 'vue';

import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy';

// import { initializeTheme } from '@/composables/useAppearance';
// import AppLayout from '@/layouts/AppLayout.vue';
// import AuthLayout from '@/layouts/AuthLayout.vue';
// import SettingsLayout from '@/layouts/settings/Layout.vue';
// import { initializeFlashToast } from '@/lib/flashToast';

const appName = import.meta.env.VITE_APP_NAME || 'Doctor Point';

const pages = import.meta.glob<{
    default: DefineComponent;
}>([
    './pages/**/*.vue',
    './Pages/**/*.vue',
    '../../Modules/*/resources/js/Pages/**/*.vue',
], {
    eager: true,
});

void createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),

    resolve: (name) => {
        let path: string;

        if (name.includes('::')) {
            const [module, ...pageParts] = name.split('::');
            const page = pageParts.join('::');

            path = `../../Modules/${module}/resources/js/Pages/${page}.vue`;
        } else {
            path = `./pages/${name}.vue`;

            if (!(path in pages)) {
                path = `./Pages/${name}.vue`;
            }
        }

        const component = pages[path];

        if (!component) {
            throw new Error(
                `Inertia page not found: ${name}. Expected path: ${path}`,
            );
        }

        return component;
    },

    // layout: (name) => {
    //     switch (true) {
    //         case name === 'Welcome':
    //             return null;

    //         case name.startsWith('auth/'):
    //             return AuthLayout;

    //         case name.startsWith('settings/'):
    //             return [AppLayout, SettingsLayout];

    //         default:
    //             return AppLayout;
    //     }
    // },

    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .use(ZiggyVue, {
                ...Ziggy,
                location:
                    typeof window !== 'undefined'
                        ? window.location.href
                        : props.initialPage.url,
            });

        app.directive('focus', {
            mounted: (el: HTMLElement, shouldFocus) => {
                if (shouldFocus.value !== false) {
                    el.focus();
                }
            },
        });

        if (el) {
            app.mount(el);
        }

        return app;
    },

    progress: {
        color: '#4B5563',
    },
});

// initializeTheme();
// initializeFlashToast();
