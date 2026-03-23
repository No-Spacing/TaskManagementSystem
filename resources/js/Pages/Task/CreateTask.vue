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
    import Message from 'primevue/message';
    import { Form } from '@primevue/forms';
    import { useToast } from 'primevue/usetoast';

    import * as yup from 'yup';

    import { useForm } from '@inertiajs/vue3'

    const toast = useToast();

    const form = useForm({
        title: null,
        description: null,
        members: []
    });

    const props = defineProps({
        users: {
            type: Array, // expect an array of user names or objects
            required: true
        }
    });

    function addMember() {
        form.members.push({ id: null, name: '' });
    }

    const filteredUsers = ref(props.users.map(u => ({
        id: u.id ?? u.user?.id,
        name: u.name ?? u.user?.name
    })));

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

    const schema = yup.object().shape({
        title: yup
        .string()
        .required('The title field is required.')
        .matches(/^[A-Za-z0-9 ]+$/, 'The title may only contain letters, numbers, and spaces.'),
        description: yup
        .string()
        .required('The description field is required')
        .matches(/^[A-Za-z0-9 ]+$/, 'The title may only contain letters, numbers, and spaces.'),
        members: yup.array().of(
            yup.mixed().test(
                'is-valid-member',
                'You must select a member',
                value => typeof value === 'string' || (value && typeof value === 'object' && value.id)
            ).required('You must select a member')
        )
    });

    const resolver = ({ values }) => {
        const errors = {};
        try {
            schema.validateSync(values, { abortEarly: false });
        } catch (validationError) {
            validationError.inner.forEach(err => {
                errors[err.path] = [{ message: err.message }];
            });
        }
        return { values, errors };
    };

    const onFormSubmit = ({ valid }) => {
        if (valid) {
            form.post('/task/add-task', {
                onSuccess: () => {
                    toast.add({
                        summary: 'Success',
                        detail: 'Form Submitted',
                        severity: 'success',
                        life: 3000
                    });
                    emit('close');
                }
            });
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
                    <Form v-slot="$form" :resolver="resolver" class="grid grid-rows-1 gap-10" @submit="onFormSubmit">
                        <div class="grid grid-rows-1 gap-5">
                            <div>
                                <FloatLabel variant="on">
                                    <label for="title">Title</label>
                                    <InputText v-model="form.title" id="title" name="title" fluid></InputText>
                                </FloatLabel>
                                <Message
                                    v-if="$form.title?.invalid || form.errors.title"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                >
                                    {{ $form.title?.error?.message || form.errors.title }}
                                </Message>
                            </div>
                            <div>
                                <FloatLabel variant="on">
                                    <label for="description" >Description</label>
                                    <Textarea v-model="form.description" id="description" name="description" fluid></Textarea>
                                </FloatLabel>
                                <Message
                                    v-if="$form.description?.invalid || form.errors.description"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                >
                                    {{ $form.description?.error?.message || form.errors.description }}
                                </Message>
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
                            <div class="grid grid-cols-1 gap-4 items-start" v-for="(member, index) in form.members" :key="index">
                                <label>Step {{ index + 1 }}</label>
                                <AutoComplete
                                    v-model="form.members[index]"
                                    :name="`members[${index}]`"
                                    placeholder="Select a user"
                                    :suggestions="filteredUsers"
                                    optionLabel="name"
                                    @complete="searchUsers"
                                    fluid
                                    dropdown
                                />
                                <Message
                                    v-if="$form.members?.[index]?.invalid"
                                    severity="error"
                                    size="small"
                                    variant="simple"
                                >
                                    {{ $form.members[index]?.error?.message }}
                                </Message>
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