<template>
    <v-toolbar class="mb-3 glass rounded-lg">
        <v-toolbar-title>
            Employees List
        </v-toolbar-title>
    </v-toolbar>

    <v-card class="glass rounded-lg mt-5">

        <v-toolbar color="primary">
            <v-spacer/>

            <v-dialog v-model="dialog" width="700" persistent>
                <template  v-slot:activator="{ props: activatorProps }">
                    <v-btn color="white" variant="outlined" v-bind="activatorProps">
                        Add Client
                    </v-btn>
                </template>

                <v-form @submit.prevent="addClientDetails">
                    <v-card variant="flat">
                        <v-card-title>
                            Add Client Details
                        </v-card-title>

                        <v-card-text>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.name"
                                        :error-messages="$page.props.errors.name"
                                        label="Client Full Name"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                                <v-col>

                                    <v-text-field
                                        v-model="form.employee_job_id"
                                        label="Select Employee Job"
                                        :error-messages="$page.props.errors.employee_job_id"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.email"
                                        :error-messages="$page.props.errors.email"
                                        label="Client Email"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="form.phone"
                                        :error-messages="$page.props.errors.phone"
                                        label="Client Phone No"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                            </v-row>



                            <v-textarea
                                rows="3"
                                v-model="form.physical_address"
                                :error-messages="$page.props.errors.physical_address"
                                label="Physical Address"
                                variant="outlined"
                                density="comfortable"
                            />


                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="form.national_id"
                                        label="National ID No"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                                <v-col>
                                    <v-text-field
                                        v-model="form.nationality"
                                        label="Nationality"
                                        variant="outlined"
                                        density="comfortable"
                                    />
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <v-card-actions class="glass">
                            <v-btn color="warning" @click="()=>{ this.form.reset(); this.dialog = false }">
                                Cancel
                            </v-btn>

                            <v-spacer/>

                            <v-btn :loading="form.processing" variant="flat" color="success" type="submit">
                                <span v-if="form.id > 1">Update Client Details</span>
                                <span v-else>Add Client</span>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-dialog>
        </v-toolbar>
        <v-card-text>
            <v-data-table
                    :headers="headers"
                    :items="$page.props.employees"
                    :search="search"
            >
                <template v-slot:item.actions="{ item }">
                   <div class="d-flex">
                       <v-btn color="primary" variant="flat" @click="showUpdateForm(item)">
                           View
                       </v-btn>

                       <v-btn class="ml-2" color="error" variant="flat" @click="deleteEmployee(item)">
                           Delete
                       </v-btn>
                   </div>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout:AuthenticatedLayout,

    data(){
        return{
            search:'',
            dialog:false,
            headers:[
                { title: 'Full Name', value: 'name' },
                { title: 'Email', value: 'email' },
                { title: 'Phone', value: 'phone' },
                { title: 'Job Post', value: 'employee_job_id' },
                { title: 'Actions', value: 'actions', sortable:false },
            ],

            form:this.$inertia.form({
                id:'',
                name:'',
                role:'',
                email:'',
                phone:'',
                employee_job_id:'',
                physical_address:'',
                national_id:'',
                nationality:'',
            })
        }
    },

    methods:{

        addClientDetails(){

            if(this.form.id){ // If the form has an ID we send data to the update methods

                this.form.put(route('employees.update',this.form.id),{
                    onSuccess:()=>{
                        this.dialog = false
                    }
                })

            }else{ // Create a new employee

                this.form.post(route('employees.store'),{
                    onSuccess:()=>{
                        this.dialog = false
                    }
                })

            }
        },


        deleteEmployee(employee){

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete employee!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    this.$inertia.delete(route('employees.destroy',employee.id),{
                        onSuccess:()=>{
                            this.dialog = false
                        }
                    })
                }
            });
        },

        showUpdateForm(employee){

            //Fill Form with Values

            this.form.id                 = employee.id
            this.form.name               = employee.name
            this.form.role               = employee.role
            this.form.email              = employee.email
            this.form.phone              = employee.phone
            this.form.employee_job_id    = employee.employee_job_id
            this.form.physical_address   = employee.physical_address
            this.form.national_id        = employee.national_id
            this.form.nationality        = employee.nationality

            //Show Dialog

            this.dialog = true
        }
    }
}
</script>
