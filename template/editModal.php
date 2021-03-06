<script>
    $(document).ready(function () {
        $("#editModal").on('show.bs.modal', function (event) {
            var modal = $(this);
            modal.find('.modal-title').text("Editing Project Details");
        });
    });
	 $(function () {
        $('#edit_project').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: './phpFunctions/processEdit.php',
                data: $('#edit_project').serialize(),
                success: function () {
                    alert('Project Details Updated');
			        location.reload();
			    }
            });
        });
    });
</script>
<div id="editModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-left"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="edit_project" method="POST">
				<input name="edit_projectid" type="hidden" id="edit_projectid" value="" required />
				<div class="form-group row">
					<label for="edit_title" class="col-lg-4 col-form-label">Project Title:</label>
                    <div class="col-lg-8">
                        <input name="edit_title" id="edit_title" class="form-control" placeholder="Title" required/>
                    </div>
				</div>
				<div class="form-group row">
					<label for="edit_start_date" class="col-lg-4 col-form-label">Start Date:</label>
                    <div class="col-lg-8">
                        <input name="edit_start_date" id="edit_start_date" class="form-control" placeholder="start_date" disabled required/>
                    </div>
				</div>
                <div class="form-group row">
					<label for="edit_description" class="col-lg-4 col-form-label">Project Description:</label>
                    <div class="col-lg-8">
                        <textarea name="edit_description" id="edit_description" class="form-control" placeholder="Description" rows="5" required></textarea>
                    </div>            
                </div>
                <div class="form-group row">
					<label for="edit_amount_sought" class="col-lg-4 col-form-label">Amount of funding sought:</label>
                    <div class="col-lg-8">
                        <input name="edit_amount_sought" id="edit_amount_sought" class="form-control" placeholder="Amount" type="number" min="1" max = "2147483647" required/>
                    </div>
                </div>
                <div class="form-group row">
					<label for="edit_duration" class="col-lg-4 col-form-label">Project Duration (number of days):</label>
                    <div class="col-lg-8">
                        <input name="edit_duration" id="edit_duration" class="form-control" placeholder="Duration" type="number" min="1" max = "2147483647" required/>
                    </div>
                </div>
                <div class="form-group row">
					<label for="edit_keywords" class="col-lg-4 col-form-label">Keywords</label>
                    <div class="col-lg-8">
                        <input name="edit_keywords" id="edit_keywords" class="form-control" placeholder="Keywords"/>
                    </div>
                </div>
				<div class="form-group text-center">
					<button class="btn btn-primary" type="submit" id="editSubmit">Submit</button>
				</div>
				</form>
            </div>   
        </div>  
    </div>
</div>
