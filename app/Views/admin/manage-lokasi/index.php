<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

    <?php if (session()->getFlashdata('error-msg')) : ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error-msg'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="row">
            <div class="col-12">
                <div class "alert alert-success" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">

            <div class="card shadow">
                <div class="card-header">
                    <a href="/lokasi/tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Lokasi Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-main" id="tbl-lokasi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Ketua RT</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data) : ?>
                                    <?php foreach ($data as $num => $row) : ?>
                                        <tr>
                                            <td><?= $num + 1; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nama_ketua_rt']; ?></td>
                                            <td>
                                                <a href="/lokasi/ubah/<?= $row['id']; ?>" class="btn btn-success">
                                                    <i class="fa fa-pencil-alt fa-lg"></i>
                                                </a>
                                                <a href="/lokasi/soft_delete/<?= $row['id']; ?>" class="btn btn-danger">
                                                    <i class="fa fa-trash-alt fa-lg"></i>
                                                </a>
                                                <!-- <button type="button" class="btn btn-danger hapus-lokasi" data-toggle="modal" data-target="#deleteConfirmationModal" data-id="<?= $row['id']; ?>">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4">
                                            <h3 class="text-gray-900 text-center">Data belum ada.</h3>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- Modal Konfirmasi Penghapusan -->
<!-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
                <input type="hidden" id="lokasi_id" value="DELETE">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="confirm-delete-button" href="/pengaduan/soft_delete/<?= $row['id']; ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div> -->
<?= $this->endSection(); ?>


<?= $this->section('additional-js'); ?>
<script>
$(document).ready(function() {
    // Menangani klik pada tombol "Hapus"
    $('.hapus-lokasi').on('click', function() {
        var id = $(this).data('id');
        $('#confirm-delete-button').attr('href', '/lokasi/delete/' + id);
        $('#deleteConfirmationModal').modal('show')
    })
})
</script>
<?= $this->endSection(); ?>


<?= $this->section('additional-js'); ?>
<script>
    $(document).ready(function() {
        $("#tbl-lokasi").DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "columnDefs": [{
                "targets": 3,
                "orderable": false
            }],
            "responsive": true,
            "searchDelay": 350,
            "scrollY": 300,
            // "scrollCollapse": true,
            "language": {
                "infoEmpty": "0 entri",
                "info": "Menampilkan _END_ data pengaduan.",
                "infoFiltered": "(difilter dari _MAX_ total entri)",
                "emptyTable": "Belum ada data",
                "lengthMenu": "Menampilkan _MENU_ entri",
                "search": "Pencarian:",
                "zeroRecords": "Data tidak ditemukan",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            }
        })
    })
   

   

        // $('#formHapus').submit(function(e) {
        //     e.preventDefault()

        //     var userid = $("#pengaduan_id").val()

        //     $.ajax({
        //         url: $(this).attr('action'),
        //         method: $(this).attr('method'),
        //         dataType: 'json',
        //         data: {
        //             id: userid
        //         },
        //         beforeSend: function() {
        //             $('.btn-yakin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
        //         },
        //         success: function(res) {
        //             $.toast({
        //                 text: res.msg,
        //                 position: "top-right",
        //                 hideAfter: 2500,
        //             })
        //             $("#confirmDelete").modal('toggle')
        //             setTimeout(function() {
        //                 location.reload()
        //             }, 3000)
        //         }
        //     })
        // })
</script>
<?= $this->endSection(); ?>