// A document-level event listener to ensure all HTML is loaded before running the script.
document.addEventListener('DOMContentLoaded', function () {
    // === 1. Swiper Slider ===
    var swiper = new Swiper(".mobile-swiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        touchRatio: 1,
        grabCursor: true,
        preloadImages: true,
        updateOnImagesReady: true,
        on: {
            init: function () {
                console.log('Swiper initialized successfully');
            }
        }
    });

    // === 6. المساعد الذكي ===
    const chatToggle = document.getElementById('chat-toggle');
    const chatClose = document.getElementById('chat-close');
    const chatPopup = document.getElementById('chat-popup');
    const chatBox = document.getElementById('chat-box');
    const categoryButtons = document.getElementById('category-buttons');
    const questionButtons = document.getElementById('question-buttons');

    // 🌐 ترجمات المساعد
    const chatTranslations = {
        ar: {
            greeting: 'مرحبًا بك! أنا هنا لمساعدتك 😊 اختر فئة من الأسئلة:',
            backButton: '⬅ رجوع للفئات',
            categories: {
                services: 'الخدمات',
                booking: 'الحجز',
                location: 'الموقع',
                general: 'أسئلة عامة'
            },
            questions: {
                services: [
                    'ما هي خدماتكم؟',
                    'هل تقدمون تقويم الأسنان الشفاف؟',
                    'هل تقدمون تبييض الأسنان؟',
                    'هل تقدمون زراعة الأسنان؟',
                    'هل تقدمون علاج العصب؟',
                    'هل تقدمون علاج اللثة؟'
                ],
                booking: [
                    'كيف أحجز موعد؟',
                    'ما هي مواعيد العمل؟',
                    'هل يمكنني تغيير موعد الحجز؟',
                    'هل يمكنني إلغاء الحجز؟',
                    'هل يوجد تقسيط للدفع؟'
                ],
                location: [
                    'أين موقعكم؟'
                ],
                general: [
                    'أين موقعكم؟',
                    'ما هي طرق الدفع المتاحة؟',
                    'هل يوجد موقف سيارات؟',
                    'هل تقبلون التأمين الصحي؟',
                    'ما هي اللغات التي تتحدثون بها؟'
                ]
            }
        },

        en: {
            greeting: 'Welcome! I\'m here to help you 😊 Choose a question category:',
            backButton: '⬅ Back to Categories',
            categories: {
                services: 'Services',
                booking: 'Booking',
                location: 'Location',
                general: 'General Questions'
            },
            questions: {
                services: [
                    'What services do you offer?',
                    'Do you offer invisible braces?',
                    'Do you offer teeth whitening?',
                    'Do you offer dental implants?',
                    'Do you offer root canal treatment?',
                    'Do you treat gum diseases?'
                ],
                booking: [
                    'How can I book an appointment?',
                    'What are your working hours?',
                    'Can I reschedule my appointment?',
                    'Can I cancel my appointment?',
                    'Do you offer payment plans?'
                ],
                location: [
                    'Where are you located?'
                ],
                general: [
                    'Where are you located?',
                    'What payment methods do you accept?',
                    'Is there a parking lot?',
                    'Do you accept health insurance?',
                    'What languages do you speak?'
                ]
            }
        },

        fr: {
            greeting: 'Bienvenue ! Je suis là pour vous aider 😊 Choisissez une catégorie de questions :',
            backButton: '⬅ Retour aux catégories',
            categories: {
                services: 'Services',
                booking: 'Réservation',
                location: 'Emplacement',
                general: 'Questions générales'
            },
            questions: {
                services: [
                    'Quels services proposez-vous ?',
                    'Proposez-vous des appareils dentaires invisibles ?',
                    'Proposez-vous le blanchiment des dents ?',
                    'Proposez-vous des implants dentaires ?',
                    'Proposez-vous un traitement de canal ?',
                    'Traitez-vous les maladies des gencives ?'
                ],
                booking: [
                    'Comment puis-je prendre rendez-vous ?',
                    'Quelles sont vos heures d\'ouverture ?',
                    'Puis-je reprogrammer mon rendez-vous ?',
                    'Puis-je annuler mon rendez-vous ?',
                    'Proposez-vous des plans de paiement ?'
                ],
                location: [
                    'Où êtes-vous situé ?'
                ],
                general: [
                    'Où êtes-vous situé ?',
                    'Quels modes de paiement acceptez-vous ?',
                    'Y a-t-il un parking disponible ?',
                    'Acceptez-vous l\'assurance santé ?',
                    'Quelles langues parlez-vous ?'
                ]
            }
        }
    };


    // 🌍 اللغة الحالية
    let currentLanguage = document.documentElement.getAttribute('lang');
    if (!['en', 'ar', 'fr'].includes(currentLanguage)) {
        currentLanguage = 'en'; // اللغة الافتراضية
    }

    // 📋 عرض الفئات
    function showCategories() {
        if (!categoryButtons) return;
        const langData = chatTranslations[currentLanguage];
        categoryButtons.classList.remove('hidden');
        questionButtons.classList.add('hidden');

        const btns = categoryButtons.querySelectorAll('[data-category]');
        btns.forEach(btn => {
            const cat = btn.getAttribute('data-category');
            btn.textContent = langData.categories[cat] || cat;
            btn.onclick = () => showQuestions(cat);
        });
    }

    // ❓ عرض الأسئلة
    function showQuestions(category) {
        if (!questionButtons) return;
        const langData = chatTranslations[currentLanguage];
        questionButtons.innerHTML = '';

        langData.questions[category].forEach(q => {
            const btn = document.createElement('button');
            btn.className = 'question-btn';
            btn.textContent = q;
            btn.onclick = () => askQuestion(q);
            questionButtons.appendChild(btn);
        });

        const backBtn = document.createElement('button');
        backBtn.className = 'question-btn';
        backBtn.textContent = langData.backButton;
        backBtn.onclick = () => {
            questionButtons.classList.add('hidden');
            showCategories();
        };
        questionButtons.appendChild(backBtn);

        if (categoryButtons) categoryButtons.classList.add('hidden');
        questionButtons.classList.remove('hidden');
    }

    // 💬 عرض رسالة
    function renderMessage(message, isUser = false) {
        if (!chatBox) return;
        const div = document.createElement('div');
        div.className = isUser ? 'text-right' : 'text-left';
        const bgColor = isUser ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-700';
        div.innerHTML = `<div class="inline-block px-4 py-2 rounded-xl ${bgColor} max-w-[80%]">${message}</div>`;
        chatBox.appendChild(div);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // ❓ طرح سؤال
    function askQuestion(question) {
        renderMessage(question, true);

        // 👇 نضيف مؤشر "الكتابة"
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message bot-message typing';
        typingDiv.textContent = currentLanguage === 'ar' ? "💬 يكتب..." : "💬 typing...";
        chatBox.appendChild(typingDiv);
        chatBox.scrollTop = chatBox.scrollHeight;

        fetch(AI_HANDLE_ROUTE, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                message: question,
                language: currentLanguage
            })
        })
            .then(res => res.json())
            .then(data => {
                // ⏳ نخلي المؤشر يبان شوية قبل الرد
                setTimeout(() => {
                    typingDiv.remove();

                    const reply = data.reply || data.response || data.message ||
                        (currentLanguage === 'ar' ? "شكراً على سؤالك 🙏" : "Thanks for your question 🙏");

                    renderMessage(reply, false);
                }, 1200); // مدة الانتظار (1.2 ثانية) قبل إظهار الرد
            })
            .catch(() => {
                typingDiv.remove();
                renderMessage(
                    currentLanguage === 'ar' ?
                        "⚠️ حدث خطأ أثناء معالجة سؤالك، حاول مجدداً." :
                        "⚠️ An error occurred while processing your question, please try again."
                );
            });
    }



    // 🔄 فتح/إغلاق النافذة
    window.toggleChat = function () {
        if (!chatPopup) return;
        if (chatPopup.classList.contains('hidden')) {
            chatPopup.classList.remove('hidden');
            if (chatBox) {
                chatBox.innerHTML = '';
                renderMessage(chatTranslations[currentLanguage].greeting, false);
            }
            showCategories();
        } else {
            chatPopup.classList.add('hidden');
        }
    };

    // 🌍 تحديث اللغة عند تغيير `html[lang]`
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'lang') {
                currentLanguage = document.documentElement.getAttribute('lang') === 'en' ? 'en' : 'ar';
                if (!chatPopup.classList.contains('hidden')) {
                    chatBox.innerHTML = '';
                    renderMessage(chatTranslations[currentLanguage].greeting, false);
                    showCategories();
                }
            }
        });
    });
    observer.observe(document.documentElement, { attributes: true });

    // 🎯 ربط الأحداث
    chatToggle?.addEventListener('click', window.toggleChat);
    chatClose?.addEventListener('click', window.toggleChat);

    // === 3. Mobile Menu & Dark Mode ===
    const menuBtn = document.getElementById('mobileBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const darkBtn = document.getElementById('toggleDark');

    menuBtn?.addEventListener('click', () => {
        mobileMenu?.classList.toggle('hidden');
    });

    darkBtn?.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        document.documentElement.classList.toggle('dark'); // Add to html tag for Tailwind
        darkBtn.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
        localStorage.setItem('darkMode', document.body.classList.contains('dark'));
    });

    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark');
        document.documentElement.classList.add('dark');
        if (darkBtn) {
            darkBtn.textContent = '☀️';
        }
    }



    // === 4. Booking Form ===
    const bookingForm = document.querySelector('form');
    bookingForm?.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name')?.value.trim();
        const phone = document.getElementById('phone')?.value.trim();
        const service = document.getElementById('service')?.value;
        const message = document.getElementById('message')?.value.trim();
        const whatsappNumber = '212670518758';

        if (!name || !phone || !service) {
            console.error('Please fill out all required fields.');
            return;
        }

        const fullMessage =
            `🔵 طلب حجز جديد:\n` +
            `👤 الاسم: ${name}\n` +
            `📞 الهاتف: ${phone}\n` +
            `🦷 الخدمة: ${service}\n` +
            `${message ? '✉️ رسالة: ' + message : ''}`;

        const encodedMessage = encodeURIComponent(fullMessage);
        window.open(`https://wa.me/${whatsappNumber}?text=${encodedMessage}`, '_blank');
    });

    // === 5. Sticky Navbar ===
    window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".sticky-nav");
        if (navbar) {
            const scrollY = window.scrollY;
            const maxScroll = 300;
            const opacity = Math.min(scrollY / maxScroll, 0.7);
            if (scrollY > 10) {
                navbar.classList.add("scrolled");
                navbar.style.backgroundColor = `rgba(29, 78, 216, ${1 - opacity})`;
            } else {
                navbar.classList.remove("scrolled");
                navbar.style.backgroundColor = "rgba(29, 78, 216, 1)";
            }
        }
    });
});
// === 7. أيقونة تبديل اللغة مع تحديث العلم ===
document.addEventListener('DOMContentLoaded', function () {
    const langToggle = document.getElementById('lang-toggle');
    const langPopup = document.getElementById('lang-popup');
    const langFlagWithCode = document.getElementById('lang-flag-with-code');
    const arrowIcon = document.getElementById('arrow-icon');
    const body = document.body;

    if (!langToggle || !langPopup || !langFlagWithCode || !arrowIcon) {
        console.error('❌ عناصر تبديل اللغة غير موجودة في DOM');
        return;
    }

    // عرض/إخفاء نافذة اختيار اللغة وتدوير السهم
    langToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = langPopup.classList.toggle('hidden');
        if (isHidden) {
            arrowIcon.classList.remove('rotate-180');
        } else {
            arrowIcon.classList.add('rotate-180');
        }
    });

    // إغلاق النافذة عند النقر خارجها
    document.addEventListener('click', (e) => {
        if (!langPopup.contains(e.target) && !langToggle.contains(e.target)) {
            langPopup.classList.add('hidden');
            arrowIcon.classList.remove('rotate-180');
        }
    });

    // 🔁 تحديث العلم والاختصار عند تغيير اللغة
    function updateFlagAndCode() {
        const currentLang = document.documentElement.getAttribute('lang') || '{{ app()->getLocale() }}';
        let flag = '🇸🇦';
        let code = currentLang.toUpperCase();

        if (currentLang === 'en') {
            flag = '🇬🇧';
        } else if (currentLang === 'fr') {
            flag = '🇫🇷';
        }

        langFlagWithCode.innerHTML = `<span>${flag}</span><span class="font-bold">${code}</span>`;
    }

    // 🌍 مراقبة تغيير اللغة في <html lang="...">
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'lang') {
                updateFlagAndCode();
            }
        });
    });

    observer.observe(document.documentElement, { attributes: true });

    // ✅ تحديث عند تحميل الصفحة
    updateFlagAndCode();
});

