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
                                    <th scope="col">Tanggal transaksi</th>
                                    <th scope="col">Member</th>
                                    <th scope="col">Paket</th>
                                    <th scope="col">Harga bayar</th>
                                    <th scope="col">Kadaluarsa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($member_pakets as $member_paket) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= date('j F Y', strtotime($member_paket['created_at'])) ?></td>
                                        <td><?= $member_paket['name'] ?></td>
                                        <td><?= $member_paket['paket'] ?></td>
                                        <td><?= $member_paket['harga_bayar'] ?></td>
                                        <td><?= date('j F Y', strtotime($member_paket['kadaluarsa_paket'])) ?></td>
                                        <td>
                                            <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $member_paket['id'] ?>" data-member_id="<?= $member_paket['member_id'] ?>" data-paket_id="<?= $member_paket['paket_id'] ?>" data-harga_bayar="<?= $member_paket['harga_bayar'] ?>" data-kadaluarsa_paket="<?= $member_paket['kadaluarsa_paket'] ?>">Ubah</a>

                                            <a href="<?= base_url("Laundry/MemberPaket/delete/$member_paket[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="member_paket">Hapus</a>
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
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data Paket Member</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/MemberPaket') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body modal-add">
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Member</label>
                        <select class="form-select <?= (form_error('member_id')) ? 'is-invalid' : '' ?>" name="member_id" id="member_id">
                            <option value="" disabled selected>Pilih Member</option>
                            <?php foreach ($members as $member) : ?>
                                <option value="<?= $member->id ?>" <?= ($member->id == set_value('member_id')) ? 'selected' : '' ?>><?= $member->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('member_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="paket_id" class="form-label">Paket</label>
                        <select class="form-select <?= (form_error('paket_id')) ? 'is-invalid' : '' ?>" name="paket_id" id="paket_id">
                            <option value="" disabled selected>Pilih Paket</option>
                            <?php foreach ($pakets as $paket) : ?>
                                <option value="<?= $paket->id ?>" <?= ($paket->id == set_value('paket_id')) ? 'selected' : '' ?>><?= $paket->paket ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('paket_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="harga_bayar" class="form-label">Harga Bayar</label>
                        <input type="number" step="any" class="form-control <?= (form_error('harga_bayar')) ? 'is-invalid' : '' ?>" name="harga_bayar" id="harga_bayar" readonly>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('harga_bayar', '<small class="text-danger pl-3">', '</small>') ?><div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="can-edit">
                            <label class="form-check-label" for="can-edit">
                                edit?
                            </label>
                        </div>
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
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data member_paket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/MemberPaket') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body modal-update">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Member</label>
                        <select class="form-select <?= (form_error('member_id')) ? 'is-invalid' : '' ?>" name="member_id" id="member_id">
                            <option value="" disabled selected>Pilih Member</option>
                            <?php foreach ($members as $member) : ?>
                                <option value="<?= $member->id ?>" <?= ($member->id == set_value('member_id')) ? 'selected' : '' ?>><?= $member->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('member_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="paket_id" class="form-label">Paket</label>
                        <select class="form-select <?= (form_error('paket_id')) ? 'is-invalid' : '' ?>" name="paket_id" id="paket_id">
                            <option value="" disabled selected>Pilih Paket</option>
                            <?php foreach ($pakets as $paket) : ?>
                                <option value="<?= $paket->id ?>" <?= ($paket->id == set_value('paket_id')) ? 'selected' : '' ?>><?= $paket->paket ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('paket_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="harga_bayar" class="form-label">Harga Bayar</label>
                        <input type="number" step="any" class="form-control <?= (form_error('harga_bayar')) ? 'is-invalid' : '' ?>" name="harga_bayar" id="harga_bayar">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('harga_bayar', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="kadaluarsa_paket" class="form-label">Kadaluarsa Paket</label>
                        <input type="date" class="form-control <?= (form_error('kadaluarsa_paket')) ? 'is-invalid' : '' ?>" name="kadaluarsa_paket" id="kadaluarsa_paket">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('kadaluarsa_paket', '<small class="text-danger pl-3">', '</small>') ?>
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

        var paket_id = $(this).data('paket_id');
        $(".modal-body  #paket_id").val(paket_id);

        var harga_bayar = $(this).data('harga_bayar');
        $(".modal-body  #harga_bayar").val(harga_bayar);

        var kadaluarsa_paket = $(this).data('kadaluarsa_paket');
        $(".modal-body  #kadaluarsa_paket").val(kadaluarsa_paket);
    });

    $(document).ready(function() {
        function updateHarga() {
            var paket_id = $(".modal-update #paket_id").val();

            // Make sure both fields are filled before making the AJAX request
            if (paket_id) {
                // AJAX request to get the updated harga
                $.ajax({
                    url: "<?= base_url('Laundry/Laundry/hitungHargaPaket') ?>", // Replace this with your server endpoint URL that returns the updated harga
                    method: "POST", // Use "POST" or "GET" depending on your server implementation
                    data: {
                        paket_id: paket_id
                    },
                    dataType: "json", // Use "json" if your server returns JSON, or "text" for plain text response
                    success: function(data) {
                        // Update the harga field with the retrieved value
                        $(".modal-body #harga_bayar").val(data);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            }
        };
        $(".modal-update #paket_id").on("change", updateHarga);
    });
    $(document).ready(function() {
        function addHarga() {
            var paket_id = $(".modal-add #paket_id").val();

            // Make sure both fields are filled before making the AJAX request
            if (paket_id) {
                // AJAX request to get the addd harga
                $.ajax({
                    url: "<?= base_url('Laundry/Laundry/hitungHargaPaket') ?>", // Replace this with your server endpoint URL that returns the addd harga
                    method: "POST", // Use "POST" or "GET" depending on your server implementation
                    data: {
                        paket_id: paket_id
                    },
                    dataType: "json", // Use "json" if your server returns JSON, or "text" for plain text response
                    success: function(data) {
                        // add the harga field with the retrieved value
                        $(".modal-body #harga_bayar").val(data);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            }
        };
        $(".modal-add #paket_id").on("change", addHarga);
    });

    $(document).ready(function() {
        $('#can-edit').on('change', function() {
            var hargaBayarInput = $('#harga_bayar');

            // Jika checkbox dicentang, hilangkan atribut readonly pada input harga_bayar
            if (this.checked) {
                hargaBayarInput.prop('readonly', false);
            } else {
                // Jika checkbox tidak dicentang, tambahkan kembali atribut readonly pada input harga_bayar
                hargaBayarInput.prop('readonly', true);
            }
        });
    });
</script>