<script setup>
    import Layout from '../../Layouts/Master.vue'

    import { ref } from 'vue';

    import { router } from '@inertiajs/vue3';

    import { Card, DataTable, Column, Button, Dialog, Divider, Tag, Select, FloatLabel } from 'primevue';

    import AddTicketDialog from './Component/AddTicketDialog.vue';
    import ViewTicketDialog from './Component/ViewTicketDialog.vue';

    const props = defineProps({  
        tickets: Object,
        departments: Object
    });

    const addTicketDialog = ref(false);
    
    const viewTicketDialog = ref(false);
    const selectedTicket = ref(null);

    function Test(item) {
        selectedTicket.value = { ...item }
        viewTicketDialog.value = true
    } 

    function filterTable(value) {
        router.visit('/ticket', {
            data: {
                'filter_by': value.value
            },
            preserveState: true
        })
    }
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
                <div>
                    <FloatLabel variant="in">
                        <Select 
                            id="filter" 
                            class="w-40" 
                            :options="['All', 'Requests', 'Tickets']" 
                            @change="filterTable"
                        />
                        <label for="filter">Filter By:</label>
                    </FloatLabel>
                </div>  
                <DataTable tableStyle="min-width: 50rem" :value="props.tickets">
                    <Column field="id" header="Ticket ID"></Column>
                    <Column field="title" header="Title"></Column>
                    <Column field="department.name" header="Department"></Column>
                    <Column field="status" header="Status">
                        <template #body="{data}">
                            <div v-if="data.status.name === 'in progress'">
                                <Tag :value="data.status.name.toUpperCase()" severity="warn"></Tag>
                            </div>
                            <div v-if="data.status.name === 'finished'">
                                <Tag :value="data.status.name.toUpperCase()" severity="success"></Tag>
                            </div>
                        </template>
                    </Column>
                    <Column field="created_at" header="Created at"></Column>
                    <Column field="">
                        <template #body="data">
                            <div class="flex gap-2">
                                <Button severity="success" icon="pi pi-eye" label="View" @click="Test(data)"/>
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
        <Dialog v-model:visible="addTicketDialog" modal header="Add Ticket" :style="{ width: '50rem' }">
            <AddTicketDialog @close="addTicketDialog = false" :departments="props.departments"></AddTicketDialog>
        </Dialog>
        <Dialog v-model:visible="viewTicketDialog" modal header="Add Ticket" :style="{ width: '50rem' }">
            <ViewTicketDialog @close="viewTicketDialog = false" :ticketData="selectedTicket"></ViewTicketDialog>
        </Dialog>
    </Layout>
</template>