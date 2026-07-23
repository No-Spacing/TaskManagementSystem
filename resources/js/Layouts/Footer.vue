<script setup>
    import Toast from 'primevue/toast';
</script>
<template>
    <Toast position="top-center" />
    <div class="bg-gray-900 w-full">
        <p class="text-center py-4 text-sm text-gray-200">© {{ new Date().getFullYear() }} PMC Group. All rights reserved.</p>
    </div>
</template>