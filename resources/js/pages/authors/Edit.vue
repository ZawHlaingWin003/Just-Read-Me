<template>
    <section-container class="py-16">
        <template v-if="isLoading">
            <loader />
        </template>
        <template v-else>
            <form-card>
                <template #header> Edit Author Details </template>

                <template #default>
                    <Form
                        @submit.prevent="updateAuthor"
                        enctype="multipart/form-data"
                    >
                        <FormGroup>
                            <Label for="name">Name</Label>
                            <Input
                                type="name"
                                id="name"
                                v-model="author.name"
                                @change="checkSlug"
                            ></Input>
                        </FormGroup>
                        <FormGroup>
                            <Label for="slug"
                                >Slug (<span class="text-gray-500 text-xs"
                                    >This'll be auto-generated when you filled
                                    the name field.</span
                                >)</Label
                            >
                            <div class="relative flex items-center">
                                <Input
                                    type="slug"
                                    id="slug"
                                    v-model="author.slug"
                                    disabled
                                ></Input>
                                <ButtonLoader
                                    class="absolute right-2"
                                    v-if="isSlugLoading"
                                />
                            </div>
                        </FormGroup>
                        <FormGroup>
                            <Label for="profile">Profile</Label>
                            <Input
                                type="file"
                                id="profile"
                                @change="changePreviewImage"
                            ></Input>
                            <div v-if="imgPreview">
                                <img
                                    :src="imgPreview"
                                    width="100"
                                    height="100"
                                />
                            </div>
                        </FormGroup>
                        <FormGroup>
                            <Label for="biography">Biography</Label>
                            <Textarea
                                id="biography"
                                rows="5"
                                v-model="author.biography"
                            ></Textarea>
                        </FormGroup>
                        <Button :disabled="isButtonLoading">
                            <ButtonLoader v-if="isButtonLoading" />
                            <i class="fa-solid fa-edit" v-else></i>
                            <span>Edit</span>
                        </Button>
                    </Form>
                </template>

                <template #footer>
                    Go Back To <Link to="/authors">Author List</Link>
                </template>
            </form-card>
        </template>
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
import Textarea from "../../components/form/Textarea.vue";
import SectionContainer from "../../components/SectionContainer.vue";
import Loader from "../../components/partials/Loader.vue";
import ButtonLoader from "../../components/partials/ButtonLoader.vue";

import { request } from "../../helpers/request";

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
        Textarea,
        Loader,
        ButtonLoader,
    },

    props: ["slug"],

    data() {
        return {
            author: {
                name: "",
                slug: "",
                biography: "",
                profile: "",
            },
            imgPreview: null,
            errors: null,

            isLoading: true,
            isSlugLoading: false,
            isButtonLoading: false,

            response: "",
        };
    },
    mounted() {
        this.getAuthor(this.slug);
    },
    methods: {
        changePreviewImage(e) {
            this.author.profile = e.target.files[0];
            let reader = new FileReader();
            reader.onload = () => {
                this.imgPreview = reader.result;
            };
            reader.readAsDataURL(this.author.profile);
        },
        async getAuthor(slug) {
            await request("get", "/api/authors/" + slug).then((response) => {
                this.author = response.data.data;
                this.imgPreview = this.author.profile;
                this.isLoading = false;
            });
        },

        async checkSlug() {
            this.isSlugLoading = true;
            await request("post", "/api/authors/check-slug", this.author).then(
                (response) => {
                    this.author.slug = response.data.slug;
                    this.isSlugLoading = false;
                }
            );
        },

        async updateAuthor() {
            this.isButtonLoading = true;
            let data = new FormData();
            data.append("name", this.author.name);
            data.append("slug", this.author.slug);
            data.append("biography", this.author.biography);

            console.log(data);
            await request("put", "/api/authors/" + this.slug, data)
                .then((response) => {
                    this.$router.push({ name: "authors.index" });
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