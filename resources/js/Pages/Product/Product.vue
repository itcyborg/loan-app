<template>
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <router-link to="/product/create" class="btn btn-primary">
                            Add Product
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Products</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Rate</th>
                        <th>Min Amount</th>
                        <th>Max Amount</th>
                        <th>Min Duration</th>
                        <th>Max Duration</th>
                        <th>Security</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        <tr v-for="row in rows">
                            <td>{{row.id}}</td>
                            <td>{{row.name}}</td>
                            <td>{{row.code}}</td>
                            <td>{{row.rate}}</td>
                            <td>{{row.min_amount}}</td>
                            <td>{{row.max_amount}}</td>
                            <td>{{row.min_duration}}</td>
                            <td>{{row.max_duration}}</td>
                            <td>{{row.security}}</td>
                            <td>{{row.status}}</td>
                            <td>{{row.created_at}}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" v-on:click="deleteProduct(row.id)">X</button>
                                <router-link :to="{name:'EditProduct',params:{id:row.id} }" class="btn btn-primary">Edit</router-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getProducts()
    },
    data(){
        return {
            rows:[]
        }
    },
    methods:{
        deleteProduct(id){
            axios.delete('api/product/'.id).then((res)=>{
                // this.rows=res.data;
            });
        },
        getProducts(){
            axios.get('api/product').then((res)=>{
                this.rows=res.data;
            });
        }
    }
}
</script>

<style scoped>

</style>
