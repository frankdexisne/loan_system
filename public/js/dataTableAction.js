datatable.on('click','.edit',function(){
    $tr = $(this).closest('tr');
    var data = datatable.row($tr).data();
    for (const [key, value] of Object.entries(data)) {
        $('#form #'+key).val(value);
    }
    $('#modal-form').modal('show');
})

dataTable.on('click','a.delete',function(e){
    e.preventDefault();
    $tr=$(this).closest('tr');
    var data = dataTable.row($tr).data();
    Swal.fire({
        title: 'Are you sure?',
        text: "Delete this data",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var form_data = { _token : $('meta[name="csrf_token"]').attr('content'), _method: "_delete" , id: data['id']};

            $.ajax({
                url: "{{url('/'.$module)}}/"+data['id'],
                type: "DELETE",
                data: form_data,
                success: function(result){
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then((result)=>{
                        dataTable.row($tr).remove().draw(false);
                        $tr.removeClass('selected');
                    })
                },
                error: function(xhr){
                    if(xhr.status==422){
                        Swal.fire(
                            'Ooops!',
                            xhr.responseJSON.message,
                            'error'
                        )
                    }
                }
            });
        }
    })


});
