<template>
    <div>
        <div class="row">
            <router-link to="/store-category" class="btn btn-primary">Add Category</router-link>
        </div>
        <br>
            <input type="text" v-model="searchTerm" class="form-control" style="width: 300px" placeholder="search Here">
        <br>
           <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <tr v-for="employee in employees" :key="employee.id"> -->
                      <tr v-for="category in filterSearch" :key="category.id">
                            <td>{{ category.category_name }}</td>
                            <td>
                                <router-link :to="{name: 'edit-category', params:{id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                <a @click="deleteCategory(category.id)" href="#" class="btn btn-sm btn-danger"><font color="#ffffff"> Delete</font> </a>
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
            categories: [],
            searchTerm:''
        }
    },
    computed: {
        filterSearch(){
            return this.categories.filter(category => {
            //    return employee.phone.match(this.searchTerm)
               return category.category_name.match(this.searchTerm)
            });
        }
    },
    methods: {
       allCategory(){
           axios.get('/api/category/')
           .then(({data})=> (this.categories = data))
           .catch()
       },
       deleteCategory(id){
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
                    axios.delete('/api/category/'+id)
                    .then(()=> {
                        this.categories = this.categories.filter(category => {
                            console.log(category); 
                            return category.id != id
                        });
                    })
                    .catch(()=> {
                        this.$router.push({name: 'category' })
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
        this.allCategory();
    }
   
}
</script>

<style type="text/css">
    #emp_photo{
        height: 40px;
        width: 40px;
    }
</style>