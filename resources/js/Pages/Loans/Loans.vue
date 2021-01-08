<template>
    <div class="row">
        <div class="row w-100">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <router-link :to="{ name: 'CreateLoan'}" class="btn btn-primary">Create Loan Application</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Loan Applications</h5>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive table-sm">
                        <table class="table table-sm">
                            <thead>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Product Name</th>
                            <th>Amount Applied</th>
                            <th>Amount Approved</th>
                            <th>Rate</th>
                            <th>Duration</th>
                            <th>Total Interest</th>
                            <th>Approval Date</th>
                            <th>Disbursement Date</th>
                            <th>Repayment Frequency</th>
                            <th>Total Amount Repaid</th>
                            <th>Loan Officer</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            <tr v-for="row in rows">
                                <td>{{ row.id }}</td>
                                <td>{{ row.client.name }}</td>
                                <td>{{ row.product.name }}</td>
                                <td>{{ row.amount_applied }}</td>
                                <td>{{ row.amount_approved }}</td>
                                <td>{{ row.rate }}</td>
                                <td>{{ row.duration }}</td>
                                <td>{{ row.total_interest }}</td>
                                <td>{{ row.approval_date }}</td>
                                <td>{{ row.disbursement_date }}</td>
                                <td>{{ row.repayment_frequency }}</td>
                                <td>{{ row.total_amount_repaid }}</td>
                                <td>
                                  <div v-if="row.officer">
                                    {{ row.officer.name }}
                                  </div>
                                </td>
                                <td>{{ row.status }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                  <div class="row">
                                      <button class="btn btn-sm btn-danger" v-on:click="deleteLoan(row.id)">X</button>
                                      <router-link :to="{name:'EditLoan',params:{id:row.id} }" class="btn btn-sm btn-primary">
                                          Edit
                                      </router-link>
                                  </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                      </div>
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
           rows:[]
         }
      },
      mounted() {
        this.getLoans();
      },
      methods:{
        getLoans(){
          axios.get('/api/loan').then((res)=>{
            // console.log(res)
            this.rows=res.data;
          });
        }
      }
    }
</script>
