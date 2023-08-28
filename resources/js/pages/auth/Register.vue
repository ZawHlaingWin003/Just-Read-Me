<template>
    <section-container>
        <AuthCard>
            <template #header> Create an account </template>

            <template #default>
                <Form @submit.prevent="userRegister">
                    <FormGroup>
                        <Label for="name">Username</Label>
                        <Input
                            type="text"
                            id="name"
                            v-model="user.name"
                        ></Input>
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.name"
                            >{{ errors.name[0] }}</span
                        >
                    </FormGroup>

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
                        <Label for="phone">Phone Number</Label>
                        <Input
                            type="text"
                            id="phone"
                            v-model="user.phone"
                        ></Input>
                        <span
                            class="error text-xs text-pink-600"
                            v-if="errors.phone"
                            >{{ errors.phone[0] }}</span
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

                    <FormGroup>
                        <Label for="confirm-password">Confirm Password</Label>
                        <div class="relative">
                            <Input
                                :type="
                                    showConfirmPassword ? 'text' : 'password'
                                "
                                id="confirm-password"
                                v-model="user.password_confirmation"
                            >
                            </Input>
                            <span
                                class="absolute top-0 right-0 h-full w-12 flex items-center justify-center border-l-2 rounded bg-gray-100 hover:bg-gray-200 cursor-pointer"
                                @click="toggleShowConfirmPassword"
                                ><i
                                    class="fa-solid"
                                    :class="{
                                        'fa-eye': showConfirmPassword,
                                        'fa-eye-slash': !showConfirmPassword,
                                    }"
                                ></i
                            ></span>
                        </div>
                    </FormGroup>

                    <div class="mb-4">
                        <Checkbox v-model="user.agree" id="agree_terms">
                            I accept the
                            <Link to="/register"> Terms and conditions </Link>
                        </Checkbox>
                    </div>

                    <Button>Register</Button>
                </Form>
            </template>

            <template #footer>
                Already a member?
                <Link to="/login">Sign in</Link>
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

export default {
    components: {
        Form,
        AuthCard,
        FormGroup,
        Input,
        Label,
        Button,
        Link,
        Checkbox,
        SectionContainer,
    },
    data() {
        return {
            user: {
                name: "",
                email: "",
                phone: "",
                password: "",
                password_confirmation: "",
                agree: false,
            },
            errors: "",
            showPassword: false,
            showConfirmPassword: false,
        };
    },
    methods: {
        toggleShowPassword() {
            this.showPassword = !this.showPassword;
        },
        toggleShowConfirmPassword() {
            this.showConfirmPassword = !this.showConfirmPassword;
        },

        async userRegister() {
            await axios
                .post("/api/register", this.user)
                .then((response) => {
                    console.log(response);
                    this.$router.push({ name: "home" });
                })
                .catch((error) => {
                    if ((error.response.status = 422)) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
    },
};
</script>

<style></style>
