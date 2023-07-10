
    <section class="row">
        <?= $this->session->flashdata('message'); ?>
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>" data-objek="Bantuan"></div>
        <div class="card text-left">
			<div class="card-header">
				<?= $konten['header'] ?>
			</div>
			<div class="card-body">
				<h5 class="card-title"><?= $konten['title'] ?></h5>
				<p class="card-text"><?= $konten['content'] ?></p>
			</div>
			<div class="card-footer text-muted">
				-<?= $konten['footer'] ?>
			</div>
		</div>
	</section>