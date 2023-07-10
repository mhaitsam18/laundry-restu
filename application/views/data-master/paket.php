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

                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0"><?= $title ?></h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a href="#" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addModal"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Role"></div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama paket</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Lama</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pakets as $paket) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $paket['paket'] ?></td>
                                        <td><?= $paket['harga'] ?></td>
                                        <td><?= $paket['deskripsi'] ?></td>
                                        <td><?= $paket['lama'] ?></td>
                                        <td>

                                            <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $paket['id'] ?>" data-paket="<?= $paket['paket'] ?>" data-harga="<?= $paket['harga'] ?>" data-deskripsi="<?= $paket['deskripsi'] ?>" data-lama="<?= $paket['lama'] ?>">Ubah</a>

                                            <a href="<?= base_url("DataMaster/paket/delete/$paket[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="paket">Hapus</a>
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data paket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/paket') ?>" method="post">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="paket">Nama paket</label>
                        <input type="text" class="form-control" id="paket" name="paket" placeholder="paket">
                        <?= form_error('paket', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" step="any" class="form-control" id="harga" name="harga" placeholder="harga">
                        <?= form_error('harga', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi"></textarea>
                        <?= form_error('deskripsi', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="lama">Lama</label>
                        <input type="text" class="form-control" id="lama" name="lama" placeholder="1 bulan">
                        <?= form_error('lama', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Paket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/paket') ?>" method="post">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="paket">Nama paket</label>
                        <input type="text" class="form-control" id="paket" name="paket" placeholder="paket">
                        <?= form_error('paket', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" step="any" class="form-control" id="harga" name="harga" placeholder="harga">
                        <?= form_error('harga', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi"></textarea>
                        <?= form_error('deskripsi', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="lama">Lama</label>
                        <input type="text" class="form-control" id="lama" name="lama" placeholder="1 bulan">
                        <?= form_error('lama', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    $(document).on("click", ".btn-update", function() {
        var id = $(this).data('id');
        $(".modal-body  #id").val(id);

        var paket = $(this).data('paket');
        $(".modal-body  #paket").val(paket);

        var harga = $(this).data('harga');
        $(".modal-body  #harga").val(harga);

        var lama = $(this).data('lama');
        $(".modal-body  #lama").val(lama);

        var deskripsi = $(this).data('deskripsi');
        $(".modal-body  #deskripsi").val(deskripsi);
    });
</script>