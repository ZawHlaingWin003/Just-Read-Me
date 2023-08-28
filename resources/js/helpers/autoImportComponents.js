import { defineAsyncComponent } from "vue";

// note: globEager is now deprecated. Use import.meta.glob('*', { eager: true }) instead.
const requireComponent = import.meta.glob("./components/Base*.vue");

const install = (app) => {
    Object.keys(requireComponent).forEach((fileName) => {
        const component = defineAsyncComponent(() =>
            requireComponent[fileName]()
        );
        const componentName = fileName
            .replace(/^.\/Base/, "")
            .replace(/\.vue$/, "");
        app.component(componentName, component);
    });
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

export default { install };
