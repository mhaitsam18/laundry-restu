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
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Daerah</th>
                                    <th scope="col">Nama Kost</th>
                                    <th scope="col">Alamat Pengantaran</th>
                                    <th scope="col">Paket</th>
                                    <th scope="col">Masa Paket</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Nomor Gawai</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($members as $member) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $member['name'] ?></td>
                                        <td><?= $member['nama_daerah'] ?></td>
                                        <td><?= $member['nama_kost'] ?></td>
                                        <td><?= $member['address'] ?></td>
                                        <td><?= $member['paket'] ?></td>
                                        <td>
                                            <?php if ($member['kadaluarsa_paket']) : ?>
                                                <?= date('j F Y', strtotime($member['kadaluarsa_paket'])) ?>
                                            <?php else : ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $member['username'] ?></td>
                                        <td><?= $member['email'] ?></td>
                                        <td><?= $member['gender'] ?></td>
                                        <td><?= date('j F Y', strtotime($member['birthday'])) ?></td>
                                        <td><?= $member['phone_number'] ?></td>
                                        <td><img src="<?= base_url('assets/img/' . $member['image']) ?>" class="img-thumbnail img-fluid"></td>
                                        <td>
                                            <a href="#" class="badge bg-success btn-update" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $member['member_id'] ?>" data-user_id="<?= $member['user_id'] ?>" data-name="<?= $member['name'] ?>" data-username="<?= $member['username'] ?>" data-email="<?= $member['email'] ?>" data-gender="<?= $member['gender'] ?>" data-birthday="<?= $member['birthday'] ?>" data-phone_number="<?= $member['phone_number'] ?>" data-address="<?= $member['address'] ?>" data-image="<?= $member['image'] ?>" data-daerah_id="<?= $member['daerah_id'] ?>" data-nama_kost="<?= $member['nama_kost'] ?>" data-alamat="<?= $member['alamat'] ?>" data-paket_id="<?= $member['paket_id'] ?>" data-kadaluarsa_paket="<?= $member['kadaluarsa_paket'] ?>">Ubah</a>

                                            <a href="<?= base_url("Laundry/member/delete/$member[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="member">Hapus</a>
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
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data member</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/member') ?>" method="post">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= (form_error('name')) ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
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
                    <!-- <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Pengantaran</label>
                        <input type="text" class="form-control <?= (form_error('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                    </div> -->
                    <div class="mb-3">
                        <label for="paket_id" class="form-label">Paket</label>
                        <select class="form-select <?= (form_error('paket_id')) ? 'is-invalid' : '' ?>" id="paket_id" name="paket_id">
                            <option value="" selected disabled>Pilih Paket</option>
                            <?php foreach ($pakets as $paket) : ?>
                                <option value="<?= $paket->id ?>" <?= (set_value('paket_id') == $paket->id) ? 'selected' : '' ?>><?= $paket->paket ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('paket_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= (form_error('username')) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select <?= (form_error('gender')) ? 'is-invalid' : '' ?>" name="gender" id="gender">
                            <option value="" disabled selected>Pilih Gender</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= (form_error('birthday')) ? 'is-invalid' : '' ?>" id="birthday" name="birthday" placeholder="Tanggal Lahir" value="<?= set_value('birthday') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('birthday', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control <?= (form_error('phone_number')) ? 'is-invalid' : '' ?>" id="phone_number" name="phone_number" placeholder="Nomor Telepon" value="<?= set_value('phone_number') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Pengantaran</label>
                        <textarea class="form-control <?= (form_error('address')) ? 'is-invalid' : '' ?>" id="address" name="address" rows="3" placeholder="Alamat"><?= set_value('address') ?></textarea>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="password1" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control <?= (form_error('password1')) ? 'is-invalid' : '' ?>" id="password1" name="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="bi bi-shield-lockdanger pl-3">', '</small>') ?>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="password2" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control <?= (form_error('password2')) ? 'is-invalid' : '' ?>" id="password2" name="password2" placeholder="Konfirmasi Kata Sandi">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control filepond" name="file" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3" data-folder="genus">
                        <input type="hidden" name="image" id="img-filepond" value="">
                    </div>
                    <?php echo form_error('image', '<span class="text-danger">', '</span>'); ?>
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
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data member</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Laundry/member') ?>" method="post">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="kadaluarsa_paket" id="kadaluarsa_paket">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= (form_error('name')) ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
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
                    <!-- <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Pengantaran</label>
                        <input type="text" class="form-control <?= (form_error('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                    </div> -->
                    <div class="mb-3">
                        <label for="paket_id" class="form-label">Paket</label>
                        <select class="form-select <?= (form_error('paket_id')) ? 'is-invalid' : '' ?>" id="paket_id" name="paket_id">
                            <option value="" selected disabled>Pilih Paket</option>
                            <?php foreach ($pakets as $paket) : ?>
                                <option value="<?= $paket->id ?>" <?= (set_value('paket_id') == $paket->id) ? 'selected' : '' ?>><?= $paket->paket ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('paket_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= (form_error('username')) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select <?= (form_error('gender')) ? 'is-invalid' : '' ?>" name="gender" id="gender">
                            <option value="" disabled selected>Pilih Gender</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= (form_error('birthday')) ? 'is-invalid' : '' ?>" id="birthday" name="birthday" placeholder="Tanggal Lahir" value="<?= set_value('birthday') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('birthday', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control <?= (form_error('phone_number')) ? 'is-invalid' : '' ?>" id="phone_number" name="phone_number" placeholder="Nomor Telepon" value="<?= set_value('phone_number') ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Pengantaran</label>
                        <textarea class="form-control <?= (form_error('address')) ? 'is-invalid' : '' ?>" id="address" name="address" rows="3" placeholder="Alamat"><?= set_value('address') ?></textarea>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <div class="col-sm-4 m-1">
                            <img src="" class="img-thumbnail img-preview">
                        </div>
                        <label for="image">Foto</label>
                        <input type="file" class="form-control img-input" name="image" onchange="previewImg()" id="image">
                    </div>
                    <?php echo form_error('image', '<span class="text-danger">', '</span>'); ?>
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
    function previewImg() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<script>
    $(document).on("click", ".btn-update", function() {
        var id = $(this).data('id');
        $(".modal-body  #id").val(id);
        var user_id = $(this).data('user_id');
        $(".modal-body  #user_id").val(user_id);

        var daerah_id = $(this).data('daerah_id');
        $(".modal-body  #daerah_id").val(daerah_id);
        var nama_kost = $(this).data('nama_kost');
        $(".modal-body  #nama_kost").val(nama_kost);
        // var alamat = $(this).data('alamat');
        // $(".modal-body  #alamat").val(alamat);
        var paket_id = $(this).data('paket_id');
        $(".modal-body  #paket_id").val(paket_id);
        var kadaluarsa_paket = $(this).data('kadaluarsa_paket');
        $(".modal-body  #kadaluarsa_paket").val(kadaluarsa_paket);

        var name = $(this).data('name');
        $(".modal-body  #name").val(name);
        var username = $(this).data('username');
        $(".modal-body  #username").val(username);
        var email = $(this).data('email');
        $(".modal-body  #email").val(email);
        var gender = $(this).data('gender');
        $(".modal-body  #gender").val(gender);
        var birthday = $(this).data('birthday');
        $(".modal-body  #birthday").val(birthday);
        var phone_number = $(this).data('phone_number');
        $(".modal-body  #phone_number").val(phone_number);
        var address = $(this).data('address');
        $(".modal-body  #address").val(address);

        var image = $(this).data('image');
        var baseURL = "<?= base_url() ?>/assets/img/";
        $(".img-preview").attr('src', baseURL + image);
    });
</script>