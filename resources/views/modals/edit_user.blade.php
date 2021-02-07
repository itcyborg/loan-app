<div class="modal fade view_user" tabindex="-1" role="dialog" aria-labelledby="ViewUser" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">User Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="col-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="col-4">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="" disabled selected hidden>Select a role</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer w-100">
                @can('reset_password')
                    <button class="btn btn-warning pull-right" onclick="resetPassword()"><i class="fa fa-refresh"></i> Password</button>
                @endcan
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                @can('create_user')
                    <button class="btn btn-outline-success" id="edit" onclick="updateUser('{{url('users')}}')">Save and Exit</button>
                @endcan
            </div>
        </div>
    </div>
</div>

