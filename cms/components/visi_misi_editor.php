<?php

/*
|--------------------------------------------------------------------------
| Visi & Misi Editor
|--------------------------------------------------------------------------
|
| Editor untuk visi dan misi Dashboard.
|
*/

?>

<div class="card editor-card shadow-sm mb-4">

    <div class="card-header">

        Visi & Misi

    </div>

    <div class="card-body">

        <form
            method="POST">

            <input
                type="hidden"
                name="action"
                value="save_visi_misi">

            <div class="mb-4">

                <label class="form-label fw-semibold">

                    Judul Halaman / Bagian

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="visi_misi_title"
                    value="<?= htmlspecialchars($visionMission['title'] ?? 'Visi & Misi'); ?>"
                    required>

            </div>

            <div class="row g-4">

                <!-- Vision Column -->
                <div class="col-lg-6">

                    <div class="border rounded p-4 h-100 bg-white">

                        <h5 class="fw-bold border-bottom pb-2 mb-3 text-warning">

                            Visi

                        </h5>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Judul Visi

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="vision_title"
                                value="<?= htmlspecialchars($visionMission['vision']['title'] ?? 'Visi'); ?>"
                                required>

                        </div>

                        <div>

                            <label class="form-label fw-semibold">

                                Deskripsi Visi

                            </label>

                            <textarea
                                class="form-control"
                                rows="6"
                                name="vision_description"
                                placeholder="Masukkan rumusan visi..."
                                required><?= htmlspecialchars($visionMission['vision']['description'] ?? ''); ?></textarea>

                        </div>

                    </div>

                </div>

                <!-- Mission Column -->
                <div class="col-lg-6">

                    <div class="border rounded p-4 h-100 bg-white">

                        <h5 class="fw-bold border-bottom pb-2 mb-3 text-warning">

                            Misi

                        </h5>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Judul Misi

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="mission_title"
                                value="<?= htmlspecialchars($visionMission['mission']['title'] ?? 'Misi'); ?>"
                                required>

                        </div>

                        <div>

                            <label class="form-label fw-semibold">

                                Deskripsi Misi

                            </label>

                            <textarea
                                class="form-control"
                                rows="6"
                                name="mission_description"
                                placeholder="Masukkan rumusan misi..."
                                required><?= htmlspecialchars($visionMission['mission']['description'] ?? ''); ?></textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-end mt-4">

                <button
                    type="submit"
                    class="btn btn-warning fw-bold px-4">

                    Simpan Visi & Misi

                </button>

            </div>

        </form>

    </div>

</div>
