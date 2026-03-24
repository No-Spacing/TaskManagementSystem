<script setup>
    import Layout from "../../Layouts/Master.vue"; 

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
    import Badge from "primevue/badge";
    import { Form } from "@primevue/forms";
    import Textarea from "primevue/textarea";
    import FloatLabel from 'primevue/floatlabel';
    import InputText from "primevue/inputtext";
    import Message  from "primevue/message";
    import FileUpload from "primevue/fileupload"

    const props = defineProps({
        tasks: Object,
    })

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
                <div v-for="(task, index) in props.tasks" :key="index">
                    <Accordion value="0" >
                        <AccordionPanel>
                            <AccordionHeader>
                                <div>
                                    {{ task.title }}
                                </div>
                                <div>
                                    <Badge severity="success">{{ task.status.name.toUpperCase() }}</Badge>
                                </div>
                            </AccordionHeader>
                            <AccordionContent>
                                <Card>
                                    <template #title>
                                        <div class="flex justify-between">
                                            <div>
                                                Progress of Task
                                            </div>
                                        </div>
                                    </template>
                                    <template #subtitle><Divider /></template>
                                    <template #content>
                                        <Stepper :value="task.StepList">
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
                                                    <div class="flex flex-col h-48">
                                                        <div class=" border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 font-medium">
                                                            <Form class="grid grid-rows-1">
                                                                <div class="grid grid-rows-1 gap-4">
                                                                    
                                                                    <div>
                                                                        <FileUpload url="/api/upload" :multiple="true" :maxFileSize="1000000">
                                                                            <template #empty>
                                                                                <span>Drag and drop files to here to upload.</span>
                                                                            </template>
                                                                        </FileUpload>
                                                                    </div>
                                                                    <div>
                                                                        <FloatLabel variant="on">
                                                                            <label for="content">Content</label>
                                                                            <Textarea id="content" name="content" rows="3" fluid></Textarea>
                                                                        </FloatLabel>
                                                                    </div>
                                                                </div>
                                                            </Form>
                                                        </div>
                                                    </div>
                                                    <div class="flex pt-15 justify-end">
                                                        <Button 
                                                        label="Submit" 
                                                        />
                                                    </div>
                                                </StepPanel>
                                            </StepPanels>
                                        </Stepper>
                                    </template>
                                </Card>
                            </AccordionContent>
                        </AccordionPanel>
                    </Accordion>
                </div>
            </template>
        </Card>
    </Layout>
</template>