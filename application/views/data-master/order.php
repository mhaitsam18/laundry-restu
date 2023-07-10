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

                    <?= form_error('order', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0"><?= $title ?></h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a href="#" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#tambahModal"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">Tambah</span></a>
                            </div>
                        </div>
                    </div>
                    <?= form_error('order', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="order"></div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Latin Ordo</th>
                                    <th scope="col">Nama Umum</th>
                                    <th scope="col">Subkelas</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Filum</th>
                                    <th scope="col">Kingdom</th>
                                    <th scope="col" style="max-width: 100px;">Deskripsi</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($orders as $order) : ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $order['order'] ?></td>
                                        <td><?= $order['general_name'] ?></td>
                                        <td><?= $order['subclass'] ?></td>
                                        <td><?= $order['classify'] ?></td>
                                        <td><?= $order['phylum'] ?></td>
                                        <td><?= $order['kingdom'] ?></td>
                                        <td><?= $order['description'] ?></td>
                                        <td><img src="<?= base_url('assets/img/' . $order['picture']) ?>" class="img-thumbnail img-fluid"></td>
                                        <td>

                                            <a href="#" class="badge bg-success updateOrder" data-bs-toggle="modal" data-bs-target="#edit" data-id="<?= $order['id'] ?>" data-order="<?= $order['order'] ?>" data-general_name="<?= $order['general_name'] ?>" data-description="<?= $order['description'] ?>" data-picture="<?= $order['picture'] ?>" data-classify_id="<?= $order['classify_id'] ?>" data-subclass_id="<?= $order['subclass_id'] ?>">Ubah</a>

                                            <a href="<?= base_url("DataMaster/order/delete/$order[id]"); ?>" class="badge bg-danger tombol-hapus" data-hapus="order">Hapus</a>
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
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah Data Ordo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/order') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="order">Nama Latin Ordo</label>
                        <input type="text" class="form-control" id="order" name="order">
                    </div>
                    <?php echo form_error('order', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="general_name">Nama Umum</label>
                        <input type="text" class="form-control" id="general_name" name="general_name">
                    </div>
                    <?php echo form_error('general_name', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="classify_id">Kelas</label>
                        <select class="form-select select2-add" id="classify_id" name="classify_id">
                            <option value="" selected disabled>Pilih Kelas</option>
                            <?php foreach ($classifies as $classify) : ?>
                                <option value="<?= $classify['id'] ?>"><?= $classify['classify'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_error('classify_id', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="subclass_id">Subkelas</label>
                        <select class="form-select select2-add" id="subclass_id" name="subclass_id">
                            <option value="" selected disabled>Pilih Subkelas</option>
                            <?php foreach ($subclassifies as $subclass) : ?>
                                <option value="<?= $subclass['id'] ?>"><?= $subclass['subclass'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_error('subclass_id', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <?php echo form_error('description', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="picture">Gambar</label>
                        <input type="file" class="form-control filepond" name="file" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3" data-folder="order">
                        <input type="hidden" name="picture" id="img-filepond" value="">
                    </div>
                    <?php echo form_error('picture', '<span class="text-danger">', '</span>'); ?>
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
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Edit Data phylum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('DataMaster/order') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="order">Nama Latin Ordo</label>
                        <input type="text" class="form-control" id="order" name="order">
                    </div>
                    <?php echo form_error('order', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="general_name">Nama Umum</label>
                        <input type="text" class="form-control" id="general_name" name="general_name">
                    </div>
                    <?php echo form_error('general_name', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="classify_id">Kelas</label>
                        <select class="form-select select2-edit" id="classify_id" name="classify_id">
                            <option value="" selected disabled>Pilih Kelas</option>
                            <?php foreach ($classifies as $classify) : ?>
                                <option value="<?= $classify['id'] ?>"><?= $classify['classify'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_error('classify_id', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="subclass_id">Subkelas</label>
                        <select class="form-select select2-edit" id="subclass_id" name="subclass_id">
                            <option value="" selected disabled>Pilih Subkelas</option>
                            <?php foreach ($subclassifies as $subclass) : ?>
                                <option value="<?= $subclass['id'] ?>"><?= $subclass['subclass'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_error('subclass_id', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <?php echo form_error('description', '<span class="text-danger">', '</span>'); ?>
                    <div class="mb-3">
                        <div class="col-sm-4 m-1">
                            <img src="" class="img-thumbnail img-preview">
                        </div>
                        <label for="picture">Gambar</label>
                        <input type="file" class="form-control img-input" name="picture" onchange="previewImg()" id="picture">
                    </div>
                    <?php echo form_error('picture', '<span class="text-danger">', '</span>'); ?>
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
    function previewImg() {
        const picture = document.querySelector('#picture');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(picture.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
    
    $(document).on("click", ".updateOrder", function() {
        var id = $(this).data('id');
        $(".modal-body  #id").val(id);

        var order = $(this).data('order');
        $(".modal-body  #order").val(order);

        var general_name = $(this).data('general_name');
        $(".modal-body  #general_name").val(general_name);

        var classify_id = $(this).data('classify_id');
        $(".modal-body  #classify_id").val(classify_id);

        var subclass_id = $(this).data('subclass_id');
        $(".modal-body  #subclass_id").val(subclass_id);

        var description = $(this).data('description');
        $(".modal-body  #description").val(description);

        var picture = $(this).data('picture');
        $(".img-preview").attr('src', '<?= base_url('assets/img/') ?>' + picture);
    });


    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select2-add').select2({
            dropdownParent: $('#tambahModal'),
            theme: 'bootstrap',
            tags: true
        });
        $('.select2-edit').select2({
            dropdownParent: $('#edit'),
            theme: 'bootstrap',
            tags: true
        });
    });
</script>