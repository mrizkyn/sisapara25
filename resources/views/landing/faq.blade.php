@extends('layouts.user.main')
@section('title', '| FAQ')

@push('css')
    <style>
        .faq-container {
            padding-top: 60px;
            padding-left: 20px;
            padding-right: 20px;
            max-width: 1200px;
            margin: 100px auto 50px;
            padding-top: 70px;
            border-radius: 16px;
        }

        .accordion-item {
            border: none;
            border-bottom: 1px solid #e0e0e0;
        }

        .accordion-button {
            font-weight: 600;
            color: #016974;
            background-color: #f7f9fc;
            padding: 1rem 1.25rem;
            border-radius: 8px;
        }

        .accordion-button:not(.collapsed) {
            background-color: #016974;
            color: #fff;
            box-shadow: none;
        }

        .accordion-body {
            background-color: #fff;
            padding: 1rem 1.5rem;
            font-size: 15px;
            color: #444;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        h2.section-title {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
            color: #016974;
        }
    </style>
@endpush

@section('main-content')
    <div class="faq-container">
        <h2 class="section-title">❓ Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion" style="margin-bottom: 300px;"></div>
    </div>
@endsection

@push('script')
    <script>
        const faqData = [{
                question: "Bagaimana cara mengajukan reservasi fasilitas?",
                answer: "Klik menu 'Ajukan Reservasi' di dashboard kamu, lalu pilih fasilitas, tanggal, dan jam yang tersedia. Setelah itu, klik 'Kirim'."
            },
            {
                question: "Apa saja status dalam reservasi?",
                answer: `
                    <ul>
                        <li><strong>Pending:</strong> Permintaan dikirim, menunggu admin.</li>
                        <li><strong>Verified:</strong> Disetujui admin, menunggu superadmin.</li>
                        <li><strong>Approved:</strong> Disetujui sepenuhnya.</li>
                        <li><strong>Rejected:</strong> Permintaan ditolak.</li>
                    </ul>
                `
            },
            {
                question: "Apakah saya bisa edit reservasi yang sudah diajukan?",
                answer: "Tidak bisa. Jika ada kesalahan, kamu bisa batalkan lewat admin dan ajukan ulang."
            },
            {
                question: "Kapan reservasi saya dianggap aktif?",
                answer: "Setelah status berubah menjadi <strong>Approved</strong>. Sebelum itu, harap tunggu proses verifikasi dan persetujuan."
            },
            {
                question: "Apa yang harus saya bawa saat hadir ke lokasi?",
                answer: "Bawa bukti reservasi (tangkapan layar atau surat), serta patuhi jadwal dan aturan fasilitas."
            },
            {
                question: "Berapa lama proses verifikasi reservasi berlangsung?",
                answer: "Proses verifikasi biasanya memakan waktu maksimal 2x24 jam, tergantung antrean dan jadwal admin."
            },
            {
                question: "Apakah saya bisa reservasi untuk lebih dari satu jam?",
                answer: "Bisa, selama slot waktu tersebut masih tersedia. Sistem akan otomatis menolak jika bentrok dengan reservasi lain."
            },
            {
                question: "Apakah saya bisa melihat riwayat reservasi saya?",
                answer: "Bisa. Masuk ke akun kamu dan buka menu <strong>Reservasi</strong> untuk melihat data sebelumnya."
            },
            {
                question: "Apakah saya perlu mencetak surat reservasi?",
                answer: "Tidak wajib, cukup tunjukkan bukti reservasi digital. Tapi untuk acara resmi, sebaiknya cetak surat sebagai arsip."
            },
            {
                question: "Siapa yang bisa membuat reservasi?",
                answer: "Semua pengguna terdaftar bisa melakukan reservasi, selama memenuhi syarat dan ketentuan yang berlaku."
            },
            {
                question: "Apakah saya bisa ajukan reservasi di hari yang sama?",
                answer: "Reservasi minimal dilakukan <strong>1 hari sebelumnya</strong>. Reservasi mendadak tidak dijamin disetujui."
            },
            {
                question: "Apakah bisa ajukan lebih dari satu reservasi dalam satu hari?",
                answer: "Bisa, selama tidak ada konflik waktu dan kapasitas fasilitas masih memungkinkan."
            },
        ];

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('faqAccordion');
            faqData.forEach((item, index) => {
                const faqItem = document.createElement('div');
                faqItem.classList.add('accordion-item');

                faqItem.innerHTML = `
                    <h2 class="accordion-header" id="heading${index}">
                        <button class="accordion-button ${index !== 0 ? 'collapsed' : ''}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="${index === 0}" aria-controls="collapse${index}">
                            ${item.question}
                        </button>
                    </h2>
                    <div id="collapse${index}" class="accordion-collapse collapse ${index === 0 ? 'show' : ''}" aria-labelledby="heading${index}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            ${item.answer}
                        </div>
                    </div>
                `;

                container.appendChild(faqItem);
            });
        });
    </script>
@endpush
