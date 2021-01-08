<template>
    <div class="row">
        <div class="row w-100">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <router-link :to="{ name: 'CreateClient'}" class="btn btn-primary">Create Client</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Clients</h5>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive table-sm">
                        <table class="table table-sm">
                            <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Identification Document</th>
                            <th>Identification Number</th>
                            <th>Primary Contact</th>
                            <th>Alternative Contact</th>
                            <th>Address</th>
                            <th>Longitude</th>
                            <th>latitude</th>
                            <th>Date of Birth</th>
                            <th>Nationality</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            <tr v-for="row in rows">
                                <td>{{ row.id }}</td>
                                <td>{{ row.name }}</td>
                                <td>{{ row.email }}</td>
                                <td>{{ row.gender }}</td>
                                <td>{{ row.identification_document }}</td>
                                <td>{{ row.identification_number }}</td>
                                <td>{{ row.primary_contact }}</td>
                                <td>{{ row.alternative_contact }}</td>
                                <td>{{ row.address }}</td>
                                <td>{{ row.longitude }}</td>
                                <td>{{ row.latitude }}</td>
                                <td>{{ row.date_of_birth }}</td>
                                <td>{{ row.nationality }}</td>
                                <td>{{ row.status }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" v-on:click="deleteClient(row.id)">X</button>
                                    <router-link :to="{name:'EditClient',params:{id:row.id} }" class="btn btn-primary">
                                        Edit
                                    </router-link>
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
    data() {
        return {
            rows:[]
        }
    },
    mounted() {
        this.getClients()
    },
    methods: {
        getClients() {
            axios.get('api/customer').then((res) => {
                this.rows = res.data;
            })
        },
        deleteClient(id) {
            axios.delete('api/customer/' + id).then((res) => {
            })
        }
    }
}
</script>
