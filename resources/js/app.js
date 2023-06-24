import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { library } from "@fortawesome/fontawesome-svg-core";
const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import * as fontAwesomeSolid from "./assets/icons/fontAwesomeSolid.js";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        library.add(fontAwesomeSolid);
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("fa-icon", FontAwesomeIcon)
            .mount(el);
        return app;
    },
    progress: {
        color: "#4B5563",
    },
});
