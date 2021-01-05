<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="addUser">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="title">Edit User</div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <form @submit.prevent="editUser">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                            </div>
                                            <div class="col-6">
                                                <label>Email</label>
                                                <input type="email" v-model="form.email" class="form-control">
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
import axios from 'axios';
import { required } from 'vuelidate/lib/validators';
export default {
    mounted(){
        this.getUser(this.$route.params.id);
    },
    data() {
        return {
            form: {
                name: null,
                email: null
            }
        };
    },
    validations:{
        name:{
            required
        },
        email:{

        }
    },
    methods: {
        editUser:function() {
            axios.patch('/api/user/'+this.$route.params.id,this.form)
            .then((res)=>{
                if(res.status==201){
                    this.$toast.success('User Updated Successfully',{
                        position:'top-right'
                    });
                    this.form.name='';
                    this.form.email='';
                }
            })
        },
        getUser:function(id){
            console.log(id);
            axios.get('/api/user/'+id).then((res)=>{
                console.log(res.data);
                this.form.name=res.data.name;
                this.form.email=res.data.email;
            });
        }
    }
}
</script>
