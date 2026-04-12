<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Note::firstOrCreate([
            'content' => '<p>Rapat tim hari ini sangat produktif. Kami membahas roadmap produk untuk quarter selanjutnya dan menetapkan prioritas fitur-fitur baru yang akan dikembangkan. Tim engineering siap untuk memulai sprint baru minggu depan dengan target penyelesaian dua fitur utama.</p><p>Hasil keputusan rapat: prioritas pertama adalah peningkatan performa database, diikuti dengan integrasi API pihak ketiga, dan enhancement UI untuk mobile interface. Semua tim sudah mendapat task breakdown dan timeline yang jelas.</p>',
            'tags' => 'meeting, roadmap, sprint',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Belajar Laravel 12 sangat menyenangkan terutama dengan fitur-fitur baru seperti pendefinisian middleware langsung di bootstrap/app.php. Struktur folder yang lebih streamlined membuat navigasi project jauh lebih mudah dibanding versi sebelumnya. Dokumentasi resmi juga sangat lengkap dan mudah dipahami.</p><p>Sudah mencoba membuat REST API sederhana dan semua berjalan lancar. Route definitions lebih clean, controller lebih ringkas, dan eloquent queries jauh lebih powerful. Akan menggunakan Laravel 12 untuk semua project baru ke depannya.</p>',
            'tags' => 'laravel, php, belajar, backend',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Ide untuk fitur baru dashboard analytics yang menampilkan grafik real-time user activity. Dashboard akan menampilkan berbagai metrik penting seperti active users, registration trend, dan user engagement metrics dalam bentuk chart yang interaktif dan mudah dipahami.</p><p>Implementasi akan menggunakan Chart.js untuk visualisasi dan WebSocket untuk real-time updates. Backend perlu dioptimasi untuk handle banyak concurrent connections. Timeline estimasi dua minggu untuk development dan testing sebelum deployment ke production.</p>',
            'tags' => 'fitur, dashboard, analytics',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Catatan debugging issue di production server yang menyebabkan response time melambat drastis. Setelah investigasi mendalam, ditemukan bahwa query database tidak menggunakan proper indexing pada table users. Dengan menambahkan index pada kolom email dan status, response time berkurang 80%.</p><p>Pelajaran penting: selalu gunakan debugger tools seperti Laravel Debugbar dan database profiler untuk mengidentifikasi bottleneck. Query optimization adalah aspek kritis dalam scaling aplikasi. Planning untuk setup monitoring proaktif menggunakan APM tools di quarter depan.</p>',
            'tags' => 'debugging, performance, database',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Desain UI baru untuk halaman login sudah selesai dan siap untuk implementasi. Menggunakan modern design patterns dengan gradient background, smooth interactions, dan better form validation feedback. Design sudah di-review oleh tim UX dan mendapat approval dari product manager.</p><p>Implementasi akan menggunakan Tailwind CSS untuk styling dan Alpine.js untuk interaktifitas. Password strength indicator akan membantu user membuat password yang lebih aman. Estimasi development time adalah tiga hari untuk completion dan testing.</p>',
            'tags' => 'design, frontend, ui/ux',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Testing strategy untuk aplikasi sudah didiskusikan bersama QA team. Kami akan mengimplementasikan three-tier testing: unit tests untuk business logic, integration tests untuk API endpoints, dan end-to-end tests untuk user workflows. Target coverage adalah 85% minimum untuk critical paths.</p><p>Tools yang akan digunakan adalah PHPUnit untuk unit testing, Pest untuk feature testing, dan Cypress untuk E2E testing. Setiap developer wajib menulis test sebelum merge ke main branch. CI/CD pipeline akan otomatis run semua tests dan tidak izinkan merge jika ada test yang failed.</p>',
            'tags' => 'testing, qa, ci/cd',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Dokumentasi API sudah diperbarui dengan endpoint baru untuk analytics dan reporting. Setiap endpoint dilengkapi dengan request/response examples, possible error codes, dan rate limiting information. OpenAPI specification juga sudah di-generate secara otomatis dari code menggunakan Laravel API documentation generator.</p><p>Dokumentasi tersedia di format HTML yang responsive dan mudah dicari. Ada juga download option untuk Postman collection dan OpenAPI JSON file untuk integrasi dengan tools lain. Developer eksternal sudah dapat mulai mengintegrasikan API tanpa perlu bertanya kepada tim kami.</p>',
            'tags' => 'dokumentasi, api, developer',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Security audit telah dilakukan oleh third-party security firm dan hasilnya sangat positif. Tidak ada critical vulnerabilities yang ditemukan. Beberapa minor issues seperti missing security headers sudah di-fix dan di-verify ulang. Aplikasi sudah siap untuk production dengan confidence level tinggi.</p><p>Rekomendasi dari auditor: lakukan penetration testing quarterly dan keep dependencies selalu updated. Sudah setup automated vulnerability scanning menggunakan GitHub Dependabot. Training security awareness untuk semua team member juga dijadwalkan bulan depan.</p>',
            'tags' => 'security, audit, compliance',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Database migration strategy untuk upgrade dari MySQL 5.7 ke MySQL 8.0 sudah direncanakan. Migration akan dilakukan di staging environment terlebih dahulu untuk memastikan semua query compatible dengan versi baru. Backup strategi sudah disiapkan dan disaster recovery plan sudah di-test.</p><p>Timeline: migration dijalankan saat traffic rendah yaitu jam 2-4 pagi. Expected downtime kurang dari 15 menit. Semua aplikasi sudah diupdate dependency untuk ensure compatibility. Post-migration testing akan dilakukan untuk 24 jam sebelum komunikasi resmi ke customers.</p>',
            'tags' => 'database, infrastructure, devops',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Brainstorming session untuk mobile app menghasilkan banyak ide-ide menarik. Kami akan develop native apps untuk iOS dan Android menggunakan Flutter karena code sharing dan fast development cycle. MVP akan include core features seperti view notes, create note, dan search dengan push notification support.</p><p>Design sudah mulai dikerjakan dan akan selesai minggu depan. Development timeline adalah dua bulan untuk MVP. Beta testing akan dilakukan dengan selected users sebelum public launch. Marketing campaign juga sudah mulai dipersiapkan untuk maksimalkan adoption di launch day.</p>',
            'tags' => 'mobile, flutter, product',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Performance optimization project menghasilkan significant improvement di page load time. Dengan mengimplementasikan caching strategy yang proper, lazy loading untuk images, dan code splitting, page load time berkurang dari 5 detik menjadi 1.5 detik. Core Web Vitals scores juga meningkat drastis.</p><p>Optimization techniques yang digunakan: Redis caching untuk database queries, CDN untuk static assets, service worker untuk offline support, dan database query optimization. Monitoring setup menggunakan appropriate tools untuk track metrics dari time. ROI dari optimization ini sangat tinggi dalam terms of user experience dan conversion rate improvement.</p>',
            'tags' => 'performance, optimization, frontend',
        ]);

        Note::firstOrCreate([
            'content' => '<p>DevOps infrastructure sudah di-upgrade dengan containerization menggunakan Docker dan orchestration dengan Kubernetes. Semua services sekarang running di containerized environment yang memberikan better resource utilization dan easier deployment. Auto-scaling sudah dikonfigurasi berdasarkan CPU dan memory metrics.</p><p>Dengan infrastructure baru ini, deployment time berkurang dari 30 menit menjadi 5 menit. Rollback juga jauh lebih cepat karena previous versions tersimpan dalam registry. Infrastructure as Code practice sudah diterapkan sehingga reproducible environment di berbagai stages. Cost optimization juga achieved dengan lebih efisien.</p>',
            'tags' => 'devops, docker, kubernetes',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Customer feedback session memberikan insights berharga tentang user behavior dan pain points. Majority users mencari fitur untuk collaborate di notes, sharing dengan team, dan better organization dengan nested folders structure. Feedback ini akan menjadi input untuk product roadmap quarter depan.</p><p>Dari 50 respondents, 80% satisfied dengan current features tetapi 70% minta collaboration features. Net Promoter Score meningkat 15 points dibanding last quarter. Akan conduct follow-up interviews untuk deeper understanding tentang collaboration use cases sebelum mulai development.</p>',
            'tags' => 'feedback, product, user research',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Training session untuk team tentang clean code principles dan design patterns sangat helpful. Seluruh team members understand tentang SOLID principles, design patterns seperti Factory dan Observer, dan code refactoring best practices. Quiz di akhir session menunjukkan excellent understanding dari semua peserta.</p><p>Outcome dari training: code review process akan lebih ketat focusing pada code cleanliness, semua new code harus follow established conventions, dan technical debt akan di-track dan reduced gradually. Mentoring program juga di-setup untuk junior developers dengan pairing sessions regular basis.</p>',
            'tags' => 'training, engineering culture, development',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Release notes untuk version 2.0 sudah disiapkan dengan detailed changelog mencakup 50+ improvements dan bug fixes. Major features di release ini adalah: new dashboard, collaboration support limited beta, dan improved mobile experience. Breaking changes sudah di-highlight dengan migration guide untuk affected users.</p><p>Release hari Jumat pukul 10 pagi dengan full support team standby. Gradual rollout akan dilakukan: 10% users hari pertama, 50% hari kedua, 100% hari ketiga. Monitoring setup untuk track any issues. Release celebration planned dengan team untuk appreciate hard work dari semua orang.</p>',
            'tags' => 'release, version2, launch',
        ]);

        Note::firstOrCreate([
            'content' => '<p>Year-end retrospective meeting menghasilkan positive results review dengan significant achievements. Revenue target tercapai 120%, user base grow 150%, product stability improved dengan 99.9% uptime. Team also improved collaboration dan communication patterns yang noticed dari positive feedback dari internal surveys.</p><p>Planning untuk next year sudah started dengan ambitious goals: expand to three markets baru, launch mobile app, dan hire 10 additional team members. Investment dalam education dan infrastructure juga ditingkatkan untuk support growth. Team very excited dengan prospects dan ready untuk bigger challenges di tahun depan.</p>',
            'tags' => 'retrospective, planning, company',
        ]);
    }
}
