<script setup>
    import { useToast } from 'primevue/usetoast';
    import { onMounted } from 'vue';
    import { Form } from '@primevue/forms';
    import { InputText, Button, Select, Divider, Message, Password, Textarea, DatePicker } from 'primevue';
   
    import * as yup from 'yup';

    onMounted(() => {
        console.log('Component is now mounted!')
    })

    import { useForm } from '@inertiajs/vue3'

    const toast = useToast();
    const form = useForm({
        title:null,
        description: null,
        department: null,
        date_needed: null,
    });

    const props = defineProps({
        departments: Object // or Object, depending on your data
    })

    const emit = defineEmits(['close'])

    const schema = yup.object().shape({
        title: yup
        .string()
        .required('The title field is required'),
        description: yup
        .string()
        .required('The description field is required'),
        department: yup
        .number()
        .required('The department field is required'),
        date_needed: yup
        .date()
        .required('The date field is required')
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
            form.post('/ticket/add-ticket', {
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
    <span class="text-surface-500 dark:text-surface-400 block mb-8">Type the ticket details.</span>
    <Form v-slot="$form" :resolver @submit="onFormSubmit">
        <div class="flex flex-col gap-1 mb-4">
            <label for="title" class="font-semibold w-24">Title</label>
            <InputText v-model="form.title" id="title" name="title" class="flex-auto" fluid/>
            <Message
                v-if="$form.title?.invalid || form.errors.title"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.title?.error?.message || form.errors.title }}
            </Message>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="description" class="font-semibold w-24">Description</label>
            <Textarea v-model="form.description" id="description" name="description" class="flex-auto" rows="5" fluid/>
            <Message
                v-if="$form.description?.invalid || form.errors.description"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.description?.error?.message || form.errors.description }}
            </Message>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="department" class="font-semibold w-24">Department</label>
            <Select v-model="form.department" id="department" name="department" class="flex-auto" :options="props.departments" optionLabel="name" optionValue="id" />
            <Message
                v-if="$form.department?.invalid || form.errors.department"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.department?.error?.message || form.errors.department }}
            </Message>
        </div>
        <!-- <div class="flex flex-col gap-1 mb-4">
            <label for="title" class="font-semibold w-24">Deadline</label>
            <DatePicker v-model="form.date_needed" id="date_needed" name="date_needed" class="flex-auto" fluid/>
            <Message
                v-if="$form.title?.invalid || form.errors.title"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.title?.error?.message || form.errors.title }}
            </Message>
        </div> -->
        <div class="my-8">
            <Divider></Divider>
        </div>
        <div class="flex justify-end gap-2">
            <Button type="submit" label="Save" :loading="form.processing" :style="{ width: '7rem' }"></Button>
        </div>
    </Form>
</template>