<template>
    <section-container>
        <form-card>
            <template #header> Create New Author </template>

            <template #default>
                <Form @submit.prevent="addAuthor" enctype="multipart/form-data">
                    <FormGroup>
                        <Label for="name" class="required">Name</Label>
                        <Input
                            type="name"
                            id="name"
                            v-model="author.name"
                            @change="checkSlug"
                            required
                        ></Input>
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.name"
                            >{{ errors.name[0] }}</span
                        >
                    </FormGroup>
                    <FormGroup>
                        <Label for="slug" class="required"
                            >Slug (<span class="text-gray-500 text-xs"
                                >This'll be auto-generated when you filled the
                                name field.</span
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
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.profile"
                            >{{ errors.profile[0] }}</span
                        >
                        <div v-if="author.profile">
                            <img :src="imgPreview" width="100" height="100" />
                        </div>
                    </FormGroup>
                    <FormGroup>
                        <Label for="biography" class="required"
                            >Biography</Label
                        >
                        <Textarea
                            id="biography"
                            rows="5"
                            v-model="author.biography"
                        ></Textarea>
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.biography"
                            >{{ errors.biography[0] }}</span
                        >
                    </FormGroup>
                    <Button :disabled="isButtonLoading">
                        <ButtonLoader v-if="isButtonLoading" />
                        <i class="fa-solid fa-plus" v-else></i>
                        <span>Create</span>
                    </Button>
                </Form>
            </template>

            <template #footer>
                Go Back To <Link to="/authors">Author List</Link>
            </template>
        </form-card>
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
        ButtonLoader,
    },
    data() {
        return {
            author: {
                name: "",
                slug: "",
                biography: "",
                profile: "",
            },
            imgPreview: null,
            errors: "",

            isSlugLoading: false,
            isButtonLoading: false,
        };
    },
    methods: {
        changePreviewImage(e) {
            console.log(e);
            this.author.profile = e.target.files[0];
            let reader = new FileReader();
            reader.onload = () => {
                this.imgPreview = reader.result;
            };
            reader.readAsDataURL(this.author.profile);
        },

        async addAuthor() {
            this.isButtonLoading = true;
            let data = new FormData();
            data.append("name", this.author.name);
            data.append("slug", this.author.slug);
            data.append("biography", this.author.biography);
            data.append("profile", this.author.profile);

            console.log(data);

            await request("post", "/api/authors", data)
                .then((response) => {
                    this.$router.push({ name: "authors.index" });
                })
                .catch((error) => {
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

            await request("post", "/api/authors/check-slug", this.author).then(
                (response) => {
                    this.author.slug = response.data.slug;
                    this.isSlugLoading = false;
                }
            );
        },
    },
};
</script>

<style>
</style>