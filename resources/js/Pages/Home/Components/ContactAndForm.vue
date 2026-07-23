<script setup>
    import { useToast } from 'primevue/usetoast';
    import { InputText, FloatLabel, Button, Textarea, Message } from 'primevue';
    import { Form } from '@primevue/forms';
    import { useForm } from '@inertiajs/vue3';
    import * as yup from 'yup';

    const toast = useToast();

    const form = useForm({
        firstname: null,
        lastname: null,
        email: null,
        confirm_email: null,
        organization: null,
        address: null,
        city: null,
        country: null,
        message: null,
    });

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
        .required('The organization field is required.')
        .matches(/^[A-Za-z0-9]+$/, 'The first name may only contain letters and numbers.'),
        address: yup
        .string()
        .required('The address field is required.'),
        city: yup
        .string()
        .required('The city field is required.'),
        country: yup
        .string()
        .required('The country field is required.'),
        message: yup
        .string()
        .required('The message field is required.')
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
            form.post('/submit-inquiry', {
                onSuccess: (message) => {
                    toast.add({
                        summary: 'Success',
                        detail: message.props.flash.message,
                        severity: 'success',
                        life: 3000
                    });
                    form.reset();
                },
                onError: (error) => {
                    console.log(error);
                },
                preserveScroll: true
           }) 
        }
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
                <Form v-slot="$form" :resolver="resolver"  @submit="onFormSubmit">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <FloatLabel variant="on">
                                <label for="firstname">First Name</label>
                                <InputText v-model="form.firstname" id="firstname" name="firstname" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="form.errors.firstname || $form.firstname?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.firstname || $form.firstname?.error?.message }}
                            </Message>
                        </div>
                        <div>
                            <FloatLabel variant="on">
                                <label for="lastname">Last Name</label>
                                <InputText v-model="form.lastname" id="lastname" name="lastname" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="form.errors.lastname || $form.lastname?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.lastname || $form.lastname?.error?.message }}
                            </Message>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <FloatLabel variant="on">
                                <label for="email">Email</label>
                                <InputText v-model="form.email" id="email" name="email" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="form.errors.email || $form.email?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.email || $form.email?.error?.message }}
                            </Message>
                        </div>
                        <div>
                            <FloatLabel variant="on">
                                <label for="confirm_email">Confirm Email</label>
                                <InputText v-model="form.confirm_email" id="confirm_email" name="confirm_email" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="form.errors.confirm_email || $form.confirm_email?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.confirm_email || $form.confirm_email?.error?.message }}
                            </Message>
                        </div>
                    </div>

                    <div class="mb-4">
                        <FloatLabel variant="on">
                            <label for="organization">Organization</label>
                            <InputText v-model="form.organization" id="organization" name="organization" fluid></InputText>
                        </FloatLabel>
                        <Message
                            v-if="form.errors.organization || $form.organization?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.organization || $form.organization?.error?.message }}
                        </Message>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <FloatLabel variant="on">
                                <label for="address">Address</label>
                                <InputText v-model="form.address" id="address" name="address" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="form.errors.address || $form.address?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.address || $form.address?.error?.message }}
                            </Message>
                        </div>
                        <div>
                            <FloatLabel variant="on">
                                <label for="city">City</label>
                                <InputText v-model="form.city" id="city" name="city" fluid></InputText>
                            </FloatLabel>
                            <Message
                                v-if="form.errors.city ||$form.city?.invalid"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.city ||$form.city?.error?.message }}
                            </Message>
                        </div>
                    </div>
                    <div class="mb-4">
                        <FloatLabel variant="on">
                            <label for="country">Country</label>
                            <InputText v-model="form.country" id="country" name="country" fluid></InputText>
                        </FloatLabel>
                        <Message
                            v-if="form.errors.country || $form.country?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.country || $form.country?.error?.message }}
                        </Message>
                    </div>
                    <div class="mb-4">
                        <FloatLabel variant="on">
                            <label for="message">Message</label>
                            <Textarea v-model="form.message" id="message" name="message" rows="8" fluid></Textarea>
                        </FloatLabel>
                        <Message
                            v-if="form.errors.message || $form.message?.invalid"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.message || $form.message?.error?.message }}
                        </Message>
                    </div>
                    <div class="text-center">
                        <Button type="submit" :loading="form.processing" class="w-50">Submit</Button>
                    </div>
                </Form>
            </div>
        </div>
    </section>
</template>