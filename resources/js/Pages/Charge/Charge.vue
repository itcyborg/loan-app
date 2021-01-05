<template>
    <div class="row">
        <div class="row w-100">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <router-link :to="{ name: 'CreateCharge'}" class="btn btn-primary">Create Charge</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="row w-100">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h5 class="title">Charges</h5>
                  </div>
                  <div class="card-body">
                      <table class="table">
                          <thead>
                              <th>#</th>
                              <th>Name</th>
                              <th>Product</th>
                              <th>Type</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Created</th>
                              <th>Action</th>
                          </thead>
                          <tbody>
                              <tr v-for="row in rows">
                                  <td>{{row.id}}</td>
                                  <td>{{row.name}}</td>
                                  <td>{{row.product.name}}</td>
                                  <td>{{row.type}}</td>
                                  <td>{{row.amount}}</td>
                                  <td>{{row.status}}</td>
                                  <td>{{row.created_at}}</td>
                                  <td>
                                      <button class="btn btn-sm btn-danger" v-on:click="deleteCharge(row.id)">X</button>
                                      <router-link :to="{name:'EditCharge',params:{id:row.id} }" class="btn btn-primary">Edit</router-link>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                rows: []
            }
        },
        mounted() {
            this.getCharges()
        },
        methods:{
            deleteCharge(){},
            getCharges(){
                axios.get('api/charge').then((res)=>{
                    this.rows=res.data;
                })
            }
        }
    }
</script>
