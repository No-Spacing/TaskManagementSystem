<template>
    <div 
        class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-8 mb-8 bg-gray-50 p-12 rounded-lg" 
        v-motion="{ 
            initial: { opacity: 0, y: 50 },
            whileInView: { opacity: 1, y: -10 },
            transition: { duration: 1.0 },
            inViewOptions: { once:true }
        }"  
    >
        <div class="text-center">
            <h2 class="text-5xl md-text-6xl lg-text-6xl font-bold mb-8 text-[#dca206]">Mission</h2>
            <p class="text-2xl md-text-6xl lg-text-6xl text-gray-700 font-medium mt-2">
                We simplify corporate chaos - cutting through complexity so businesses move faster, smarter, and stronger.
            </p>
        </div>
        <div class="text-center">
            <h2 class="text-5xl md-text-6xl lg-text-6xl font-bold mb-8 text-[#dca206]">Vision</h2>
            <p class="text-2xl md-text-6xl lg-text-6xl text-gray-700 font-medium mt-2">
                We're building the kind of future where companies don’t just survive - they lead, disrupt, and inspire.
            </p>
        </div>
    </div>
</template>