<?= $this->extend('partials/main') ?>

<?= $this->section('content') ?>
    <?= $this->include('parts/modals')?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Tiket Bus Rosalia Online - DataTable</h3>
                    <div class="float-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-block btn-primary" id="create-tiket" data-toggle="modal" data-target="#modal-create-tiket"><i class="fa fa-plus"></i> Create Tiket</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="data-table-tiket" class="table table-striped dataTable">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>No HP</th>
                                                <th>Tanggal Keberangkatan</th>
                                                <th>Kelas Armada</th>
                                                <th>Kota Tujuan</th>
                                                <th>Tiket</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
<!-- /.row -->
<?= $this->endSection() ?>


<?= $this->section('extra-js') ?>
<script>
$(document).ready(function () {

    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf_token_name"]').attr('content')
	    }
	});

    var dataTableTiket = $('#data-table-tiket').DataTable({
        autoWidth: false,
        serverSide : true,
        processing: true,
        order: [[1, 'asc']],
        columnDefs: [{
            orderable: false,
            targets: [0,5]
        }],

        ajax : {
            url: "<?= route_to('datatable') ?>",
            method : 'POST'
        },

        columns: [
            {
                "data": null
            },
            {
                "data": "nama"
            },
            {
                "data": "nohp"
            },
            {
                "data": "tglberangkat"
            },
            {
                "data": "kelasarmada"
            },
            {
                "data": "kotatujuan"
            },
            {
                "data": "tiket"
            },
            {
                "data": function(data) {
                    switch(data.status) {
                        case 'Publish':
                        return `<span class="right badge badge-success">${data.status}</span>`
                        break;
                        case 'Pending':
                        return `<span class="right badge badge-info">${data.status}</span>`
                        break;
                        case 'Draft':
                        return `<span class="right badge badge-warning">${data.status}</span>`
                        break;
                    }
                }
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-primary btn-edit" data-id="${data.id}"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    dataTableTiket.on('draw.dt', function() {
        var PageInfo = $('#data-table-tiket').DataTable().page.info();
        dataTableTiket.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    $(document).on('click', '#btn-save-tiket', function () {
        $('.text-danger').remove();
        $('.is-invalid').removeClass('is-invalid');
        var createForm = $('#form-create-tiket');
        
        $.ajax({
            url: '<?= route_to('resource') ?>',
            method: 'POST',
            data: createForm.serialize()
        }).done((data, textStatus) => {
            Toast.fire({
                icon: 'success',
                title: textStatus
            })
            dataTableTiket.ajax.reload();
            $("#form-create-tiket").trigger("reset");
            $("#modal-create-tiket").modal('hide');

        }).fail((xhr, status, error) => {
            if (xhr.responseJSON.message) {
                Toast.fire({
                    icon: 'error',
                    title: xhr.responseJSON.message,
                });
            }

            $.each(xhr.responseJSON.messages, (elem, messages) => {
                createForm.find('select[name="' + elem + '"]').after('<p class="text-danger">' + messages + '</p>');
                createForm.find('input[name="' + elem + '"]').addClass('is-invalid').after('<p class="text-danger">' + messages + '</p>');
                createForm.find('textarea[name="' + elem + '"]').addClass('is-invalid').after('<p class="text-danger">' + messages + '</p>');
            });
        })
    })

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();
        $.ajax({
            url: `<?= route_to('tiket/resource') ?>/${$(this).attr('data-id')}/edit`,
            method: 'GET',
            
        }).done((response) => {
            var editForm = $('#form-edit-tiket');
            editForm.find('input[name="nama"]').val(response.data.nama);
            editForm.find('input[name="nohp"]').val(response.data.nohp);
            editForm.find('textarea[name="tglberangkat"]').val(response.data.tglberangkat);
            editForm.find('textarea[name="kelasarmada"]').val(response.data.kelasarmada);
            editForm.find('textarea[name="kotatujuan"]').val(response.data.kotatujuan);
            editForm.find('textarea[name="tiket"]').val(response.data.tiket);
            editForm.find('select[name="status_id"]').val(response.data.status_id);
            $("#tiket_id").val(response.data.id);
            $("#modal-edit-tiket").modal('show');
        }).fail((error) => {
            Toast.fire({
                icon: 'error',
                title: error.responseJSON.messages.error,
            });
        })
    });

    $(document).on('click', '#btn-update-tiket', function (e) {
        e.preventDefault();
        $('.text-danger').remove();
        var editForm = $('#form-edit-tiket');

        $.ajax({
            url: `<?= route_to('tiket/resource') ?>/${$('#tiket_id').val()}`,
            method: 'PUT',
            data: editForm.serialize()
            
        }).done((data, textStatus) => {
            Toast.fire({
                icon: 'success',
                title: textStatus
            })
            dataTableTiket.ajax.reload();
            $("#form-edit-tiket").trigger("reset");
            $("#modal-edit-tiket").modal('hide');

        }).fail((xhr, status, error) => {
            $.each(xhr.responseJSON.messages, (elem, messages) => {
                editForm.find('select[name="' + elem + '"]').after('<p class="text-danger">' + messages + '</p>');
                editForm.find('input[name="' + elem + '"]').addClass('is-invalid').after('<p class="text-danger">' + messages + '</p>');
                editForm.find('textarea[name="' + elem + '"]').addClass('is-invalid').after('<p class="text-danger">' + messages + '</p>');
            });
        })
    });

    $(document).on('click', '.btn-delete', function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: `<?= route_to('tiket/resource') ?>/${$(this).attr('data-id')}`,
                    method: 'DELETE',
                }).done((data, textStatus) => {
                    Toast.fire({
                        icon: 'success',
                        title: textStatus,
                    });
                    dataTableTiket.ajax.reload();
                }).fail((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: error.responseJSON.messages.error,
                    });
                })
            }
        })
    });

    $('#modal-create-tiket').on('hidden.bs.modal', function() {
        $(this).find('#form-create-tiket')[0].reset();
        $('.text-danger').remove();
        $('.is-invalid').removeClass('is-invalid');
    });

    $('#modal-edit-tiket').on('hidden.bs.modal', function() {
        $(this).find('#form-edit-permission')[0].reset();
        $('.text-danger').remove();
        $('.is-invalid').removeClass('is-invalid');
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
});
</script>
<?= $this->endSection() ?>