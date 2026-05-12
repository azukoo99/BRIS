@extends('layouts.app')

@section('title', 'CV. Benih Rakyat - Benih Unggul Terpercaya untuk Ketahanan Pangan')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION                                 --}}
{{-- ============================================ --}}
<section id="hero" class="relative min-h-[90vh] flex items-center overflow-hidden">
    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-bg.png') }}" alt="Sawah Indonesia" class="w-full h-full object-cover">
        <div class="hero-overlay absolute inset-0"></div>
    </div>

    {{-- Decorative Elements --}}
    <div class="absolute top-20 right-10 w-72 h-72 bg-secondary-light/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 left-10 w-96 h-96 bg-gold/10 rounded-full blur-3xl"></div>

    {{-- Content --}}
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-3xl">
            {{-- Badge --}}
            <div class="fade-up inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-8">
                <span class="w-2 h-2 rounded-full bg-secondary-light animate-pulse"></span>
                <span class="text-xs font-medium text-white/90 tracking-wide">Komitmen Kami untuk Pertanian Indonesia</span>
            </div>

            {{-- Heading --}}
            <h1 class="fade-up fade-up-delay-1 text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                Fokus pada kualitas produksi benih dan
                <span class="text-secondary-light">kesejahteraan mitra</span>
            </h1>

            {{-- Subtitle --}}
            <p class="fade-up fade-up-delay-2 text-lg text-white/70 leading-relaxed mb-10 max-w-xl">
                Mulai bergabung dengan kami dan mulai transformasi panen yang berkualitas. Penyedia benih unggul yang terpercaya dan berdaya saing.
            </p>

            {{-- CTA Buttons --}}
            <div class="fade-up fade-up-delay-3 flex flex-wrap gap-4">
                <a href="#produk" class="pulse-ring inline-flex items-center gap-2 px-8 py-4 bg-white text-primary font-semibold rounded-2xl hover:bg-surface transition-all duration-300 shadow-xl shadow-black/10" id="hero-cta-produk">
                    Lihat Produk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#tentang" class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300" id="hero-cta-tentang">
                    Tentang Kami
                </a>
            </div>
        </div>

        {{-- Stats Bar --}}
        <div class="fade-up fade-up-delay-4 mt-16 grid grid-cols-3 gap-4 max-w-xl">
            <div class="text-center p-4 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10">
                <div class="text-3xl sm:text-4xl font-bold text-white mb-1">
                    <span data-count="32" data-suffix="+">0+</span>
                </div>
                <p class="text-xs sm:text-sm text-white/60">Tahun</p>
            </div>
            <div class="text-center p-4 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10">
                <div class="text-3xl sm:text-4xl font-bold text-white mb-1">
                    <span data-count="300" data-suffix="+">0+</span>
                </div>
                <p class="text-xs sm:text-sm text-white/60">Pelanggan</p>
            </div>
            <div class="text-center p-4 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10">
                <div class="text-3xl sm:text-4xl font-bold text-white mb-1">
                    <span data-count="100" data-suffix="%">0%</span>
                </div>
                <p class="text-xs sm:text-sm text-white/60">Kepuasan</p>
            </div>
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- TENTANG KAMI SECTION                         --}}
{{-- ============================================ --}}
<section id="tentang" class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="fade-up inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider rounded-full mb-4">Tentang Kami</span>
            <h2 class="fade-up fade-up-delay-1 text-3xl sm:text-4xl lg:text-5xl font-bold text-dark mb-6">
                Solusi Benih Unggul untuk<br>
                <span class="text-gradient">Pertanian Berkelanjutan</span> Indonesia
            </h2>
            <p class="fade-up fade-up-delay-2 text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Memproduksi dan mendistribusikan benih padi dan jagung unggul bermutu tinggi. Kami berkomitmen menyediakan benih berdaya hasil tinggi, tahan hama, dan adaptif.
            </p>
        </div>

        {{-- Content Grid --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Image Side --}}
            <div class="fade-up relative">
                <div class="rounded-3xl overflow-hidden shadow-2xl shadow-primary/10">
                    <img src="{{ asset('images/about-bg.png') }}" alt="Pertanian Indonesia" class="w-full h-80 lg:h-[450px] object-cover">
                </div>
                {{-- Floating BPSB Badge --}}
                <div class="absolute -bottom-6 left-6 sm:left-auto sm:right-6 bg-white rounded-2xl shadow-xl px-5 py-4 border border-gray-100">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-bpsbp.svg') }}" alt="BPSB" class="h-10 w-auto">
                        <div>
                            <p class="text-sm font-bold text-dark">Tersertifikasi</p>
                            <p class="text-xs text-gray-500">BPSB Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Features Side --}}
            <div class="space-y-6">
                {{-- Feature 1 --}}
                <div class="fade-up card-hover bg-white rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-start gap-4">
                        <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-2">Benih Unggul Berkualitas</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Menyediakan benih unggul berdaya hasil tinggi, tahan hama, dan adaptif terhadap berbagai lingkungan.</p>
                        </div>
                    </div>
                </div>

                {{-- Feature 2 --}}
                <div class="fade-up fade-up-delay-1 card-hover bg-white rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-start gap-4">
                        <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-2">Model Kemitraan</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Bekerja sama dengan penangkar lokal, petani mitra, dan petani pengembang varietas lokal.</p>
                        </div>
                    </div>
                </div>

                {{-- Feature 3 --}}
                <div class="fade-up fade-up-delay-2 card-hover bg-white rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-start gap-4">
                        <div class="feature-icon w-12 h-12 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-2">Fokus pada Inovasi dan Adaptasi</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Aktif mengembangkan dan memperbaiki varietas lokal unggul (inbrida) dan hibrida.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- PRODUK SECTION                               --}}
{{-- ============================================ --}}
<section id="produk" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <span class="fade-up inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider rounded-full mb-4">Produk</span>
            <h2 class="fade-up fade-up-delay-1 text-3xl sm:text-4xl lg:text-5xl font-bold text-dark mb-6">
                Produk Benih Pertanian Unggul<br>
                <span class="text-gradient">Selalu Hadir</span> Untukmu
            </h2>
            <p class="fade-up fade-up-delay-2 text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Dapatkan jaminan kualitas benih bersertifikasi BPSB. Produk kami dirancang tahan hama dan adaptif untuk berbagai kondisi lingkungan.
            </p>
        </div>

        {{-- Products Grid --}}
        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            @forelse($produks->take(2) as $index => $p)
            <div class="fade-up {{ $index > 0 ? 'fade-up-delay-1' : '' }} card-hover group bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
                <div class="relative overflow-hidden bg-gray-50">
                    <img src="{{ $p->gambar ? asset($p->gambar) : (strtolower($p->kategori) == 'jagung' ? asset('images/product-jagung.png') : asset('images/product-padi.png')) }}" alt="{{ $p->nama }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 {{ strtolower($p->kategori) == 'jagung' ? 'bg-gold' : 'bg-primary' }} text-white text-xs font-semibold rounded-full">{{ ucfirst($p->kategori ?? 'Produk') }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-dark mb-3">{{ $p->nama }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-5 line-clamp-2">
                        {{ $p->deskripsi }}
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="/produk?role={{ $role }}" class="flex-1 inline-flex items-center justify-center gap-2 py-3 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-light transition-all duration-200 hover:shadow-lg hover:shadow-primary/20">
                            Lihat Produk
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center text-gray-500 py-8">
                Belum ada produk unggulan.
            </div>
            @endforelse
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- TESTIMONIAL SECTION                          --}}
{{-- ============================================ --}}
<section id="testimonial" class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-12 gap-6">
            <div>
                <span class="fade-up inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider rounded-full mb-4">Testimonial</span>
                <h2 class="fade-up fade-up-delay-1 text-3xl sm:text-4xl font-bold text-dark">
                    Cerita Sukses dari<br><span class="text-gradient">Klien Kami</span>
                </h2>
            </div>
            {{-- Navigation Arrows --}}
            <div class="fade-up flex gap-3">
                <button id="testimonial-prev" class="w-12 h-12 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-200" aria-label="Sebelumnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button id="testimonial-next" class="w-12 h-12 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-200" aria-label="Selanjutnya">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- Carousel --}}
        <div class="overflow-hidden rounded-2xl">
            <div id="testimonial-track" class="testimonial-track">
                {{-- Testimonial 1 --}}
                <div class="testimonial-card">
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full shadow-sm">
                        {{-- Stars --}}
                        <div class="flex gap-1 mb-5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        {{-- Quote --}}
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-sm">
                            <span class="text-2xl text-primary/20 font-serif">"</span>
                            Kualitas Benih Padi Beres 05 ini benar-benar stabil. Hasil panennya selalu melimpah, dan yang paling penting, pertumbuhannya seragam. Sertifikasi BPSB-nya membuat saya yakin menjualnya ke petani lain.
                        </blockquote>
                        {{-- Author --}}
                        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center">
                                <span class="text-sm font-bold text-primary">BA</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">Bunga Amalia</p>
                                <p class="text-xs text-gray-400">PT Beras Makmur</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="testimonial-card">
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full shadow-sm">
                        <div class="flex gap-1 mb-5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-sm">
                            <span class="text-2xl text-primary/20 font-serif">"</span>
                            Klien kami puas sekali dengan Benih Jagung T-Rex. Kemurnian genetiknya terjaga, tidak ada variasi aneh. Benih ini adaptif, sehingga permintaan dari berbagai daerah stabil tinggi.
                        </blockquote>
                        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-full bg-secondary/10 flex items-center justify-center">
                                <span class="text-sm font-bold text-secondary">EG</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">Eko Gustiwana</p>
                                <p class="text-xs text-gray-400">PT Indonesia Maju</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div class="testimonial-card">
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full shadow-sm">
                        <div class="flex gap-1 mb-5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-sm">
                            <span class="text-2xl text-primary/20 font-serif">"</span>
                            Dulu sering was-was karena serangan hama. Tapi setelah pakai benih dari CV. Benih Rakyat, padinya lebih kuat dan tahan penyakit. Produktivitas sawah tadah hujan saya jadi jauh lebih maksimal.
                        </blockquote>
                        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-full bg-gold/10 flex items-center justify-center">
                                <span class="text-sm font-bold text-gold">ZA</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">Zahra Anggun</p>
                                <p class="text-xs text-gray-400">Petani Mitra, Sumatera Barat</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 4 --}}
                <div class="testimonial-card">
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full shadow-sm">
                        <div class="flex gap-1 mb-5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-sm">
                            <span class="text-2xl text-primary/20 font-serif">"</span>
                            Sudah 5 tahun bermitra dengan CV. Benih Rakyat dan hasilnya selalu konsisten. Benih padi Beres 05 memberikan hasil panen yang luar biasa setiap musim tanam.
                        </blockquote>
                        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-full bg-accent/10 flex items-center justify-center">
                                <span class="text-sm font-bold text-accent">RS</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">Rudi Santoso</p>
                                <p class="text-xs text-gray-400">Petani Mitra, Jawa Timur</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 5 --}}
                <div class="testimonial-card">
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full shadow-sm">
                        <div class="flex gap-1 mb-5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-sm">
                            <span class="text-2xl text-primary/20 font-serif">"</span>
                            Sebagai distributor, kami sangat mengandalkan kualitas benih dari Benih Rakyat. Pelanggan kami tidak pernah komplain, dan repeat order selalu tinggi setiap musim.
                        </blockquote>
                        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-full bg-primary-light/10 flex items-center justify-center">
                                <span class="text-sm font-bold text-primary-light">DW</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">Dewi Wulandari</p>
                                <p class="text-xs text-gray-400">CV Tani Subur Makmur</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 6 --}}
                <div class="testimonial-card">
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full shadow-sm">
                        <div class="flex gap-1 mb-5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-sm">
                            <span class="text-2xl text-primary/20 font-serif">"</span>
                            Benih Jagung T-Rex memang juara! Tongkolnya besar-besar dan biji padat. Hasil panen saya meningkat hampir 40% dibanding varietas sebelumnya. Sangat direkomendasikan.
                        </blockquote>
                        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-full bg-gold/10 flex items-center justify-center">
                                <span class="text-sm font-bold text-gold">AH</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-dark">Ahmad Hidayat</p>
                                <p class="text-xs text-gray-400">Petani, Nusa Tenggara Barat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dots --}}
        <div class="flex justify-center gap-2 mt-8">
            <button class="testimonial-dot w-8 h-3 rounded-full bg-primary transition-all duration-300" aria-label="Slide 1"></button>
            <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 transition-all duration-300" aria-label="Slide 2"></button>
            <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 transition-all duration-300" aria-label="Slide 3"></button>
            <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 transition-all duration-300" aria-label="Slide 4"></button>
            <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 transition-all duration-300" aria-label="Slide 5"></button>
            <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 transition-all duration-300" aria-label="Slide 6"></button>
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- INVESTOR SECTION                             --}}
{{-- ============================================ --}}
<section id="investor" class="relative py-24 overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/investor-bg.png') }}" alt="Investor" class="w-full h-full object-cover">
        <div class="investor-gradient absolute inset-0"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left Content --}}
            <div>
                <span class="fade-up inline-block px-4 py-1.5 bg-white/10 text-white text-xs font-semibold uppercase tracking-wider rounded-full mb-4 backdrop-blur-sm border border-white/20">Investor</span>
                <h2 class="fade-up fade-up-delay-1 text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                    Investasi di Masa Depan<br>Pertanian Indonesia
                </h2>
                <p class="fade-up fade-up-delay-2 text-white/70 leading-relaxed mb-8 max-w-lg">
                    Informasi terbaru mengenai kinerja keuangan, dan komitmen kami dalam menciptakan nilai berkelanjutan di sektor agribisnis benih unggul.
                </p>
                <a href="#" class="fade-up fade-up-delay-3 inline-flex items-center gap-2 px-8 py-4 bg-white text-primary font-semibold rounded-2xl hover:bg-surface transition-all duration-300 shadow-xl shadow-black/10" id="investor-cta">
                    Lihat Detail Informasi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Right Stats --}}
            <div class="grid grid-cols-2 gap-5">
                <div class="fade-up bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center">
                    <div class="text-4xl font-bold text-white mb-2">
                        <span data-count="30" data-suffix="%">0%</span>
                    </div>
                    <p class="text-sm text-white/60">Saham</p>
                    <p class="text-xs text-white/40 mt-1">Return on Investment</p>
                </div>
                <div class="fade-up fade-up-delay-1 bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center">
                    <div class="text-xl sm:text-2xl font-bold text-white mb-2">Rp 100.000.000</div>
                    <p class="text-sm text-white/60">Lab</p>
                    <p class="text-xs text-white/40 mt-1">Labelisasi</p>
                </div>
                <div class="fade-up fade-up-delay-2 bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 text-center col-span-2">
                    <div class="text-2xl sm:text-3xl font-bold text-white mb-2">Rp 100.000.000</div>
                    <p class="text-sm text-white/60">Operasional</p>
                    <p class="text-xs text-white/40 mt-1">Total dana operasional tahunan</p>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- CTA SECTION                                  --}}
{{-- ============================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="fade-up text-3xl sm:text-4xl font-bold text-dark mb-5">
            Siap Bergabung Bersama Kami?
        </h2>
        <p class="fade-up fade-up-delay-1 text-gray-500 max-w-xl mx-auto leading-relaxed mb-8">
            Hubungi kami untuk informasi lebih lanjut mengenai kemitraan, investasi, dan dampak positif yang kami ciptakan.
        </p>
        <div class="fade-up fade-up-delay-2 flex flex-wrap justify-center gap-4">
            <a href="mailto:cvbenihrakyat@gmail.com" class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white font-semibold rounded-2xl hover:bg-primary-light transition-all duration-300 hover:shadow-xl hover:shadow-primary/20" id="cta-hubungi">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Hubungi Kami
            </a>
            <a href="https://wa.me/6282338979023" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 bg-green-600 text-white font-semibold rounded-2xl hover:bg-green-700 transition-all duration-300 hover:shadow-xl hover:shadow-green-600/20" id="cta-whatsapp">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Google Fonts - Inter */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');


    /* Text gradient */
    .text-gradient {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Hero overlay */
    .hero-overlay {
        background: linear-gradient(
            135deg,
            rgba(15, 41, 34, 0.88) 0%,
            rgba(27, 67, 50, 0.75) 40%,
            rgba(45, 106, 79, 0.6) 100%
        );
    }

    /* Section fade-in animation */
    .fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-up-delay-1 { transition-delay: 0.1s; }
    .fade-up-delay-2 { transition-delay: 0.2s; }
    .fade-up-delay-3 { transition-delay: 0.3s; }
    .fade-up-delay-4 { transition-delay: 0.4s; }

    /* Stat counter animation */
    .stat-number {
        display: inline-block;
    }

    /* Card hover lift */
    .card-hover {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(27, 67, 50, 0.12);
    }

    /* Testimonial carousel */
    .testimonial-track {
        display: flex;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .testimonial-card {
        min-width: 100%;
        padding: 0 1rem;
    }

    @media (min-width: 768px) {
        .testimonial-card {
            min-width: 50%;
        }
    }

    @media (min-width: 1024px) {
        .testimonial-card {
            min-width: 33.333%;
        }
    }


    /* Feature icon container */
    .feature-icon {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    }

    /* Pulse animation for CTA */
    .pulse-ring {
        animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }

    @keyframes pulse-ring {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(27, 67, 50, 0.4);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 12px rgba(27, 67, 50, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(27, 67, 50, 0);
        }
    }

    /* Gradient border */
    .gradient-border {
        position: relative;
    }

    .gradient-border::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-secondary-light), var(--color-gold));
        border-radius: 3px 3px 0 0;
    }

    /* Investor section gradient */
    .investor-gradient {
        background: linear-gradient(
            135deg,
            rgba(15, 41, 34, 0.92) 0%,
            rgba(27, 67, 50, 0.85) 50%,
            rgba(45, 106, 79, 0.78) 100%
        );
    }
</style>
@endpush

@push('scripts')
<script>
    // ========================================
    // Benih Rakyat - Main JavaScript
    // ========================================

    document.addEventListener('DOMContentLoaded', () => {
        initScrollAnimations();
        initTestimonialCarousel();
        initStatCounters();
    });


    // ----------------------------------------
    // Scroll Animations - IntersectionObserver
    // ----------------------------------------
    function initScrollAnimations() {
        const elements = document.querySelectorAll('.fade-up');
        if (elements.length === 0) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            }
        );

        elements.forEach(el => observer.observe(el));
    }

    // ----------------------------------------
    // Testimonial Carousel
    // ----------------------------------------
    function initTestimonialCarousel() {
        const track = document.getElementById('testimonial-track');
        const prevBtn = document.getElementById('testimonial-prev');
        const nextBtn = document.getElementById('testimonial-next');
        const dots = document.querySelectorAll('.testimonial-dot');

        if (!track || !prevBtn || !nextBtn) return;

        let currentIndex = 0;
        const cards = track.querySelectorAll('.testimonial-card');
        const totalCards = cards.length;

        function getVisibleCount() {
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 768) return 2;
            return 1;
        }

        function getMaxIndex() {
            return Math.max(0, totalCards - getVisibleCount());
        }

        function updateCarousel() {
            const visibleCount = getVisibleCount();
            const maxIndex = getMaxIndex();
            const percentage = (100 / visibleCount) * currentIndex;
            track.style.transform = `translateX(-${percentage}%)`;

            // Show only relevant dots (maxIndex + 1)
            dots.forEach((dot, i) => {
                if (i <= maxIndex) {
                    dot.style.display = '';
                    dot.classList.toggle('bg-primary', i === currentIndex);
                    dot.classList.toggle('bg-gray-300', i !== currentIndex);
                    dot.classList.toggle('w-8', i === currentIndex);
                    dot.classList.toggle('w-3', i !== currentIndex);
                } else {
                    dot.style.display = 'none';
                }
            });

            // Update button states
            prevBtn.classList.toggle('opacity-40', currentIndex === 0);
            prevBtn.classList.toggle('cursor-not-allowed', currentIndex === 0);
            nextBtn.classList.toggle('opacity-40', currentIndex >= maxIndex);
            nextBtn.classList.toggle('cursor-not-allowed', currentIndex >= maxIndex);
        }

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentIndex < getMaxIndex()) {
                currentIndex++;
                updateCarousel();
            }
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                currentIndex = Math.min(i, getMaxIndex());
                updateCarousel();
            });
        });

        // Auto-play
        let autoPlay = setInterval(() => {
            if (currentIndex >= getMaxIndex()) {
                currentIndex = 0;
            } else {
                currentIndex++;
            }
            updateCarousel();
        }, 5000);

        // Pause on hover
        track.addEventListener('mouseenter', () => clearInterval(autoPlay));
        track.addEventListener('mouseleave', () => {
            autoPlay = setInterval(() => {
                if (currentIndex >= getMaxIndex()) {
                    currentIndex = 0;
                } else {
                    currentIndex++;
                }
                updateCarousel();
            }, 5000);
        });

        // Handle resize
        window.addEventListener('resize', () => {
            currentIndex = Math.min(currentIndex, getMaxIndex());
            updateCarousel();
        });

        updateCarousel();
    }

    // ----------------------------------------
    // Stat Counter Animation
    // ----------------------------------------
    function initStatCounters() {
        const counters = document.querySelectorAll('[data-count]');
        if (counters.length === 0) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.5 }
        );

        counters.forEach(el => observer.observe(el));
    }

    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-count'));
        const suffix = el.getAttribute('data-suffix') || '';
        const prefix = el.getAttribute('data-prefix') || '';
        const duration = 2000;
        const start = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - start;
            const progress = Math.min(elapsed / duration, 1);

            // Ease out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(eased * target);

            el.textContent = prefix + current + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }
</script>
@endpush

@endsection
