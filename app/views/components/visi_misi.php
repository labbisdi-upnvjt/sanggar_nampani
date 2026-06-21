<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">

                <?= htmlspecialchars($visionMission['title']); ?>

            </h2>

        </div>

        <div class="row g-4">

            <div class="col-lg-6">

                <div
                    class="bg-white p-4 rounded shadow-sm h-100"
                    style="border:4px solid #FFDD00;border-radius:16px;">

                    <h3 class="fw-bold mb-3">

                        <?= htmlspecialchars($visionMission['vision']['title']); ?>

                    </h3>

                    <p>

                        <?= htmlspecialchars($visionMission['vision']['description']); ?>

                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div
                    class="bg-white p-4 rounded shadow-sm h-100"
                    style="border:4px solid #FFDD00;border-radius:16px;">

                    <h3 class="fw-bold mb-3">

                        <?= htmlspecialchars($visionMission['mission']['title']); ?>

                    </h3>

                    <p>

                        <?= htmlspecialchars($visionMission['mission']['description']); ?>

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>