<script setup>
    import Layout from '../../Layouts/Master.vue'; 

    import Stepper from 'primevue/stepper';
    import StepList from 'primevue/steplist';
    import StepPanels from 'primevue/steppanels';
    import StepItem from 'primevue/stepitem';
    import Step from 'primevue/step';
    import StepPanel from 'primevue/steppanel';
    import Button from 'primevue/button';
    import Card from 'primevue/card'
    import Divider from 'primevue/divider'
    import Accordion from 'primevue/accordion';
    import AccordionPanel from 'primevue/accordionpanel';
    import AccordionHeader from 'primevue/accordionheader';
    import AccordionContent from 'primevue/accordioncontent';
    import Badge from 'primevue/badge';
    import { Form } from '@primevue/forms';
    import Textarea from 'primevue/textarea';
    import FloatLabel from 'primevue/floatlabel';
    import InputText from 'primevue/inputtext';
    import Message  from 'primevue/message';
    import FileUpload from 'primevue/fileupload'

    import { usePage, useForm } from '@inertiajs/vue3';

    import { ref, onMounted } from 'vue';

    import * as yup from 'yup'; 

    const page = usePage();

    const props = defineProps({
        tasks: Object,
    })

    const isEnabletoEdit = ref(true);
    
    const form = useForm({
        file: null,
        content: null,
    })

    const schema = yup.object().shape({
        file: yup
        .mixed()
        .required('The file field is required.')
        .test('fileType', 'Only PDF files are allowed.', (value) => {
        return value && value.type === 'application/pdf'
        }),
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

    const onFormSubmit = ({ valid }) => {
        if (valid) {
            form.post('/task/submit-task', {
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
    <Layout>
        <Card style="width: 75rem; margin-top: 10px;">
            <template #title>
                <div class="flex justify-between">
                    <div>
                        List of Tasks
                    </div>
                    <div>
                        <Button as="a" href="/task/create-task">Create Task</Button>
                    </div>
                </div>
            </template>
            <template #content>
                <Accordion>
                    <AccordionPanel v-for="(task, index) in props.tasks" :key="index" :value="task.id" >
                        <AccordionHeader>
                            <div>
                                {{ task.title }}
                            </div>
                            <div>
                                <Badge severity="success">{{ task.status.name.toUpperCase() }}</Badge>
                            </div>
                        </AccordionHeader>
                        <AccordionContent>
                            <Card class="custom-card">
                                <template #title>
                                    <div class="flex justify-between">
                                        <div>
                                            Progress of Task
                                        </div>
                                    </div>
                                </template>
                                <template #subtitle><Divider /></template>
                                <template #content>
                                    <Stepper :value="task.steps" class="custom-step-panel">
                                        <StepList>
                                            <Step 
                                            v-for="(user, index) in task.users" 
                                            :key="index" 
                                            :value="index + 1"
                                            >
                                                {{ user.name }}
                                            </Step>
                                        </StepList>
                                        <StepPanels>
                                            <StepPanel
                                            v-for="(content, index) in task.users"
                                            :key="index"
                                            :value="index + 1"
                                            >
                                                <fieldset :disabled="page.props.user.id != content.pivot.user_id">
                                                    <Form v-slot="$form" :resolver @submit="onFormSubmit" class="flex flex-col space-y-4">
                                                        <div class="flex-1">
                                                            <div class=" border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 font-medium">
                                                                <div class="grid grid-rows-1 gap-4">
                                                                    <div>
                                                                        <FileUpload 
                                                                            ref="fileupload" 
                                                                            mode="basic" 
                                                                            name="file[]" 
                                                                            accept="application/pdf, image/*"
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
                                                            <Button type="submit" label="Submit" />
                                                        </div>
                                                    </Form>
                                                </fieldset>
                                            </StepPanel>
                                        </StepPanels>
                                    </Stepper>
                                </template>
                            </Card>
                        </AccordionContent>
                    </AccordionPanel>
                </Accordion>
            </template>
        </Card>
    </Layout>
</template>