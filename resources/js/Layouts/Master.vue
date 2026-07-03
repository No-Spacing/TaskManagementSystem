<script setup>
    import Menubar from 'primevue/menubar';
    import Badge  from 'primevue/badge';
    import InputText from 'primevue/inputtext';
    import Avatar from 'primevue/avatar';
    import Button from 'primevue/button';
    import Drawer from 'primevue/drawer';
    import Toast from 'primevue/toast';
    import Splitter from 'primevue/splitter';
    import SplitterPanel from 'primevue/splitterpanel';
    import Card from 'primevue/card';
    import Image from 'primevue/image';

    import Menu from 'primevue/menu';

    import Sidebar from './Sidebar/Sidebar.vue'

    import { ref } from "vue";

    import { Link, usePage, Head } from '@inertiajs/vue3'
    import Footer from './Footer.vue';

    const page = usePage();
    const visible = ref(false);

    defineProps({ title: String });
</script>

<template>
    <main class="bg-zinc-200 ">
        <article>
            <Toast position="top-center" />
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
            <!-- <Splitter style="height: 100%">
                <SplitterPanel class="" :size="13" :minSize="10"> 
                    <SideBarContent :countOfPendingTask="page.props.user.countOfPendingTask" />
                </SplitterPanel>
                <SplitterPanel :size="90">
                    <div class="p-2">
                        <slot />
                    </div>
                </SplitterPanel>
            </Splitter> -->
        </article>
    </main>
    <Footer></Footer>
</template>