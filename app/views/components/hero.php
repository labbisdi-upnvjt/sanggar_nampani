<section class="py-4">

    <div class="container">

        <div
            id="heroSlider"
            class="carousel slide overflow-hidden"
            style="border: 8px solid #FFDD00; border-radius:16px;"
            data-bs-ride="carousel">

            <div class="carousel-inner">

                <?php foreach ($hero as $index => $slide): ?>

                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">

                        <div
                            class="overflow-hidden position-relative"
                            style="
                                height:500px;
                                background:
                                    linear-gradient(
                                        rgba(0,0,0,.45),
                                        rgba(0,0,0,.45)
                                    ),
                                    url('<?= $slide['image']; ?>');
                                background-size:cover;
                                background-position:center;
                            ">

                            <div
                                class="position-absolute
                                top-50
                                start-50
                                translate-middle
                                text-center
                                text-white">

                                <?php if ($index === 0): ?>

                                    <h1 class="fw-bold display-5">
                                        <?= htmlspecialchars($slide['title']); ?>
                                    </h1>

                                <?php else: ?>

                                    <h2 class="fw-bold">
                                        <?= htmlspecialchars($slide['title']); ?>
                                    </h2>

                                <?php endif; ?>

                                <p class="<?= $index === 0 ? 'lead' : '' ?>">
                                    <?= htmlspecialchars($slide['subtitle']); ?>
                                </p>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#heroSlider"
                data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>

            </button>

            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#heroSlider"
                data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>

            </button>

        </div>

    </div>

</section>