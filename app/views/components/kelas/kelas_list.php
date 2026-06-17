<?php

$kelasList = [

    [
        'nama'   => 'Anak-anak',
        'gambar' => 'kelas_anak.png',
    ],

    [
        'nama'   => 'Remaja',
        'gambar' => 'kelas_remaja.png',
    ],

    [
        'nama'   => 'Dewasa',
        'gambar' => 'kelas_dewasa.png',
    ]

];

?>

<section class="py-4">

    <div class="container">

        <div class="row g-4">

            <?php foreach ($kelasList as $kelas): ?>

                <div class="col-lg-4">

                    <div class="kelas-card">

                        <div class="row g-0 align-items-center">

                            <div class="col-5">

                                <img
                                    src="/project_sanggar/public/assets/images/<?=
                                                                                $kelas['gambar']
                                                                                ?>"
                                    alt="<?= $kelas['nama'] ?>"
                                    class="kelas-card-image">

                            </div>

                            <div class="col-7">

                                <div class="kelas-card-content">

                                    <h2 class="kelas-card-title">

                                        Kelas<br>

                                        <?= $kelas['nama'] ?>

                                    </h2>

                                    <p class="kelas-card-schedule">

                                        Setiap Minggu

                                    </p>

                                    <p class="kelas-card-time">

                                        16:00 WIB

                                    </p>

                                    <a
                                        href="https://wa.me/6289682008271"
                                        target="_blank"
                                        class="kelas-btn">

                                        Daftar Sekarang

                                        <img
                                            src="/project_sanggar/public/assets/images/vector.png"
                                            alt="Whatsapp"
                                            class="kelas-btn-icon"
                                            style="width: 30px; height: 30px;">

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>