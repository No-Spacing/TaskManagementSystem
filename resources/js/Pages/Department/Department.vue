<script setup>
    import Layout from '../../Layouts/Master.vue'
    import AddDepartmentModal from './Components/AddDepartmentModal.vue';

    import { ref } from 'vue';

    import Card from 'primevue/card';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Button from 'primevue/button';
    import Dialog from 'primevue/dialog';

    const props = defineProps({departments: Object})

    const addDepartmentDialog = ref(false);
</script>
<template>
    <Layout>
        <Card style="width: 75rem; margin-top: 10px;">
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
                <DataTable :value="props.departments" tableStyle="min-width: 50rem">
                    <Column field="name" header="Name"></Column>
                </DataTable>
            </template>
        </Card>
        <Dialog v-model:visible="addDepartmentDialog" modal header="Add Department" :style="{ width: '35rem' }">
            <AddDepartmentModal @close="addDepartmentDialog = false"></AddDepartmentModal>
        </Dialog>
    </Layout>
</template>