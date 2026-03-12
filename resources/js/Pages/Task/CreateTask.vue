<script setup>
    import Layout from "../../Layouts/Master.vue";

    import Card from 'primevue/card';
    import FloatLabel from 'primevue/floatlabel';
    import InputText from 'primevue/inputtext';
    import Divider from 'primevue/divider';
    import Textarea  from 'primevue/textarea';
    import Button from 'primevue/button';
    import AutoComplete from 'primevue/autocomplete';

    import { ref } from 'vue'

    const members = ref(['']) // start with one input
    const value = ref(null);
    const users = ref(["User 1", "User 2", "User 3"]);
    const filteredUsers = ref([]);

    function addMember() {
        members.value.push('') // add new input field
    }

    const searchUsers = (event) => {
      // When dropdown is clicked, event.query is empty
      if (!event.query.trim().length) {
        filteredUsers.value = [...users.value]; // show all
      } else {
        filteredUsers.value = users.value.filter(user =>
          user.toLowerCase().includes(event.query.toLowerCase())
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
                    <form class="grid grid-rows-1 gap-10">
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
                                        dropdown
                                        @complete="searchUsers"
                                    />
                                </div>       
                            </div>
                        </div>
                        <div class="">
                            <Divider />
                            <Button label="Submit" style="width: 150px;" class="flex justify-self-center"></Button>
                        </div>
                    </form>
                </template>
            </Card>
        </div>
    </Layout>
</template>