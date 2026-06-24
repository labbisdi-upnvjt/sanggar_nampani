<?php

/*
|--------------------------------------------------------------------------
| Sejarah Editor
|--------------------------------------------------------------------------
|
| Editor untuk Sejarah / Timeline Dashboard.
| Maksimal 3 event.
|
*/

?>

<div class="card editor-card shadow-sm mb-4">

    <div class="card-header">

        Sejarah / Timeline

    </div>

    <div class="card-body">

        <form
            method="POST"
            enctype="multipart/form-data">

            <input
                type="hidden"
                name="action"
                value="save_sejarah">

            <?php for ($i = 1; $i <= 3; $i++): ?>

                <div class="border rounded p-4 mb-4">

                    <h5 class="fw-bold mb-4">

                        Peristiwa <?= $i; ?>

                    </h5>

                    <div class="row">

                        <div class="col-lg-5">

                            <label class="form-label fw-semibold">

                                Preview Gambar

                            </label>

                            <?php if (!empty($timeline[$i - 1]['image'])): ?>

                                <img
                                    src="<?= htmlspecialchars($timeline[$i - 1]['image']); ?>"
                                    class="preview mb-3"
                                    alt="Preview Peristiwa">

                            <?php else: ?>

                                <div class="preview mb-3 bg-light d-flex align-items-center justify-content-center border" style="height:220px; border-radius:10px;">
                                    <span class="text-muted small">Belum ada gambar</span>
                                </div>

                            <?php endif; ?>

                            <input
                                type="file"
                                class="form-control"
                                name="timeline_image_<?= $i; ?>"
                                accept="image/*">

                            <div class="form-text">

                                Kosongkan jika tidak ingin mengganti gambar.

                            </div>

                        </div>

                        <div class="col-lg-7">

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="form-label fw-semibold">

                                        Tahun

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="timeline_year_<?= $i; ?>"
                                        value="<?= htmlspecialchars($timeline[$i - 1]['year'] ?? ''); ?>"
                                        placeholder="Contoh: 2024"
                                        required>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <label class="form-label fw-semibold">

                                        Judul Peristiwa

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="timeline_title_<?= $i; ?>"
                                        value="<?= htmlspecialchars($timeline[$i - 1]['title'] ?? ''); ?>"
                                        placeholder="Nama peristiwa"
                                        required>

                                </div>

                            </div>

                            <div>

                                <label class="form-label fw-semibold">

                                    Deskripsi Peristiwa

                                </label>

                                <textarea
                                    class="form-control"
                                    rows="4"
                                    name="timeline_description_<?= $i; ?>"
                                    placeholder="Penjelasan singkat peristiwa..."
                                    required><?= htmlspecialchars($timeline[$i - 1]['description'] ?? ''); ?></textarea>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endfor; ?>

            <div class="text-end">

                <button
                    type="submit"
                    class="btn btn-warning fw-bold px-4">

                    Simpan Sejarah

                </button>

            </div>

        </form>

    </div>

</div>
