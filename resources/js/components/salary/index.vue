<template>
    <div>
        <div class="row">
            <router-link to="/store-employee" class="btn btn-primary">Add Employee</router-link>
        </div>
        <br>
            <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="search Here">
        <br>
           <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone Number</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                      <tr v-for="employee in filterSearch" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td> <img :src="employee.photo" id="emp_photo"></td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.salary }}</td>
                        <td>{{ employee.joining_date }}</td>
                        <td>
                            <router-link :to="{name: 'pay-salary', params:{id:employee.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
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
            employees: [],
            searchTerm:''
        }
    },
    computed: {
        filterSearch(){
            return this.employees.filter(employee => {
            //    return employee.phone.match(this.searchTerm)
               return employee.name.match(this.searchTerm)
            });
        }
    },
    methods: {
       allEmployee(){
           axios.get('/api/employee/')
           .then(({data})=> (this.employees = data))
           .catch()
       }
    },
    created(){
        this.allEmployee();
    }
   
}
</script>

<style type="text/css">
    #emp_photo{
        height: 40px;
        width: 40px;
    }
</style>