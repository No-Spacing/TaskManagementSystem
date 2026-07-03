<script setup>
    import Layout from '../../Layouts/Master.vue'; 

    import Stepper from 'primevue/stepper';
    import StepList from 'primevue/steplist';
    import StepPanels from 'primevue/steppanels';
    import StepItem from 'primevue/stepitem';
    import Step from 'primevue/step';
    import StepPanel from 'primevue/steppanel';
    import Button from 'primevue/button';
    import Card from 'primevue/card'
    import Divider from 'primevue/divider'
    import Badge from 'primevue/badge';
    import { Form } from '@primevue/forms';
    import Textarea from 'primevue/textarea';
    import FloatLabel from 'primevue/floatlabel';
    import InputText from 'primevue/inputtext';
    import Message  from 'primevue/message';
    import FileUpload from 'primevue/fileupload'

    import { usePage, useForm } from '@inertiajs/vue3';

    import { ref, onMounted } from 'vue';

    import * as yup from 'yup'; 

</script>
<template>
    <Layout>
        <Card class="p-5">
            <template #title>    
                <div>
                    Settings
                </div>
            </template>
            <template #subtitle><Divider /></template>
            <template #content>
                <div>Content...</div>
            </template>
        </Card>
    </Layout>
</template>