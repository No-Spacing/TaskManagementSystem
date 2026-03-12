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
                <Accordion value="0" >
                    <AccordionPanel>
                        <AccordionHeader>
                            <div>
                                Task 1
                            </div>
                            <div>
                                <Badge severity="success">Finished</Badge>
                            </div>
                        </AccordionHeader>
                        <AccordionContent>
                            <Card>
                                <template #title>
                                    <div class="flex justify-between">
                                        <div>
                                            Progress of Task
                                        </div>
                                        <!-- <div>
                                            <Button as="a" href="/task/create-task">Create Task</Button>
                                        </div> -->
                                    </div>
                                </template>
                                <template #subtitle><Divider /></template>
                                <template #content>
                                    <Stepper value="3">
                                        <StepList>
                                            <Step value="1">User I</Step>
                                            <Step value="2">User II</Step>
                                            <Step value="3">User III</Step>
                                        </StepList>
                                        <StepPanels>
                                            <StepPanel v-slot="{ activateCallback }" value="1">
                                                <div class="flex flex-col h-48">
                                                    <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">Content I</div>
                                                </div>
                                                <div class="flex pt-6 justify-end">
                                                    <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="activateCallback('2')" />
                                                </div>
                                            </StepPanel>
                                            <StepPanel v-slot="{ activateCallback }" value="2">
                                                <div class="flex flex-col h-48">
                                                    <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">Content II</div>
                                                </div>
                                                <div class="flex pt-6 justify-between">
                                                    <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="activateCallback('1')" />
                                                    <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="activateCallback('3')" />
                                                </div>
                                            </StepPanel>
                                            <StepPanel v-slot="{ activateCallback }" value="3">
                                                <div class="flex flex-col h-48">
                                                    <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">Content III</div>
                                                </div>
                                                <div class="pt-6">
                                                    <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="activateCallback('2')" />
                                                </div>
                                            </StepPanel>
                                        </StepPanels>
                                    </Stepper>
                                </template>
                            </Card>
                        </AccordionContent>
                    </AccordionPanel>
                </Accordion>
                <Accordion value="1">
                    <AccordionPanel>
                        <AccordionHeader>
                            <div>
                                Task 2
                            </div>
                            <div>
                                <Badge severity="info">In Progress</Badge>
                            </div>
                        </AccordionHeader>
                        <AccordionContent>
                            <Card>
                                <template #title>
                                    Progress of Task
                                </template>
                                <template #subtitle><Divider /></template>
                                <template #content>
                                    <Stepper value="2">
                                    <StepList>
                                        <Step value="1">User I</Step>
                                        <Step value="2">User II</Step>
                                        <Step value="3">User III</Step>
                                    </StepList>
                                    <StepPanels>
                                        <StepPanel v-slot="{ activateCallback }" value="1">
                                            <div class="flex flex-col h-48">
                                                <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">Content I</div>
                                            </div>
                                            <div class="flex pt-6 justify-end">
                                                <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="activateCallback('2')" />
                                            </div>
                                        </StepPanel>
                                        <StepPanel v-slot="{ activateCallback }" value="2">
                                            <div class="flex flex-col h-48">
                                                <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">Content II</div>
                                            </div>
                                            <div class="flex pt-6 justify-between">
                                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="activateCallback('1')" />
                                                <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="activateCallback('3')" />
                                            </div>
                                        </StepPanel>
                                        <StepPanel v-slot="{ activateCallback }" value="3">
                                            <div class="flex flex-col h-48">
                                                <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">Content III</div>
                                            </div>
                                            <div class="pt-6">
                                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="activateCallback('2')" />
                                            </div>
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