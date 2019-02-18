function edit_object(id){
    $.ajax({
	type: "POST",
	data: "edit_id=" + id,
	url: "ajax.php",
	dataType: "json",
	success: function(data){
           $('#student_name').val(data[0][1]);
           $('#student_surname').val(data[0][2]);
           $('#student_age').val(data[0][3]);
           $('#student_university').val(data[0][4]);
           $('#update_id').val(data[0][0]);
           $('#exampleModal').modal('show');
           $('#submit_button').html('Update');
        }
    })
}