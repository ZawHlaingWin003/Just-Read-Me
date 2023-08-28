import "./bootstrap";

import { createApp } from "vue";
import App from "./components/App.vue";
import router from "./router";

// Filepond Image Upload
import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImagePreview
);

// Pagination
import { TailwindPagination } from "laravel-vue-pagination";

// Progress Bar
import VueProgressBar from "@aacassandra/vue3-progressbar";
const progressbar_options = {
    color: "#016fb9",
    failedColor: "#874b4b",
    thickness: "5px",
};

// Select Input (Multiple, Searchable, ...)
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";
// import VueSelect from 'vue-select';
// import "vue-select/dist/vue-select.css";

// Rich Text Editor
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

// Swiper Vue.js Components
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";

// Vue Toastification
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
const toast_options = {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    icon: "fas fa-rocket",
    rtl: false,
};

import registerComponents from "./helpers/autoImportComponents";

// createApp(App)
//     // .component("v-select", VueSelect)
//     .component("Multiselect", Multiselect)
//     .component("TailwindPagination", TailwindPagination)
//     .component("Swiper", Swiper)
//     .component("SwiperSlide", SwiperSlide)
//     .component("FilePond", FilePond)
//     .component("QuillEditor", QuillEditor)
//     .use(VueProgressBar, progressbar_options)
//     .use(Toast, toast_options)
//     .use(router)
//     .mount("#app");

const app = createApp(App)
    // .component("v-select", VueSelect)
    .component("Multiselect", Multiselect)
    .component("TailwindPagination", TailwindPagination)
    .component("Swiper", Swiper)
    .component("SwiperSlide", SwiperSlide)
    .component("FilePond", FilePond)
    .component("QuillEditor", QuillEditor)
    .use(VueProgressBar, progressbar_options)
    .use(Toast, toast_options)
    .use(router);

app.use(registerComponents);
app.mount("#app");
