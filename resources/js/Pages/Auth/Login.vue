<script setup>
    import Card from 'primevue/card';
    import { Form } from '@primevue/forms';
    import Divider  from 'primevue/divider';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import Message from 'primevue/message';
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    import Toast from 'primevue/toast';
    import { useToast } from 'primevue/usetoast';

    import { useForm, usePage } from '@inertiajs/vue3';

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
            form.post('/login', {
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
    <div class="flex justify-center items-center min-h-screen">
        <Card style="width: 35rem; overflow: hidden">
            <template #header>
                <img alt="user header" src="https://i1.wp.com/www.primefaces.org/wp-content/uploads/2021/05/hashnode-vue-3.5.02x.jpg?resize=1060%2C557&ssl=1" />
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
                    <Button type="submit" severity="secondary" :loading="form.processing" label="Login" />
                </Form>
            </template>
        </Card>
    </div>
    <Toast position="top-center"/>
</template> 