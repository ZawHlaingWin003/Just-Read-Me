<template>
    <section-container class="py-12">
        <div class="">
            <!-- Main Form (Create and Edit) -->
            <div class="main-form w-4/5 mx-auto" id="form">
                <div class="border rounded shadow divide-y-2">
                    <div class="card-header p-4">
                        <h2 class="text-2xl font-big-title text-primary-900">
                            {{
                                isEditMode
                                    ? "Edit Genre Detail"
                                    : "Create New Genre"
                            }}
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <form
                            @submit.prevent="
                                isEditMode ? updateGenre() : addGenre()
                            "
                            ref="form"
                            class="flex gap-8 items-center"
                        >
                            <FormGroup class="text-center w-full">
                                <Label for="name">Name</Label>
                                <Input
                                    type="text"
                                    id="name"
                                    v-model="genre.name"
                                    @change="checkSlug"
                                />
                            </FormGroup>
                            <FormGroup class="text-center w-full">
                                <Label for="slug">Slug</Label>
                                <div class="relative flex items-center">
                                    <Input
                                        type="text"
                                        id="slug"
                                        v-model="genre.slug"
                                        disabled
                                    />
                                    <ButtonLoader
                                        class="absolute right-2"
                                        v-if="isSlugLoading"
                                    />
                                </div>
                            </FormGroup>
                            <Button :disabled="isButtonLoading">
                                <ButtonLoader v-if="isButtonLoading" />
                                <i
                                    class="fa-solid"
                                    :class="
                                        isEditMode
                                            ? 'fa-edit'
                                            : 'fa-floppy-disk'
                                    "
                                    v-else
                                ></i>
                                <span>{{
                                    isEditMode ? "Update" : "Save"
                                }}</span>
                            </Button>
                        </form>
                    </div>
                </div>
            </div>

            <hr class="border-dark-brown-700 my-8" />

            <div class="w-full">
                <!-- Table Actions -->
                <div
                    class="space-y-4 md:flex md:justify-between md:items-center md:space-y-0"
                >
                    <!-- Create and Select Pagination Size -->
                    <div class="flex gap-3">
                        <Button
                            :disabled="isEditMode == false"
                            @click="createMode"
                            >Create Genre</Button
                        >
                        <Button
                            :disabled="isSelectedGenres == false"
                            @click="bulkDeleteGenres"
                            >Bulk Delete</Button
                        >
                        <div>
                            <select
                                id=""
                                class="p-2 my-1 ring-2 ring-primary-700 rounded focus:outline-none focus:ring-primary-900 disabled:ring-gray-400 text-sm tracking-wide block w-full"
                                v-model="per_page"
                                @change="getGenres"
                            >
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search Action -->
                    <div class="relative flex items-center justify-between">
                        <div
                            class="absolute left-3 text-[1.1rem] text-gray-500"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <Input
                            id="name"
                            class="pl-10 pr-32 py-3"
                            v-model="search"
                            @keyup.enter="getGenres"
                        />
                        <Button class="absolute right-1" @click="getGenres">
                            <span>Search</span>
                        </Button>
                    </div>
                </div>

                <!-- Table -->
                <div class="genre-list overflow-x-auto my-4 shadow-md">
                    <table class="border border-primary-700 w-full">
                        <thead class="border border-primary-700 bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">
                                    <p class="flex">
                                        <label for="select-all"
                                            >Select All</label
                                        >
                                        <input
                                            type="checkbox"
                                            id="select-all"
                                            v-model="isSelectedAllGenres"
                                            @change="selectAllGenres"
                                        />
                                    </p>
                                </th>
                                <th class="px-6 py-3">Id</th>
                                <th class="px-6 py-3">
                                    <p
                                        class="hover:text-dark-brown-900 cursor-pointer flex justify-center"
                                        :class="{
                                            'text-dark-brown-900':
                                                params.sort_field == 'name',
                                        }"
                                        @click="sorting('name')"
                                    >
                                        <span>Name</span>
                                        <span class="ml-2">
                                            <span
                                                v-if="
                                                    this.params.sort_field ==
                                                        'name' &&
                                                    this.params
                                                        .sort_direction == 'asc'
                                                "
                                                ><i
                                                    class="fa-solid fa-arrow-up"
                                                ></i
                                            ></span>
                                            <span
                                                v-if="
                                                    this.params.sort_field ==
                                                        'name' &&
                                                    this.params
                                                        .sort_direction ==
                                                        'desc'
                                                "
                                                ><i
                                                    class="fa-solid fa-arrow-down"
                                                ></i
                                            ></span>
                                        </span>
                                    </p>
                                    <hr />
                                    <Input
                                        type="text"
                                        v-model="params.search_name"
                                        @keyup.enter="columnSearch"
                                    />
                                </th>
                                <th class="px-6 py-3">
                                    <p
                                        class="hover:text-dark-brown-900 cursor-pointer flex justify-center"
                                        @click="sorting('slug')"
                                        :class="{
                                            'text-dark-brown-900':
                                                params.sort_field == 'slug',
                                        }"
                                    >
                                        <span>Slug</span>
                                        <span class="ml-2">
                                            <span
                                                v-if="
                                                    this.params.sort_field ==
                                                        'slug' &&
                                                    this.params
                                                        .sort_direction == 'asc'
                                                "
                                                ><i
                                                    class="fa-solid fa-arrow-up"
                                                ></i
                                            ></span>
                                            <span
                                                v-if="
                                                    this.params.sort_field ==
                                                        'slug' &&
                                                    this.params
                                                        .sort_direction ==
                                                        'desc'
                                                "
                                                ><i
                                                    class="fa-solid fa-arrow-down"
                                                ></i
                                            ></span>
                                        </span>
                                    </p>
                                    <hr />
                                    <Input
                                        type="text"
                                        v-model="params.search_slug"
                                        @keyup.enter="columnSearch"
                                    />
                                </th>
                                <th class="px-6 py-3">
                                    <p
                                        class="hover:text-dark-brown-900 cursor-pointer flex justify-center"
                                        :class="{
                                            'text-dark-brown-900':
                                                params.sort_field ==
                                                'created_at',
                                        }"
                                        @click="sorting('created_at')"
                                    >
                                        <span>Created at</span>
                                        <span class="ml-2">
                                            <span
                                                v-if="
                                                    this.params.sort_field ==
                                                        'created_at' &&
                                                    this.params
                                                        .sort_direction == 'asc'
                                                "
                                                ><i
                                                    class="fa-solid fa-arrow-up"
                                                ></i
                                            ></span>
                                            <span
                                                v-if="
                                                    this.params.sort_field ==
                                                        'created_at' &&
                                                    this.params
                                                        .sort_direction ==
                                                        'desc'
                                                "
                                                ><i
                                                    class="fa-solid fa-arrow-down"
                                                ></i
                                            ></span>
                                        </span>
                                    </p>
                                    <hr />
                                    <Input
                                        type="text"
                                        v-model="params.search_created_at"
                                        @keyup.enter="columnSearch"
                                    />
                                </th>
                                <th
                                    v-if="genres.data?.length"
                                    class="px-6 py-3"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border border-primary-700 text-center">
                            <template v-if="isTableLoading">
                                <tr>
                                    <td colspan="6">
                                        <loader />
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <template v-if="genres.data?.length">
                                    <tr
                                        v-for="(item, index) in genres.data"
                                        :key="item.id"
                                    >
                                        <td class="px-6 py-3">
                                            <input
                                                type="checkbox"
                                                :value="item.id"
                                                v-model="selectedGenres"
                                            />
                                        </td>
                                        <td class="px-6 py-3">
                                            {{
                                                ++index +
                                                (paginations.current_page - 1) *
                                                    per_page
                                            }}
                                        </td>
                                        <td class="px-6 py-3 capitalize">
                                            {{ item.name }}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{ item.slug }}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{ item.readable_created_at }}
                                        </td>
                                        <td
                                            class="px-6 py-3 flex space-x-2 justify-center"
                                        >
                                            <LinkButton
                                                :to="
                                                    isSelectedGenres
                                                        ? '#'
                                                        : '/genres/show'
                                                "
                                                :class="{
                                                    'bg-gray-500 border-gray-500 text-gray-100 hover:bg-gray-500 hover:text-gray-100':
                                                        isSelectedGenres,
                                                }"
                                                :disabled="
                                                    isSelectedGenres == true
                                                "
                                            >
                                                <p
                                                    class="flex items-center gap-2"
                                                >
                                                    <span
                                                        class="hidden lg:inline-block"
                                                        >View</span
                                                    >
                                                    <i
                                                        class="fa-solid fa-eye"
                                                    ></i>
                                                </p>
                                            </LinkButton>
                                            <Button
                                                class="border-green-500 bg-green-500 hover:text-green-500 focus:ring-green-700 active:ring-green-500"
                                                @click="editMode(item, '#form')"
                                                :disabled="
                                                    isSelectedGenres == true
                                                "
                                            >
                                                <span
                                                    class="hidden lg:inline-block"
                                                    >Edit</span
                                                >
                                                <i class="fa-solid fa-edit"></i
                                            ></Button>
                                            <Button
                                                class="border-red-900 bg-red-500 hover:text-red-500 focus:ring-red-900 active:ring-red-500"
                                                @click="deleteGenre(item.slug)"
                                                :disabled="
                                                    isSelectedGenres == true
                                                "
                                            >
                                                <span
                                                    class="hidden lg:inline-block"
                                                    >Delete</span
                                                >
                                                <i class="fa-solid fa-trash"></i
                                            ></Button>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="5" class="py-3">
                                            <span
                                                class="text-red-600 text-2xl font-big-title"
                                                >No datas Found</span
                                            >
                                        </td>
                                    </tr>
                                </template>
                            </template>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="flex justify-between items-center">
                    <TailwindPagination
                        :data="genres"
                        :limit="1"
                        :item-classes="[
                            'h-8 md:h-10 flex items-center px-3 md:px-5 text-gray-600 bg-white hover:bg-gray-300 rounded border border-gray-600 disabled:bg-gray-300 disabled:border-opacity-30',
                        ]"
                        :active-classes="[
                            'h-8 md:h-10 flex items-center px-3 md:px-5 bg-gray-600 text-white rounded border border-r-0 border-gray-600',
                        ]"
                        @pagination-change-page="getGenres"
                        class="flex flex-wrap gap-2"
                    >
                        <template #prev-nav>
                            <span class="rounded">Prev</span>
                        </template>
                        <template #next-nav>
                            <span class="rounded">Next</span>
                        </template>
                    </TailwindPagination>
                    <p>Total Items - {{ paginations.total }}</p>
                </div>

                <!-- <Pagination :data="genres" @paginate="getGenres" :offset="4" /> -->
            </div>
        </div>
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";
import FormGroup from "../../components/form/FormGroup.vue";
import Label from "../../components/form/Label.vue";
import Input from "../../components/form/Input.vue";
import Button from "../../components/form/Button.vue";
import Link from "../../components/form/Link.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import FormCard from "../../components/cards/FormCard.vue";
import ButtonLoader from "../../components/partials/ButtonLoader.vue";
import Loader from "../../components/partials/Loader.vue";

import Pagination from "../../components/partials/Pagination.vue";

import { request } from "../../helpers/request";

export default {
    components: {
        SectionContainer,
        FormGroup,
        Label,
        Input,
        Button,
        FormCard,
        LinkButton,
        Link,
        Pagination,
        ButtonLoader,
        Loader,
    },
    data() {
        return {
            allGenres: [],
            genres: {},
            genre: {
                name: "",
                slug: "",
            },

            selectedGenres: [],

            updateSlug: "",

            errors: "",
            search: "",

            isSlugLoading: false,
            isButtonLoading: false,
            isTableLoading: false,

            isEditMode: false,
            isSelectedGenres: false,
            isSelectedAllGenres: false,

            paginations: {},
            per_page: "5",

            params: {
                sort_field: "created_at",
                sort_direction: "desc",
                search_name: "",
                search_slug: "",
                search_created_at: "",
            },
        };
    },

    mounted() {
        this.getGenres();
        this.getAllGenres();
    },

    watch: {
        params: {
            // handler() {
            //     this.getGenres();
            // },
            handler: "getGenres",
            immediate: true,
            deep: true,
        },

        selectedGenres: {
            handler() {
                if (this.selectedGenres.length) {
                    this.isSelectedGenres = true;

                    let allGenresIds = this.allGenres.map((genre) => genre.id);
                    if (allGenresIds.length != this.selectedGenres.length) {
                        this.isSelectedAllGenres = false;
                    } else {
                        this.isSelectedAllGenres = true;
                    }
                } else {
                    this.isSelectedGenres = false;
                }
            },
            deep: true,
        },
    },

    computed: {
        pageLinks() {
            return this.paginations.links.slice(1, -1);
        },
    },

    methods: {
        // Prevent multiple form submissions
        submit: _.debounce(function () {
            /*
             * Submission post request
             */
        }, 1000),

        editMode(genre, url) {
            this.isEditMode = true;

            this.genre.name = genre.name;
            this.genre.slug = genre.slug;

            this.updateSlug = genre.slug;

            window.location = url;
        },

        createMode() {
            this.genre.name = "";
            this.genre.slug = "";

            this.isEditMode = false;

            // Reset the form value to empty but it won't affect on vue data
            // this.$refs.form.reset();
        },

        async getAllGenres() {
            await axios
                .get("/api/genres")
                .then((response) => (this.allGenres = response.data.data));
        },

        async getGenres(page = 1) {
            this.isTableLoading = true;
            this.$Progress.start();

            // await axios
            //     .get(
            //         `/api/genres?page=${page}&per_page=${this.per_page}&search=${this.search}&name=${this.params.search_name}&slug=${this.params.search_slug}&created_at=${this.params.search_created_at}&sort_field=${this.params.sort_field}&sort_direction=${this.params.sort_direction}`
            //     )

            await axios({
                method: "get",
                url: "/api/genres",
                params: {
                    page: page,
                    per_page: this.per_page,
                    search: this.search,
                    name: this.params.search_name,
                    slug: this.params.search_slug,
                    created_at: this.params.search_created_at,
                    sort_field: this.params.sort_field,
                    sort_direction: this.params.sort_direction,
                },
            })
                .then((response) => {
                    console.log(response);

                    this.genres = response.data;
                    this.paginations = response.data.meta;

                    this.isTableLoading = false;
                    this.$Progress.finish();
                })
                .catch((error) => {
                    // console.log(error);
                    this.$Progress.fail();
                });
        },

        async addGenre() {
            this.isButtonLoading = true;

            await request("post", "/api/genres", this.genre)
                .then(() => {
                    this.genre.name = "";
                    this.genre.slug = "";

                    this.getGenres();

                    Toast.fire({
                        icon: "success",
                        title: "Genre created successfully",
                    });
                })
                .catch((error) => {
                    // console.log(error);
                    if ((error.response.status = 422)) {
                        this.errors = error.response.data.errors;
                    }
                })
                .finally(() => {
                    this.isButtonLoading = false;
                });
        },

        async checkSlug() {
            this.isSlugLoading = true;
            await request(
                "get",
                `/api/genres/check-slug?name=${this.genre.name}`
            ).then((response) => {
                // console.log(response)
                this.genre.slug = response.data.slug;
                this.isSlugLoading = false;
            });
        },

        async updateGenre() {
            this.isButtonLoading = true;

            await request("put", "/api/genres/" + this.updateSlug, this.genre)
                .then((response) => {
                    this.getGenres(this.paginations.current_page);
                    this.isEditMode = false;

                    this.genre.name = "";
                    this.genre.slug = "";

                    Toast.fire({
                        icon: "success",
                        title: "Genre updated successfully",
                    });
                })
                .catch((error) => {
                    // console.log(error);
                })
                .finally(() => {
                    this.isButtonLoading = false;
                });
        },

        deleteGenre(slug) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete("/api/genres/" + slug).then(() => {
                        this.getGenres();
                        Swal.fire({ title: "Deleted!", icon: "success" });
                    });
                }
            });
        },

        bulkDeleteGenres() {
            Swal.fire({
                title: "Are you sure you want to delete all datas?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                        method: "delete",
                        url: "/api/genres/bulk-delete",
                        data: {
                            ids: this.selectedGenres,
                        },
                    }).then(() => {
                        this.getGenres();
                        this.selectedGenres = [];
                        this.isSelectedAllGenres = false;
                        Swal.fire({ title: "Deleted!", icon: "success" });
                    });
                }
            });
        },

        async selectAllGenres() {
            this.selectedGenres = this.isSelectedAllGenres
                ? this.allGenres.map((genre) => genre.id)
                : [];
        },

        sorting(field) {
            if (this.params.sort_field === field) {
                this.params.sort_direction =
                    this.params.sort_direction === "asc" ? "desc" : "asc";
            } else {
                this.params.sort_field = field;
                this.params.sort_direction = "asc";
            }
            this.getGenres();
        },

        columnSearch() {
            this.getGenres();
        },
    },
};
</script>

<style>
</style>