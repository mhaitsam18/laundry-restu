<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0"><?= $title ?></h4>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif ?>

                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0"><?= $title ?></h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#setRoleModal"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Role"></div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive" style="width: 100%;">
                        <table class="table table-hover" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelimpahan</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($abundance as $ct) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $ct['abundance'] ?></td>
                                        <td><?= substr($ct['description'], 0, 100) . "...." ?></td>
                                        <td>

                                            <a class="badge bg-success updateBenua" data-bs-toggle="modal" data-bs-target="#editCont" data-id="<?= $ct['id'] ?>" data-abundance="<?= $ct['abundance'] ?>" data-description="<?= $ct['description'] ?>">Ubah</a>

                                            <a href="<?= base_url("DataMaster/abundance/delete/$ct[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="role">Hapus</a>
                                        </td>
                                    </tr>

                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
</div>

<!-- Modal Add-->
<div class="modal fade" id="setRoleModal" tabindex="-1" aria-labelledby="setRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="setRoleModalLabel">Tambah Data Jenis Ikan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/abundance') ?>" method="post">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="abundance">Abundance</label>
                        <input type="text" class="form-control" id="abundance" name="abundance" placeholder="Abundance">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Abundance Description"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editCont" tabindex="-1" aria-labelledby="editContLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editContLabel">Edit Data Jenis Ikan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/abundance') ?>" method="post">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group mb-3">
                        <label for="abundance">Abundance</label>
                        <input type="text" class="form-control" id="abundance" name="abundance" placeholder="Abundance">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Abundance Description"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<script>
    $(document).on("click", ".updateBenua", function() {
        var id = $(this).data('id');
        $(".modal-body  #id").val(id);

        var abundance = $(this).data('abundance');
        $(".modal-body  #abundance").val(abundance);

        var description = $(this).data('description');
        $(".modal-body  #description").val(description);
        // As pointed out in comments, 
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>