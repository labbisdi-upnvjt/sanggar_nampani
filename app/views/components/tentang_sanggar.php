<section class="py-5">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div
                    class="overflow-hidden shadow-sm"
                    style="border:4px solid #FFDD00;border-radius:16px;height:400px;">

                    <img
                        src="<?= htmlspecialchars($about['image']); ?>"
                        alt="<?= htmlspecialchars($about['title']); ?>"
                        class="w-100 h-100"
                        style="object-fit:cover;">

                </div>

            </div>

            <div class="col-lg-6">

                <h2 class="fw-bold mb-4">

                    <?= htmlspecialchars($about['title']); ?>

                </h2>

                <p>

                    <?= htmlspecialchars($about['description']); ?>

                </p>

                <div class="row mt-4">

                    <?php foreach ($about['statistics'] as $item): ?>

                        <div class="col-6">

                            <div
                                class="text-center p-4 h-100"
                                style="border:4px solid #FFDD00;border-radius:16px;">

                                <h3 class="fw-bold">

                                    <?= htmlspecialchars($item['number']); ?>

                                </h3>

                                <p class="mb-0">

                                    <?= htmlspecialchars($item['label']); ?>

                                </p>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </div>

</section>