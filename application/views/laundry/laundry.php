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
                                    <th scope="col">Tanggal Pemesanan</th>
                                    <th scope="col">Member</th>
                                    <th scope="col">Pengantaran</th>
                                    <th scope="col">Jenis Laundry</th>
                                    <th scope="col">Kurir</th>
                                    <th scope="col">Berat</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Testimoni</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($laundrys as $laundry) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= date('j F Y H:i:s', strtotime($laundry['created_at'])) ?></td>
                                        <td><?= $laundry['nama_member'] ?></td>
                                        <td><?= $laundry['pengantaran'] ?></td>
                                        <td><?= $laundry['jenis_laundry'] ?></td>
                                        <td><?= $laundry['nama_kurir'] ?></td>
                                        <td><?= $laundry['berat'] ?></td>
                                        <td><?= ($laundry['harga']) ? 'Rp.' . number_format($laundry['harga'], 2, ',', '.') : '-' ?></td>
                                        <td><?= $laundry['status'] ?></td>
                                        <td><?= $laundry['testimoni'] ?></td>
                                        <td>
                                            <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $laundry['id'] ?>" data-member_id="<?= $laundry['member_id'] ?>" data-pengantaran="<?= $laundry['pengantaran'] ?>" data-kurir_id="<?= $laundry['kurir_id'] ?>" data-jenis_laundry_id="<?= $laundry['jenis_laundry_id'] ?>" data-berat="<?= $laundry['berat'] ?>" data-harga="<?= $laundry['harga'] ?>" data-pembayaran="<?= $laundry['pembayaran'] ?>" data-status="<?= $laundry['status'] ?>" data-testimoni="<?= $laundry['testimoni'] ?>">Perbarui</a>

                                            <a href="<?= base_url("Laundry/laundry/delete/$laundry[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="laundry">Hapus</a>
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
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah laundry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/laundry') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Member</label>
                        <select class="select2-add form-select  <?= (form_error('member_id')) ? 'is-invalid' : '' ?>" id="member" name="member_id">
                            <option value="" selected disabled>Pilih Member</option>
                            <?php foreach ($members as $member) : ?>
                                <option value="<?= $member->id ?>" <?= (set_value('member_id') == $member->id) ? 'selected' : '' ?>><?= $member->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('member_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="pengantaran" class="form-label">Pengantaran</label>
                        <select class="form-select <?= (form_error('pengantaran')) ? 'is-invalid' : '' ?>" id="pengantaran" name="pengantaran">
                            <option value="" selected disabled>Pilih Pengantaran</option>
                            <option value="drop off">Drop Off (diantar member)</option>
                            <option value="pick up">Pick Up (dijemput kurir)</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('pengantaran', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="kurir" class="form-label">Kurir</label>
                        <select class="select2-add form-select  <?= (form_error('kurir_id')) ? 'is-invalid' : '' ?>" id="kurir" name="kurir_id">
                            <option value="" selected disabled>Pilih Kurir</option>
                            <?php foreach ($kurirs as $kurir) : ?>
                                <option value="<?= $kurir->id ?>" <?= (set_value('kurir_id') == $kurir->id) ? 'selected' : '' ?>><?= $kurir->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('kurir_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_laundry_id" class="form-label">Jenis Laundry</label>
                        <select class="form-select <?= (form_error('jenis_laundry_id')) ? 'is-invalid' : '' ?>" id="jenis_laundry_id" name="jenis_laundry_id">
                            <option value="" selected disabled>Pilih Jenis</option>
                            <?php foreach ($jenis_laundrys as $jenis_laundry) : ?>
                                <option value="<?= $jenis_laundry->id ?>" <?= (set_value('jenis_laundry_id') == $jenis_laundry->id) ? 'selected' : '' ?>><?= $jenis_laundry->jenis_laundry ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('jenis_laundry_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" step="any" class="form-control <?= (form_error('berat')) ? 'is-invalid' : '' ?>" id="berat" name="berat" placeholder="Berat" value="<?= set_value('berat') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('berat', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" step="any" class="form-control <?= (form_error('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" placeholder="harga" value="<?= set_value('harga') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('harga', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select <?= (form_error('status')) ? 'is-invalid' : '' ?>" id="status" name="status">
                            <option value="" selected disabled>Pilih status</option>
                            <option value="menunggu pengambilan">Menunggu Pengambilan</option>
                            <option value="proses">Sedang proses</option>
                            <option value="batal">dibatalkan</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Sudah diambil</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('status', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="<?= date('Y-m-d H:i:s') ?>" checked>
                        <label class="custom-control-label" for="active">Aktif?</label>
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
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data laundry</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/laundry') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="member_id" id="member_id">

                    <div class="mb-3">
                        <label for="member_id" class="form-label">Member</label>
                        <!-- <select class="select2-edit form-select  <?= (form_error('member_id')) ? 'is-invalid' : '' ?>" id="member_id" name="member_id">
                            <option value="" selected disabled>Pilih Member</option>
                            <?php foreach ($members as $member) : ?>
                                <option value="<?= $member->id ?>" <?= (set_value('member_id') == $member->id) ? 'selected' : '' ?>><?= $member->name ?></option>
                            <?php endforeach; ?>
                        </select> -->
                        <input type="text" class="form-control  <?= (form_error('member_id')) ? 'is-invalid' : '' ?>" value="<?= $member->name ?>" readonly>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('member_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="pengantaran" class="form-label">Pengantaran</label>
                        <select class="form-select <?= (form_error('pengantaran')) ? 'is-invalid' : '' ?>" id="pengantaran" name="pengantaran">
                            <option value="" selected disabled>Pilih Pengantaran</option>
                            <option value="drop off">Drop Off (diantar member)</option>
                            <option value="pick up">Pick Up (dijemput kurir)</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('pengantaran', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="kurir_id" class="form-label">Kurir</label>
                        <select class="select2-edit form-select  <?= (form_error('kurir_id')) ? 'is-invalid' : '' ?>" id="kurir_id" name="kurir_id">
                            <option value="" selected disabled>Pilih Kurir</option>
                            <?php foreach ($kurirs as $kurir) : ?>
                                <option value="<?= $kurir->id ?>" <?= (set_value('kurir_id') == $kurir->id) ? 'selected' : '' ?>><?= $kurir->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('kurir_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_laundry_id" class="form-label">Jenis Laundry</label>
                        <select class="form-select <?= (form_error('jenis_laundry_id')) ? 'is-invalid' : '' ?>" id="jenis_laundry_id" name="jenis_laundry_id">
                            <option value="" selected disabled>Pilih Jenis</option>
                            <?php foreach ($jenis_laundrys as $jenis_laundry) : ?>
                                <option value="<?= $jenis_laundry->id ?>" <?= (set_value('jenis_laundry_id') == $jenis_laundry->id) ? 'selected' : '' ?>><?= $jenis_laundry->jenis_laundry ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('jenis_laundry_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" step="any" class="form-control <?= (form_error('berat')) ? 'is-invalid' : '' ?>" id="berat" name="berat" placeholder="Berat" value="<?= set_value('berat') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('berat', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" step="any" class="form-control <?= (form_error('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" placeholder="harga" value="<?= set_value('harga') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('harga', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select <?= (form_error('status')) ? 'is-invalid' : '' ?>" id="status" name="status">
                            <option value="" selected disabled>Pilih status</option>
                            <option value="menunggu pengambilan">Menunggu Pengambilan</option>
                            <option value="proses">Sedang proses</option>
                            <option value="batal">dibatalkan</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Sudah diambil</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('status', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="<?= date('Y-m-d H:i:s') ?>" checked>
                        <label class="custom-control-label" for="active">Aktif?</label>
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
        var member_id = $(this).data('member_id');
        $(".modal-body  #member_id").val(member_id);
        var pengantaran = $(this).data('pengantaran');
        $(".modal-body  #pengantaran").val(pengantaran);
        var kurir_id = $(this).data('kurir_id');
        $(".modal-body  #kurir_id").val(kurir_id);
        var jenis_laundry_id = $(this).data('jenis_laundry_id');
        $(".modal-body  #jenis_laundry_id").val(jenis_laundry_id);
        var berat = $(this).data('berat');
        $(".modal-body  #berat").val(berat);
        var harga = $(this).data('harga');
        $(".modal-body  #harga").val(harga);
        var pembayaran = $(this).data('pembayaran');
        $(".modal-body  #pembayaran").val(pembayaran);
        var status = $(this).data('status');
        $(".modal-body  #status").val(status);
        // var testimoni = $(this).data('testimoni');
        // $(".modal-body  #testimoni").val(testimoni);
    });


    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select2-add').select2({
            dropdownParent: $('#addModal'),
            theme: 'bootstrap',
            tags: true
        });
        $('.select2-edit').select2({
            dropdownParent: $('#editModal'),
            theme: 'bootstrap',
            tags: true
        });
        $('.multiple-add').select2({
            dropdownParent: $('#addModal'),
            theme: "bootstrap",
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true
        });
    });
</script>