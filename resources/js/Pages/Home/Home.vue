<script setup>
import ContactAndForm from './Components/ContactAndForm.vue';
import ImageCards from './Components/ImageCards.vue';
import MissionVision from './Components/MissionVision.vue';
import Footer from '../../Layouts/Footer.vue';
import * as yup from 'yup';

import { Head } from '@inertiajs/vue3';

</script>
<template>
    <Head title="PMC Group of Companies" />
    <div id="hero" class="bg-overlay h-screen relative flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div 
            v-motion="{
                initial: { opacity: 0, x: 0, y: 50},
                whileInView: { opacity: 1, y: -10 },
                transition: { duration: 1.0 },
                inViewOptions: { once:true }
            }"
            class="relative bg-white bg-opacity-75 p-10 rounded-lg shadow-lg" 
        >
            <img src="/public/assets/images/pmcg.png" alt="Logo" class="h-16 md:h-20 lg:h-20 w-auto">
        </div>
    </div>
    <div class="container-fluid bg-gray-700">
        <div class="container mx-auto flex flex-col justify-center p-6">
            <div class="text-center sm:text-left max-w-5xl py-14 mx-14" 
                v-motion="{ 
                    initial: { opacity: 0, y: 150 },
                    whileInView: { opacity: 1, y: -10 },
                    transition: { duration: 1.0 },
                    inViewOptions: { once:true }
                }"      
            >
                <h2 class="text-3xl md:text-5xl lg:text-5xl font-bold text-white mb-8">We can help you<br> make all the <span class="text-[#dca206]">right connections.</span></h2>
                <p class="text-sm md:text-lg text-white font-medium mt-2">
                    PMC Group is comprised of a diverse group of companies with brands of expertise in property development,
                    logistics, hospital equipment, medical and laboratory consumables, fast-moving consumer goods and food.
                    Offering fresh innovations, quality products and service excellence to a wide range of consumers,
                    we are focused on providing essential solutions for a better future.
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto flex flex-col justify-center p-6 bg-gray-50">
        <mission-vision></mission-vision>

        <!-- Image Grid -->
        <image-cards></image-cards>

        <!-- Bottom Content -->
        <div class="text-left max-w-5xl my-14">
            <h2 class="text-5xl md-text-6xl lg-text-6xl font-bold text-gray-900 mb-8">Quality is <br><span class="text-[#dca206]">never an
                    accident</span></h2>
            <p class="text-gray-700 font-medium mt-2">
                It is always the result of high intention, sincere effort, intelligent direction and skillful execution;
                it represents the wise choice of many alternatives, the cumulative experience of many masters of
                craftsmanship. Quality also marks the search for an ideal after necessity has been satisfied and mere
                usefulness achieved.
            </p>
            <p class="text-gray-400 font-medium mt-2">
                - Will A. Foster
            </p>
        </div>

        <!-- Contact Section with Moving Gradient Background -->
        <contact-and-form></contact-and-form>
    </div>
    <Footer></Footer>
</template>
<style>
    .bg-overlay {
        background: url('/public/assets/images/building.jpg') center/cover no-repeat;
        height: 100vh;
        position: relative;
        background-attachment: fixed;
    }

    .contact-section {
        background: linear-gradient(270deg, #27A49E, #047AB6);
        background-size: 400% 400%;
        animation: gradientBG 8s ease infinite;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>