<script setup>
    import Layout from "../../Layouts/Master.vue";

    import { ref } from 'vue'

    import Card from 'primevue/card';
    import FloatLabel from 'primevue/floatlabel';
    import InputText from 'primevue/inputtext';
    import Divider from 'primevue/divider';
    import Textarea  from 'primevue/textarea';
    import Button from 'primevue/button';
    import AutoComplete from 'primevue/autocomplete';
    import { Form } from '@primevue/forms';

    import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        users: {
            type: Array, // expect an array of user names or objects
            required: true
        }

    });

    const members = ref(['']) // start with one input

    function addMember() {
        members.value.push('') // add new input field
    }

    const filteredUsers = ref([...props.users]);

    const searchUsers = (event) => {
        const query = event.query.trim().toLowerCase();

        if (!query.length) {
            filteredUsers.value = [...props.users];
        } else {
            filteredUsers.value = props.users.filter(user =>
            user.name.toLowerCase().includes(query)
            );
        }
    };




</script>
<template>
    <Layout>
        <div class="grid place-content-center">
            <Card style="width: 75rem; margin-top: 10px;">
                <template #title>Create</template>
                <template #subtitle><Divider /></template>
                <template #content>
                    <Form class="grid grid-rows-1 gap-10">
                        <div class="grid grid-rows-1 gap-5">
                            <div>
                                <FloatLabel variant="on">
                                    <InputText id="task-title" fluid></InputText>
                                    <label for="task-title">Title</label>
                                </FloatLabel>
                            </div>
                            <div>
                                <FloatLabel variant="on">
                                    <Textarea id="task-description" fluid></Textarea>
                                    <label for="task-description" >Description</label>
                                </FloatLabel>
                            </div>
                        </div>
                        <div class="grid grid-rows-1 gap-1">
                            <div>
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-bold">Members</h2>
                                    <Button 
                                        label="Add Members" 
                                        icon="pi pi-plus" 
                                        @click="addMember" 
                                    />
                                </div>
                                <Divider></Divider>
                            </div>
                            <div class="grid grid-cols-1 gap-4 items-start">
                                <div class="flex flex-col gap-2" v-for="(task, index) in members":key="index" >
                                    <label for="username">Step {{ ++index }}</label>
                                    <AutoComplete 
                                        placeholder="Select a user"
                                        v-model="members[index]" 
                                        :suggestions="filteredUsers"
                                        optionLabel="name"
                                        optionValue="id"
                                        dropdown
                                        @complete="searchUsers"
                                    />
                                </div>       
                            </div>
                        </div>
                        <div class="">
                            <Divider />
                            <Button type="submit" label="Submit" style="width: 150px;" class="flex justify-self-center"></Button>
                        </div>
                    </Form>
                </template>
            </Card>
        </div>
    </Layout>
</template>