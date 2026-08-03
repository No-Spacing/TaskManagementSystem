<script setup>
    import { useToast } from 'primevue/usetoast';
    import { Form } from '@primevue/forms';
    import { InputText, Button, Select, Divider, Message, Password, Textarea, DatePicker } from 'primevue';
    
    import * as yup from 'yup';

    import { useForm, usePage } from '@inertiajs/vue3'
    import { ref } from 'vue';

    const toast = useToast();
    const form = useForm({
        ticket_id: null,
        status: null
    });

    const props = defineProps({
        ticketData: Object
    })

    const page = usePage();

    const statuses = ref([
        { id: 1, name: 'In Progress' },
        { id: 2, name: 'Finished' },
    ]);

    const emit = defineEmits(['close'])

    const schema = yup.object().shape({
        status: yup
        .number()
        .required('The status field is required')
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
            form
            .transform((data) => ({
                ...data,
                ticket_id: props.ticketData.data.id
            }))
            .post('/ticket/submit-ticket', {
                onSuccess: () => {
                    toast.add({
                        summary: 'Success',
                        detail: page.props.flash.message,
                        severity: 'success',
                        life: 3000
                    });
                    emit('close');
                },
                onError: (error) => {
                    toast.add({
                        summary: 'Warning',
                        detail: error.message,
                        severity: 'warn',
                        life: 3000
                    });
                }
            });
        }
    };
</script>
<template>
    <span class="text-surface-500 dark:text-surface-400 block mb-8">View ticket details.</span>
    <Form v-slot="$form" :resolver @submit="onFormSubmit">
        <div class="flex flex-col gap-1 mb-4">
            <label for="title" class="font-semibold w-24">Title</label>
            <InputText id="title" name="title" class="flex-auto" :value="props.ticketData.data.title" fluid disabled/>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="description" class="font-semibold w-24">Description</label>
            <Textarea :value="props.ticketData.data.description" id="description" name="description" class="flex-auto" rows="5" fluid disabled/>
        </div>
        <div class="flex flex-col gap-1 mb-4">
            <label for="department" class="font-semibold w-24">Department</label>
            <InputText id="department" name="department" class="flex-auto" :value="props.ticketData.data.department.name" disabled/>
        </div>

        <div class="flex flex-col gap-1 mb-4">
            <label for="status" class="font-semibold w-24">Status</label>
            <Select v-model="form.status" :disabled="props.ticketData.data.status_id === 2" id="status" name="status" class="flex-auto" :options="statuses" option-label="name" option-value="id" :default-value="props.ticketData.data.status_id"/>
            <Message
                v-if="$form.status?.invalid || form.errors.status"
                severity="error"
                size="small"
                variant="simple"
            >
                {{ $form.status?.error?.message || form.errors.status }}
            </Message>
        </div>

        <div class="flex flex-col gap-1 mb-4">
            <label for="title" class="font-semibold w-25">Submitted by</label>
            <InputText id="title" name="title" class="flex-auto" fluid :value="props.ticketData.data?.user?.name" disabled/>
        </div>
        
        <div class="my-8">
            <Divider></Divider>
        </div>
        <div v-if="props.ticketData.data.status_id === 1" class="flex justify-end gap-2">
            <Button type="submit" label="Update" :loading="form.processing" :style="{ width: '7rem' }" />
        </div>
    </Form>
</template>