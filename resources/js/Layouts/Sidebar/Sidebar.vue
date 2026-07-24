<script setup>
    import Button from "primevue/button";
    import Badge from "primevue/badge";
    import Menu from 'primevue/menu';
    import Image from 'primevue/image';

    import { usePage, Link } from "@inertiajs/vue3";

    import { ref } from "vue";

    const props = defineProps({
        countOfPendingTask: Number,
    })

    const page = usePage();

    const items = ref([
        {
            separator: true
        },
        {
            label: 'Home',
            items: [
                {
                    label: 'Dashboard',
                    icon: 'pi pi-home',
                    link: '/dashboard'
                }
            ]
        },
        {
            label: 'Activities',
            items: [
                {
                    label: 'Drafts',
                    icon: 'pi pi-pen-to-square',
                    link: '/drafts'
                },
                {
                    label: 'Tasks',
                    icon: 'pi pi-list',
                    link: '/task'
                },
                {
                    label: 'Tickets',
                    icon: 'pi pi-ticket',
                    link: '/ticket'
                },
            ]
        },
        {
            label: 'Tools',
            items: [
                {
                    label: 'Users',
                    icon: 'pi pi-user',
                    link: '/users'
                },
                {
                    label: 'Departments',
                    icon: 'pi pi-users',
                    link: '/department'
                },
            ]
        },
        {
            label: 'Account',
            items: [
                {
                    label: 'Settings',
                    icon: 'pi pi-cog',
                    link: '/settings'
                },
                {
                    label: 'Logout',
                    icon: 'pi pi-sign-out',
                    link: '/logout'
                }
            ]
        },
        {
            separator: true
        }
    ]);
</script>
<template>
    <div class="">
        <div class="overflow-y-auto">
            <div class="card flex justify-center">
                <Menu :model="items" class="w-full md:w-60">
                    <template #start>
                        <span class="inline-flex items-center gap-1 px-2 py-2">
                            <Image src="/assets/images/pmcg.png" alt="Image" width="210" />
                            <!-- <span class="text-xl font-semibold">Laravel</span> -->
                        </span>
                    </template>
                    <template #submenulabel="{ item }">
                        <span class="text-primary font-bold">{{ item.label }}</span>
                    </template>
                    <template #item="{ item, props }">
                        <Link v-ripple class="flex items-center" v-bind="props.action" :href="item.link">
                            <span :class="item.icon" />
                            <span>{{ item.label }}</span>
                        </Link>
                    </template>
                    <template #end>
                        <div class="flex justify-between items-center pt-2">
                            <Image src="/assets/images/pmcgroup.png" alt="Image" width="55" />
                            <span class="flex inline-flex flex-col items-start m-2">
                                <span class="font-bold">{{ page.props.user.name }}</span>
                                <span class="text-sm">{{ page.props.user.department }}</span>
                                <span class="text-sm">{{ page.props.user.role }}</span>
                            </span>
                        </div>
                    </template>
                </Menu>
            </div>
        </div>
    </div>
</template>