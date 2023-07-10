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
                    <form action="<?= base_url('Artikel/create') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-9 col-sm-12">
                                <textarea class="form-control" name="content" id="simpleMdeExample" rows="10"></textarea>
                                <?= form_error('content', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="mb-3">
                                    <label for="title">Judul</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control">
                                    <?= form_error('slug', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="excerpt">Kutipan</label>
                                    <textarea name="excerpt" id="excerpt" class="form-control" cols="30" rows="10"></textarea>
                                    <?= form_error('excerpt', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" class="form-control filepond" name="thumbnail" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3" data-folder="artikel">
                                    <input type="hidden" name="nama_thumbnail" id="img-filepond" value="">
                                    <?= form_error('nama_thumbnail', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="article_category_id">Kategori Artikel</label>
                                    <select class="form-select" name="article_category_id" id="article_category_id">
                                        <option value="" selected disabled>Pilih Kategori Artikel</option>
                                        <?php foreach ($data_ikan as $ikan) : ?>
                                            <option value="<?= $ikan->id ?>"><?= $ikan->scientific_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('article_category_id', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="article_type_id">Tipe Artikel</label>
                                    <select class="form-select" name="article_type_id" id="article_type_id">
                                        <option value="" selected disabled>Pilih Tipe Artikel</option>
                                        <?php foreach ($data_type as $type) : ?>
                                            <option value="<?= $type->id ?>"><?= $type->type ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('article_type_id', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="published_at" id="published_at">
                                        <label class="form-check-label" for="published_at">
                                            Publikasi?
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
</div>