$('#delete_me').on('click', function(e){
    Swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            //Do Your Delete code here
            Swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
});
