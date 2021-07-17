<template>
    <div>
        <div class="row">
            <router-link to="" class="btn btn-primary">All Employee</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                        </div>
                        <form class="user" @submit.prevent="signup">
                            <div class="form-group">
                                
                                <div class="form-row">
                                    <div class="col-md-6">
                                         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Full Name" v-model="form.name">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>

                                    <div class="col-md-6">
                                         <input type="email" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Email" v-model="form.email">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>
                                </div>
                            </div>

                           <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Address" v-model="form.address">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>

                                    <div class="col-md-6">
                                         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Salary" v-model="form.salary">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                         <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Joining" v-model="form.joining_date">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>

                                    <div class="col-md-6">
                                         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Nid" v-model="form.nid">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Phone Number" v-model="form.phone">
                                         <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>

                                    <div class="col-md-6">
                                        <img src="form.photo" alt="" style="height: 40px; width: 40px;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <hr>
                           
                        </form>
                        <hr>
                        <div class="text-center">
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    // This runs first before login method works
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' })
        }
    },
    data(){
        return {
            form:{
                name: null,
                email: null,
                password: null,
                confirm_password: null
                // The Password confirmation is created in anothe way
            },
            errors: {

            }
        }
    },
   
}
</script>

<style type="text/css" lang="">
    
</style>