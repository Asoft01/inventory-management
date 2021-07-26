<template>
    <div>
        <div class="row">
            <router-link to="/store-expense" class="btn btn-primary">Add Expense</router-link>
        </div>
        <br>
            <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="search Here">
        <br>
           <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                      <tr v-for="expense in filterSearch" :key="expense.id">
                            <td>{{ expense.details }}</td>
                            <td>{{ expense.amount }}</td>
                            <td>{{ expense.expense_date }}</td>
                            <td>
                                <router-link :to="{name: 'edit-expense', params:{id:expense.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                <a @click="deleteExpense(expense.id)" href="#" class="btn btn-sm btn-danger"><font color="#ffffff"> Delete</font> </a>
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
            expenses: [],
            searchTerm:''
        }
    },
    computed: {
        filterSearch(){
            return this.expenses.filter(expense => {
            //    return employee.phone.match(this.searchTerm)
               return expense.expense_date.match(this.searchTerm)
            });
        }
    },
    methods: {
       allExpense(){
           axios.get('/api/expense/')
           .then(({data})=> (this.expenses = data))
           .catch()
       },
       deleteExpense(id){
           Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/api/expense/'+id)
                    .then(()=> {
                        this.expenses = this.expenses.filter(expense => {
                            console.log(expense); 
                            return expense.id != id
                        });
                    })
                    .catch(()=> {
                        this.$router.push({name: 'expense' })
                    })
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
       }
    },
    created(){
        this.allExpense();
    }
   
}
</script>

<style type="text/css">
    #emp_photo{
        height: 40px;
        width: 40px;
    }
</style>