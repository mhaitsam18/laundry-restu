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
                                    <th scope="col">Berat / Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Testimoni</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($laundrys as $laundry) : ?>
                                    <?php 
                                        $table = '';
                                        if ($laundry['status'] == 'menunggu pengambilan') {
                                            $table = 'table-info';
                                        } elseif($laundry['status'] == 'proses'){
                                            $table = 'table-warning';
                                        } elseif($laundry['status'] == 'batal'){
                                            $table = 'table-danger';
                                        } elseif($laundry['status'] == 'selesai'){
                                            $table = 'table-success';
                                        } elseif($laundry['status'] == 'diantar'){
                                            $table = 'table-secondary';
                                        } elseif($laundry['status'] == 'diambil'){
                                        }
                                        ?>
                                    <tr class="<?= $table ?>">
                                        <td><?= $no++ ?></td>
                                        <td><?= date('j F Y H:i:s', strtotime($laundry['created_at'])) ?></td>
                                        <td>
                                            <?= $laundry['nama_member'] ?>
                                            <?php if ($laundry['paket_id'] == 1) : ?>
                                                <span class="badge bg-danger"><?= $laundry['paket'] ?></span>
                                            <?php elseif ($laundry['paket_id'] == 2) : ?>
                                                <span class="badge bg-success"><?= $laundry['paket'] ?></span>
                                            <?php elseif ($laundry['paket_id'] == 3) : ?>
                                                <span class="badge bg-primary"><?= $laundry['paket'] ?></span>
                                            <?php else : ?>
                                                <span class="badge bg-info"><?= $laundry['paket'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $laundry['pengantaran'] ?></td>
                                        <td><?= $laundry['jenis_laundry'] ?></td>
                                        <td><?= $laundry['nama_kurir'] ?></td>
                                        <td>
                                            <?php if ($laundry['tipe_laundry'] == 'laundry berat') : ?>
                                                <?= $laundry['berat'] ?> kg
                                            <?php elseif ($laundry['tipe_laundry'] == 'laundry tetap') : ?>
                                                <?= number_format($laundry['berat'],0) ?> pcs
                                            <?php endif; ?>
                                        </td>
                                        <td><?= ($laundry['harga']) ? 'Rp.' . number_format($laundry['harga'], 2, ',', '.') : '-' ?></td>
                                        <td><?= $laundry['status'] ?></td>
                                        <td><?= $laundry['testimoni'] ?></td>
                                        <td>
                                            <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $laundry['id'] ?>" data-member_id="<?= $laundry['member_id'] ?>" data-pengantaran="<?= $laundry['pengantaran'] ?>" data-kurir_id="<?= $laundry['kurir_id'] ?>" data-jenis_laundry_id="<?= $laundry['jenis_laundry_id'] ?>" data-berat="<?= $laundry['berat'] ?>" data-harga="<?= $laundry['harga'] ?>" data-pembayaran="<?= $laundry['pembayaran'] ?>" data-status="<?= $laundry['status'] ?>" data-testimoni="<?= $laundry['testimoni'] ?>" data-paket_id="<?= $laundry['paket_id'] ?>" data-paket="<?= $laundry['paket'] ?>">Perbarui</a>

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
                <div class="modal-body modal-add">
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Member</label>
                        <select class="select2-add form-select  <?= (form_error('member_id')) ? 'is-invalid' : '' ?>" id="member_id" name="member_id">
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
                    <input type="hidden" name="paket_id" id="paket_id">
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
                        <label for="berat" class="form-label">Berat / Jumlah (kg / pcs)</label>
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
                    <!-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="<?= date('Y-m-d H:i:s') ?>" checked>
                        <label class="custom-control-label" for="active">Aktif?</label>
                    </div> -->
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
                <h1 class="modal-title fs-5 me-2" id="editModalLabel">Lengkapi Data laundry </h1>
                <span id="paket_id"></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/laundry') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body modal-update">
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
                    <input type="hidden" name="paket_id" id="paket_id">
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
                        <label for="berat" class="form-label">Berat / Jumlah (kg/pcs)</label>
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
                    <!-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="<?= date('Y-m-d H:i:s') ?>" checked>
                        <label class="custom-control-label" for="active">Aktif?</label>
                    </div> -->
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
        var paket_id = $(this).data('paket_id');
        $(".modal-body  #paket_id").val(paket_id);
        var paket = $(this).data('paket');
        // var testimoni = $(this).data('testimoni');
        // $(".modal-body  #testimoni").val(testimoni);
        // Set the paket_id content
        $(".modal-header #paket_id").text(paket);

        // Set the class based on the paket_id
        if (paket_id === 1) {
            $(".modal-header #paket_id").removeClass().addClass("badge bg-primary");
        } else if (paket_id === 2) {
            $(".modal-header #paket_id").removeClass().addClass("badge bg-success");
        } else if (paket_id === 3) {
            $(".modal-header #paket_id").removeClass().addClass("badge bg-warning");
        } else {
            // If the paket_id is none of the specified values, you can add a default class here
            // For example, a gray badge for unknown paket_ids
            $(".modal-header #paket_id").removeClass().addClass("badge bg-secondary");
        }
    });



    $(document).ready(function() {
        // Trigger the AJAX request when either jenis_laundry_id or berat changes
        $(".modal-body #member_id").on("change", function() {
            var member_id = $("#member_id").val();

            // Make sure both fields are filled before making the AJAX request
            if (member_id) {
                // AJAX request to get the updated harga
                $.ajax({
                    url: "<?= base_url('Laundry/Laundry/ubahPaketId') ?>", // Replace this with your server endpoint URL that returns the updated harga
                    method: "POST", // Use "POST" or "GET" depending on your server implementation
                    data: {
                        member_id: member_id
                    },
                    dataType: "json", // Use "json" if your server returns JSON, or "text" for plain text response
                    success: function(data) {
                        // Update the harga field with the retrieved value
                        $("#paket_id").val(data);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        function addHarga() {
            // Get the selected jenis_laundry_id and berat values
            var jenis_laundry_id = $(".modal-add #jenis_laundry_id").val();
            var berat = $(".modal-add #berat").val();
            var paket_id = $(".modal-add #paket_id").val();

            // Make sure both fields are filled before making the AJAX request
            if (jenis_laundry_id && berat) {
                // AJAX request to get the updated harga
                $.ajax({
                    url: "<?= base_url('Laundry/Laundry/hitungHarga') ?>", // Replace this with your server endpoint URL that returns the updated harga
                    method: "POST", // Use "POST" or "GET" depending on your server implementation
                    data: {
                        paket_id: paket_id,
                        jenis_laundry_id: jenis_laundry_id,
                        berat: berat
                    },
                    dataType: "json", // Use "json" if your server returns JSON, or "text" for plain text response
                    success: function(data) {
                        // Update the harga field with the retrieved value
                        $(".modal-body #harga").val(data);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            }
        };
        // Trigger the AJAX request when the user types in the berat field
        $(".modal-add #berat").on("input", addHarga);

        // Trigger the AJAX request when the jenis_laundry_id selection changes
        $(".modal-add #jenis_laundry_id").on("change", addHarga);
    });
    $(document).ready(function() {
        function updateHarga() {
            // Get the selected jenis_laundry_id and berat values
            var jenis_laundry_id = $(".modal-update #jenis_laundry_id").val();
            var berat = $(".modal-update #berat").val();
            var paket_id = $(".modal-update #paket_id").val();

            // Make sure both fields are filled before making the AJAX request
            if (jenis_laundry_id && berat) {
                // AJAX request to get the updated harga
                $.ajax({
                    url: "<?= base_url('Laundry/Laundry/hitungHarga') ?>", // Replace this with your server endpoint URL that returns the updated harga
                    method: "POST", // Use "POST" or "GET" depending on your server implementation
                    data: {
                        paket_id: paket_id,
                        jenis_laundry_id: jenis_laundry_id,
                        berat: berat
                    },
                    dataType: "json", // Use "json" if your server returns JSON, or "text" for plain text response
                    success: function(data) {
                        // Update the harga field with the retrieved value
                        $(".modal-body #harga").val(data);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            }
        };
        // Trigger the AJAX request when the user types in the berat field
        $(".modal-update #berat").on("input", updateHarga);

        // Trigger the AJAX request when the jenis_laundry_id selection changes
        $(".modal-update #jenis_laundry_id").on("change", updateHarga);
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