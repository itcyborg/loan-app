<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addProduct">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Product</div>
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
        createProduct:function() {
            axios.post('/api/product',this.form)
            .then((res)=>{
                if(res.status==201){
                    this.$toast.success('User Created Successfully',{
                        position:'top-right'
                    });
                    this.form.name='';
                    this.form.email='';
                }
            })
        }
    }
}
</script>
