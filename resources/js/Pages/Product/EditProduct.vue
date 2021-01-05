<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addProduct">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Edit Product</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form @submit.prevent="createProduct">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                            </div>
                                            <div class="col-6">
                                                <label>Code</label>
                                                <input type="text" v-model="form.code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Annual Rate</label>
                                                <input type="text" class="form-control" v-model="form.rate">
                                            </div>
                                            <div class="col-6">
                                                <label>Security</label>
                                                <input type="number" class="form-control" v-model="form.security">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Minimum Amount</label>
                                                <input type="number" class="form-control" v-model="form.min_amount">
                                            </div>
                                            <div class="col-6">
                                                <label>Maximum Amount</label>
                                                <input type="number" class="form-control" v-model="form.max_amount">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Minimum Duration (months)</label>
                                                <input type="number" class="form-control" v-model="form.min_duration">
                                            </div>
                                            <div class="col-6">
                                                <label>Maximum Duration (months)</label>
                                                <input type="number" class="form-control" v-model="form.max_duration">
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
    mounted(){
        this.getProduct(this.$route.params.id);
    },
    data() {
        return {
            form: {
                name: null,
                code:null,
                min_amount:null,
                max_amount:null,
                min_duration:null,
                max_duration:null,
                security:null,
                rate:null,
            }
        };
    },
    methods: {
        editProduct:function() {
            axios.patch('/api/product/'+this.$route.params.id,this.form)
            .then((res)=>{
                if(res.status==201){
                    this.$toast.success('Product Updated Successfully',{
                        position:'top-right'
                    });
                    this.form.name='';
                    this.form.email='';
                }
            })
        },
        getProduct:function(id){
            axios.get('/api/product/'+id).then((res)=>{
                this.form.name=res.data.name;
                this.form.code=res.data.code;
                this.form.min_amount=res.data.min_amount;
                this.form.max_amount=res.data.max_amount;
                this.form.min_duration=res.data.min_duration;
                this.form.max_duration=res.data.max_duration;
                this.form.security=res.data.security;
                this.form.rate=res.data.rate;
            });
        }
    }
}
</script>
