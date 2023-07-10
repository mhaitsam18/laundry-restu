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
                    <?php if ($member) : ?>
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Data Member</h6>
                        </div>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Laundry"></div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <form action="<?= base_url('member/laundry') ?>" method="post">
                                    <input type="hidden" name="form" value="member">
                                    <input type="hidden" name="aksi" value="update">
                                    <input type="hidden" name="member_id" id="member_id" value="<?= $member->id ?>">
                                    <div class="mb-3">
                                        <label for="daerah_id" class="form-label">Daerah</label>
                                        <select class="form-select <?= (form_error('daerah_id')) ? 'is-invalid' : '' ?>" id="daerah_id" name="daerah_id">
                                            <option value="" selected disabled>Pilih Daerah</option>
                                            <?php foreach ($daerahs as $daerah) : ?>
                                                <option value="<?= $daerah->id ?>" <?= (set_value('daerah_id', $member->daerah_id) == $daerah->id) ? 'selected' : '' ?>><?= $daerah->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </div>
                                        <?= form_error('daerah_id', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_kost" class="form-label">Nama Kost</label>
                                        <input type="text" class="form-control <?= (form_error('nama_kost')) ? 'is-invalid' : '' ?>" id="nama_kost" name="nama_kost" placeholder="Nama Kost" value="<?= set_value('nama_kost', $member->nama_kost) ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </div>
                                        <?= form_error('nama_kost', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Pengantaran</label>
                                        <input type="text" class="form-control <?= (form_error('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat', $member->alamat) ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </div>
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#laundryModal">
                                            Pesan Laundry
                                        </button>
                                    </div>
                                </form>

                                <!-- Modal -->
                                <div class="modal fade" id="laundryModal" tabindex="-1" aria-labelledby="laundryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="laundryModalLabel">Pesan Laundry</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url('member/laundry') ?>" method="post">
                                                <div class="modal-body">
                                                    <h4>Apakah Anda yakin?</h4>
                                                    <h5>Jam Operasional Kami Adalah:</h5>
                                                    <h6>Senis-Jumat: 08:00-20:00</h6>
                                                    <h6>Sabtu-Minggu: 08:00-14:00</h6>
                                                    <h5>Setelah Anda menekan tombol Ya, maka Kurir Kami akan segera datang saat jam Operasional</h5>
                                                    <input type="hidden" name="form" value="laundry">
                                                    <input type="hidden" name="aksi" value="add">
                                                    <input type="hidden" name="member_id" id="member_id" value="<?= $member->id ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                    <button type="submit" class="btn btn-primary">Ya</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Lengkapi data Member Terlebih Dahulu</h6>
                        </div>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Laundry"></div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <form action="<?= base_url('member/laundry') ?>" method="post">
                                    <input type="hidden" name="form" value="member">
                                    <input type="hidden" name="aksi" value="add">
                                    <input type="hidden" name="user_id" id="user_id" value="<?= $user['id'] ?>">
                                    <div class="mb-3">
                                        <label for="daerah_id" class="form-label">Daerah</label>
                                        <select class="form-select <?= (form_error('daerah_id')) ? 'is-invalid' : '' ?>" id="daerah_id" name="daerah_id">
                                            <option value="" selected disabled>Pilih Daerah</option>
                                            <?php foreach ($daerahs as $daerah) : ?>
                                                <option value="<?= $daerah->id ?>" <?= (set_value('daerah_id') == $daerah->id) ? 'selected' : '' ?>><?= $daerah->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </div>
                                        <?= form_error('daerah_id', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_kost" class="form-label">Nama Kost</label>
                                        <input type="text" class="form-control <?= (form_error('nama_kost')) ? 'is-invalid' : '' ?>" id="nama_kost" name="nama_kost" placeholder="Nama Kost" value="<?= set_value('nama_kost') ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </div>
                                        <?= form_error('nama_kost', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Pengantaran</label>
                                        <input type="text" class="form-control <?= (form_error('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat') ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-lock"></i>
                                        </div>
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h6 class="card-title mb-0">Data Laundry</h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pengantaran</th>
                                    <th scope="col">Jenis Laundry</th>
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
                                        <td><?= $laundry['pengantaran'] ?></td>
                                        <td><?= $laundry['jenis_laundry'] ?></td>
                                        <td><?= $laundry['berat'] ?></td>
                                        <td>Rp.<?= number_format($laundry['harga'], 2, ',', '.') ?></td>
                                        <td><?= $laundry['status'] ?></td>
                                        <td><?= $laundry['testimoni'] ?></td>
                                        <td>
                                            <?php if (!$laundry['testimoni'] && $laundry['status'] == 'diambil') : ?>
                                                <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $laundry['id'] ?>" data-testimoni="<?= $laundry['testimoni'] ?>">Testimoni</a>
                                            <?php endif; ?>
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

<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Testimoni</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('member/laundry') ?>" method="post">
                <input type="hidden" name="form" value="laundry">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="testimoni" class="form-label">Testimoni</label>
                        <textarea class="form-control <?= (form_error('testimoni')) ? 'is-invalid' : '' ?>" id="testimoni" name="testimoni" rows="3" placeholder="Alamat"><?= set_value('testimoni') ?></textarea>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('testimoni', '<small class="text-danger pl-3">', '</small>') ?>
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
        var testimoni = $(this).data('testimoni');
        $(".modal-body  #testimoni").val(testimoni);
    });
</script>