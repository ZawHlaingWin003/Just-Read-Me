<template>
    <section-container class="pt-12 pb-24">
        <FormCard class="lg:w-3/4 py-0">
            <template #header> Add Book To Library </template>

            <template #default>
                <Form @submit.prevent="addBook" enctype="multipart/form-data">
                    <FormGroup>
                        <Label for="name">Name</Label>
                        <Input
                            type="name"
                            id="name"
                            v-model="book.name"
                            @change="checkSlug"
                        ></Input>
                    </FormGroup>
                    <FormGroup>
                        <Label for="slug"
                            >Slug (<span class="text-gray-500 text-xs"
                                >This'll be auto-generated when you filled the
                                name field.</span
                            >)</Label
                        >
                        <div class="relative flex items-center">
                            <Input
                                type="slug"
                                id="slug"
                                disabled
                                v-model="book.slug"
                            ></Input>
                            <ButtonLoader
                                class="absolute right-2"
                                v-if="isSlugLoading"
                            />
                        </div>
                    </FormGroup>
                    <FormGroup>
                        <Label for="genres">Genres</Label>
                        <Multiselect
                            v-model="selectGenres"
                            :options="genres"
                            label="slug"
                            track-by="id"
                            placeholder="Select Genre"
                            :multiple="true"
                            class="my-1 ring-2 ring-primary-700 rounded focus:outline-none focus:ring-primary-900 disabled:ring-gray-400 text-sm tracking-wide block w-full"
                        ></Multiselect>
                    </FormGroup>
                    <FormGroup>
                        <Label for="author">Author</Label>
                        <Multiselect
                            v-model="selectAuthor"
                            :options="authors"
                            label="name"
                            track-by="id"
                            placeholder="Select Author"
                            class="my-1 ring-2 ring-primary-700 rounded focus:outline-none focus:ring-primary-900 disabled:ring-gray-400 text-sm tracking-wide block w-full"
                        ></Multiselect>
                    </FormGroup>
                    <FormGroup>
                        <Label for="excerpt">Book Excerpt</Label>
                        <QuillEditor
                            theme="snow"
                            toolbar="essential"
                            v-model:content="book.excerpt"
                            contentType="html"
                            @ready="onEditorReady($event)"
                            class="my-1 ring-2 ring-primary-700 rounded focus:outline-none focus:ring-primary-900 disabled:ring-gray-400 text-sm tracking-wide block w-full"
                        />
                    </FormGroup>
                    <FormGroup>
                        <Label for="cover" class="required">Book Cover</Label>
                        <Input
                            type="file"
                            id="cover"
                            ref="book_cover"
                            multiple
                            @change="changePreviewImages"
                        ></Input>
                        <div
                            v-if="preview_images.length > 0"
                            class="flex flex-wrap gap-8"
                        >
                            <div
                                v-for="(src, index) in preview_images"
                                :key="index"
                                class="relative"
                            >
                                <img
                                    :src="src"
                                    width="100"
                                    height="100"
                                    class="w-full max-h-28 object-contain"
                                />
                                <div
                                    class="delete-icon absolute right-0 top-0 bg-gray-900 p-2 rounded-bl-lg"
                                >
                                    <i
                                        class="fa-solid fa-trash text-red-500 hover:text-red-700 cursor-pointer"
                                        @click="delImage(index)"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </FormGroup>
                    <FormGroup>
                        <Label for="pdf_file">Book PDF File</Label>
                        <Input
                            type="file"
                            id="pdf_file"
                            @change="initPdfFile"
                        ></Input>
                    </FormGroup>

                    <Button :disabled="isButtonLoading">
                        <ButtonLoader v-if="isButtonLoading" />
                        <i class="fa-solid fa-plus" v-else></i>
                        <span>Create</span>
                    </Button>
                </Form>
            </template>

            <template #footer
                >Go Back To <Link to="/books">Library</Link></template
            >
        </FormCard>
    </section-container>
</template>

<script>
import Form from "../../components/form/Form.vue";
import FormGroup from "../../components/form/FormGroup.vue";
import Label from "../../components/form/Label.vue";
import Input from "../../components/form/Input.vue";
import FormCard from "../../components/cards/FormCard.vue";
import Link from "../../components/form/Link.vue";
import Button from "../../components/form/Button.vue";
import SectionContainer from "../../components/SectionContainer.vue";
import ButtonLoader from "../../components/partials/ButtonLoader.vue";

import { request } from "../../helpers/request";
import { useToast } from "vue-toastification";

const toast = useToast();

export default {
    components: {
        SectionContainer,
        FormCard,
        Link,
        Form,
        FormGroup,
        Label,
        Input,
        Button,
        ButtonLoader,
    },
    data() {
        return {
            isSlugLoading: false,
            isButtonLoading: false,

            selectAuthor: "",
            selectGenres: [],

            book: {
                name: "",
                slug: "",
                excerpt: "",
                author_id: "",
                genres_id: [],
                cover: [],
                pdf_file: "",
                published_at: "",
            },

            preview_images: [],

            genres: [],
            authors: [],
        };
    },
    mounted() {
        this.getGenres();
        this.getAuthors();
    },
    watch: {
        selectAuthor(newValue) {
            this.book.author_id = newValue.id;
        },
        selectGenres(newValues) {
            this.book.genres_id = newValues.map((obj) => obj.id);
        },
    },
    methods: {
        async checkSlug() {
            this.isSlugLoading = true;
            await request(
                "get",
                `/api/books/check-slug?name=${this.book.name}`
            ).then((response) => {
                this.book.slug = response.data.slug;
                this.isSlugLoading = false;
            });
        },

        delImage(index) {
            console.log(this.$refs.book_cover.files);
            this.book.cover.splice(index, 1);
            this.preview_images.splice(index, 1);

            // console.log("Book Covers - ", this.book.cover);
            // console.log("Preview Images - ", this.preview_images);
        },

        changePreviewImages(e) {
            this.book.cover = [];
            this.preview_images = [];
            let files = e.target.files;

            for (const i of files) {
                this.book.cover.push(i);
                let reader = new FileReader();
                reader.onload = () => {
                    this.preview_images.push(reader.result);
                    // console.log("Preview Images - ", this.preview_images);
                };
                reader.readAsDataURL(i);
            }

            // console.log("Book Covers - ", this.book.cover);
        },

        initPdfFile(e) {
            this.book.pdf_file = e.target.files[0];
        },

        async getGenres() {
            await request("get", "/api/genres").then((response) => {
                this.genres = response.data.data;
            });
        },

        async getAuthors() {
            await request("get", "/api/authors").then((response) => {
                this.authors = response.data.data;
            });
        },

        onEditorReady(e) {
            e.container.querySelector(".ql-blank").innerHTML =
                this.book.excerpt;
        },

        // onInputFile(files) {
        //     this.files = files;
        // },

        async addBook() {
            this.isButtonLoading = true;
            let data = new FormData();
            data.append("name", this.book.name);
            data.append("slug", this.book.slug);
            data.append("excerpt", this.book.excerpt);
            data.append("author_id", this.book.author_id);
            data.append("genres_id", this.book.genres_id);
            for (let i = 0; i < this.book.genres_id.length; i++) {
                data.append("genres_id[]", this.book.genres_id[i]);
            }

            for (let i = 0; i < this.book.cover.length; i++) {
                data.append("cover[]", this.book.cover[i]);
            }
            data.append("pdf_file", this.book.pdf_file);

            await request("post", "/api/books", data)
                .then((response) => {
                    console.log(response);
                    toast.success("Book created successfully");
                    this.$router.push({ name: "books.index" });
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
    },
};
</script>

<style>
</style>