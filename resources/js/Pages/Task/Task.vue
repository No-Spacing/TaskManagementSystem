<script setup>
    import Layout from '../../Layouts/Master.vue'; 
    import TaskForm from './Component/TaskForm.vue';

    import { Badge, Button, Card, Divider, FileUpload, FloatLabel, InputText, Message, Textarea } from 'primevue';
    
    import Accordion from 'primevue/accordion';
    import AccordionPanel from 'primevue/accordionpanel';
    import AccordionHeader from 'primevue/accordionheader';
    import AccordionContent from 'primevue/accordioncontent';
    import Stepper from 'primevue/stepper';
    import StepList from 'primevue/steplist';
    import StepPanels from 'primevue/steppanels';
    import StepItem from 'primevue/stepitem';
    import Step from 'primevue/step';
    import StepPanel from 'primevue/steppanel';

    import { usePage } from '@inertiajs/vue3';

    const page = usePage();
    
    const props = defineProps({
        tasks: Object,
    })
    
</script>
<template>
    <Layout>
        <Card class="p-5">
            <template #title>
                <div class="flex justify-between">
                    <div>
                        List of Tasks
                    </div>
                    <div>
                        <Link href="/task/create-task"><Button>Create Task</Button></Link>
                    </div>
                </div>
            </template>
            <template #subtitle><Divider /></template>
            <template #content>
                <div v-if="props.tasks.length === 0">
                    Your task is empty.  
                </div>
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
                                                    <TaskForm :taskId="task.id" />
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