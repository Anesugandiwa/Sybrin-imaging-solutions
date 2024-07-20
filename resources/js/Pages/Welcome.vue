<template>
   <v-app>
       <v-main>
           <v-card variant="flat" class="text-center mx-auto mt-10" width="600">
               <v-card-title >
                   <img class="d-block mx-auto" src="/images/sybrin-logo-new.jpg" alt="" width="250" >
                   <h1 class="display-5 fw-bold text-body-emphasis">Sybrin Imaging Solutions</h1>
               </v-card-title>
               <v-card-text>
                   <p class="text-h6 mb-4">
                       Welcome to Imaging Solutions Employee Management System.
                   </p>
               </v-card-text>

               <v-card-actions class="mb-5">
                   <InertiaLink class="inertiaLink" :href="route('login')">
                       <v-btn block variant="flat"    color="primary" size="x-large">
                           Get Started
                       </v-btn>
                   </InertiaLink>
               </v-card-actions>
           </v-card>
       </v-main>
   </v-app>
</template>

<script setup>
</script>
