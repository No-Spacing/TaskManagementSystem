<script setup>
    import Layout from '../../Layouts/Master.vue';
    import Cards from './Admin/Cards/Cards.vue';
    import EmployeeProgress from './Admin/Progress/EmployeeProgress.vue';

    import Chart from 'primevue/chart';
    import Card from 'primevue/card';
    import Divider from 'primevue/divider';
    import ProgressBar from 'primevue/progressbar';

    import { ref, onMounted } from "vue";

    import { Head } from '@inertiajs/vue3';

    const props = defineProps({ users: Object});
</script>
<template>
    <Layout>
        <Head title="Welcome to Dashboard" />
        <Card class="p-5">
            <template #title>Dashboard</template>
            <template #subtitle><Divider /></template>
            <template #content> 
                <Cards></Cards>
                <div class="mt-5">
                    <EmployeeProgress :users="props.users"></EmployeeProgress>
                </div>
            </template>
        </Card>
        
    </Layout>
</template>