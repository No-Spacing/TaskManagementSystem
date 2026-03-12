<script setup>
    import Drawer from "primevue/drawer";
    import Button from "primevue/button";
    import Badge from "primevue/badge";

    import { ref } from "vue";
</script>
<template>
    <div class="flex flex-col h-full">
        <div class="overflow-y-auto">
            <ul class="list-none m-0">
                <li>
                    <ul class="list-none p-0 m-0 overflow-hidden">
                        <li>
                            <a v-ripple href="/" class="flex items-center cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                                <i class="pi pi-home mr-2"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a v-ripple href="/task" class="flex items-center justify-between cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                                <div>
                                    <i class="pi pi-list mr-2"></i>
                                    <span class="font-medium">Task Sequence</span>
                                </div>
                                <div>
                                    <Badge value="2" severity="warn"></Badge>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a v-ripple class="flex items-center justify-between cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                                <div>
                                    <i class="pi pi-file-edit mr-2"></i>
                                    <span class="font-medium">Drafts</span>
                                </div>
                                <div>
                                    <Badge value="2" severity="warn"></Badge>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a v-ripple class="flex items-center cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                                <i class="pi pi-calendar mr-2"></i>
                                <span class="font-medium">Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a v-ripple href="/department" class="flex items-center cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                                <i class="pi pi-building mr-2"></i>
                                <span class="font-medium">Department</span>
                            </a>
                        </li>
                        <li>
                            <a v-ripple href="/users" class="flex items-center cursor-pointer p-4 rounded text-surface-700 hover:bg-surface-100 dark:text-surface-0 dark:hover:bg-surface-800 duration-150 transition-colors p-ripple">
                                <i class="pi pi-users mr-2"></i>
                                <span class="font-medium">Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </div>
    </div>
</template>