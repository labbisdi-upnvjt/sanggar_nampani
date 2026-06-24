<?php

/*
|--------------------------------------------------------------------------
| Hero Editor
|--------------------------------------------------------------------------
|
| Editor untuk Hero Slider Dashboard
| Maksimal 3 slide.
|
*/

?>

<div class="card editor-card shadow-sm mb-4">

    <div class="card-header">

        Hero Slider

    </div>

    <div class="card-body">

        <form
            method="POST"
            enctype="multipart/form-data">

            <input
                type="hidden"
                name="action"
                value="save_hero">

            <?php for ($i = 1; $i <= 3; $i++): ?>

                <div class="border rounded p-4 mb-4">

                    <h5 class="fw-bold mb-4">

                        Slide <?= $i; ?>

                    </h5>

                    <div class="row">

                        <div class="col-lg-5">

                            <label class="form-label fw-semibold">

                                Preview Gambar

                            </label>

                            <img
                                src="/project_sanggar/public/assets/images/dashboard_<?= $i; ?>.png"
                                class="preview mb-3"
                                alt="Preview Hero">

                            <input
                                type="file"
                                class="form-control"
                                name="hero_image_<?= $i; ?>"
                                accept="image/*">

                            <div class="form-text">

                                Kosongkan jika tidak ingin mengganti gambar.

                            </div>

                        </div>

                        <div class="col-lg-7">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Judul

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="hero_title_<?= $i; ?>"
                                    value="<?= htmlspecialchars($hero[$i - 1]['title'] ?? ''); ?>">

                            </div>

                            <div>

                                <label class="form-label fw-semibold">

                                    Subtitle

                                </label>

                                <textarea
                                    class="form-control"
                                    rows="5"
                                    name="hero_subtitle_<?= $i; ?>"><?= htmlspecialchars($hero[$i - 1]['subtitle'] ?? ''); ?></textarea>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endfor; ?>

            <div class="text-end">

                <button
                    type="submit"
                    class="btn btn-warning fw-bold px-4">

                    Simpan Hero

                </button>

            </div>

        </form>

    </div>

</div>