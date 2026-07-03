<script setup>
    import Layout from '../../Layouts/Master.vue'
    import AddUserModal from './Components/AddUserModal.vue';

    import { ref } from 'vue';

    import { Card, DataTable, Column, Button, Dialog, Divider, Badge, Tag } from 'primevue';

    const props = defineProps({
        users: Object,
        department: Object,
    })

    const addUserDialog = ref(false);
</script>
<template>
    <Layout>
        <Card class="p-5">
            <template #title>
                <div class="flex justify-between">
                    <div>
                        Users
                    </div>
                    <div>
                        <Button @click="addUserDialog = true">Add User</Button>
                    </div>
                </div>
                <Divider></Divider>
            </template>
            <template #content>
                <DataTable :value="props.users" tableStyle="min-width: 50rem">
                    <Column field="name" header="Name"></Column>
                    <Column field="email" header="Email"></Column>
                    <Column field="department.name" header="Department"></Column>
                    <Column field="status" header="Status">
                        <template #body="{data}">
                            <div v-if="data.status.name === 'active'">
                                <Tag :value="data.status.name.toUpperCase()" severity="success"></Tag>
                            </div>
                            <div v-if="data.status.name === 'inactive'">
                                <Tag :value="data.status.name.toUpperCase()" severity="danger"></Tag>
                            </div>
                        </template>
                    </Column>
                    <Column field="" header="">
                        <template #body>
                            <Button severity="secondary" icon="pi pi-pencil" aria-label="Save" />
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
        <Dialog v-model:visible="addUserDialog" modal header="Add User" :style="{ width: '35rem' }">
            <AddUserModal @close="addUserDialog = false" :department="props.department"></AddUserModal>
        </Dialog>
    </Layout>
</template>