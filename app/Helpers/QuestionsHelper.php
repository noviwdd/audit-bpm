<?php

namespace App\Helpers;

class QuestionsHelper {

    // Menampung semua pertanyaan beserta kode dan kriteria
    private $questions =
    [
        // A.1
        'Kondisi Eksternal' => [
            'Kondisi Eksternal' => [
                [
                    'code' => 'A.1',
                    'type' => 'option',
                    'question' => "Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan. Unit Pengelola Program Studi (UPPS) mampu: \n1. Mengidentifikasi kondisi lingkungan dan industri yang relevan secara komprehensif dan strategis, \n2. Menetapkan posisi relatif program studi terhadap lingkungannya, \n3. Menggunakan hasil identifikasi dan posisi yang ditetapkan untuk melakukan analisis (SWOT/metoda analisis lain yang relevan) untuk pengembangan program studi,  \n4. Merumuskan strategi pengembangan program studi yang berkesesuaian untuk menghasilkan program-program pengembangan alternatif yang tepat.",
                    'choices' => [
                        '0' => 'Unit Pengelola Program Studi (UPPS) tidak mampu melakukan poin 1 dan 2',
                        '1' => 'Unit Pengelola Program Studi (UPPS) kurang mampu melakukan poin 1 dan 2',
                        '2' => 'Unit Pengelola Program Studi (UPPS) mampu melakukan poin 1 dan 2',
                        '3' => 'Unit Pengelola Program Studi (UPPS) mampu melakukan poin 1 s.d. 3',
                        '4' => 'Unit Pengelola Program Studi (UPPS) mampu melakukan poin 1 s.d. 4'
                    ]
                ]
            ]
        ],

        // B.1
        'Profil Unit Pengelola Program Studi' => [
            'Profil Unit Pengelola Program Studi' => [
                [
                    'code' => 'B.1',
                    'type' => 'option',
                    'question' => "Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya. Profil UPPS:\n 1) menunjukkan keserbacakupan informasi yang jelas dan konsisten dengan data dan informasi yang disampaikan pada masing-masing kriteria,\n 2) menggambarkan keselarasan dengan substansi keilmuan program studi.\n 3) menunjukkan iklim yang kondusif untuk pengembangan keilmuan program studi.\n 4) menunjukkan reputasi sebagai rujukan di bidang keilmuannya.",
                    'choices' => [
                        '0' => 'Profil UPPS tidak menunjukkan keserbacakupan informasi yang jelas dengan data dan informasi yang disampaikan pada masing-masing kriteria.',
                        '1' => 'Profil UPPS kurang menunjukkan poin 1 dan 2',
                        '2' => 'Profil UPPS mencakup poin 1 dan 2',
                        '3' => 'Profil UPPS mencakup poin 1 s.d. 3',
                        '4' => 'Profil UPPS mencakup poin 1 s.d. 4'
                    ]
                ]
            ]
        ],

        // IBIK-STD-01.
        'Visi, Misi, Tujuan dan Strategi' => [
            'Indikator Kinerja Utama' => [
                [
                    'code' => 'IBIK-STD-01.1',
                    'type' => 'option',
                    'question' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.',
                    'choices' => [
                        '0' => "UPPS memiliki misi, tujuan, dan strategi yang tidak terkait dengan strategi perguruan tinggi dan pengembangan program studi.",
                        '1' => "Visi yang mencerminkan visi perguruan tinggi namun tidak memayungi visi keilmuan terkait program studi. Misi, tujuan, dan strategi kurang searah dengan misi, tujuan, dan strategi perguruan tinggi serta kurang mendukung pengembangan program studi.",
                        '2' => "Visi yang mencerminkan visi perguruan tinggi dan memayungi visi keilmuan terkait program studi. Misi, tujuan, dan strategi yang searah dengan misi, tujuan, dan strategi perguruan tinggi serta  mendukung pengembangan program studi.",
                        '3' => "Visi yang mencerminkan visi perguruan tinggi dan memayungi visi keilmuan terkait keunikan program studi. Misi, tujuan, dan strategi yang searah dan bersinerji dengan misi, tujuan, dan strategi perguruan tinggi serta mendukung pengembangan program studi.",
                        '4' => "Visi yang mencerminkan visi perguruan tinggi dan memayungi visi keilmuan terkait keunikan program studi serta didukung data implementasi yang konsisten. Misi, tujuan, dan strategi yang searah dan bersinerji dengan misi, tujuan, dan strategi perguruan tinggi serta mendukung pengembangan program studi dengan data implementasi yang konsisten."
                    ]
                ],
                [
                    'code' => 'IBIK-STD-01.2',
                    'type' => 'option',
                    'question' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS UPPS.',
                    'choices' => [
                        '0' => 'Tidak ada mekanisme dalam penyusunan dan penetapan visi, misi, tujuan dan strategi.',
                        '1' => 'Ada mekanisme dalam penyusunan dan penetapan visi, misi, tujuan dan strategi yang terdokumentasi namun tidak melibatkan pemangku kepentingan.',
                        '2' => 'Ada mekanisme dalam penyusunan dan penetapan visi, misi, tujuan dan strategi yang terdokumentasi serta ada keterlibatan pemangku kepentingan internal (dosen dan mahasiswa) dan pemangku kepentingan eksternal (lulusan).',
                        '3' => 'Ada mekanisme dalam penyusunan dan penetapan visi, misi, tujuan dan strategi yang terdokumentasi serta ada keterlibatan pemangku kepentingan internal (dosen, mahasiswa dan tenaga kependidikan) dan pemangku kepentingan eksternal (lulusan dan pengguna lulusan).',
                        '4' => 'Ada mekanisme dalam penyusunan dan penetapan visi, misi, tujuan dan strategi yang terdokumentasi serta ada keterlibatan semua pemangku kepentingan internal (dosen, mahasiswa dan tenaga kependidikan) dan eksternal (lulusan, pengguna lulusan dan pakar/mitra/organisasi profesi/pemerintah).'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-01.3',
                    'type' => 'option',
                    'question' => 'Strategi pencapaian tujuan disusun berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti.',
                    'choices' => [
                        '0' => 'Tidak memiliki strategi untuk mencapai tujuan.',
                        '1' => 'Strategi untuk mencapai tujuan disusun berdasarkan analisis yang kurang sistematis serta tidak menggunakan metoda yang relevan.',
                        '2' => 'Strategi untuk mencapai tujuan dan disusun berdasarkan analisis yang sistematis dengan menggunakan metoda yang relevan serta terdokumentasi namun belum terbukti efektifitasnya.',
                        '3' => 'Strategi efektif untuk mencapai tujuan dan disusun berdasarkan analisis yang sistematis dengan menggunakan metoda yang relevan dan terdokumentasi serta pada pelaksanaannya dilakukan pemantauan dan evaluasi.',
                        '4' => 'Strategi efektif untuk mencapai tujuan dan disusun berdasarkan analisis yang sistematis dengan menggunakan metoda yang relevan dan terdokumentasi serta pada pelaksanaannya dilakukan pemantauan dan evaluasi dan ditindaklanjuti.'
                    ]
                ]
            ]
        ],

        // IBIK-STD-02.
        'Tata Pamong, Tata Kelola dan Kerjasama' => [
            'Sistem Tata Pamong' => [
                [
                    'code' => 'IBIK-STD-02.1A',
                    'type' => 'option',
                    'question' => 'Kelengkapan struktur organisasi dan keefektifan penyelenggara organisasi.',
                    'choices' => [
                        '0' => 'UPPS tidak memiliki dokumen formal struktur organisasi.',
                        '1' => 'UPPS memiliki dokumen formal struktur organisasi dan tata kerja namun tugas dan fungsi belum berjalan secara konsisten.',
                        '2' => 'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten.',
                        '3' => 'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten dan menjamin tata pamong yang baik.',
                        '4' => 'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten dan menjamin tata pamong yang baik serta berjalan efektif dan efisien.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-02.1B',
                    'type' => 'option',
                    'question' => "Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong, yang mencakup: \n 1) Kredibel,\n 2) Transparan,\n 3) Akuntabel,\n 4) Bertanggung jawab,\n 5) Adil,\n untuk menjamin penyelenggaraan program studi yang bermutu.",
                    'choices' => [
                        '1' => 'UPPS menerapkan tata pamong yang memenuhi 1 s.d. 2 kaidah good governance.',
                        '2' => 'UPPS menerapkan tata pamong yang memenuhi 3 kaidah good governance',
                        '3' => 'UPPS menerapkan tata pamong yang memenuhi 4 kaidah good governance',
                        '4' => 'UPPS menerapkan tata pamong yang memenuhi 5 kaidah good governance'
                    ],
                ],
            ],

            'Kepemimpinan dan Kemampuan Manajerial' => [
                [
                    'code' => 'IBIK-STD-02.2A',
                    'type' => 'option',
                    'question' => 'Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki karakter kepemimpinan operasional, organisasi, dan publik.',
                    'choices' => [
                        '2' => 'Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki 1 karakter.',
                        '3' => 'Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki 2 karakter.',
                        '4' => 'Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki karakter kepemimpinan operasional, organisasi, dan publik.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-02.2B',
                    'type' => 'option',
                    'question' => "Kapabilitas pimpinan UPPS, mencakup aspek:\n 1) perencanaan,\n 2) pengorganisasian,\n 3) penempatan personel,\n 4) pelaksanaan,\n 5) pengendalian dan pengawasan,\n 6) pelaporan yang menjadi dasar tindak lanjut.",
                    'choices' => [
                        '1' => 'Pimpinan UPPS mampu melaksanakan kurang dari 6 fungsi manajemen.',
                        '2' => 'Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif.',
                        '3' => 'Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan efisien serta mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga',
                        '4' => 'Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan efisien, mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga, dan melakukan inovasi untuk menghasilkan nilai tambah'
                    ]
                ]
            ],

            'Kerja sama' => [
                [
                    'code' => 'IBIK-STD-02.3',
                    'type' => 'option',
                    'question' => "Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi. UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:\n 1) memberikan manfaat bagi program studi dalam pemenuhan proses pembelajaran, penelitian, PkM.\n 2) memberikan peningkatan kinerja tridharma dan fasilitas pendukung program studi.\n 3) memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan hasilnya.",
                    'choices' => [
                        '1' => 'UPPS tidak memiliki bukti pelaksanaan kerjasama',
                        '2' => 'UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1',
                        '3' => 'UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2',
                        '4' => 'UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-02.4A',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir',
                        'N1' => 'Jumlah kerjasama pendidikan',
                        'N2' => 'Jumlah kerjasama penelitian',
                        'N3' => 'Jumlah kerjasama PkM',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ],
                ],
                [
                    'code' => 'IBIK-STD-02.4B',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kerjasama tingkat internasional, nasional, wilayah/lokal yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir',
                        'NI' => 'Jumlah kerjasama tingkat internasional',
                        'NN' => 'Jumlah kerjasama tingkat nasional',
                        'NW' => 'Jumlah kerjasama tingkat wilayah/lokal'
                    ]
                ]
            ],

            'Indikator Kinerja Tambahan' => [
                [
                    'code' => 'IBIK-STD-02.5',
                    'type' => 'option',
                    'question' => 'Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi pada tiap kriteria',
                    'choices' => [
                        '2' => 'UPPS tidak menetapkan indikator kinerja tambahan.',
                        '3' => 'UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup sebagian kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat nasional. Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan',
                        '4' => 'UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat inernasional. Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.'
                    ]
                ]
            ],

            'Evaluasi Capaian Kinerja' => [
                [
                    'code' => 'IBIK-STD-02.6',
                    'type' => 'option',
                    'question' => "Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut:\n 1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi, dan\n 2) analisis terhadap capaian kinerja mencakup identifikasi akar masalah, faktor pendukung keberhasilan dan faktor penghambat ketercapaian standard, dan deskripsi singkat tindak lanjut yang akan dilakukan.",
                    'choices' => [
                        '0' => 'UPPS tidak memiliki laporan pencapaian kinerja.',
                        '1' => 'UPPS memiliki laporan pencapaian kinerja namun belum dianalisis dan dievaluasi.',
                        '2' => 'Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek.',
                        '3' => 'Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek dan dilaksanakan setiap tahun.',
                        '4' => 'Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun dan hasilnya dipublikasikan kepada para pemangku kepentingan'
                    ]
                ]
            ],

            'Penjaminan Mutu' => [
                [
                    'code' => 'IBIK-STD-02.7',
                    'type' => 'option',
                    'question' => "Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan nonakademik) yang dibuktikan dengan keberadaan 5 aspek:\n 1) dokumen legal pembentukan unsur pelaksana penjaminan mutu.\n 2) ketersediaan dokumen mutu: kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI.\n 3) terlaksananya siklus penjaminan mutu (siklus PPEPP).\n 4) bukti sahih efektivitas pelaksanaan penjaminan mutu.\n 5) memiliki external benchmarking dalam peningkatan mutu."	,
                    'choices' => [
                        '0' => 'UPPS telah memiliki dokumen legal pembentukan unsur pelaksana penjaminan mutu tanpa pelaksanaan SPMI.',
                        '1' => 'UPPS telah melaksanakan SPMI yang memenuhi aspek nomor 1 dan 2, serta siklus kegiatan SPMI baru dilaksanakan pada tahapan penetapan standar dan pelaksanaan standar pendidikan tinggi.',
                        '2' => 'UPPS telah melaksanakan SPMI yang memenuhi aspek nomor 1 sampai dengan 3.',
                        '3' => 'UPPS telah melaksanakan SPMI yang memenuhi aspek nomor 1 sampai dengan 4.',
                        '4' => 'UPPS telah melaksanakan SPMI yang memenuhi 5 aspek.'
                    ]
                ]
            ],

            'Kepuasan Pemangku Kepentingan' => [
                [
                    'code' => 'IBIK-STD-02.8',
                    'type' => 'option',
                    'question' => "Pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) terhadap layanan manajemen, yang memenuhi aspekaspek berikut:\n 1) menggunakan instrumen kepuasan yang sahih, andal, mudah digunakan,\n 2) dilaksanakan secara berkala, serta datanya terekam secara komprehensif,\n 3) dianalisis dengan metode yang tepat serta bermanfaat untuk pengambilan keputusan,\n 4) tingkat kepuasan dan umpan balik ditindaklanjuti untuk perbaikan dan peningkatan mutu luaran secara berkala dan tersistem.\n 5) dilakukan review terhadap pelaksanaan pengukuran kepuasan dosen dan mahasiswa,\n 6) hasilnya dipublikasikan dan mudah diakses oleh dosen dan mahasiswa",
                    'choices' => [
                        '0' => 'UPPS tidak melakukan pengukuran kepuasan layanan manajemen.',
                        '1' => 'UPPS melakukan pengukuran kepuasan kepada sebagian pemangku kepentingan terhadap layanan manajemen yang memenuhi aspek 1 s.d. 4.',
                        '2' => 'UPPS melakukan pengukuran kepuasan kepada seluruh pemangku kepentingan terhadap layanan manajemen yang memenuhi aspek 1 s.d 4.',
                        '3' => 'UPPS melakukan pengukuran kepuasan kepada seluruh pemangku kepentingan terhadap layanan manajemen yang memenuhi aspek 1 s.d 4 dan salah satu dari aspek 5 atau aspek 6.',
                        '4' => 'UPPS melakukan pengukuran kepuasan kepada seluruh pemangku kepentingan terhadap layanan manajemen yang memenuhi seluruh aspek.'
                    ]
                ]
            ]
        ],

        // IBIK-STD-03.
        'Mahasiswa' => [
            'Kualitas Input Mahasiswa' => [
                [
                    'code' => 'IBIK-STD-03.1',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Metoda rekrutmen dan keketatan seleksi',
                        'JP' => 'Jumlah Pendaftar',
                        'JPL' => 'Jumlah Pendaftar yang lulus seleksi'
                    ]
                ]
            ],
            'Daya Tarik Program Studi' => [
                [
                    'code' => 'IBIK-STD-03.2A',
                    'type' => 'option',
                    'question' => 'Peningkatan animo calon mahasiswa',
                    'choices' => [
                        '0' => 'UPPS tidak melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir.',
                        '1' => 'UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir namun trennya menurun.',
                        '2' => 'UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir dengan tren tetap',
                        '3' => 'UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar dalam 3 tahun terakhir',
                        '4' => 'UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar secara signifikan (> 10%) dalam 3 tahun terakhir.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-03.2B',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Mahasiswa Asing',
                        'NMA' => 'Jumlah Mahasiswa Asing',
                        'NMD' => 'Jumlah Mahasiswa yang diterima'
                    ]
                ]
            ],
            'Layanan Kemahasiswaan' => [
                [
                    'code' => 'IBIK-STD-03.3A',
                    'type' => 'option',
                    'question' => "Ketersediaan layanan kemahasiswaan di bidang:\n" .
                                "1) penalaran, minat dan bakat,\n" .
                                "2) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan\n" .
                                "3) bimbingan karir dan kewirausahaan.",
                    'choices' => [
                        '0' => 'Tidak memiliki layanan kemahasiswaan.',
                        '1' => 'Jenis layanan hanya mencakup sebagian bidang penalaran, minat atau bakat.',
                        '2' => 'Jenis layanan hanya mencakup bidang 1',
                        '3' => 'Jenis layanan mencakup bidang 1 dan 2',
                        '4' => 'Jenis layanan mencakup bidang 1 s.d. 3'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-03.3B',
                    'type' => 'option',
                    'question' => 'Akses dan mutu layanan kemahasiswaan.',
                    'choices' => [
                        '0' => 'Tidak memiliki layanan kemahasiswaan.',
                        '1' => 'Mutu layanan kurang baik untuk bidang penalaran atau minat bakat mahasiswa.',
                        '2' => 'Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran dan minat bakat mahasiswa',
                        '3' => 'Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan sebagian layanan kesehatan.',
                        '4' => 'Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan semua jenis layanan kesehatan.'
                    ]
                ]
            ]
        ],

        // IBIK-STD-04.
        'Sumber Daya Manusia' => [
            'Profil Dosen' => [
                [
                    'code' => 'IBIK-STD-04.1',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kecukupan jumlah DTPS',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.2',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kualifikasi akademik DTPS',
                        'NDS3' => ' Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.3',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Jabatan akademik DTPS',
                        'NDGB' => 'Jumlah DTPS yang memiliki jabatan akademik Guru Besar',
                        'NDLK' => 'Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala',
                        'NDL' => 'Jumlah DTPS yang memiliki jabatan akademik Lektor',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.4',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS',
                        'NM' => 'Jumlah mahasiswa pada saat TS',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.5',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Penugasan DTPS sebagai pembimbing utama tugas akhir mahasiswa',
                        'RDPU' => 'Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.6',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Ekuivalensi Waktu Mengajar Penuh DTPS',
                        'REWMP' => 'Rata-rata Ekuivalensi Waktu Mengajar Penuh DTPS'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.7',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Dosen tidak tetap',
                        'NDTT' => 'Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi',
                        'NDT' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi'
                    ]
                ],
            ],

            'Kinerja Dosen' => [
                [
                    'code' => 'IBIK-STD-04.8',
                    'type' => 'input',
                    'question' => [
                        'main' => "Pengakuan/rekognisi atas kepakaran/ prestasi/ kinerja DTPS.\n" .
                                "a) menjadi visiting lecturer atau visiting scholar di program studi/perguruan tinggi terakreditasi A/Unggul atau program studi/perguruan tinggi internasional bereputasi.\n" .
                                "b) menjadi keynote speaker/invited speaker pada pertemuan ilmiah tingkat nasional/ internasional.\n" .
                                "c) menjadi editor atau mitra bestari pada jurnal nasional terakreditasi/jurnal internasional bereputasi di bidang yang sesuai dengan bidang program studi.\n" .
                                "d) menjadi staf ahli/narasumber di lembaga tingkat wilayah/nasional/internasional pada bidang yang sesuai dengan bidang program studi (untuk pengusul dari program studi pada program Sarjana/ Magister/Doktor), atau menjadi tenaga ahli/konsultan di lembaga/industri tingkat wilayah/nasional/ internasional pada bidang yang sesuai dengan bidang program studi (untuk pengusul dari program studi pada program Diploma Tiga/Sarjana Terapan/Magister Terapan/Doktor Terapan).\n" .
                                "e) mendapat penghargaan atas prestasi dan kinerja di tingkat wilayah/nasional/internasional.\n",
                        'NRD' => 'Jumlah pengakuan atas prestasi/kinerja DTPS yang relevan dengan bidang keahlian dalam 3 tahun terakhir',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.9',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kegiatan penelitian DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir',
                        'NI' => 'Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir',
                        'NN' => 'Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir',
                        'NL' => 'Jumlah penelitian dengan sumber pembiayaan PT/ mandiri dalam 3 tahun terakhir',
                        'NTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.10',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kegiatan PkM DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir',
                        'NI' => 'Jumlah PkM dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir',
                        'NN' => 'Jumlah PkM dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir',
                        'NL' => 'Jumlah PkM dengan sumber pembiayaan PT/ mandiri dalam 3 tahun terakhir',
                        'NTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.11',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 3 tahun terakhir',
                        'NA1' => 'Jumlah publikasi di jurnal nasional tidak terakreditasi',
                        'NA2' => 'Jumlah publikasi di jurnal nasional terakreditasi',
                        'NA3' => 'Jumlah publikasi di jurnal Internasional',
                        'NA4' => 'Jumlah publikasi di jurnal Internasional Bereputasi',
                        'NB1' => 'Jumlah publikasi di seminar wilayah/lokal/PT',
                        'NB2' => 'Jumlah publikasi di seminar nasional',
                        'NB3' => 'Jumlah publikasi di seminar internasional',
                        'NC1' => 'Jumlah tulisan di media massa wilayah',
                        'NC2' => 'Jumlah tulisan di media massa nasional',
                        'NC3' => 'Jumlah tulisan di media massa Internasional',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.12',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Artikel karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir',
                        'NAS' => 'Jumlah artikel yang disitasi',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.13',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 3 tahun terakhir',
                        'NA' => 'Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana)',
                        'NB' => 'Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)',
                        'NC' => 'Jumlah luaran penelitian/PkM dalam bentuk Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial',
                        'ND' => 'Jumlah luaran penelitian/PkM yang diterbitkan dalam bentuk Buku ber-ISBN, Book Chapter',
                        'NDTPS' => 'Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi'
                    ]
                ]
            ],

            'Pengembangan Dosen' => [
                [
                    'code' => 'IBIK-STD-04.14',
                    'type' => 'option',
                    'question' => 'Upaya pengembangan dosen',
                    'choices' => [
                        '0' => 'Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan SDM',
                        '1' => 'UPPS mengembangkan DTPS tidak mengikuti atau tidak sesuai dengan rencana pengembangan SDM di perguruan tinggi (Renstra PT)',
                        '2' => 'UPPS mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT)',
                        '3' => 'UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT)',
                        '4' => 'UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT) secara konsisten'
                    ]
                ]
            ],

            'Tenaga Kependidikan' => [
                [
                    'code' => 'IBIK-STD-04.15A',
                    'type' => 'option',
                    'question' => 'Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.) Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi informasi dan komputer dalam proses administrasi dapat dijadikan pertimbangan untuk menilai efektifitas pekerjaan dan kebutuhan akan tenaga kependidikan',
                    'choices' => [
                        '0' => 'UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.',
                        '1' => 'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.',
                        '2' => 'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.',
                        '3' => 'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik dan fungsi unit pengelola.',
                        '4' => 'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-04.15B',
                    'type' => 'option',
                    'question' => 'Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi',
                    'choices' => [
                        '0' => 'UPPS tidak memiliki laboran.',
                        '1' => 'UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi.',
                        '2' => 'UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya.',
                        '3' => 'UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang tugasnya.',
                        '4' => 'UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi tertentu sesuai bidang tugasnya.'
                    ]
                ]
            ]
        ],

        // IBIK-STD-05.
        'Keuangan, Sarana dan Prasarana' => [
            'Keuangan' => [
                [
                    'code' => 'IBIK-STD-05.1',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Biaya operasional pendidikan',
                        'DOP' => 'Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-05.2',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Dana penelitian DTPS',
                        'DPD' => 'Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-05.3',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Dana Pengabdian kepada Masyarakat DTPS',
                        'DPkMD' => 'Rata-rata dana PkM DTPS/ tahun dalam 3 tahun terakhir'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-05.4',
                    'type' => 'option',
                    'question' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma',
                    'choices' => [
                        '0' => 'Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.',
                        '1' => 'Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.',
                        '2' => 'Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.',
                        '3' => 'Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.',
                        '4' => 'Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-05.5',
                    'type' => 'option',
                    'question' => 'Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.',
                    'choices' => [
                        '0' => 'Dana tidak mencukupi untuk keperluan operasional.',
                        '1' => 'Dana dapat menjamin keberlangsungan operasional dan tidak ada untuk pengembangan.',
                        '2' => 'Dana dapat menjamin keberlangsungan operasional tridharma dan sebagian kecil pengembangan.',
                        '3' => 'Dana dapat menjamin keberlangsungan operasional tridharma serta pengembangan 3 tahun terakhir.',
                        '4' => 'Dana dapat menjamin keberlangsungan operasional tridharma, pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.'
                    ]
                ],
            ],

            'Sarana dan Prasarana' => [
                [
                    'code' => 'IBIK-STD-05.6',
                    'type' => 'option',
                    'question' => 'Kecukupan, aksesibilitas dan mutu sarana dan prasarana untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.',
                    'choices' => [
                        '0' => 'UPPS tidak memiliki sarana dan prasarana.',
                        '1' => 'UPPS menyediakan sarana dan prasarana serta aksesibiltas yang tidak cukup untuk menjamin pencapaian capaian pembelajaran.',
                        '2' => 'UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran.',
                        '3' => 'UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.',
                        '4' => 'UPPS menyediakan sarana dan prasarana yang mutakhir serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.'
                    ]
                ]
            ],
        ],

        // IBIK-STD-06.
        'Pendidikan' => [
            'Kurikulum' => [
                [
                    'code' => 'IBIK-STD-06.1A',
                    'type' => 'option',
                    'question' => 'Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum',
                    'choices' => [
                        '0' => 'Evaluasi dan pemutakhiran kurikulum dilakukan oleh dosen program studi.',
                        '1' => 'Evaluasi dan pemutakhiran kurikulum tidak melibatkan seluruh pemangku kepentingan internal.',
                        '2' => 'Evaluasi dan pemutakhiran kurikulum melibatkan pemangku kepentingan internal.',
                        '3' => 'Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal.',
                        '4' => 'Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu program studi, industri, asosiasi, serta sesuai perkembangan ipteks dan kebutuhan pengguna'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.1B',
                    'type' => 'option',
                    'question' => 'Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.',
                    'choices' => [
                        '0' => 'Capaian pembelajaran tidak diturunkan dari profil lulusan dan tidak memenuhi level KKNI.',
                        '1' => 'Capaian pembelajaran diturunkan dari profil lulusan dan tidak memenuhi level KKNI.',
                        '2' => 'Capaian pembelajaran diturunkan dari profil lulusan dan memenuhi level KKNI.',
                        '3' => 'Capaian pembelajaran diturunkan dari profil lulusan, memenuhi level KKNI, dan dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks atau kebutuhan pengguna.',
                        '4' => 'Capaian pembelajaran diturunkan dari profil lulusan, mengacu pada hasil kesepakatan dengan asosiasi penyelenggara program studi sejenis dan organisasi profesi, dan memenuhi level KKNI, serta dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks dan kebutuhan pengguna.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.1C',
                    'type' => 'option',
                    'question' => 'Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.',
                    'choices' => [
                        '1' => 'Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan.',
                        '2' => 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.',
                        '3' => 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah.',
                        '4' => 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembelajaran matakuliah yang tidak mendukung capaian pembelajaran lulusan.'
                    ]
                ],

            ],

            'Karakteristik Proses Pembelajaran' => [
                [
                    'code' => 'IBIK-STD-06.2',
                    'type' => 'option',
                    'question' => "Pemenuhan karakteristik proses pembelajaran, yang terdiri atas sifat:\n" .
                                "1) interaktif,\n" .
                                "2) holistik,\n" .
                                "3) integratif,\n" .
                                "4) saintifik,\n" .
                                "5) kontekstual,\n" .
                                "6) tematik,\n" .
                                "7) efektif,\n" .
                                "8) kolaboratif,\n" .
                                "dan 9) berpusat pada mahasiswa",
                    'choices' => [
                        '1' => 'Karakteristik proses pembelajaran program studi belum berpusat pada mahasiswa.',
                        '2' => 'Karakteristik proses pembelajaran program studi berpusat pada mahasiswa yang diterapkan pada minimal 50% matakuliah.',
                        '3' => 'Terpenuhinya karakteristik proses pembelajaran program studi yang berpusat pada mahasiswa, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.',
                        '4' => 'Terpenuhinya karakteristik proses pembelajaran program studi yang mencakup seluruh sifat, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.'
                    ]
                ],
            ],

            'Rencana Proses Pembelajaran' => [
                [
                    'code' => 'IBIK-STD-06.3A',
                    'type' => 'option',
                    'question' => 'Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)',
                    'choices' => [
                        '0' => 'Tidak memiliki dokumen RPS.',
                        '1' => 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.',
                        '2' => 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.',
                        '3' => 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.',
                        '4' => 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.3B',
                    'type' => 'option',
                    'question' => 'Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.',
                    'choices' => [
                        '0' => 'Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.',
                        '1' => 'Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.',
                        '2' => 'Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.',
                        '3' => 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.',
                        '4' => 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.'
                    ]
                ],
            ],

            'Pelaksanaan Proses Pembelajaran' => [
                [
                    'code' => 'IBIK-STD-06.4A',
                    'type' => 'option',
                    'question' => 'Bentuk interaksi antara dosen, mahasiswa dan sumber belajar',
                    'choices' => [
                        '0' => 'Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa.',
                        '1' => 'Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.',
                        '2' => 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.',
                        '3' => 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line.',
                        '4' => 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dalam bentuk audio-visual terdokumentasi.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.4B',
                    'type' => 'option',
                    'question' => 'Pemantauan kesesuaian proses terhadap rencana pembelajaran',
                    'choices' => [
                        '0' => 'Tidak memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran.',
                        '1' => 'Memiliki bukti sahih adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.',
                        '2' => 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.',
                        '3' => 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.',
                        '4' => 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.4C',
                    'type' => 'option',
                    'question' => "C. Proses pembelajaran yang terkait dengan penelitian harus mengacu SN Dikti Penelitian:\n" .
                                "1) hasil penelitian: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.\n" .
                                "2) isi penelitian: memenuhi kedalaman dan keluasan materi penelitian sesuai capaian pembelajaran.\n" .
                                "3) proses penelitian: mencakup perencanaan, pelaksanaan, dan pelaporan.\n" .
                                "4) penilaian penelitian memenuhi unsur edukatif, obyektif, akuntabel, dan transparan.",
                    'choices' => [
                        '2' => 'Terdapat bukti sahih tentang pemenuhan SN Dikti Penelitian pada proses pembelajaran terkait penelitian namun tidak memenuhi SN Dikti Penelitian pada proses pembelajaran.',
                        '4' => 'Terdapat bukti sahih tentang pemenuhan SN Dikti Penelitian pada proses pembelajaran terkait penelitian serta pemenuhan SN Dikti Penelitian pada proses pembelajaran terkait penelitian.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.4D',
                    'type' => 'option',
                    'question' => "D. Proses pembelajaran yang terkait dengan PkM harus mengacu SN Dikti PkM:\n" .
                                "1) hasil PkM: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.\n" .
                                "2) isi PkM: memenuhi kedalaman dan keluasan materi PkM sesuai capaian pembelajaran.\n" .
                                "3) proses PkM: mencakup perencanaan, pelaksanaan, dan pelaporan.\n" .
                                "4) penilaian PkM memenuhi unsur edukatif, obyektif, akuntabel, dan transparan.",
                    'choices' => [
                        '2' => 'Terdapat bukti sahih tentang pemenuhan SN Dikti PkM pada proses pembelajaran terkait PkM namun tidak memenuhi SN Dikti PkM pada proses pembelajaran terkait PkM.',
                        '4' => 'Terdapat bukti sahih tentang pemenuhan SN Dikti PkM pada proses pembelajaran terkait PkM serta pemenuhan SN Dikti PkM pada proses pembelajaran terkait PkM.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.4E',
                    'type' => 'option',
                    'question' => 'Kesesuaian metode pembelajaran dengan capaian pembelajaran. Contoh: RBE (research based education), IBE (industry based education), teaching factory/teaching industry, dll.',
                    'choices' => [
                        '0' => 'Tidak terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan.',
                        '1' => 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada < 25% mata kuliah.',
                        '2' => 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 25 s.d. < 50% mata kuliah.',
                        '3' => 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 50 s.d. < 75% mata kuliah.',
                        '4' => 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 75% s.d. 100% mata kuliah.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.5',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Pembelajaran yang dilaksanakan dalam bentuk praktikum, praktik studio, praktik bengkel, atau praktik lapangan.',
                        'JP' => 'Jam pembelajaran praktikum, praktik studio, praktik bengkel, atau praktik lapangan (termasuk KKN)',
                        'JB' => 'Jam pembelajaran total selama masa pendidikan.'
                    ]
                ]
            ],

            'Monitoring dan Evaluasi Proses Pembelajaran' => [
                [
                    'code' => 'IBIK-STD-06.6',
                    'type' => 'option',
                    'question' => 'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa untuk memperoleh capaian pembelajaran lulusan',
                    'choices' => [
                        '0' => 'UPPS tidak melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.',
                        '1' => 'UPPS telah melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa namun tidak semua didukung bukti sahih.',
                        '2' => 'UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.',
                        '3' => 'UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten.',
                        '4' => 'UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten dan ditindak lanjuti.'
                    ]
                ],
            ],

            'Penilaian Pembelajaran' => [
                [
                    'code' => 'IBIK-STD-06.7A',
                    'type' => 'option',
                    'question' => "Mutu pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup:\n" .
                                "1) edukatif,\n" .
                                "2) otentik,\n" .
                                "3) objektif,\n" .
                                "4) akuntabel,\n" .
                                "5) transparan,\n" .
                                "yang dilakukan secara terintegrasi.",
                    'choices' => [
                        '0' => 'Tidak terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian.',
                        '1' => 'Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang tidak dilakukan secara terintegrasi.',
                        '2' => 'Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi.',
                        '3' => 'Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 50% jumlah matakuliah.',
                        '4' => 'Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 70% jumlah matakuliah.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.7B',
                    'type' => 'option',
                    'question' => "Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian. \n- Teknik penilaian terdiri dari: \n1) observasi, \n2) partisipasi, \n3) unjuk kerja, \n4) test tertulis, \n5) test lisan, \n6) angket. \n- Instrumen penilaian terdiri dari: \n1) penilaian proses dalam bentuk rubrik, dan/ atau; \n2) penilaian hasil dalam bentuk portofolio, \n3) karya disain",
                    'choices' => [
                        '0' => 'Tidak terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran.',
                        '1' => 'Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai < 25% dari jumlah matakuliah.',
                        '2' => 'Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai minimum 25 s.d. < 50% dari jumlah matakuliah.',
                        '3' => 'Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 50 s.d. < 75% dari jumlah matakuliah.',
                        '4' => 'Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 75% s.d. 100% dari jumlah matakuliah.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-06.7C',
                    'type' => 'option',
                    'question' => "Pelaksanaan penilaian memuat unsurunsur sebagai berikut: \n1) Mempunyai kontrak rencana penilaian, \n2) Melaksanakan penilaian sesuai kontrak atau kesepakatan, \n3) Memberikan umpan balik dan memberi kesempatan untuk mempertanyakan hasil kepada mahasiswa, \n4) Mempunyai dokumentasi penilaian proses dan hasil belajar mahasiswa, \n5) Mempunyai prosedur yang mencakup tahap perencanaan, kegiatan pemberian tugas atau soal, observasi kinerja, pengembalian hasil observasi, dan pemberian nilai akhir, \n6) Pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah dalam bentuk huruf dan angka, \n7) Mempunyai buktibukti rencana dan telah melakukan proses perbaikan berdasar hasil monev penilaian.",
                    'choices' => [
                        '1' => 'Terdapat bukti sahih pelaksanaan penilaian hanya mencakup unsur 6.',
                        '2' => 'Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6.',
                        '3' => 'Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6 serta 2 unsur lainnya.',
                        '4' => 'Terdapat bukti sahih pelaksanaan penilaian mencakup 7 unsur.'
                    ]
                ],
            ],

            'Integrasi kegiatan penelitian dan PkM dalam pembelajaran' => [
                [
                    'code' => 'IBIK-STD-06.8',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Integrasi kegiatan penelitian dan PkM dalam pembelajaran oleh DTPS dalam 3 tahun terakhir',
                        'NMKI' => 'Jumlah mata kuliah yang dikembangkan berdasarkan hasil penelitian/PkM DTPS dalam 3 tahun terakhir'
                    ]
                ],
            ],

            'Suasana Akademik' => [
                [
                    'code' => 'IBIK-STD-06.9',
                    'type' => 'option',
                    'question' => 'Keterlaksanaan dan keberkalaan program dan kegiatan diluar kegiatan pembelajaran terstruktur untuk meningkatkan suasana akademik. Contoh: kegiatan himpunan mahasiswa, kuliah umum/studium generale, seminar ilmiah, bedah buku.',
                    'choices' => [
                        '1' => 'Kegiatan ilmiah yang terjadwal dilaksanakan lebih dari enam bulan sekali.',
                        '2' => 'Kegiatan ilmiah yang terjadwal dilaksanakan empat s.d. enam bulan sekali.',
                        '3' => 'Kegiatan ilmiah yang terjadwal dilaksanakan dua s.d tiga bulan sekali.',
                        '4' => 'Kegiatan ilmiah yang terjadwal dilaksanakan setiap bulan.'
                    ]
                ],
            ],

            'Kepuasan Mahasiswa' => [
                [
                    'code' => 'IBIK-STD-06.10A',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Tingkat kepuasan mahasiswa terhadap proses pendidikan',
                        'TKM1' => [
                            'sub_main' => 'Tingkat kepuasan mahasiswa pada aspek Realibility',
                            'ai_1' => 'Presentase "Sangat Baik"',
                            'bi_1' => 'Presentase "Baik"',
                            'ci_1' => 'Presentase "Cukup"',
                            'di_1' => 'Presentase "Kurang"',
                        ],
                        'TKM2' => [
                            'sub_main' => 'Tingkat kepuasan mahasiswa pada aspek Responsiveness',
                            'ai_2' => 'Presentase "Sangat Baik"',
                            'bi_2' => 'Presentase "Baik"',
                            'ci_2' => 'Presentase "Cukup"',
                            'di_2' => 'Presentase "Kurang"',
                        ],
                        'TKM3' => [
                            'sub_main' => 'Tingkat kepuasan mahasiswa pada aspek Assurance',
                            'ai_3' => 'Presentase "Sangat Baik"',
                            'bi_3' => 'Presentase "Baik"',
                            'ci_3' => 'Presentase "Cukup"',
                            'di_3' => 'Presentase "Kurang"',
                        ],
                        'TKM4' => [
                            'sub_main' => 'Tingkat kepuasan mahasiswa pada aspek Emphaty',
                            'ai_4' => 'Presentase "Sangat Baik"',
                            'bi_4' => 'Presentase "Baik"',
                            'ci_4' => 'Presentase "Cukup"',
                            'di_4' => 'Presentase "Kurang"',
                        ],
                        'TKM5' => [
                            'sub_main' => 'Tingkat kepuasan mahasiswa pada aspek Tangible',
                            'ai_5' => 'Presentase "Sangat Baik"',
                            'bi_5' => 'Presentase "Baik"',
                            'ci_5' => 'Presentase "Cukup"',
                            'di_5' => 'Presentase "Kurang"',
                        ],
                    ]
                ],

                [
                    'code' => 'IBIK-STD-06.10B',
                    'type' => 'option',
                    'question' => 'Analisis dan tindak lanjut dari hasil pengukuran kepuasan mahasiswa.',
                    'choices' => [
                        '0' => 'Tidak dilakukan analisis terhadap hasil pengukuran kepuasan terhadap proses pembelajaran.',
                        '1' => 'Hasil pengukuran dianalisis dan ditindaklanjuti, serta digunakan untuk perbaikan proses pembelajaran, namun dilakukan secara insidentil.',
                        '2' => 'Hasil pengukuran dianalisis dan ditindaklanjuti setiap tahun, serta digunakan untuk perbaikan proses pembelajaran.',
                        '3' => 'Hasil pengukuran dianalisis dan ditindaklanjuti setiap semester, serta digunakan untuk perbaikan proses pembelajaran dan menunjukkan peningkatan hasil pembelajaran.',
                        '4' => 'Hasil pengukuran dianalisis dan ditindaklanjuti minimal 2 kali setiap semester, serta digunakan untuk perbaikan proses pembelajaran dan menunjukkan peningkatan hasil pembelajaran.'
                    ]
                ],
            ]
        ],

        // IBIK-STD-07.
        'Penelitian' => [
            'Relevansi Penelitian' => [
                [
                    'code' => 'IBIK-STD-07.1',
                    'type' => 'option',
                    'question' => "Relevansi penelitian pada UPPS mencakup unsur-unsur sebagai berikut: \n1) Memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa yang mencakup isu-isu ekonomi yg berkembang di tingkat Internasional, \n2) Dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada peta jalan penelitian. \n3) Melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan, \n4) Menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.",
                    'choices' => [
                        '0' => 'UPPS Tidak mempunyai peta jalan penelitian dosen dan mahasiswa.',
                        '1' => 'UPPS memenuhi unsur pertama namun penelitian dosen dan mahasiswa tidak sesuai dengan peta jalan.',
                        '2' => 'UPPS memenuhi unsur 1, dan 2 relevansi penelitian dosen dan mahasiswa.',
                        '3' => 'UPPS memenuhi unsur 1, 2, dan 3 relevansi penelitian dosen dan mahasiswa.',
                        '4' => 'UPPS memenuhi 4 unsur relevansi penelitian dosen dan mahasiswa.'
                    ]
                ]
            ],

            'Penelitian Dosen dan Mahasiswa' => [
                [
                    'code' => 'IBIK-STD-07.2',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.',
                        'NPM' => 'Jumlah judul penelitian DTPS yang melibatkan mahasiswa dlm 3 tahun terakhir',
                        'NPD' => 'Jumlah judul penelitian DTPS dalam 3 tahun terakhir'
                    ]
                ]
            ]
        ],

        // IBIK-STD-08.
        'Pengabdian kepada Masyarakat' => [
            'Relevansi PkM' => [
                [
                    'code' => 'IBIK-STD-08.1',
                    'type' => 'option',
                    'question' => "Relevansi PkM pada UPPS mencakup unsurunsur sebagai berikut: \n1) Memiliki peta jalan yang memayungi tema PkM dosen dan mahasiswa serta hilirisasi/penerapan keilmuan program studi, \n2) Dosen dan mahasiswa melaksanakan PkM sesuai dengan peta jalan PkM. \n3) Melakukan evaluasi kesesuaian PkM dosen dan mahasiswa dengan peta jalan, \n4) Menggunakan hasil evaluasi untuk perbaikan relevansi PkM dan pengembangan keilmuan program studi.",
                    'choices' => [
                        '0' => 'UPPS tidak mempunyai peta jalan PkM dosen dan mahasiswa.',
                        '1' => 'UPPS memenuhi unsur pertama namun PkM dosen dan mahasiswa tidak sesuai dengan peta jalan.',
                        '2' => 'UPPS memenuhi unsur 1, dan 2 relevansi PkM dosen dan mahasiswa.',
                        '3' => 'UPPS memenuhi unsur 1, 2, dan 3 relevansi PkM dosen dan mahasiswa.',
                        '4' => 'UPPS memenuhi 4 unsur relevansi PkM dosen dan mahasiswa.'
                    ]
                ]
            ],

            'PkM Dosen dan Mahasiswa' => [
                [
                    'code' => 'IBIK-STD-08.2',
                    'type' => 'input',
                    'question' => [
                        'main' => 'PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa PS dlm 3 tahun terakhir.',
                        'NPkMM' => 'Jumlah judul PkM DTPS yang melibatkan mahasiswa dlm 3 tahun terakhir',
                        'NPkMD' => 'Jumlah judul PkM DTPS dalam 3 tahun terakhir',
                    ]
                ]
            ]
        ],

        // IBIK-STD-09.
        'Luaran dan Capaian Tridharma' => [
            'Luaran Dharma Pendidikan' => [
                [
                    'code' => 'IBIK-STD-09.1',
                    'type' => 'option',
                    'question' => "Analisis pemenuhan capaian pembelajaran lulusan (CPL) yang diukur dengan metoda yang sahih dan relevan, mencakup aspek: \n1) Keserbacakupan, \n2) Kedalaman, \n3) Kebermanfaatan analisis yang ditunjukkan dengan peningkatan CPL dari waktu ke waktu dalam 3 tahun terakhir.",
                    'choices' => [
                        '0' => 'Tidak dilakukan analisis capaian pembelajaran lulusan.',
                        '1' => 'Analisis capaian pembelajaran lulusan tidak memenuhi ketiga aspek.',
                        '2' => 'Analisis capaian pembelajaran lulusan memenuhi 1 aspek.',
                        '3' => 'Analisis capaian pembelajaran lulusan memenuhi 2 aspek.',
                        '4' => 'Analisis capaian pembelajaran lulusan memenuhi 3 aspek.'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.2',
                    'type' => 'input',
                    'question' => [
                        'main' => 'IPK Lulusan',
                        'RIPK' => 'Rata-rata IPK lulusan dalam 3 tahun terakhir'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.3',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Prestasi mahasiswa di bidang akademik dalam 3 tahun terakhir.',
                        'NI' => 'Jumlah prestasi akademik internasional',
                        'NN' => 'Jumlah prestasi akademik nasional',
                        'NW' => 'Jumlah prestasi akademik wilayah/lokal',
                        'NM' => 'Jumlah mahasiswa pada saat TS'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.4',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Prestasi mahasiswa di bidang non akademik dalam 3 tahun terakhir.',
                        'NI' => 'Jumlah prestasi non akademik internasional',
                        'NN' => 'Jumlah prestasi non akademik nasional',
                        'NW' => 'Jumlah prestasi non akademik wilayah/lokal',
                        'NM' => 'Jumlah mahasiswa pada saat TS'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.5',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Masa Studi.',
                        'MS' => 'Rata-rata masa studi lulusan',
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.6',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kelulusan tepat waktu.',
                        'PTW' => 'Persentase kelulusan tepat waktu',
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.7',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Keberhasilan Studi.',
                        'PPS' => 'Persentase keberhasilan studi',
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.8',
                    'type' => 'option',
                    'question' => "Pelaksanaan tracer study yang mencakup 5 aspek sebagai berikut: \n1) Pelaksanaan tracer study terkoordinasi di tingkat PT, \n2) Kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi, \n3) Isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI. \n4) Ditargetkan pada seluruh populasi (lulusan TS-4 s.d. TS-2) \n5) Hasilnya disosialisasikan dan digunakan untuk pengembangan kurikulum dan pembelajaran.",
                    'choices' => [
                        '0' => 'UPPS tidak melaksanakan tracer study',
                        '1' => 'Tracer study yang dilakukan UPPS telah mencakup 2 aspek',
                        '2' => 'Tracer study yang dilakukan UPPS telah mencakup 3 aspek',
                        '3' => 'Tracer study yang dilakukan UPPS telah mencakup 4 aspek',
                        '4' => 'Tracer study yang dilakukan UPPS telah mencakup 5 aspek'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.9',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Waktu Tunggu.',
                        'WT' => 'Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2',
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.10',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Kesesuaian Bidang Kerja.',
                        'PBS' => 'Persentase Kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2',
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.11',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Tingkat dan ukuran tempat kerja lulusan.',
                        'NI' => 'Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional',
                        'NN' => 'Jumlah lulusan yang bekerja di badan usaha tingkat nasional atau berwirausaha yang berizin',
                        'NW' => 'Jumlah lulusan yang bekerja di badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin',
                        'NL' => 'Jumlah lulusan',
                        'NJ' => 'Jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) yang terlacak'
                    ]
                ],
                [
                    'code' => 'IBIK-STD-09.12',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Tingkat kepuasan pengguna lulusan',
                        'TK1' => [
                            'sub_main' => 'Tingkat kepuasan aspek etika',
                            'ai_1' => 'Presentase "Sangat Baik"',
                            'bi_1' => 'Presentase "Baik"',
                            'ci_1' => 'Presentase "Cukup"',
                            'di_1' => 'Presentase "Kurang"',
                        ],
                        'TK2' => [
                            'sub_main' => 'Tingkat kepuasan aspek keahlian pada bidang ilmu (kompetensi utama)',
                            'ai_2' => 'Presentase "Sangat Baik"',
                            'bi_2' => 'Presentase "Baik"',
                            'ci_2' => 'Presentase "Cukup"',
                            'di_2' => 'Presentase "Kurang"',
                        ],
                        'TK3' => [
                            'sub_main' => 'Tingkat kepuasan aspek kemampuan berbahasa asing',
                            'ai_3' => 'Presentase "Sangat Baik"',
                            'bi_3' => 'Presentase "Baik"',
                            'ci_3' => 'Presentase "Cukup"',
                            'di_3' => 'Presentase "Kurang"',
                        ],
                        'TK4' => [
                            'sub_main' => 'Tingkat kepuasan aspek penggunaan teknologi informasi',
                            'ai_4' => 'Presentase "Sangat Baik"',
                            'bi_4' => 'Presentase "Baik"',
                            'ci_4' => 'Presentase "Cukup"',
                            'di_4' => 'Presentase "Kurang"',
                        ],
                        'TK5' => [
                            'sub_main' => 'Tingkat kepuasan aspek kemampuan berkomunikasi',
                            'ai_5' => 'Presentase "Sangat Baik"',
                            'bi_5' => 'Presentase "Baik"',
                            'ci_5' => 'Presentase "Cukup"',
                            'di_5' => 'Presentase "Kurang"',
                        ],
                        'TK6' => [
                            'sub_main' => 'Tingkat kepuasan aspek kerjasama tim',
                            'ai_6' => 'Presentase "Sangat Baik"',
                            'bi_6' => 'Presentase "Baik"',
                            'ci_6' => 'Presentase "Cukup"',
                            'di_6' => 'Presentase "Kurang"',
                        ],
                        'TK7' => [
                            'sub_main' => 'Tingkat kepuasan aspek pengembangan diri',
                            'ai_7' => 'Presentase "Sangat Baik"',
                            'bi_7' => 'Presentase "Baik"',
                            'ci_7' => 'Presentase "Cukup"',
                            'di_7' => 'Presentase "Kurang"',
                        ],
                        'NL' => 'Jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2)',
                        'NJ' => 'Jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) yang terlacak'
                    ]
                ],
            ],

            'Luaran Dharma penelitian dan PkM' => [
                [
                    'code' => 'IBIK-STD-09.13',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Publikasi ilmiah mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, dengan judul yang relevan dengan bidang program studi dalam 3 tahun terakhir.',
                        'NA1' => 'Jumlah publikasi mahasiswa di jurnal nasional tidak terakreditasi',
                        'NA2' => 'Jumlah publikasi mahasiswa di jurnal nasional terakreditasi',
                        'NA3' => 'Jumlah publikasi mahasiswa di jurnal internasional',
                        'NA4' => 'Jumlah publikasi mahasiswa di jurnal internasional bereputasi',
                        'NB1' => 'Jumlah publikasi mahasiswa di seminar wilayah/lokal/PT',
                        'NB2' => 'Jumlah publikasi mahasiswa di seminar nasional',
                        'NB3' => 'Jumlah publikasi mahasiswa di seminar internasional',
                        'NC1' => 'Jumlah tulisan mahasiswa di media massa wilayah',
                        'NC2' => 'Jumlah tulisan mahasiswa di media massa nasional',
                        'NC3' => 'Jumlah tulisan mahasiswa di media massa internasional',
                        'NM' => 'jumlah mahasiswa pada saat TS',
                    ],
                ],
                [
                    'code' => 'IBIK-STD-09.14',
                    'type' => 'input',
                    'question' => [
                        'main' => 'Luaran penelitian dan PkM yang dihasilkan mahasiswa, baik secara mandiri atau bersama DTPS dalam 3 tahun terakhir.',
                        'NA' => 'Jumlah luaran penelitian/PkM mahasiswa yang mendapat Pengakuan HKI(paten, paten sederhana)',
                        'NB' => 'Jumlah luaran penelitian/PkM mahasiswa yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)',
                        'NC' => 'Jumlah luaran penelitian/PkM mahasiswa dalam bentuk Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial',
                        'ND' => 'Jumlah luaran penelitian/PkM mahasiswa yang diterbitkan dalam bentuk Buku ber-ISBN, Book Chapter'
                    ]
                ]
            ]
        ],

        // D
        'Analisis dan Penetapan Program Pengembangan' => [
            'Analisis dan Capaian Kinerja' => [
                [
                    'code' => 'D.1',
                    'type' => 'option',
                    'question' => 'Keserbacakupan (kelengkapan, keluasan, dan kedalaman), ketepatan, ketajaman, dan kesesuaian analisis capaian kinerja serta konsistensi dengan setiap kriteria.',
                    'choices' => [
                        '0' => 'UPPS tidak melakukan analisis capaian kinerja.',
                        '1' => "UPPS telah melakukan analisis capaian kinerja yang: \n1) Analisisnya tidak sepenuhnya didukung oleh data/informasi yang relevan (merujuk pada pencapaian standar mutu perguruan tinggi) dan berkualitas (andal dan memadai), \n2) Konsisten dengan sebagian kecil (kurang dari 5) kriteria yang diuraikan sebelumnya, \n3) Analisisnya dilakukan tidak secara komprehensif untuk mengidentifikasi akar masalah di UPPS, 4) hasilnya tidak dipublikasikan.",
                        '2' => "UPPS telah melakukan analisis capaian kinerja yang: \n1) analisisnya didukung oleh data/informasi yang relevan (merujuk pada pencapaian standar mutu perguruan tinggi) dan berkualitas (andal dan memadai), \n2) konsisten dengan sebagian (5 s.d. 6) kriteria yang diuraikan sebelumnya, \n3) analisisnya dilakukan secara komprehensif untuk mengidentifikasi akar masalah di UPPS, \n4) hasilnya dipublikasikan kepada para pemangku kepentingan internal.",
                        '3' => "UPPS telah melakukan analisis capaian kinerja yang: \n1) analisisnya didukung oleh data/informasi yang relevan (merujuk pada pencapaian standar mutu perguruan tinggi) dan berkualitas (andal dan memadai) yang didukung oleh keberadaan pangkalan data institusi yang belum terintegrasi, \n2) konsisten dengan sebagian besar (7 s.d. 8) kriteria yang diuraikan sebelumnya, \n3) analisisnya dilakukan secara komprehensif dan tepat untuk mengidentifikasi akar masalah di UPPS, \n4) hasilnya dipublikasikan kepada para pemangku kepentingan internal serta mudah diakses.",
                        '4' => "UPPS telah melakukan analisis capaian kinerja yang: \n1) analisisnya didukung oleh data/informasi yang relevan (merujuk pada pencapaian standar mutu perguruan tinggi) dan berkualitas (andal dan memadai) yang didukung oleh keberadaan pangkalan data institusi yang terintegrasi. \n2) konsisten dengan seluruh kriteria yang diuraikan sebelumnya, \n3) analisisnya dilakukan secara komprehensif, tepat, dan tajam untuk mengidentifikasi akar masalah di UPPS. \n4) hasilnya dipublikasikan kepada para pemangku kepentingan internal dan eksternal serta mudah diakses",
                    ]
                ]
            ],

            'Analisis SWOT atau Analisis Lain yang Relevan' => [
                [
                    'code' => 'D.2',
                    'type' => 'option',
                    'question' => 'Ketepatan analisis SWOT atau analisis yang relevan di dalam mengembangkan strategi',
                    'choices' => [
                        '0' => 'UPPS tidak melakukan analisis untuk mengembangkan strategi',
                        '1' => "UPPS melakukan analisis SWOT atau analisis lain yang memenuhi aspek-aspek sebagai berikut: \n1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS \n2) memiliki keterkaitan dengan hasil analisis capaian kinerja, namun tidak terstruktur dan tidak sistematis",
                        '2' => "UPPS melakukan analisis SWOT atau analisis lain yang relevan, serta memenuhi aspek-aspek sebagai berikut: \n1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS dilakukan secara tepat, \n2) memiliki keterkaitan dengan hasil analisis capaian kinerja.",
                        '3' => "UPPS melakukan analisis SWOT atau analisis lain yang relevan, serta memenuhi aspek-aspek sebagai berikut: \n1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS dilakukan secara tepat, \n2) memiliki keterkaitan dengan hasil analisis capaian kinerja, \n3) merumuskan strategi pengembangan UPPS yang berkesesuaian",
                        '4' => "UPPS melakukan analisis SWOT atau analisis lain yang relevan, serta memenuhi aspek-aspek sebagai berikut: \n1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS dilakukan secara tepat, \n2) memiliki keterkaitan dengan hasil analisis capaian kinerja, \n3) merumuskan strategi pengembangan UPPS yang berkesesuaian, \n4) menghasilkan program-program pengembangan alternatif yang tepat.",
                    ]
                ]
            ],

            'Program Pengembangan' => [
                [
                    'code' => 'D.3',
                    'type' => 'option',
                    'question' => 'Ketepatan di dalam menetapkan prioritas program pengembangan.',
                    'choices' => [
                        '0' => 'UPPS tidak menetapkan prioritas program pengembangan.',
                        '1' => "UPPS menetapkan prioritas program pengembangan namun belum mempertimbangan secara komprehensif: \n1) kapasitas UPPS, \n2) kebutuhan UPPS dan PS, \n3) rencana strategis UPPS yang berlaku",
                        '2' => "UPPS menetapkan prioritas program pengembangan berdasarkan hasil analisis SWOT atau analisis lainnya yang mempertimbangkan secara komprehensif: \n1) kapasitas UPPS, \n2) kebutuhan UPPS dan PS di masa depan, \n3) rencana strategis UPPS yang berlaku",
                        '3' => "UPPS menetapkan prioritas program pengembangan berdasarkan hasil analisis SWOT atau analisis lainnya yang mempertimbangkan secara komprehensif: \n1) kapasitas UPPS, \n2) kebutuhan UPPS dan PS di masa depan, \n3) rencana strategis UPPS yang berlaku, \n4) aspirasi dari pemangku kepentingan internal.",
                        '4' => "UPPS menetapkan prioritas program pengembangan berdasarkan hasil analisis SWOT atau analisis lainnya yang mempertimbangkan secara komprehensif: \n1) kapasitas UPPS, \n2) kebutuhan UPPS dan PS di masa depan, \n3) rencana strategis UPPS yang berlaku, \n4) aspirasi dari pemangku kepentingan internal dan eksternal, serta 5) program yang menjamin keberlanjutan",
                    ]
                ]
            ],

            'Program Keberlanjutan' => [
                [
                    'code' => 'D.4',
                    'type' => 'option',
                    'question' => 'UPPS memiliki kebijakan, ketersediaan sumberdaya, kemampuan melaksanakan, dan kerealistikan program.',
                    'choices' => [
                        '0' => 'UPPS tidak memiliki kebijakan dan upaya untuk menjamin keberlanjutan program.',
                        '1' => 'UPPS memiliki kebijakan dan upaya namun belum cukup untuk menjamin keberlanjutan program.',
                        '2' => "UPPS memiliki kebijakan dan upaya untuk menjamin keberlanjutan program yang mencakup: \n1) alokasi sumber daya, \n2) kemampuan melaksanakan program pengembangan, \n3) rencana penjaminan mutu yang berkelanjutan.",
                        '3' => "UPPS memiliki kebijakan dan upaya yang diturunkan ke dalam berbagai peraturan untuk menjamin keberlanjutan program yang mencakup: \n1) alokasi sumber daya, \n2) kemampuan melaksanakan program pengembangan, \n3) rencana penjaminan mutu yang berkelanjutan.",
                        '4' => "UPPS memiliki kebijakan dan upaya yang diturunkan ke dalam berbagai peraturan untuk menjamin keberlanjutan program yang mencakup: \n1) alokasi sumber daya, \n2) kemampuan melaksanakan program pengembangan, \n3) rencana penjaminan mutu yang berkelanjutan, \n4) keberadaan dukungan pemangku kepentingan eksternal",
                    ]
                ]
            ]
        ]
    ];

    // Menampung nilai bobot dari setiap pertanyaan
    // 'code' => 'bobot'
    private $weights =
    [
        'A.1' => 1,
        'B.1' => 1,

        'IBIK-STD-01.1' => 0.51,
        'IBIK-STD-01.2' => 1.02,
        'IBIK-STD-01.3' => 1.53,

        'IBIK-STD-02.1A' => 0.34,
        'IBIK-STD-02.1B' => 0.34,
        'IBIK-STD-02.2A' => 0.34,
        'IBIK-STD-02.2B' => 0.34,
        'IBIK-STD-02.3' => 0.68,
        'IBIK-STD-02.4A' => 0.34,
        'IBIK-STD-02.4B' => 0.34,
        'IBIK-STD-02.5' => 0.68,
        'IBIK-STD-02.6' => 1.02,
        'IBIK-STD-02.7' => 1.36,
        'IBIK-STD-02.8' => 1.36,

        'IBIK-STD-03.1' => 4.60,
        'IBIK-STD-03.2A' => 3.07,
        'IBIK-STD-03.2B' => 3.07,
        'IBIK-STD-03.3A' => 1.53,
        'IBIK-STD-03.3B' => 1.53,

        'IBIK-STD-04.1' => 0.74,
        'IBIK-STD-04.2' => 0.99,
        'IBIK-STD-04.3' => 0.50,
        'IBIK-STD-04.4' => 0.50,
        'IBIK-STD-04.5' => 0.99,
        'IBIK-STD-04.6' => 0.25,
        'IBIK-STD-04.7' => 0.50,
        'IBIK-STD-04.8' => 0.81,
        'IBIK-STD-04.9' => 0.81,
        'IBIK-STD-04.10' => 0.41,
        'IBIK-STD-04.11' => 0.81,
        'IBIK-STD-04.12' => 0.81,
        'IBIK-STD-04.13' => 0.81,
        'IBIK-STD-04.14' => 2.23,
        'IBIK-STD-04.15A' => 1.12,
        'IBIK-STD-04.15B' => 1.12,

        'IBIK-STD-05.1' => 0.77,
        'IBIK-STD-05.2' => 0.77,
        'IBIK-STD-05.3' => 0.38,
        'IBIK-STD-05.4' => 0.38,
        'IBIK-STD-05.5' => 0.77,
        'IBIK-STD-05.6' => 3.07,

        'IBIK-STD-06.1A' => 2.51,
        'IBIK-STD-06.1B' => 2.51,
        'IBIK-STD-06.1C' => 2.51,
        'IBIK-STD-06.2' => 0.84,
        'IBIK-STD-06.3A' => 1.67,
        'IBIK-STD-06.3B' => 1.67,
        'IBIK-STD-06.4A' => 1.12,
        'IBIK-STD-06.4B' => 1.12,
        'IBIK-STD-06.4C' => 1.12,
        'IBIK-STD-06.4D' => 1.12,
        'IBIK-STD-06.4E' => 1.12,
        'IBIK-STD-06.5' => 0.56,
        'IBIK-STD-06.6' => 2.51,
        'IBIK-STD-06.7A' => 1.67,
        'IBIK-STD-06.7B' => 1.67,
        'IBIK-STD-06.7C' => 1.67,
        'IBIK-STD-06.8' => 1.67,
        'IBIK-STD-06.9' => 2.51,
        'IBIK-STD-06.10A' => 3.35,
        'IBIK-STD-06.10B' => 3.35,

        'IBIK-STD-07.1' => 1.53,
        'IBIK-STD-07.2' => 3.07,

        'IBIK-STD-08.1' => 0.51,
        'IBIK-STD-08.2' => 1.02,

        'IBIK-STD-09.1' => 1.92,
        'IBIK-STD-09.2' => 1.92,
        'IBIK-STD-09.3' => 2.88,
        'IBIK-STD-09.4' => 0.96,
        'IBIK-STD-09.5' => 1.92,
        'IBIK-STD-09.6' => 1.92,
        'IBIK-STD-09.7' => 1.92,
        'IBIK-STD-09.8' => 2.88,
        'IBIK-STD-09.9' => 2.88,
        'IBIK-STD-09.10' => 1.92,
        'IBIK-STD-09.11' => 1.92,
        'IBIK-STD-09.12' => 3.83,
        'IBIK-STD-09.13' => 2.88,
        'IBIK-STD-09.14' => 0.96,

        'D.1' => 1.50,
        'D.2' => 2.00,
        'D.3' => 1.50,
        'D.4' => 1.00,
    ];

    // Mengambil bobot berdasarkan kode pertanyaan
    public function getWeight($code)
    {
        return isset($this->weights[$code]) ? $this->weights[$code] : null;
    }

    public function getAllWeights()
    {
        return $this->weights;
    }

    // Mengembalikan semua pertanyaan yang sudah ditampung
    public function getAllQuestions()
    {
        return $this->questions;
    }

    public function flattenQuestions()
    {
        $flatquestions = [];
        foreach($this->questions as $criteriaKey => $criteria) {
            foreach($criteria as $subCriteriaKey => $subCriteria) {
                foreach($subCriteria as $question) {
                    $question['criteria'] = $criteriaKey;
                    $question['subCriteria'] = $subCriteriaKey;
                    $flatquestions[] = $question;
                }
            }
        }
        return $flatquestions;
    }

    // Mencari berdasarkan key
    public function where($key, $value)
    {
        $flatquestions = $this->flattenQuestions();
        return array_filter($flatquestions, function($question) use ($key, $value) {
            return isset($question[$key]) && $question[$key] == $value;
        });
    }

}
