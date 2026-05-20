<script setup>
    import Layout from '../../Layouts/Master.vue'
    import AddDepartmentModal from './Components/AddDepartmentModal.vue';

    import { ref } from 'vue';

    import Card from 'primevue/card';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Button from 'primevue/button';
    import Dialog from 'primevue/dialog';
    import Accordion from 'primevue/accordion';
    import AccordionPanel from 'primevue/accordionpanel';
    import AccordionHeader from 'primevue/accordionheader';
    import AccordionContent from 'primevue/accordioncontent';

    const props = defineProps({departments: Object})

    const addDepartmentDialog = ref(false);
</script>
<template>
    <Layout>
        <Card>
            <template #title>
                <div class="flex justify-between">
                    <div>
                        Department
                    </div>
                    <div>
                        <Button @click="addDepartmentDialog = true">Add Department</Button>
                        
                    </div>
                </div>
            </template>
            <template #content>
                <Accordion multiple>
                    <AccordionPanel v-for="(department, index) in props.departments" :key="index" :value="department.id" >
                        <AccordionHeader>
                            <div>
                                {{ department.name }}
                            </div>
                        </AccordionHeader>
                        <AccordionContent>
                            <div class="pl-5" v-for="(user, index) in department.users" :key="index" :value="user.id">
                                {{ ++index }}. {{ user.name }}
                            </div>
                        </AccordionContent>
                    </AccordionPanel>
                </Accordion>
                <!-- <DataTable :value="props.departments" tableStyle="min-width: 50rem">
                    <Column field="name" header="Name"></Column>
                </DataTable> -->
            </template>
        </Card>
        <Dialog v-model:visible="addDepartmentDialog" modal header="Add Department" :style="{ width: '35rem' }">
            <AddDepartmentModal @close="addDepartmentDialog = false"></AddDepartmentModal>
        </Dialog>
    </Layout>
</template>