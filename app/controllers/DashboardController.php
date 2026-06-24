<?php

require_once BASE_PATH .
'/app/controllers/BaseController.php';

class DashboardController extends BaseController
{
    public function index()
    {
        global $db;

        // Fetch hero slides from DB
        try {
            $stmt = $db->query("SELECT * FROM hero_slides WHERE is_active = 1 ORDER BY sort_order ASC");
            $dbHero = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($dbHero)) {
                $hero = $dbHero;
            } else {
                $hero = [
                    [
                        'title' => 'Sanggar Tari Nampani',
                        'subtitle' => 'Melestarikan seni dan budaya Banyuwangi melalui pendidikan, pertunjukan, dan kolaborasi komunitas.',
                        'image' => '/project_sanggar/public/assets/images/dashboard_1.png'
                    ],
                    [
                        'title' => 'Kelas Seni & Pembinaan',
                        'subtitle' => 'Ruang belajar bagi generasi muda untuk mengenal dan mengembangkan potensi seni budaya daerah.',
                        'image' => '/project_sanggar/public/assets/images/dashboard_2.png'
                    ],
                    [
                        'title' => 'Pertunjukan & Kolaborasi',
                        'subtitle' => 'Menjadi wadah kreativitas, pelestarian budaya, dan penguatan identitas masyarakat Banyuwangi.',
                        'image' => '/project_sanggar/public/assets/images/dashboard_3.png'
                    ]
                ];
            }
        } catch (Exception $e) {
            $hero = [
                [
                    'title' => 'Sanggar Tari Nampani',
                    'subtitle' => 'Melestarikan seni dan budaya Banyuwangi melalui pendidikan, pertunjukan, dan kolaborasi komunitas.',
                    'image' => '/project_sanggar/public/assets/images/dashboard_1.png'
                ],
                [
                    'title' => 'Kelas Seni & Pembinaan',
                    'subtitle' => 'Ruang belajar bagi generasi muda untuk mengenal dan mengembangkan potensi seni budaya daerah.',
                    'image' => '/project_sanggar/public/assets/images/dashboard_2.png'
                ],
                [
                    'title' => 'Pertunjukan & Kolaborasi',
                    'subtitle' => 'Menjadi wadah kreativitas, pelestarian budaya, dan penguatan identitas masyarakat Banyuwangi.',
                    'image' => '/project_sanggar/public/assets/images/dashboard_3.png'
                ]
            ];
        }

        // Fetch about info from DB
        try {
            $stmt = $db->query("SELECT * FROM about LIMIT 1");
            $dbAbout = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($dbAbout) {
                $about = [
                    'title' => $dbAbout['title'],
                    'description' => $dbAbout['description'],
                    'image' => $dbAbout['image'],
                    'statistics' => !empty($dbAbout['statistics']) ? json_decode($dbAbout['statistics'], true) : []
                ];
            } else {
                $about = [
                    'title' => 'Tentang Sanggar Nampani',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquet.',
                    'image' => '/project_sanggar/public/assets/images/dashboard_foto_sanggar.png',
                    'statistics' => [
                        [
                            'number' => '25',
                            'label' => 'Penghargaan Nasional'
                        ],
                        [
                            'number' => '100',
                            'label' => 'Anggota & Pengurus'
                        ]
                    ]
                ];
            }
        } catch (Exception $e) {
            $about = [
                'title' => 'Tentang Sanggar Nampani',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquet.',
                'image' => '/project_sanggar/public/assets/images/dashboard_foto_sanggar.png',
                'statistics' => [
                    [
                        'number' => '25',
                        'label' => 'Penghargaan Nasional'
                    ],
                    [
                        'number' => '100',
                        'label' => 'Anggota & Pengurus'
                    ]
                ]
            ];
        }

        // Fetch visi & misi from DB
        try {
            $stmt = $db->query("SELECT * FROM visi_misi LIMIT 1");
            $dbVm = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($dbVm) {
                $visionMission = [
                    'title'   => $dbVm['title'],
                    'vision'  => [
                        'title'       => $dbVm['vision_title'],
                        'description' => $dbVm['visi']
                    ],
                    'mission' => [
                        'title'       => $dbVm['mission_title'],
                        'description' => $dbVm['misi']
                    ]
                ];
            } else {
                $visionMission = [
                    'title'   => 'Visi & Misi',
                    'vision'  => ['title' => 'Visi',  'description' => 'Lorem ipsum dolor sit amet.'],
                    'mission' => ['title' => 'Misi', 'description' => 'Lorem ipsum dolor sit amet.']
                ];
            }
        } catch (Exception $e) {
            $visionMission = [
                'title'   => 'Visi & Misi',
                'vision'  => ['title' => 'Visi',  'description' => 'Lorem ipsum dolor sit amet.'],
                'mission' => ['title' => 'Misi', 'description' => 'Lorem ipsum dolor sit amet.']
            ];
        }

        // Fetch timeline / sejarah from DB
        try {
            $stmt = $db->query("SELECT * FROM timeline WHERE is_active = 1 ORDER BY sort_order ASC");
            $dbTimeline = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $timeline = !empty($dbTimeline) ? $dbTimeline : [
                ['year' => 'xxxx', 'title' => 'Sanggar Berdiri',    'image' => '', 'description' => 'Awal berdirinya Sanggar Nampani.'],
                ['year' => 'yyyy', 'title' => 'Festival Pertama',   'image' => '', 'description' => 'Mulai tampil dalam festival daerah.'],
                ['year' => 'zzzz', 'title' => 'Penghargaan Nasional','image' => '', 'description' => 'Menerima penghargaan tingkat nasional.']
            ];
        } catch (Exception $e) {
            $timeline = [
                ['year' => 'xxxx', 'title' => 'Sanggar Berdiri',    'image' => '', 'description' => 'Awal berdirinya Sanggar Nampani.'],
                ['year' => 'yyyy', 'title' => 'Festival Pertama',   'image' => '', 'description' => 'Mulai tampil dalam festival daerah.'],
                ['year' => 'zzzz', 'title' => 'Penghargaan Nasional','image' => '', 'description' => 'Menerima penghargaan tingkat nasional.']
            ];
        }

        $location = [

            'title' => 'Lokasi Sanggar',

            'address' =>
                "Dusun Kampunganyar,\nKec. Glagah,\nKab. Banyuwangi,\nJawa Timur 68432",

            'image' =>
                '/project_sanggar/public/assets/images/gambar_sanggar.jpeg',

            'maps' =>
                'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23436.944264899994!2d114.25978810784076!3d-8.184383983891387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd14f18a8ec20c1%3A0x784a84a73c816c77!2sSanggar%20Nampani!5e0!3m2!1sen!2sid!4v1781676287413!5m2!1sen!2sid'

        ];

        $this->view(
            'dashboard',
            compact(
                'hero',
                'about',
                'visionMission',
                'timeline',
                'location'
            )
        );
    }
}