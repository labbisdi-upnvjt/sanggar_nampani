<section class="py-5 bg-light">

    <div class="container">

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="ratio ratio-16x9">

                        <img
                            src="<?= htmlspecialchars($location['image']); ?>"
                            alt="<?= htmlspecialchars($location['title']); ?>"
                            class="w-100 h-100"
                            style="border:4px solid #FFDD00;border-radius:16px;object-fit:cover;object-position:center;"
                            loading="lazy">

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <h3 class="fw-bold mb-4">

                    <?= htmlspecialchars($location['title']); ?>

                </h3>

                <p class="mb-3" style="white-space:pre-line;">

                    <?= htmlspecialchars($location['address']); ?>

                </p>

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-12">

                <iframe
                    src="<?= htmlspecialchars($location['maps']); ?>"
                    class="w-100 shadow-sm"
                    style="height:350px;border:4px solid #FFDD00;border-radius:16px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>

        </div>

    </div>

</section>