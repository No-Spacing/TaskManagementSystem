<script setup>
    import { ref, onMounted } from 'vue';
    import { useToast } from 'primevue/usetoast';
    import { Form } from '@primevue/forms';
    import { useForm } from '@inertiajs/vue3';

    import { Badge, Button, Card, Divider, FileUpload, FloatLabel, InputText, Message, Textarea } from 'primevue';

    import * as yup from 'yup'; 

    const props = defineProps({
        taskId: Number
    });

    const toast = useToast();

    const form = useForm({
        file: null,
        content: null,
    })

    const schema = yup.object().shape({
        content: yup
        .string()
        .required('The content field is required.')
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
    function onFileSelect (value) {
            form.file = value.files[0]
        }

    const onFormSubmit = ({ valid }) => {
        if (!valid) return;

        form.transform((data) => ({
            ...data,
            task_id: props.taskId
        })).post('/task/submit-task', {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    summary: 'Success',
                    detail: 'Form Submitted',
                    severity: 'success',
                    life: 3000
                });
                form.reset();
            }
        });
    };
</script>
<template>
    <Form v-slot="$form" :resolver @submit="(e) => onFormSubmit(e)" class="flex flex-col space-y-4">
        <div class="flex-1">
            <div class=" border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 font-medium">
                <div class="grid grid-rows-1 gap-4">
                    <div>
                        <FileUpload 
                            ref="fileupload" 
                            mode="basic" 
                            name="file[]" 
                            accept="application/pdf, image/*"
                            @select="onFileSelect"
                        />
                        <Message
                            v-if="$form.file?.invalid || form.errors.file"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ $form.file?.error?.message || form.errors.file }}
                        </Message>
                    </div>
                    <div>
                        <FloatLabel variant="on">
                            <label for="content">Content</label>
                            <Textarea v-model="form.content" id="content" name="content" rows="3" fluid></Textarea>
                            <Message
                                v-if="$form.content?.invalid || form.errors.content"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ $form.content?.error?.message || form.errors.content }}
                            </Message>
                        </FloatLabel>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <Button type="submit" :loading="form.processing" label="Submit" />
        </div>
    </Form>
</template>