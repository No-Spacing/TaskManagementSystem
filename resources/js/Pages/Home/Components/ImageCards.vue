<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-center">
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/food.jpg" alt="Image 1"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500" 
            >
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Food</p>
            </div>
        </div>
        <div class="relative"
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/logistics.jpg" alt="Image 2"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Logistics</p>
            </div>
        </div>
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/hospital-equipments.jpg" alt="Image 3"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Hospital Equipment</p>
            </div>
        </div>
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/laboratory.jpg" alt="Image 4"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Laboratory Consumables</p>
            </div>
        </div>
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/goods.jpg" alt="Image 5"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Fast moving consumer goods</p>
            </div>
        </div>
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/property.jpg" alt="Image 6"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Property Development</p>
            </div>
        </div>
    </div>

    <!-- Centered Two Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 text-center justify-center mt-4">
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/medical-consumable.jpg" alt="Image 8"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Medical Devices and Consumables</p>
            </div>
        </div>
        <div class="relative" 
            v-motion="{ 
                initial: { opacity: 0, y: 200 },
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"  
        >
            <img src="/public/assets/images/updated/warehouse.jpg" alt="Image 7"
                class="w-full h-auto rounded-lg transition-transform transform hover:scale-105 duration-500">
            <div class="absolute inset-0 bg-black/60 hover:bg-black/20 flex items-center justify-center rounded-lg transition-colors">
                <p class="text-white text-lg md:text-2xl lg:text-3xl font-semibold">Warehouse operations</p>
            </div>
        </div>
    </div>
</template>