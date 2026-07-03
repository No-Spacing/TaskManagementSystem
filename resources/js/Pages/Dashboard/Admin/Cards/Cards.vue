<script setup>
    import Card from 'primevue/card';
</script>
<template>
    <div class="grid sm:grid-cols-1 lg:grid-cols-4 gap-4">
        <Card class="">
            <template #content>
                <div class="flex justify-between items-center m-1">
                    <div class="">
                        <p class="text-4xl p-card-subtitle">
                            100
                        </p>
                        <p class="p-card-title m-1">
                            Tasks
                        </p>
                        
                    </div>
                    <div>
                        <i class="pi pi-list"  style="font-size: 3.5rem"></i>  
                    </div>
                </div>
            </template>
        </Card>
        <Card class="">
            <template #content>
                <div class="flex justify-between items-center m-1">
                    <div class="">
                        <p class="text-4xl p-card-subtitle">
                            100
                        </p>
                        <p class="p-card-title m-1">
                            Accomplished
                        </p>
                    </div>
                    <div>
                        <i class="pi pi-list-check"  style="font-size: 3.5rem"></i>  
                    </div>
                </div>
            </template>
        </Card>
        <Card class="">
            <template #content>
                <div class="flex justify-between items-center m-1">
                    <div class="">
                        <p class="text-4xl p-card-subtitle">
                            100
                        </p>
                        <p class="p-card-title m-1">
                            Employee
                        </p>
                        
                    </div>
                    <div>
                        <i class="pi pi-user"  style="font-size: 3.5rem"></i>  
                    </div>
                </div>
            </template>
        </Card>
        <Card class="">
            <template #content>
                <div class="flex justify-between items-center m-1">
                    <div class="">
                        <p class="text-4xl p-card-subtitle">
                            100
                        </p>
                        <p class="p-card-title m-1">
                            Departments
                        </p>
                        
                    </div>
                    <div>
                        <i class="pi pi-users"  style="font-size: 3.5rem"></i>  
                    </div>
                </div>
            </template>
        </Card>
    </div>
</template>