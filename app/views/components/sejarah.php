<section class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">

                Sejarah Sanggar Nampani

            </h2>

        </div>

        <div class="position-relative mb-5">

            <hr>

        </div>

        <div class="row g-4 flex-nowrap overflow-auto pb-3">

            <?php foreach ($timeline as $item): ?>

                <div
                    class="col-md-4"
                    style="min-width:320px;">

                    <div class="card h-100 shadow-sm border-0">

                        <div
                            class="bg-light d-flex justify-content-center align-items-center"
                            style="height:180px;">

                            <?php if (!empty($item['image'])): ?>

                                <img
                                    src="<?= htmlspecialchars($item['image']); ?>"
                                    class="w-100 h-100"
                                    style="object-fit:cover;">

                            <?php else: ?>

                                <span>Tempat Gambar</span>

                            <?php endif; ?>

                        </div>

                        <div class="card-body">

                            <div class="badge bg-dark mb-3">

                                <?= htmlspecialchars($item['year']); ?>

                            </div>

                            <h5 class="fw-bold">

                                <?= htmlspecialchars($item['title']); ?>

                            </h5>

                            <p class="text-muted mb-0">

                                <?= htmlspecialchars($item['description']); ?>

                            </p>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>