<section class="py-4">

    <div class="container">

        <div class="text-center mb-4">

            <h2 class="section-title">

                Homestay

            </h2>

            <p class="section-description">

                Tersedia berbagai pilihan akomodasi untuk menikmati keindahan alam Banyuwangi,
                dengan akses dekat dari berbagai destinasi wisata dan kuliner khas Osing.

            </p>

        </div>

        <?php

        $homestays = [

            [
                'gambar' => 'item_homestay_1.png',
                'harga' => '139.999'
            ],

            [
                'gambar' => 'item_homestay_2.png',
                'harga' => '109.999'
            ]

        ];

        ?>

        <?php foreach ($homestays as $homestay): ?>

            <div class="homestay-card mb-4">

                <div class="row g-0">

                    <div class="col-lg-4">

                        <img
                            src="/project_sanggar/public/assets/images/<?= $homestay['gambar']; ?>"
                            class="homestay-image"
                            alt="Homestay">

                    </div>

                    <div class="col-lg-8">

                        <div class="p-4">

                            <h3 class="fw-bold">

                                Homestay Lorem Ipsum Der Amet

                            </h3>

                            <p class="text-muted">

                                ⭐ 4.4 | 10 Menit dari Wisata Air Banyuwangi

                            </p>

                            <div class="row">

                                <div class="col-md-4">

                                    <small>Mulai Harga :</small>

                                    <h1 class="harga-homestay">

                                        Rp. <?= $homestay['harga']; ?>,-

                                    </h1>

                                </div>

                                <div class="col-md-5">

                                    <strong>Included</strong>

                                    <ul class="list-unstyled mt-2">

                                        <li>Lemari Baju</li>
                                        <li>Dress Hanger</li>
                                        <li>Handuk</li>
                                        <li>Water Heater</li>

                                    </ul>

                                </div>

                                <div class="col-md-3 d-flex align-items-end">

                                    <a
                                        href="https://wa.me/6289682008271"
                                        target="_blank"
                                        class="btn-booking">

                                        Booking Sekarang

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>