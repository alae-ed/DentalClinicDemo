@extends('layouts.app')
@section('content')
    <div id="chat-toggle"
        class="fixed bottom-6 right-6 z-[102] bg-gradient-to-r from-cyan-500 to-sky-500 text-white p-4 rounded-full shadow-lg cursor-pointer hover:scale-105 transition">
        🤖
    </div>

    <div id="chat-popup"
        class="fixed bottom-24 right-6 w-[420px] bg-white border border-gray-300 rounded-xl shadow-2xl z-[101] hidden flex flex-col overflow-hidden">
        <div class="bg-gradient-to-r from-cyan-600 to-sky-600 text-white p-4 flex justify-between items-center">
            <span class="font-bold">{{ __('messages.AI_assistant') }}</span>
            <button id="chat-close" class=" text-white hover:text-gray-200 text-xl font-bold">×</button>
        </div>
        <div id="chat-box" class="p-4 h-[460px] overflow-y-auto space-y-2 text-sm"></div>
        <div id="category-buttons" class="p-2 border-t border-gray-200 grid grid-cols-2 gap-2 text-center text-sm">
            <button class="control-btn" data-category="services">الخدمات</button>
            <button class="control-btn" data-category="booking">الحجوزات</button>
            <button class="control-btn" data-category="location">الموقع</button>
            <button class="control-btn" data-category="general">أسئلة عامة</button>
        </div>
        <div id="question-buttons" class="p-2 border-t border-gray-200 grid grid-cols-1 gap-2 text-center text-sm hidden">
        </div>
    </div>

    <nav class="sticky-nav p-4">
        <div
            class="container mx-auto flex {{ app()->getLocale() == 'ar' ? 'flex-row-reverse' : 'flex-row' }} justify-between items-center flex-wrap">

            <a href="#" class="nav-link text-2xl font-bold mb-2 md:mb-0">
                {{ __('messages.clinic_name') }}
            </a>

            <div class="flex items-center gap-x-4">
                <button id="toggleDark" class="nav-link">🌙</button>
                <button id="mobileBtn" class="nav-link md:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div class="hidden md:flex flex-wrap gap-x-6 {{ app()->getLocale() == 'ar' ? 'text-right' : 'text-left' }}">
                <a href="#welcome" class="nav-link nav-link-main hover:text-blue-200 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-xs">{{ __('messages.home') }}</span>
                </a>

                <a href="#services" class="nav-link nav-link-main hover:text-blue-200 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4c-3.866 0-7 3.134-7 7s3.134 7 7 7c2.164 0 4.1-1.026 5.37-2.618M12 4v11m0 0v5m0-5h4m-4 0H8m4 0a7.001 7.001 0 01-4-4" />
                    </svg>
                    <span class="text-xs">{{ __('messages.our_distinguished_services') }}</span>
                </a>

                <a href="#gallery" class="nav-link nav-link-main hover:text-blue-200 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-xs">{{ __('messages.gallery') }}</span>
                </a>

                <a href="#testimonials" class="nav-link nav-link-main hover:text-blue-200 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="text-xs">{{ __('messages.testimonials') }}</span>
                </a>

                <a href="#about-us" class="nav-link nav-link-main hover:text-blue-200 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs">{{ __('messages.about_us') }}</span>
                </a>

                <a href="#contact" class="nav-link nav-link-main hover:text-blue-200 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-xs">{{ __('messages.contact_us') }}</span>
                </a>
            </div>
        </div>

        <div id="mobileMenu"
            class="hidden md:hidden flex-col space-y-2 pt-4 w-full {{ app()->getLocale() == 'ar' ? 'text-right pr-4' : 'text-left pl-4' }}">
            <a href="#welcome" class="nav-link block hover:text-blue-200">{{ __('messages.home') }}</a>
            <a href="#services"
                class="nav-link block hover:text-blue-200">{{ __('messages.our_distinguished_services') }}</a>
            <a href="#gallery" class="nav-link block hover:text-blue-200">{{ __('messages.gallery') }}</a>
            <a href="#testimonials" class="nav-link block hover:text-blue-200">{{ __('messages.testimonials') }}</a>
            <a href="#about-us" class="nav-link block hover:text-blue-200">{{ __('messages.about_us') }}</a>
            <a href="#contact" class="nav-link block hover:text-blue-200">{{ __('messages.contact_us') }}</a>
        </div>
    </nav>


    <section id="welcome"
        class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-white dark:bg-slate-900">
        <!-- Modern Abstract Background -->
        <div class="absolute inset-0 pointer-events-none">
            <div
                class="absolute -top-[20%] -right-[10%] w-[700px] h-[700px] bg-sky-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob dark:bg-sky-500/10 dark:mix-blend-screen dark:opacity-20">
            </div>
            <div
                class="absolute -bottom-[20%] -left-[10%] w-[700px] h-[700px] bg-cyan-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 dark:bg-cyan-500/10 dark:mix-blend-screen dark:opacity-20">
            </div>
            <div
                class="absolute top-[20%] left-[20%] w-[600px] h-[600px] bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000 dark:bg-blue-500/10 dark:mix-blend-screen dark:opacity-20">
            </div>
        </div>

        <div class="container mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center gap-12 lg:gap-20">
            <!-- Text Content -->
            <div class="flex-1 text-center md:text-right md:order-2">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-semibold text-sm mb-6 animate-fadeInUp border border-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    {{ __('messages.world_class_care') }}
                </div>

                <h1
                    class="text-5xl lg:text-7xl font-black mb-6 leading-tight tracking-tight text-gray-900 dark:text-white animate-fadeInUp delay-150">
                    {{ __('messages.clinic_name') }} <br>
                    <span class="text-gradient-premium">{{ __('messages.world_class_care') }}</span>
                </h1>

                <p
                    class="text-xl text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto md:mx-0 leading-relaxed animate-fadeInUp delay-300">
                    {{ __('messages.hero_text') }}
                </p>

                <div
                    class="flex flex-col sm:flex-row items-center justify-center md:justify-end gap-4 animate-fadeInUp delay-500">
                    <a href="#book"
                        class="btn-glow px-8 py-4 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold text-lg shadow-lg hover:shadow-cyan-500/30 transition-all flex items-center gap-3">
                        {{ __('messages.book_now') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="tel:+212612345678"
                        class="px-8 py-4 rounded-full bg-white text-gray-700 font-bold text-lg shadow-sm border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all dark:bg-gray-800 dark:text-white dark:border-gray-700">
                        {{ __('messages.call_us') }}
                    </a>
                </div>
            </div>

            <!-- Image/Visual -->
            <div class="flex-1 md:order-1 relative animate-fadeInUp delay-700">
                <div
                    class="relative z-10 rounded-[2rem] overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500 border-4 border-white dark:border-gray-800">
                    <img src="{{ asset('gallery5.jpg') }}" alt="Dental Clinic" class="w-full h-auto object-cover">
                    <!-- Glass Card Overlay -->
                    <div
                        class="absolute bottom-6 left-6 right-6 glass-effect p-4 rounded-2xl flex items-center gap-4 animate-bounce-slow">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <i class="fas fa-check text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white text-sm">Certified Specialists</p>
                            <p class="text-xs text-gray-500 dark:text-gray-300">Top Rated Clinic 2025</p>
                        </div>
                    </div>
                </div>
                <!-- Decorative Circle -->
                <div
                    class="absolute top-10 -left-10 w-72 h-72 bg-gradient-to-br from-blue-200 to-cyan-200 rounded-full mix-blend-multiply filter blur-2xl opacity-50 z-0 dark:opacity-20 animate-pulse">
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-24 px-6 bg-slate-50 dark:bg-slate-900 relative transition-colors duration-300">
        <!-- Subtle Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] pointer-events-none"
            style="background-image: radial-gradient(#3b82f6 1px, transparent 1px); background-size: 32px 32px;">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <h2 class="text-4xl sm:text-5xl font-black text-center mb-16 animate-fadeInUp">
                <span class="text-gradient-premium">{{ __('messages.our_distinguished_services') }}</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- Cosmetic Dentistry -->
                <div class="premium-card p-8 rounded-3xl text-center group dark:bg-slate-800 dark:border-slate-700">
                    <div class="icon-box">
                        <i class="fas fa-magic text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4 dark:text-white">
                        {{ __('messages.cosmetic_dentistry_title') }}</h3>
                    <p class="text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __('messages.cosmetic_dentistry_desc') }}</p>
                </div>

                <!-- Preventive Care -->
                <div class="premium-card p-8 rounded-3xl text-center group dark:bg-slate-800 dark:border-slate-700">
                    <div class="icon-box">
                        <i class="fas fa-shield-alt text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4 dark:text-white">
                        {{ __('messages.preventive_care_title') }}</h3>
                    <p class="text-slate-600 leading-relaxed dark:text-slate-400">{{ __('messages.preventive_care_desc') }}
                    </p>
                </div>

                <!-- Restorative Dentistry -->
                <div class="premium-card p-8 rounded-3xl text-center group dark:bg-slate-800 dark:border-slate-700">
                    <div class="icon-box">
                        <i class="fas fa-tools text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4 dark:text-white">
                        {{ __('messages.restorative_dentistry_title') }}</h3>
                    <p class="text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __('messages.restorative_dentistry_desc') }}</p>
                </div>

                <!-- Pediatric Dentistry -->
                <div class="premium-card p-8 rounded-3xl text-center group dark:bg-slate-800 dark:border-slate-700">
                    <div class="icon-box">
                        <i class="fas fa-child text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4 dark:text-white">
                        {{ __('messages.pediatric_dentistry_title') }}</h3>
                    <p class="text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __('messages.pediatric_dentistry_desc') }}</p>
                </div>

                <!-- Emergency Treatments -->
                <div class="premium-card p-8 rounded-3xl text-center group dark:bg-slate-800 dark:border-slate-700">
                    <div class="icon-box">
                        <i class="fas fa-heartbeat text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4 dark:text-white">
                        {{ __('messages.emergency_treatments_title') }}</h3>
                    <p class="text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __('messages.emergency_treatments_desc') }}</p>
                </div>

                <!-- Specialty Dentistry -->
                <div class="premium-card p-8 rounded-3xl text-center group dark:bg-slate-800 dark:border-slate-700">
                    <div class="icon-box">
                        <i class="fas fa-user-md text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-4 dark:text-white">
                        {{ __('messages.specialty_dentistry_title') }}</h3>
                    <p class="text-slate-600 leading-relaxed dark:text-slate-400">
                        {{ __('messages.specialty_dentistry_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-20 px-6 bg-white dark:bg-slate-800 relative overflow-hidden">
        <!-- Abstract Shapes -->
        <div
            class="absolute -left-20 top-40 w-64 h-64 bg-cyan-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 dark:bg-cyan-900/10">
        </div>
        <div
            class="absolute -right-20 bottom-40 w-64 h-64 bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 dark:bg-blue-900/10">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <h2 class="text-4xl sm:text-5xl font-black text-center mb-16 animate-fadeInUp">
                <span class="text-gradient-premium">{{ __('messages.gallery') }}</span>
            </h2>

            <!-- Mobile Swiper -->
            <div class="swiper mobile-swiper sm:hidden mb-8 rounded-2xl shadow-xl overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach(['gallery1.jpg', 'gallery2.jpg', 'gallery3.jpg', 'gallery4.jpg', 'gallery5.jpg', 'gallery6.jpg'] as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset($img) }}" class="w-full h-80 object-cover">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- Desktop Grid -->
            <div class="hidden sm:grid grid-cols-2 md:grid-cols-3 gap-6 lg:gap-8">
                @foreach(['gallery1.jpg', 'gallery2.jpg', 'gallery3.jpg', 'gallery4.jpg', 'gallery5.jpg', 'gallery6.jpg'] as $index => $img)
                    <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                        <img src="{{ asset($img) }}"
                            class="w-full h-72 object-cover transform transition-transform duration-700 group-hover:scale-110">

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <p
                                class="text-white font-bold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Dental Case #{{ $index + 1 }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="book" class="py-24 px-6 bg-slate-50 dark:bg-slate-800 relative">
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="text-4xl sm:text-5xl font-black text-center mb-4 animate-fadeInUp">
                <span class="text-gradient-premium">{{ __('messages.book_appointment') }}</span>
            </h2>
             <p class="text-center text-slate-600 dark:text-slate-400 mb-12 text-lg">{{ __('messages.book_appointment_desc') ?? 'Schedule your visit with our specialists today.' }}</p>

            <div class="bg-white dark:bg-slate-900 p-8 md:p-12 rounded-[2rem] shadow-xl border border-slate-100 dark:border-slate-700">
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-slate-700 dark:text-slate-300 text-sm font-bold mb-2">{{ __('messages.full_name') }}</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                                placeholder="{{ __('messages.full_name_placeholder') }}">
                        </div>
                        <div>
                            <label for="phone" class="block text-slate-700 dark:text-slate-300 text-sm font-bold mb-2">{{ __('messages.phone_number') }}</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                                placeholder="{{ __('messages.phone_placeholder') }}">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="service" class="block text-slate-700 dark:text-slate-300 text-sm font-bold mb-2">{{ __('messages.required_service') }}</label>
                        <select id="service" name="service"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none text-slate-600 dark:text-slate-300">
                            <option value="">{{ __('messages.select_service') }}</option>
                            <option value="تبييض الأسنان">{{ __('messages.service_1') }}</option>
                            <option value="علاج التسوس">{{ __('messages.service_2') }}</option>
                            <option value="تقويم الأسنان">{{ __('messages.service_3') }}</option>
                            <option value="زراعة الأسنان">{{ __('messages.service_4') }}</option>
                            <option value="تجميل الأسنان">{{ __('messages.service_5') }}</option>
                            <option value="طب أسنان الأطفال">{{ __('messages.service_6') }}</option>
                            <option value="أخرى">{{ __('messages.other_service') }}</option>
                        </select>
                    </div>

                    <div class="mb-8">
                        <label for="message" class="block text-slate-700 dark:text-slate-300 text-sm font-bold mb-2">{{ __('messages.your_message') }} ({{ __('messages.optional') }})</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                            placeholder="{{ __('messages.message_placeholder') }}"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="btn-glow w-full md:w-auto px-10 py-4 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold text-lg shadow-lg hover:shadow-blue-500/30 transition-all">
                            {{ __('messages.send_booking_request') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-24 px-6 bg-white dark:bg-slate-900 relative">
        <div class="max-w-7xl mx-auto">
             <h2 class="text-4xl sm:text-5xl font-black text-center mb-16 animate-fadeInUp">
                <span class="text-gradient-premium">{{ __('messages.testimonials_title') }}</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="premium-card p-8 rounded-3xl relative">
                    <div class="text-blue-100 dark:text-slate-700 text-6xl absolute top-6 left-6 font-serif leading-none">"</div>
                    <p class="text-slate-600 dark:text-slate-300 italic mb-6 relative z-10 pt-6">"{{ __('messages.testimonial_1_text') }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                            {{ substr(__('messages.testimonial_1_author'), 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">{{ __('messages.testimonial_1_author') }}</h4>
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="premium-card p-8 rounded-3xl relative">
                    <div class="text-blue-100 dark:text-slate-700 text-6xl absolute top-6 left-6 font-serif leading-none">"</div>
                    <p class="text-slate-600 dark:text-slate-300 italic mb-6 relative z-10 pt-6">"{{ __('messages.testimonial_2_text') }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center text-cyan-600 font-bold">
                            {{ substr(__('messages.testimonial_2_author'), 0, 1) }}
                        </div>
                         <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">{{ __('messages.testimonial_2_author') }}</h4>
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="premium-card p-8 rounded-3xl relative">
                    <div class="text-blue-100 dark:text-slate-700 text-6xl absolute top-6 left-6 font-serif leading-none">"</div>
                    <p class="text-slate-600 dark:text-slate-300 italic mb-6 relative z-10 pt-6">"{{ __('messages.testimonial_3_text') }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                            {{ substr(__('messages.testimonial_3_author'), 0, 1) }}
                        </div>
                         <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">{{ __('messages.testimonial_3_author') }}</h4>
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us" class="py-24 px-6 bg-slate-50 dark:bg-slate-900 relative">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2 relative">
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl">
                    <img src="{{ asset('image.jpg') }}" alt="About Us" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-700">
                     <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-100 rounded-full blur-3xl opacity-50 -z-10"></div>
            </div>
            
            <div class="w-full lg:w-1/2">
                <div class="inline-block px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-sm font-bold mb-6">
                    {{ __('messages.about_us') }}
                </div>
                <h2 class="text-4xl sm:text-5xl font-black mb-8 text-slate-900 dark:text-white">
                    {{ __('messages.who_we_are_title') }}
                </h2>
                <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700">
                     <p class="text-lg text-slate-600 dark:text-slate-300 mb-6 leading-relaxed">
                        {{ __('messages.about_us_paragraph_1') }}
                    </p>
                    <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ __('messages.about_us_paragraph_2') }}
                    </p>
                </div>
                <div class="mt-8 flex gap-4">
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-blue-600">15+</span>
                        <span class="text-sm text-slate-500 font-medium">Years Experience</span>
                    </div>
                    <div class="w-px h-12 bg-slate-200"></div>
                     <div class="flex flex-col">
                        <span class="text-3xl font-black text-blue-600">10k+</span>
                        <span class="text-sm text-slate-500 font-medium">Happy Patients</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a href="https://wa.me/966500000000" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

    <footer class="bg-slate-900 text-white py-12 px-6 border-t border-slate-800">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="text-center md:text-right">
                <h3 class="text-2xl font-black mb-4 flex items-center justify-center md:justify-end gap-2 text-white">
                    <i class="fas fa-tooth text-blue-500"></i>
                    {{ __('messages.clinic_name') }}
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    {{ __('messages.hero_text') }}
                </p>
            </div>

            <div class="text-center md:text-right">
                <h4 class="text-lg font-bold mb-6 flex items-center justify-center md:justify-end gap-2 text-white">
                    {{ __('messages.contact_info_title') }}
                </h4>
                <ul class="space-y-4 text-sm text-slate-300">
                    <li class="flex items-center justify-center md:justify-end gap-3">
                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-blue-400">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <span>06 12 34 56 78</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-end gap-3">
                         <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-blue-400">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <span>{{ __('messages.location_address') }}</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-end gap-3">
                         <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-blue-400">
                            <i class="far fa-clock"></i>
                        </div>
                        <span>{{ __('messages.opening_hours') }}</span>
                    </li>
                </ul>
            </div>

            <div class="text-center md:text-right">
                <h4 class="text-lg font-bold mb-6 flex items-center justify-center md:justify-end gap-2 text-white">
                    {{ __('messages.quick_links') }}
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="#welcome"
                            class="text-slate-400 hover:text-blue-400 transition flex justify-center md:justify-end items-center gap-2">
                            {{ __('messages.home') }}
                            <i class="fas fa-chevron-left text-xs text-slate-600"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#services"
                            class="text-slate-400 hover:text-blue-400 transition flex justify-center md:justify-end items-center gap-2">
                            {{ __('messages.services') }}
                             <i class="fas fa-chevron-left text-xs text-slate-600"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#gallery"
                            class="text-slate-400 hover:text-blue-400 transition flex justify-center md:justify-end items-center gap-2">
                             {{ __('messages.gallery') }}
                              <i class="fas fa-chevron-left text-xs text-slate-600"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#book"
                            class="text-slate-400 hover:text-blue-400 transition flex justify-center md:justify-end items-center gap-2">
                            {{ __('messages.book_appointment') }}
                             <i class="fas fa-chevron-left text-xs text-slate-600"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="text-center md:text-right">
                <h4 class="text-lg font-bold mb-6 flex items-center justify-center md:justify-end gap-2 text-white">
                    {{ __('messages.follow_us') }}
                </h4>
                <div class="flex items-center justify-center md:justify-end gap-4">
                    <a href="https://wa.me/212612345678" target="_blank"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-green-500 transition-all transform hover:scale-110">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-blue-600 transition-all transform hover:scale-110">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-pink-600 transition-all transform hover:scale-110">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 rounded-2xl overflow-hidden shadow-2xl border border-slate-700 mx-auto w-full lg:w-4/5 grayscale hover:grayscale-0 transition-all duration-500">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.0121697415584!2d-6.83255!3d34.0208821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76c9d8e2bcdcd%3A0x8f4a0f28fdfced89!2z2KfZhNmF2YTZiiDYp9mE2YXZhNi52KfYqiDYp9mE2YbYp9iv2Yog2KfZhNmF2YTZiNin2YTYqg!5e0!3m2!1sar!2sma!4v1694032182707!5m2!1sar!2sma"
                width="100%" height="250" style="border:0; width: 100%;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="border-t border-slate-800 mt-12 pt-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') ?? '2025' }} {{ __('messages.clinic_name') }}. {{ __('messages.all_rights_reserved') }}.
        </div>
    </footer>



    <!-- أيقونة تبديل اللغة المتحركة (عرض العلم فقط) -->
    <div id="lang-toggle"
        class="fixed bottom-20 left-4 md:bottom-28 md:left-8 z-[100] bg-white border border-gray-300 text-black p-1 md:p-2 rounded-lg shadow-lg cursor-pointer flex items-center gap-1 md:gap-2 hover:scale-105 transition-transform duration-300 text-xs md:text-sm">
        <span id="lang-flag-with-code" class="flex items-center gap-1">
            @php
                $locale = app()->getLocale();
                $flag = '';
                $code = strtoupper($locale);

                if ($locale === 'ar') {
                    $flag = '🇸🇦';
                } elseif ($locale === 'en') {
                    $flag = '🇬🇧';
                } elseif ($locale === 'fr') {
                    $flag = '🇫🇷';
                }
            @endphp
            <span class="text-base md:text-lg">{{ $flag }}</span>
            <span class="font-semibold">{{ $code }}</span>
        </span>
        <svg id="arrow-icon" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transform transition-transform duration-300"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <div id="lang-popup"
        class="fixed bottom-28 left-2 md:bottom-20 md:left-6 w-32 md:w-36 bg-white border border-gray-300 rounded-xl shadow-2xl z-[101] hidden flex flex-col overflow-hidden">
        <div class="bg-gradient-to-r from-green-600 to-blue-600 text-white p-2 text-center text-xs font-bold">
            {{ __('messages.select_language') }}
        </div>
        <div class="p-2 space-y-1 text-center text-xs">
            <a href="{{ route('language.switch', 'ar') }}"
                class="block py-1 px-3 rounded hover:bg-gray-100 {{ app()->getLocale() == 'ar' ? 'bg-gray-100 font-bold' : '' }}">
                🇸🇦 {{ __('messages.arabic') }}
            </a>
            <a href="{{ route('language.switch', 'en') }}"
                class="block py-1 px-3 rounded hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'bg-gray-100 font-bold' : '' }}">
                🇬🇧 {{ __('messages.english') }}
            </a>
            <a href="{{ route('language.switch', 'fr') }}"
                class="block py-1 px-3 rounded hover:bg-gray-100 {{ app()->getLocale() == 'fr' ? 'bg-gray-100 font-bold' : '' }}">
                🇫🇷 {{ __('messages.french') }}
            </a>
        </div>
    </div>
@endsection