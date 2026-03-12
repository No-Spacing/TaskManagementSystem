<script setup>
    import Layout from '../../Layouts/Master.vue'
    import AddUserModal from './Components/AddUserModal.vue';

    import { ref } from 'vue';

    import Card from 'primevue/card';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Button from 'primevue/button';
    import Dialog from 'primevue/dialog';

    const props = defineProps({
        users: Object,
        department: Object,
    })

    const addUserDialog = ref(false);
</script>
<template>
    <Layout>
        <Card style="width: 75rem; margin-top: 10px;">
            <template #title>
                <div class="flex justify-between">
                    <div>
                        Users
                    </div>
                    <div>
                        <Button @click="addUserDialog = true">Add User</Button>
                    </div>
                </div>
            </template>
            <template #content>
                <DataTable :value="props.users" tableStyle="min-width: 50rem">
                    <Column field="name" header="Name"></Column>
                    <Column field="email" header="Email"></Column>
                    <Column field="department" header="Department"></Column>
                    <Column field="status" header="Status"></Column>
                </DataTable>
            </template>
        </Card>
        <Dialog v-model:visible="addUserDialog" modal header="Add User" :style="{ width: '35rem' }">
            <AddUserModal @close="addUserDialog = false" :department="props.department"></AddUserModal>
        </Dialog>
    </Layout>
</template>