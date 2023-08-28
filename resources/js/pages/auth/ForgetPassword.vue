<template>
    <section-container>
        <AuthCard>
            <template #header> Forget Password </template>

            <template #default>
                <Form>
                    <form-group>
                        <Label>Email</Label>
                        <Input type="email" />
                    </form-group>
                    <Button>Submit</Button>
                </Form>
            </template>

            <template #footer>
                Go Back To
                <Link to="/login">Login Page?</Link>
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
import SectionContainer from "../../components/SectionContainer.vue";

export default {
    components: {
        AuthCard,
        Form,
        FormGroup,
        Label,
        Link,
        Input,
        SectionContainer,
        Button,
    },
};
</script>

<style>
</style>