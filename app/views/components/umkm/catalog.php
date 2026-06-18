<section class="pb-5">

    <div class="container">

        <div class="row g-4">

            <!-- UMKM -->
            <div class="col-lg-6">

                <div class="umkm-panel">

                    <h2 class="umkm-panel-title">

                        UMKM

                    </h2>

                    <?php

                    $umkmList = [

                        [
                            'gambar' => 'umkm_1.png',
                            'nama' => 'Batik Mufida'
                        ],

                        [
                            'gambar' => 'umkm_2.png',
                            'nama' => 'Batik Mufida'
                        ],

                        [
                            'gambar' => 'umkm_3.png',
                            'nama' => 'Batik Mufida'
                        ]

                    ];

                    ?>

                    <?php foreach ($umkmList as $item): ?>

                        <div class="umkm-item">

                            <img
                                src="/project_sanggar/public/assets/images/<?= $item['gambar']; ?>"
                                alt="<?= $item['nama']; ?>"
                                class="umkm-image">

                            <div class="umkm-content">

                                <h3>

                                    <?= $item['nama']; ?>

                                </h3>

                                <p>

                                    Batik Tulis Asli Osing,
                                    mahakarya inspirasi leluhur
                                    kaya makna adat & nilai budaya

                                </p>

                                <h4>

                                    Rp 89.999 per m3

                                </h4>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <!-- WISATA -->
            <div class="col-lg-6">

                <div class="umkm-panel">

                    <h2 class="umkm-panel-title">

                        Paket Wisata

                    </h2>

                    <div class="wisata-item">

                        <div class="row g-3">

                            <div class="col-6">

                                <img
                                    src="/project_sanggar/public/assets/images/wisata_1a.png"
                                    class="wisata-image"
                                    alt="Wisata">

                            </div>

                            <div class="col-6">

                                <img
                                    src="/project_sanggar/public/assets/images/wisata_1b.png"
                                    class="wisata-image"
                                    alt="Wisata">

                            </div>

                        </div>

                        <h3 class="wisata-title">

                            Air Terjun Jagir Glagah,
                            Kampunganyar

                        </h3>

                    </div>

                    <div class="wisata-item">

                        <div class="row g-3">

                            <div class="col-6">

                                <img
                                    src="/project_sanggar/public/assets/images/wisata_2a.png"
                                    class="wisata-image"
                                    alt="Wisata">

                            </div>

                            <div class="col-6">

                                <img
                                    src="/project_sanggar/public/assets/images/wisata_2b.png"
                                    class="wisata-image"
                                    alt="Wisata">

                            </div>

                        </div>

                        <h3 class="wisata-title">

                            Bangsring Underwater

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>