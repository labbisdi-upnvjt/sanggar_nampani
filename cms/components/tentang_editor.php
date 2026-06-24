<?php

/*
|--------------------------------------------------------------------------
| Tentang Sanggar Editor
|--------------------------------------------------------------------------
|
| Editor untuk komponen Tentang Sanggar di Dashboard
|
*/

?>

<div class="card editor-card shadow-sm mb-4">

    <div class="card-header">

        Tentang Sanggar

    </div>

    <div class="card-body">

        <form
            method="POST"
            enctype="multipart/form-data">

            <input
                type="hidden"
                name="action"
                value="save_about">

            <div class="row">

                <div class="col-lg-5">

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Preview Gambar

                        </label>

                        <img
                            src="<?= htmlspecialchars($about['image'] ?? '/project_sanggar/public/assets/images/dashboard_foto_sanggar.png'); ?>"
                            class="preview mb-3"
                            alt="Preview Tentang Sanggar">

                        <input
                            type="file"
                            class="form-control"
                            name="about_image"
                            accept="image/*">

                        <div class="form-text">

                            Kosongkan jika tidak ingin mengganti gambar.

                        </div>

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
                            name="about_title"
                            value="<?= htmlspecialchars($about['title'] ?? ''); ?>"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Deskripsi

                        </label>

                        <textarea
                            class="form-control"
                            rows="6"
                            name="about_description"
                            required><?= htmlspecialchars($about['description'] ?? ''); ?></textarea>

                    </div>

                    <!-- Statistics section -->
                    <h5 class="fw-bold border-bottom pb-2 mb-3">

                        Statistik

                    </h5>

                    <div class="row g-3 mb-4">

                        <!-- Stat 1 -->
                        <div class="col-md-6">

                            <div class="p-3 border rounded bg-light">

                                <h6 class="fw-bold mb-3">Statistik 1</h6>

                                <div class="mb-2">

                                    <label class="form-label text-muted small fw-semibold">Angka</label>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        name="stat_1_num"
                                        value="<?= htmlspecialchars($about['statistics'][0]['number'] ?? ''); ?>"
                                        placeholder="Contoh: 25"
                                        required>

                                </div>

                                <div>

                                    <label class="form-label text-muted small fw-semibold">Label</label>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        name="stat_1_label"
                                        value="<?= htmlspecialchars($about['statistics'][0]['label'] ?? ''); ?>"
                                        placeholder="Contoh: Penghargaan Nasional"
                                        required>

                                </div>

                            </div>

                        </div>

                        <!-- Stat 2 -->
                        <div class="col-md-6">

                            <div class="p-3 border rounded bg-light">

                                <h6 class="fw-bold mb-3">Statistik 2</h6>

                                <div class="mb-2">

                                    <label class="form-label text-muted small fw-semibold">Angka</label>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        name="stat_2_num"
                                        value="<?= htmlspecialchars($about['statistics'][1]['number'] ?? ''); ?>"
                                        placeholder="Contoh: 100"
                                        required>

                                </div>

                                <div>

                                    <label class="form-label text-muted small fw-semibold">Label</label>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        name="stat_2_label"
                                        value="<?= htmlspecialchars($about['statistics'][1]['label'] ?? ''); ?>"
                                        placeholder="Contoh: Anggota & Pengurus"
                                        required>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-end">

                <button
                    type="submit"
                    class="btn btn-warning fw-bold px-4">

                    Simpan Tentang Sanggar

                </button>

            </div>

        </form>

    </div>

</div>
