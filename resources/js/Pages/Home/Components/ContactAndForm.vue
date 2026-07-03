<script setup>
    import { useToast } from 'primevue/usetoast';
    import { InputText, FloatLabel, Button, Textarea, Message } from 'primevue';
    import { Form } from '@primevue/forms';
    import * as yup from 'yup';

    const schema = yup.object().shape({
        firstname: yup
        .string()
        .required('The first name field is required.')
        .matches(/^[A-Za-z]+$/, 'The first name may only contain letters.'),
        lastname: yup
        .string()
        .required('The last name field is required.')
        .matches(/^[A-Za-z]+$/, 'The last name may only contain letters.'),
        email: yup
        .string()
        .required('The email field is required.')
        .email('It must be a valid email.'),
        confirm_email: yup
        .string()
        .required('The confirm email field is required.')
        .email('It must be a valid email.')
        .oneOf([yup.ref('email')], 'The emails must match.'),
        organization: yup
        .string()
        .required('The organization field is required.'),
        address: yup
        .string()
        .required('The address field is required.'),
        city: yup
        .string()
        .required('The city field is required.'),
        country: yup
        .string()
        .required('The country field is required.')
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

</script>
<template>
    <section class="contact-section bg-gray-100 py-16 px-8">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10" 
            v-motion="{
                initial: { opacity: 0, x: 0, y: 0},
                whileInView: { opacity: 1, scale: 1 },
                transition: { duration: 0.5 },
                inViewOptions: { once:true }
            }"
        >
            
            <!-- Contact Information -->
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <h2 class="text-3xl font-bold mb-4 text-center">Contact Us</h2>
                <p class="mb-2"><strong>Phone:</strong> +63 (02) 8687-7888</p>
                <p class="mb-2"><strong>Email:</strong> info@pmcgroup.com</p>
                <p><strong>Address:</strong> Unit 2903, 29th Flr., Antel Global Corporate Center, 3 Julia Vargas Ave,
                    Ortigas Center, Pasig City</p>
                <!-- Google Map Embed with Pin -->
                <div class="mt-6">
                    <h3 class="text-xl font-bold mb-2">Our Location</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.494043376653!2d121.05937087502266!3d14.584411577953047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9145d36a66f%3A0x6b88a87db1d3b6f3!2sAntel%20Global%20Corporate%20Center!5e0!3m2!1sen!2sph!4v1632278407829!5m2!1sen!2sph"
                        width="100%" height="400" style="border:0; border-radius:8px;" allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Inquiry Form -->
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <h2 class="text-3xl font-bold mb-4 text-center">Inquiry Form</h2>
                <Form v-slot="$form" :resolver="resolver">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <FloatLabel variant="on">
                                <label for="firstname">First Name</label>
                                <InputText id="firstname" name="firstname" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="$form.firstname?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ $form.firstname?.error?.message }}
                            </Message>
                        </div>
                        <div>
                            <FloatLabel variant="on">
                                <label for="lastname">Last Name</label>
                                <InputText id="lastname" name="lastname" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="$form.lastname?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ $form.lastname?.error?.message }}
                            </Message>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <FloatLabel variant="on">
                                <label for="email">Email</label>
                                <InputText id="email" name="email" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="$form.email?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ $form.email?.error?.message }}
                            </Message>
                        </div>
                        <div>
                            <FloatLabel variant="on">
                                <label for="confirm_email">Confirm Email</label>
                                <InputText id="confirm_email" name="confirm_email" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="$form.confirm_email?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ $form.confirm_email?.error?.message }}
                            </Message>
                        </div>
                    </div>

                    <div class="mb-4">
                        <FloatLabel variant="on">
                            <label for="organization">Organization</label>
                            <InputText id="organization" name="organization" fluid></InputText>
                        </FloatLabel>
                        <Message
                                v-if="$form.organization?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ $form.organization?.error?.message }}
                            </Message>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <FloatLabel variant="on">
                            <label for="address">Address</label>
                            <InputText id="address" name="address" fluid></InputText>
                        </FloatLabel>
                        <FloatLabel variant="on">
                            <label for="city">City</label>
                            <InputText id="city" name="city" fluid></InputText>
                        </FloatLabel>
                    </div>
                    <div class="mb-4">
                        <FloatLabel variant="on">
                            <label for="country">Country</label>
                            <InputText id="country" name="country" fluid></InputText>
                        </FloatLabel>
                    </div>
                    <div class="mb-4">
                        <FloatLabel variant="on">
                            <label for="message">Message</label>
                            <Textarea id="message" name="message" rows="8" fluid></Textarea>
                        </FloatLabel>
                    </div>
                    <div class="text-center">
                        <Button class="w-50">Submit</Button>
                        <!-- <button type="submit"
                            class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300 ease-in-out">
                            Send
                        </button> -->
                    </div>
                </Form>
            </div>
        </div>
    </section>
</template>