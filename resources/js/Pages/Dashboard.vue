<template>
    <br>
        <v-row>
            <v-col cols="12" sm="4">
                <v-card class="glass">
                    <v-card-text class="d-flex align-center">
                        <div class="_20px">
                            <h3>{{ $page.props.employees }}</h3>
                            Employees
                        </div>
                        <v-spacer/>
                        <div>
                            <v-avatar size="60" color="primary">
                                <v-icon size="40" icon="mdi-account-group"></v-icon>
                            </v-avatar>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
</template>

<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    export default {
        layout:AuthenticatedLayout
    }
</script>
