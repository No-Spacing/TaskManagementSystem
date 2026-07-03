<script setup>
    import { useToast } from 'primevue/usetoast';
    import { Form } from '@primevue/forms';
    import { Button, Divider, InputText, Message } from 'primevue';
    
    import * as yup from 'yup';

    import { useForm } from '@inertiajs/vue3'

    const toast = useToast();
    const form = useForm({
        name: null,
    });

    const emit = defineEmits(['close'])

    const schema = yup.object().shape({
        name: yup
        .string()
        .required('The name field is required.')
        .matches(/^[A-Za-z0-9 ]+$/, 'The name may only contain letters, numbers, and spaces.')
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
            form.post('/add-department', {
                onSuccess: () => {
                    toast.add({
                        summary: 'Success',
                        detail: 'Form Submitted',
                        severity: 'success',
                        life: 3000
                    });
                    emit('close');
                }
            });
        }
    };
</script>
<template>
    <span class="text-surface-500 dark:text-surface-400 block mb-8">Input the department details.</span>
    <Form v-slot="$form" :resolver="resolver" @submit="onFormSubmit">
        <div class="flex flex-col gap-1 mb-4">
            <label for="name" class="font-semibold">Name</label>
            <InputText v-model="form.name" id="name" name="name" class="flex-auto" autocomplete="off" fluid/>
            <Message
                v-if="$form.name?.invalid || form.errors.name"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.name?.error?.message || form.errors.name }}
            </Message>
        </div>
        <div class="my-8">
            <Divider></Divider>
        </div>
        <div class="flex justify-end gap-2">
            <Button type="submit" label="Save" :loading="form.processing" :style="{ width: '7rem' }"></Button>
        </div>
    </Form>
</template>