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
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Berhasil"></div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Laundry</th>
                                    <th scope="col">Tipe Laundry</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Lama</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($jenis_laundrys as $jenis_laundry) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $jenis_laundry['jenis_laundry'] ?></td>
                                        <td><?= $jenis_laundry['tipe_laundry'] ?></td>
                                        <td><?= $jenis_laundry['harga'] ?></td>
                                        <td><?= $jenis_laundry['deskripsi'] ?></td>
                                        <td><?= $jenis_laundry['lama'] ?></td>
                                        <td>

                                            <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $jenis_laundry['id'] ?>" data-jenis_laundry="<?= $jenis_laundry['jenis_laundry'] ?>" data-tipe_laundry="<?= $jenis_laundry['tipe_laundry'] ?>" data-harga="<?= $jenis_laundry['harga'] ?>" data-deskripsi="<?= $jenis_laundry['deskripsi'] ?>" data-lama="<?= $jenis_laundry['lama'] ?>">Ubah</a>

                                            <a href="<?= base_url("DataMaster/jenisLaundry/delete/$jenis_laundry[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="jenis laundry">Hapus</a>
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
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data Jenis Laundry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/JenisLaundry') ?>" method="post">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jenis_laundry">Jenis Laundry</label>
                        <input type="text" class="form-control" id="jenis_laundry" name="jenis_laundry" placeholder="contoh: next day, laundry karpet, laundry selimut">
                        <?= form_error('jenis_laundry', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="tipe_laundry">Tipe Laundry</label>
                        <select class="form-select" id="tipe_laundry" name="tipe_laundry">
                            <option value="" selected disabled>Pilih Tipe</option>
                            <option value="laundry berat">laundry berat</option>
                            <option value="laundry tetap">laundry tetap</option>
                        </select>
                        <?= form_error('tipe_laundry', '<div class="invalid-feedback">', '</div>') ?>
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
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Jenis Laundry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/jenisLaundry') ?>" method="post">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="jenis_laundry">Jenis Laundry</label>
                        <input type="text" class="form-control" id="jenis_laundry" name="jenis_laundry" placeholder="contoh: next day, laundry karpet, laundry selimut">
                        <?= form_error('jenis_laundry', '<div class="invalid-feedback">', '</div>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="tipe_laundry">Tipe Laundry</label>
                        <select class="form-select" id="tipe_laundry" name="tipe_laundry">
                            <option value="" selected disabled>Pilih Tipe</option>
                            <option value="laundry berat">laundry berat</option>
                            <option value="laundry tetap">laundry tetap</option>
                        </select>
                        <?= form_error('tipe_laundry', '<div class="invalid-feedback">', '</div>') ?>
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

        var jenis_laundry = $(this).data('jenis_laundry');
        $(".modal-body  #jenis_laundry").val(jenis_laundry);

        var tipe_laundry = $(this).data('tipe_laundry');
        $(".modal-body  #tipe_laundry").val(tipe_laundry);

        var harga = $(this).data('harga');
        $(".modal-body  #harga").val(harga);

        var lama = $(this).data('lama');
        $(".modal-body  #lama").val(lama);

        var deskripsi = $(this).data('deskripsi');
        $(".modal-body  #deskripsi").val(deskripsi);
    });
</script>