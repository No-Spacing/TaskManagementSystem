<script setup>
    import Layout from '../../Layouts/Master.vue'

    import { ref } from 'vue';

    import { Card, DataTable, Column, Button, Dialog, Divider } from 'primevue';

    import AddTicketDialog from './Component/AddTicketDialog.vue';

    const props = defineProps({  
        departments: Object
    });

    const addTicketDialog = ref(false);
</script>
<template>
    <Layout>
        <Card class="p-5">
            <template #title>
                <div class="flex justify-between">
                    <div>
                        Tickets
                    </div>
                    <div>
                        <Button @click="addTicketDialog = true">Add Ticket</Button>
                    </div>
                </div>
                <Divider></Divider>
            </template>
            <template #content>
                <DataTable tableStyle="min-width: 50rem">
                    <Column field="ticketId" header="Ticket ID"></Column>
                    <Column field="description" header="Description"></Column>
                    <Column field="name" header="Open By"></Column>
                    <Column field="department" header="Department"></Column>
                    <Column field="created_at" header="Created at"></Column>
                    <Column field="status" header="Status"></Column>
                </DataTable>
            </template>
        </Card>
        <Dialog v-model:visible="addTicketDialog" modal header="Add Ticket" :style="{ width: '50rem' }">
            <AddTicketDialog @close="addTicketDialog = false" :departments="props.departments"></AddTicketDialog>
        </Dialog>
    </Layout>
</template>