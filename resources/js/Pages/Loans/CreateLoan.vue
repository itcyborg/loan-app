<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addProduct">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Create Loan Application</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form @submit.prevent="createLoan">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Product</label>
                                                <select class="form-control" name="product" v-model="form.product_id">
                                                  <option value="">Select Product</option>
                                                  <option v-for="product in products" :value="product.id">{{product.name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label>Client</label>
                                                <select class="form-control" name="client" v-model="form.customer_id">
                                                  <option value="">Select Client</option>
                                                  <option v-for="client in clients" :value="client.id">{{client.name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <label>Amount Applied</label>
                                                <input type="number" name="amount_applied" value="0" v-model="form.amount_applied" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label>Duration (Months)</label>
                                                <input type="number" class="form-control" v-model="form.duration">
                                            </div>
                                            <div class="col-4">
                                              <label>Purpose</label>
                                              <textarea name="name" rows="8" cols="80" class="form-control w-100 bg-light" v-model="form.purpose"></textarea>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">Next</button>
                                    </form>
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
    data() {
        return {
            products:[],
            clients:[],
            form: {
              product:null,
              purpose:null,
              duration:null,
              amount_applied:null,
              customer_id:null
            }
        };
    },
    mounted(){
      this.getClients()
      this.getProducts()
    },
    methods: {
        createLoan:function() {
            axios.post('/api/loan',this.form)
            .then((res)=>{
                if(res.status==201){
                    this.$toast.success('Loan Created Successfully',{
                        position:'top-right'
                    });
                }
            })
        },
        getClients(){
          axios.get('/api/customer').then((res)=>{
            this.clients=res.data;
          })
        },
        getProducts(){
          axios.get('/api/product').then((res)=>{
            this.products=res.data
          })
        }
    }
}
</script>
