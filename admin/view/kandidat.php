<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="form-group">
                <button id="btn_add" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i>
                    <span id="btn_submit"></span>
                </button>
            </div>

            <table id="lookup"
                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
                        <th class="nosort" width="40px">Action</th>
                        <th>Nama Calon Ketua</th><th>Nama Calon Wakil Ketua</th><th>Photo</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-header">
                
                <h4 class="modal-title"></h4>
            </div>
            <form id="form_kandidat" name="form_kandidat" novalidate="novalidate" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" value="add" name="action" id="action">
                    <input type="hidden" value="0" name="edit_id" id="edit_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ketua" class="control-label">Ketua:</label>
                                <input type="text" class="form-control input-sm" id="ketua" name="ketua" placeholder="Calon Ketua" />
                            </div>
                            <div class="col-sm-6">
                                <label for="wakil" class="control-label">Wakil ketua:</label>
                                <input type="text" class="form-control input-sm" id="wakil" name="wakil" placeholder="Calon Wakil Ketua" />
                            </div>
                        </div>                            
                    </div>                        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">                                
                                <label for="role" class="control-label">Photo:</label>
                                <input type="file" id="xUpload" name="xUpload">                                
                            </div>
                        </div>                        
                    </div>
                    <img id="xView" alt="your image" width="70%" />
                </div>
                <div class="modal-footer">
                    <div class="">
                        <button type="button" id="btn_cancel" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn_add" class="btn btn-sm btn-primary">Save</button>
                    </div>                        
                </div>
            </form>
        </div>
    </div>
</div>
