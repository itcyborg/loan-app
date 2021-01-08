<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addProduct">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Add Client</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form @submit.prevent="createClient">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <label>Email</label>
                                                <input type="email" v-model="form.email" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender" v-model="form.gender" required>
                                                  <option value="">Select Gender</option>
                                                  <option value="MALE">Male</option>
                                                  <option value="FEMALE">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Identification Document</label>
                                                <select class="form-control" name="identification_document" v-model="form.identification_document">
                                                  <option value="">Select Document Type</option>
                                                  <option value="NATIONAL_ID">NATIONAL ID</option>
                                                  <option value="PASSPORT">PASSPORT</option>
                                                  <option value="MILITARY_ID">MILITARY ID</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label>Identification Number</label>
                                                <input type="text" class="form-control" v-model="form.identification_number">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Nationality</label>
                                                <select class="form-control" name="product" v-model="form.nationality" placeholder="Select Country">
                                                  <option value="">Select Country</option>
                                                  <option v-for="country in countries" :value="country.name">{{country.name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" v-model="form.date_of_birth">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Primary Contact</label>
                                                <input type="text" class="form-control" v-model="form.primary_contact">
                                            </div>
                                            <div class="col-6">
                                                <label>Alternatie Contact</label>
                                                <input type="text" class="form-control" v-model="form.alternative_contact">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Address</label>
                                                <input type="text" class="form-control" v-model="form.address">
                                            </div>
                                            <div class="col-3">
                                                <label>Longitude</label>
                                                <input type="text" class="form-control" v-model="form.longitude">
                                            </div>
                                            <div class="col-3">
                                                <label>Latitude</label>
                                                <input type="text" class="form-control" v-model="form.latitude">
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
          countries:[],
            form: {
                name: null,
                email:null,
                gender:null,
                identification_document:null,
                identification_number:null,
                primary_contact:null,
                alternative_contact:null,
                address:null,
                longitude:null,
                latitude:null,
                date_of_birth:null,
                nationality:null
            }
        };
    },
    mounted(){
      this.getCountries()
    },
    methods: {
        createClient:function() {
            axios.post('/api/customer',this.form)
            .then((res)=>{
                if(res.status==201){
                    this.$toast.success('Client Created Successfully',{
                        position:'top-right'
                    });
                    this.form.name='';
                    this.form.email='';
                }
            })
        },
        getCountries(){
          axios.get('/api/countries').then((res)=>{
            this.countries=res.data;
          })
        }
    }
}
</script>
