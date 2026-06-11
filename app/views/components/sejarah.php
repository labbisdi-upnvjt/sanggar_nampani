<?php
#belum ada dot timeline, nanti dimigrasi
$timeline = [

    [
        'year'        => 'xxxx',
        'title'       => 'Sanggar Berdiri',
        'image'       => '#',
        'description' => 'Awal berdirinya Sanggar Nampani.'
    ],

    [
        'year'        => 'yyyy',
        'title'       => 'Festival Pertama',
        'image'       => '#',
        'description' => 'Mulai tampil dalam festival daerah.'
    ],

    [
        'year'        => 'zzzz',
        'title'       => 'Penghargaan Nasional',
        'image'       => '#',
        'description' => 'Menerima penghargaan tingkat nasional.'
    ]

];

?>

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

                    <div
                        class="card h-100 shadow-sm border-0">

                        <div
                            class="bg-light d-flex justify-content-center align-items-center"
                            style="height:180px;">

                            <span>

                                Tempat Gambar

                            </span>

                        </div>

                        <div class="card-body">

                            <div
                                class="badge bg-dark mb-3">

                                <?= $item['year']; ?>

                            </div>

                            <h5 class="fw-bold">

                                <?= $item['title']; ?>

                            </h5>

                            <p class="text-muted mb-0">

                                <?= $item['description']; ?>

                            </p>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>