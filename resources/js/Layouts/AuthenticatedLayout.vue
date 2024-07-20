<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer">
           <div class="glass text-center mx-3 mt-1 mb-1 rounded-lg">
               <img height="50" src="/images/sybrin-logo-new.jpg" />
           </div>

            <v-list density="comfortable" nav>

                <InertiaLink
                    v-for="item in menues"
                    :key="item.id"
                    class="inertiaLink"
                    :href="item.link"
                >
                    <v-list-item
                        :prepend-icon="item.icon"
                        :title="item.title"
                    >

                    </v-list-item>
                </InertiaLink>

                <v-divider class="my-3"/>
                <v-list-item
                    prepend-icon="mdi-logout"
                    @click="handleSignOut"
                    title="Logout"
                ></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-app-bar-title>Sybrin Imaging Solutions</v-app-bar-title>
        </v-app-bar>

        <v-main>
           <v-container>
               <slot/>
           </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { ref } from 'vue'
import {router} from "@inertiajs/vue3";

const drawer = ref(null)

const menues = ref([
    {
        id:0,
        title:'Dashboard',
        icon:'mdi-home',
        link:route('dashboard')
    },

    {
        id:0,
        title:'Employees List',
        icon:'mdi-account-group',
        link:route('employees.index')
    },

])

const handleSignOut = ()=>{
    router.visit(route('logout'), {
        method: 'post'
    })
}


</script>

<script>
    export default {
        watch: {
            $page: {
                handler() {
                    const message = this.$page.props.flash.message;
                    if (message != null) {
                        if(!message.optionRoute){
                            Swal.fire({
                                icon: message.type,
                                title: message.title,
                                text: message.description
                            })

                        }
                    }
                },
            },
        },
    }
</script>
