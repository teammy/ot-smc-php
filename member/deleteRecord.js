$(document).ready(function () {

	$(document).on('click', '.delete_product', function(){
		var id = $(this).data('id');
		swal.fire({
			title: 'ยืนยันการลบ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'ยกเลิก',
			confirmButtonText: 'ตกลง',
		}).then((result) => {

			if (result.value){
				$.ajax({
					url: 'deleteDoc.php?action=delete',
					method: 'POST',
					data: 'booking_id='+id,
					dataType: 'json'
				})
				.done(function(response){
					swal.fire({
						icon: response.status,
						title: 'ลบเรียบร้อย!',
						text: response.message,
						timer: 1000,
						showConfirmButton: false
					}).then(() => {
						location.reload();
					});
					
				})
				.fail(function(){
					swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
				});
			}

		})

	});
});





