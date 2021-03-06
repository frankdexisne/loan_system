this.dTableParams = {
    module: '',
    el: '',
    ajax: {
        url: '',
        type: '',
        data: null
    },
    bFilter: true,
    columnDefs: [],
    columns: [],
    style: null,

};



function initDTable1(){

    if($.fn.DataTable.isDataTable( dTableParams.el )){
        $(dTableParams.el).DataTable().destroy();
    }
    var datatable = $(dTableParams.el).DataTable({
        ajax : dTableParams.ajax,
        bFilter: dTableParams.bFilter,
        columnDefs: dTableParams.columnDefs,
        columns: dTableParams.columns,
        select: dTableParams.style
    })
    .off('click','.edit')
    .on('click','.edit',function(){
        $tr = $(this).closest('tr');
        var data = datatable.row($tr).data();
        for (const [key, value] of Object.entries(data)) {
            if (whatIsIt(value) === "String") {
                $('#form #'+key).val(value);
            }

            if (whatIsIt(value) === "Object") {
                console.log(value);
            }

        }
        $('#modal-form').modal('show');
    })
    .off('click','a.delete')
    .on('click','a.delete',function(e){
        e.preventDefault();
        $tr=$(this).closest('tr');
        var data = datatable.row($tr).data();
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this data",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            })
        .then((result) => {
            if (result.isConfirmed) {
                var form_data = { _token : $('meta[name="csrf-token"]').attr('content'), _method: "_delete" , id: data['id']};

                $.ajax({
                    url: origin+"/"+dTableParams.module+"/"+data['id'],
                    type: "DELETE",
                    data: form_data,
                    success: function(){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(() => {
                            datatable.row($tr).remove().draw(false);
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

    return datatable;
}



