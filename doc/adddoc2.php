<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<button id="delete">Delete</button>
<script type="text/javascript">
  document.getElementById('delete').addEventListener('click',function(){
  swal.fire({
    title: 'คุณต้องการลบ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ใช่,ต้องการลบ!'
  }).then((result) => {
    if (result.isConfirmed) {
      swal.fire(
        'ลบเรียบร้อย!'
      )
    }
  })
});
</script>

</body>
</html>