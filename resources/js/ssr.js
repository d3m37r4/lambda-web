import '../css/app.css';

import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import AppLayout from './Layouts/Main.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Lambda';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: title => title ? `${title} - ${appName}` : `${appName}`,
        resolve: name => {
            const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
            let page = pages[`./Pages/${name}.vue`];
            page.default.layout = page.default.layout || AppLayout;
            return page;
        },
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
        progress: {
            // The delay after which the progress bar will appear, in milliseconds...
            delay: 250,
            // The color of the progress bar...
            color: '#f97316',
            // Whether to include the default NProgress styles...
            includeCSS: true,
            // Whether the NProgress spinner will be shown...
            showSpinner: true,
        },
    })
);
