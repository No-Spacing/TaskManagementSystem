<script setup>
    import Card from 'primevue/card';
    import Divider from 'primevue/divider';
    import ProgressBar from 'primevue/progressbar';

    const props = defineProps({ users: Object });

    console.log(props.users);
</script>

<template>
    <div class="flex flex-col gap-3">
        <Card v-for="user in props.users">
            <template #title>Juan Dela Cruz</template>
            <template #subtitle><Divider /> Employee Progress</template>
            <template #content>
                <ProgressBar :value="50" />
            </template>
        </Card>
    </div>
</template>
