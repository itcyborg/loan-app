<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addUser">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Charge</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form @submit.prevent="createCharge">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Product</label>
                                                <select class="form-control" name="product" v-model="form.product_id" placeholder="Select Product">
                                                  <option value="">Select Product</option>
                                                  <option v-for="product in products" :value="product.id">{{product.name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-6">
                                            <label>Type</label>
                                            <select class="form-control" name="type" v-model="form.type">
                                              <option value="">Select Type</option>
                                              <option value="PERCENTAGE">Percentage</option>
                                              <option value="FIXED">Fixed</option>
                                            </select>
                                          </div>
                                          <div class="col-6">
                                            <label>Amount</label>
                                            <input type="text" name="amount" value="0" v-model="form.amount" class="form-control">
                                          </div>
                                        </div>
                                        <button class="btn btn-primary">Submit</button>
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
            form: {
                name: null,
                amount:0,
                type:null,
                product_id:null
            }
        };
    },
    mounted(){
      this.getProducts()
    },
    methods: {
        createCharge:function() {
            axios.post('/api/charge',this.form)
            .then((res)=>{
                if(res.status==201){
                    this.$toast.success('Charge Created Successfully',{
                        position:'top-right'
                    });
                    this.form.name='';
                    this.form.amount=0,
                    this.form.type=null,
                    this.form.product_id=null
                }
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
