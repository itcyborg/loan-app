<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <router-link to="/user/create" class="btn btn-primary">
                            Add User
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="card-title">Users</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                </thead>
                                <tbody>
                                    <tr v-for="row in rows">
                                        <td>{{row.id}}</td>
                                        <td>{{row.name}}</td>
                                        <td>{{row.email}}</td>
                                        <td>{{row.created_at}}</td>
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
import axios from 'axios';
    export default {
        data(){
          return {rows:[]}
        },
        mounted() {
            axios.get('/api/user').then((res)=>{
               this.rows=res.data;
            });
        }
    }
</script>
