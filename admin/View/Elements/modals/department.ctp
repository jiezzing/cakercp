<div class="modal" id="add_department_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content animated">
      <div class="modal-header">
        <h3 class="modal-title">Department</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
				<label>Code</label>
				<input class="form-control" type="text" id="add-code" maxlength="3" style="text-transform:uppercase">
          </div>
          <div class="col-sm-12 mt-4">
				<label>Name</label>
				<input class="form-control" type="text" id="add-name" style="text-transform:uppercase">
          </div>
        </div>
      </div>
      <div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal"><span class="nav-label">Close</span></a>
				<a href="<?php echo $this->params->webroot . 'save_department' ?>" id="add-department-btn" class="btn btn-primary" value="2"><span class="nav-label"> Add Department</span></a>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="edit_department_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content animated">
      <div class="modal-header">
        <h3 class="modal-title">Department</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
				<label>Code</label>
				<input class="form-control" type="text" id="edit-code" maxlength="3">
          </div>
          <div class="col-sm-12 mt-4">
				<label>Name</label>
				<input class="form-control" type="text" id="edit-name">
          </div>
        </div>
      </div>
      <div class="modal-footer">
				<a href="#" class="btn btn-danger" data-dismiss="modal"><span class="nav-label">Close</span></a>
				<a href="<?php echo $this->params->webroot . 'update_department' ?>" id="edit-department-btn" class="btn btn-primary" value="2"><span class="nav-label"> Save Changes</span></a>
      </div>
    </div>
  </div>
</div>
