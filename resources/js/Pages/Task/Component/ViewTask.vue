<script setup>
import { ref } from "vue";
import { Badge, Button, Card, Divider, FileUpload, FloatLabel, InputText, Message, Textarea, Dialog } from 'primevue';


const props = defineProps({
    file: String,
    content: String,
})
const visible = ref(false);
</script>
<template>
    <Card style="overflow: hidden">
        <template #title>Task</template>
        <template #subtitle><a :href="'/storage/'+props.file">File</a></template>
        <template #content>
            <p class="m-0">
                {{ props.content }}
            </p>
        </template>
        <template #footer>
            <div class="flex justify-end mt-4">
                <Button label="Re-submit" @click="visible = true"/>
            </div>
        </template>
    </Card>

    <Dialog v-model:visible="visible" modal header="Warning" :style="{ width: '25rem' }">
        <span class="text-surface-500 dark:text-surface-400 block mb-8">Are you sure you want to re-submit your output?</span>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Yes" @click="visible = false"></Button>
            <Button type="button" label="No" severity="secondary" @click="visible = false"></Button>
            
        </div>
    </Dialog>
</template>