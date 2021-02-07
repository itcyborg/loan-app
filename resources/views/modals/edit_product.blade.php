<div class="modal fade view_product" tabindex="-1" role="dialog" aria-labelledby="ViewProduct" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Product Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="col-4">
                                <label for="code">Code</label>
                                <input type="text" name="code" class="form-control" id="code">
                            </div>
                            <div class="col-4">
                                <label for="security">Security</label>
                                <input type="text" name="security" id="security" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3">
                                <label for="min_amount">Min Amount</label>
                                <input type="text" name="min_amount" class="form-control" id="min_amount">
                            </div>
                            <div class="col-3">
                                <label for="max_amount">Max Amount</label>
                                <input type="text" name="max_amount" class="form-control" id="max_amount">
                            </div>
                            <div class="col-3">
                                <label for="min_duration">Min Duration</label>
                                <input type="text" name="min_duration" id="min_duration" class="form-control">
                            </div>
                            <div class="col-3">
                                <label for="max_duration">Max Duration</label>
                                <input type="text" name="max_duration" id="max_duration" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-4">
                                <label for="rate">Rate</label>
                                <input type="text" name="rate" class="form-control" id="rate">
                            </div>
                            <div class="col-4">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" id="status">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer w-100">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                @can('activate_product')
                    <button type="button" class="btn btn-success" id="activate" onclick="activateProduct('{{url('products/activate')}}','activate')">Activate</button>
                @endcan
                @can('activate_product')
                    <button type="button" class="btn btn-danger" id="deactivate" onclick="activateProduct('{{url('products/activate')}}','deactivate')">Deactivate</button>
                @endcan
                @can('update_product')
                    <button class="btn btn-primary" id="edit" onclick="updateProduct('{{url('products')}}')">Save and Exit</button>
                @endcan
            </div>
        </div>
    </div>
</div>

