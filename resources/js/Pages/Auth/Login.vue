<template>
    <v-app>
        <v-main>
            <v-container fluid class="h-100">
                <v-row class="d-flex align-center">
                    <v-col cols="12" sm="6">
                        <v-img  height="100%" src="/images/bg.png"/>
                    </v-col>
                    <v-col cols="12" sm="6">

                        <v-form @submit.prevent="submit">
                            <v-card variant="flat" class="mx-auto glass pa-3" width="500" >
                                <v-card-title class="mb-5 text-center">
                                    <img class="d-block mx-auto" src="/images/sybrin-logo-new.jpg" alt="" width="200" >
                                    <h3 >SignIn</h3>
                                </v-card-title>

                                <v-card-text>
                                    <v-text-field
                                        variant="outlined"
                                        label="Enter Email"
                                        clearable
                                        :error-messages="form.errors.email"
                                        v-model="form.email"
                                    />

                                    <v-text-field
                                        class="mt-5"
                                        variant="outlined"
                                        label="Enter Password"
                                        type="password"
                                        clearable
                                        v-model="form.password"
                                        :error-messages="form.errors.password"
                                    />


                                    <div class="d-flex align-center">
                                        <v-checkbox
                                            label="Remember Me"
                                            v-model="form.remember"
                                        />
                                        <v-spacer/>
                                        <a href="#" class="mb-4">Forgot Password?</a>
                                    </div>
                                </v-card-text>

                                <v-card-actions>
                                    <v-btn :loading="form.processing" type="submit" block color="primary" variant="flat" size="x-large">
                                        Signin
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import {  useForm } from '@inertiajs/vue3';


const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
