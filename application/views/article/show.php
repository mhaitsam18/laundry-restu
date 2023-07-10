<div class="page-content">
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-wrap grid-margin">
                        <div class="text-center">
                            <h2 class="mb-3 mb-md-0"><?= $title ?></h2>
                            <div>By <?= $article['name'] ?>, <?= date('j F Y', strtotime($article['created_at'])) ?></div>
                            <img src="<?= base_url('assets/img/' . $article['thumbnail']) ?>" class="img-fluid" style="width: 100%;">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-wrap grid-margin">
                        <div class="text-justify">
                            <p class="justify-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur fuga quae porro eius vel velit, adipisci architecto non quibusdam officia aut in quam reiciendis explicabo optio consequatur officiis labore. Numquam, ut consequatur. Inventore explicabo minima vitae commodi suscipit architecto, nesciunt quos adipisci mollitia ducimus autem praesentium enim fugit, nemo unde repellendus possimus, saepe ut! Dicta rerum vel commodi, cumque nemo debitis a tenetur natus? Labore magni reprehenderit dignissimos laboriosam magnam. Ullam qui, nulla accusamus debitis, rem harum deleniti sint aliquid, possimus dolor blanditiis cupiditate mollitia voluptas quisquam ab neque! Qui magnam soluta ad laudantium veritatis animi illo consectetur a explicabo?
                            </p>
                        </div>
                    </div>
                    <h4 class="mb-3">Komentar</h4>
                    <div class="d-flex post-actions">
                        <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                            <i class="icon-md" data-feather="heart"></i>
                            <p class="d-none d-md-block ms-2">Like</p>
                        </a>
                        <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                            <i class="icon-md" data-feather="message-square"></i>
                            <p class="d-none d-md-block ms-2">Comment</p>
                        </a>
                        <a href="javascript:;" class="d-flex align-items-center text-muted">
                            <i class="icon-md" data-feather="share"></i>
                            <p class="d-none d-md-block ms-2">Share</p>
                        </a>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
</div>