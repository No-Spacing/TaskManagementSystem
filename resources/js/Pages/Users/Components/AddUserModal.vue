<script setup>
    import { useToast } from 'primevue/usetoast';
    import { Form } from '@primevue/forms';
    import { InputText, Button, Select, Divider, Message, Password } from 'primevue';
    
    import * as yup from 'yup';

    import { useForm } from '@inertiajs/vue3'

    const toast = useToast();
    const form = useForm({
        name: null,
        email: null,
        department: null,
        password: null,
        role: null
    });

    const props = defineProps({
        department: Object, // or Object, depending on your data
        roles: Object
    })

    const emit = defineEmits(['close'])

    const schema = yup.object().shape({
        name: yup
        .string()
        .required('The name field is required.')
        .matches(/^[A-Za-z0-9 ]+$/, 'The name may only contain letters, numbers, and spaces.'),
        email: yup
        .string()
        .required('The email field is required.')
        .email('Please input a valid email'),
        department: yup
        .number()
        .required('The department field is required'),
        password: yup
        .string()
        .required('The password field is required')
        .min(8, 'Password is too short - should be 8 chars minimum.')
        .matches(/[a-zA-Z]/, 'Password can only contain Latin letters.'),
        role: yup
        .number()
        .required('The role field is required'),
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
            form.post('/add-user', {
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
    <span class="text-surface-500 dark:text-surface-400 block mb-8">Type the user details.</span>
    <Form v-slot="$form" :resolver @submit="onFormSubmit">
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
        <div class="flex flex-col gap-1 mb-4">
            <label for="email" class="font-semibold w-24">Email</label>
            <InputText v-model="form.email" id="email" name="email" class="flex-auto" autocomplete="off" fluid/>
            <Message
                v-if="$form.email?.invalid || form.errors.email"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.email?.error?.message || form.errors.email }}
            </Message>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="department" class="font-semibold w-24">Department</label>
            <Select v-model="form.department" id="department" name="department" class="flex-auto" :options="props.department" optionLabel="name" optionValue="id" />
            <Message
                v-if="$form.department?.invalid || form.errors.department"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.department?.error?.message || form.errors.department }}
            </Message>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="password" class="font-semibold w-24">Password</label>
            <Password type="password" v-model="form.password" id="password" name="password" class="flex-auto" toggleMask fluid/>
            <Message
                v-if="$form.password?.invalid || form.errors.password"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.password?.error?.message || form.errors.password }}
            </Message>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="role" class="font-semibold w-24">Role</label>
            <Select v-model="form.role" id="role" name="role" class="flex-auto" :options="props.roles" optionLabel="name" optionValue="id" />
            <Message
                v-if="$form.role?.invalid || form.errors.role"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.role?.error?.message || form.errors.role }}
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