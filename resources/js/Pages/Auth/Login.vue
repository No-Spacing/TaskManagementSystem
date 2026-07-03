<script setup>
    import { Card, Divider, InputText, Button, Message, IconField, InputIcon, Toast }from 'primevue';

    import { useToast } from 'primevue/usetoast';
    import { Form } from '@primevue/forms';
    import { useForm, usePage, Head } from '@inertiajs/vue3';

    import { watchEffect, onMounted } from 'vue';

    import * as yup from 'yup';

    const page = usePage();

    const toast = useToast();

    const form = useForm({
        email: null,
        password: null
    })

    const schema = yup.object().shape({
        email: yup
        .string()
        .required('The email field is required.')
        .email(),
        password: yup
        .string()
        .required('The password field is required.')
    });

    const resolver = ({ values }) => {
        const errors = {};
        try {
            schema.validateSync(values, { abortEarly: false });
        } catch (validationError) {
            validationError.inner.forEach(err => {
                errors[err.path] = [{ message: err.message }];
            });
        }
        return { values, errors };
    };

    const onFormSubmit = ({ valid }) => {
        if (valid) {
            form.post('/submit-login', {
                onError: () => {
                    toast.add({
                        summary: 'Error',
                        detail: 'The provided credentials do not match our records.',
                        severity: 'error',
                        life: 3000
                    });
                }
            });
        }
    };
    
    onMounted(() => {
        const errors = page.props.errors;
        if (errors && Object.keys(errors).length > 0) {
            Object.values(errors).forEach((msg) => {
            toast.add({
                severity: 'error',
                summary: 'Error',
                detail: msg,
                life: 3000
            });
            });
        }
    });
</script>
<template>
    <Head title="Login" />
    <div class="flex justify-center items-center min-h-screen">
        <Card style="width: 35rem; overflow: hidden">
            <template #header>
                <div class="flex justify-center">
                    <img class="p-5" alt="user header" src="/public/assets/images/pmcg.png" style="max-width: 500px; height: auto;"/>
                </div>
            </template>
            <template #title>Login</template>
            <template #subtitle>Input your credentials.</template>
            <template #content>
                <Form v-slot="$form" :resolver @submit="onFormSubmit" class="flex flex-col gap-4">
                    <div class="flex flex-col gap-3">
                        <IconField>
                            <InputIcon class="pi pi-at" />
                            <InputText v-model="form.email" name="email" type="text" placeholder="Email" fluid />
                        </IconField>
                        <Message v-if="$form.email?.invalid || form.errors.email" severity="error" size="small" variant="simple">
                            {{ $form.email.error?.message || form.errors.email }}
                        </Message>
                        <IconField>
                            <InputIcon class="pi pi-lock" />
                            <InputText v-model="form.password" name="password" type="password" placeholder="Password" fluid />
                        </IconField>
                        <Message v-if="$form.password?.invalid || form.errors.password" severity="error" size="small" variant="simple">
                            {{ $form.password.error?.message || form.errors.password }}
                        </Message>
                    </div>
                    <Divider />
                    <Button type="submit" :loading="form.processing" label="Login" />
                </Form>
            </template>
        </Card>
    </div>
    <Toast position="top-center"/>
</template> 