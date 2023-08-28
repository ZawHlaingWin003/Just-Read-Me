<template>
    <section-container>
        <AuthCard>
            <template #header> Sign in to your account </template>

            <template #default>
                <p
                    class="text-white font-bold p-2 mb-4 border bg-red-500 rounded"
                    v-if="errors.message"
                >
                    {{ errors.message[0] }}
                </p>
                <Form @submit.prevent="userLogin">
                    <FormGroup>
                        <Label for="email">Email</Label>
                        <Input
                            type="email"
                            id="email"
                            v-model="user.email"
                        ></Input>
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.email"
                            >{{ errors.email[0] }}</span
                        >
                    </FormGroup>

                    <FormGroup>
                        <Label for="password">Password</Label>
                        <div class="relative">
                            <Input
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                v-model="user.password"
                            >
                            </Input>
                            <span
                                class="absolute top-0 right-0 h-full w-12 flex items-center justify-center border-l-2 rounded bg-gray-100 hover:bg-gray-200 cursor-pointer"
                                @click="toggleShowPassword"
                                ><i
                                    class="fa-solid"
                                    :class="{
                                        'fa-eye': showPassword,
                                        'fa-eye-slash': !showPassword,
                                    }"
                                ></i
                            ></span>
                        </div>
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.password"
                            >{{ errors.password[0] }}</span
                        >
                    </FormGroup>

                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <Checkbox v-model="user.remember" id="remember_me"
                                >Remember Me</Checkbox
                            >
                        </div>
                        <div>
                            <Link to="/forget-password">Forget Password?</Link>
                        </div>
                    </div>
                    <pre>
                        {{ user }}
                    </pre>
                    <Button :disabled="isButtonLoading">
                        <ButtonLoader v-if="isButtonLoading" />
                        <i
                            class="fa-solid fa-right-to-bracket"
                            v-if="isButtonLoading == false"
                        ></i>
                        <span>Login</span>
                    </Button>
                </Form>
            </template>
            <template #footer>
                Don't have an account?
                <Link to="/register">Create Account</Link>
            </template>
        </AuthCard>
    </section-container>
</template>

<script>
import AuthCard from "../../components/cards/AuthCard.vue";
import Button from "../../components/form/Button.vue";
import Form from "../../components/form/Form.vue";
import FormGroup from "../../components/form/FormGroup.vue";
import Input from "../../components/form/Input.vue";
import Label from "../../components/form/Label.vue";
import Link from "../../components/form/Link.vue";
import Checkbox from "../../components/form/Checkbox.vue";
import SectionContainer from "../../components/SectionContainer.vue";
import ButtonLoader from "../../components/partials/ButtonLoader.vue";

export default {
    components: {
        Form,
        AuthCard,
        FormGroup,
        Label,
        Button,
        Link,
        SectionContainer,
        Input,
        Checkbox,
        ButtonLoader,
    },
    data() {
        return {
            user: {
                email: "",
                password: "",
                remember: false,
            },
            errors: "",
            showPassword: false,
            isButtonLoading: false,
        };
    },
    methods: {
        toggleShowPassword() {
            this.showPassword = !this.showPassword;
        },

        async userLogin() {
            this.isButtonLoading = true;

            await axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/login", this.user)
                    .then((response) => {
                        console.log(response);

                        this.user.email = "";
                        this.user.password = "";

                        localStorage.setItem("API_TOKEN", response.data.token);

                        this.$router.push({ name: "home" });
                    })
                    .catch((error) => {
                        console.log(error);
                        if ((error.response.status = 422)) {
                            this.errors = error.response.data.errors
                                ? error.response.data.errors
                                : error.response.data;
                        }
                    })
                    .finally(() => {
                        this.isButtonLoading = false;
                    });
            });
        },
    },
};
</script>

<style>
</style>
