<script setup>
    import { Avatar, Badge, Card, Drawer, Image, InputText, Menubar, } from 'primevue';

    import Sidebar from './Sidebar/Sidebar.vue'


    import { usePage } from '@inertiajs/vue3'
    import Footer from './Footer.vue';

    const page = usePage();
</script>

<template>
    <main class="bg-zinc-200 ">
        <article>
            
            <div class="flex gap-2 p-2">
                <div>
                    <Card>
                        <template #content>
                            <Sidebar :countOfPendingTask="page.props.user.countOfPendingTask" />
                        </template>
                    </Card>
                </div>
                <div class="w-full min-h-screen">
                    <slot />
                </div>
            </div>
        </article>
    </main>
    <Footer></Footer>
</template>