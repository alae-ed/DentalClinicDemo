
  document.addEventListener('DOMContentLoaded', function() {
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
        init: function() {
          console.log('Swiper initialized successfully');
        }
      }
    });
  });

  
  // يمكنك إضافة هذا الكود إذا أردت تحليلات عند النقر
  document.querySelector('.whatsapp-float').addEventListener('click', function() {
    // هنا يمكنك إضافة كود تحليلات مثل Google Analytics
    console.log('تم النقر على واتساب');
  });


        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('mobileBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const darkBtn = document.getElementById('toggleDark');

            menuBtn?.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            darkBtn?.addEventListener('click', () => {
                document.body.classList.toggle('dark');
            });
        });
    
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".sticky-nav");
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

  });



    // تفعيل الوضع الليلي وحفظ التفضيل
    document.getElementById('toggleDark').addEventListener('click', function() {
        document.body.classList.toggle('dark');
        this.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
        localStorage.setItem('darkMode', document.body.classList.contains('dark'));
    });

    // تطبيق الوضع المحفوظ عند التحميل
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark');
        document.getElementById('toggleDark').textContent = '☀️';
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const service = document.getElementById('service').value;
        const message = document.getElementById('message').value.trim();

        const fullMessage = 
            `🔵 طلب حجز جديد:\n` +
            `👤 الاسم: ${name}\n` +
            `📞 الهاتف: ${phone}\n` +
            `🦷 الخدمة: ${service}\n` +
            `${message ? '✉️ رسالة: ' + message : ''}`;

        const encodedMessage = encodeURIComponent(fullMessage);
        const whatsappNumber = '212670518758'; // ← غيّر هذا إلى رقم العيادة مع مفتاح الدولة

        window.open(`https://wa.me/${whatsappNumber}?text=${encodedMessage}`, '_blank');
    });




    const questions = {
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
        general: [
            'أين موقعكم؟',
            'ما هي طرق الدفع المتاحة؟',
            'هل يوجد موقف سيارات؟',
            'هل تقبلون التأمين الصحي؟',
            'ما هي اللغات التي تتحدثون بها؟'
        ]
    };

    function showCategories() {
        const categoryBox = document.getElementById('category-buttons');
        const questionBox = document.getElementById('question-buttons');
        categoryBox.classList.remove('hidden');
        questionBox.classList.add('hidden');
    }

    function toggleChat() {
        const popup = document.getElementById('chat-popup');
        const chatBox = document.getElementById('chat-box');
        const questionButtons = document.getElementById('question-buttons');

        if (popup.classList.contains('hidden')) {
            // فتح النافذة
            popup.classList.remove('hidden');

            // إعادة تعيين المحتوى
            chatBox.innerHTML = '';
            questionButtons.innerHTML = '';

            // عرض رسالة ترحيب
            renderMessage('مرحبًا بك! أنا هنا لمساعدتك 😊. اختر فئة من الأسئلة:', false);

            // عرض الفئات
            showCategories();
        } else {
            // إغلاق النافذة
            popup.classList.add('hidden');
        }
    }

    function showQuestions(category) {
        const questionBox = document.getElementById('question-buttons');
        const categoryBox = document.getElementById('category-buttons');

        questionBox.innerHTML = '';
        questions[category].forEach(q => {
            const btn = document.createElement('button');
            btn.className = 'question-btn';
            btn.innerText = q;
            btn.onclick = () => askQuestion(q);
            questionBox.appendChild(btn);
        });

        const backBtn = document.createElement('button');
        backBtn.className = 'question-btn';
        backBtn.innerText = '⬅ رجوع للفئات';
        backBtn.onclick = () => {
            questionBox.classList.add('hidden');
            categoryBox.classList.remove('hidden');
        }
        questionBox.appendChild(backBtn);

        questionBox.classList.remove('hidden');
        categoryBox.classList.add('hidden');
    }

    function renderMessage(message, isUser = false) {
        const div = document.createElement('div');
        div.className = isUser ? 'text-right' : 'text-left';
        div.innerHTML = `<div class="inline-block px-4 py-2 rounded-xl ${isUser ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-700'} max-w-[80%]">${message}</div>`;
        document.getElementById('chat-box').appendChild(div);
        document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;
    }

    function askQuestion(question) {
        renderMessage(question, true);
        axios.post('/ai-agent', { message: question })
            .then(response => {
                renderMessage(response.data.reply);
            })
            .catch(() => {
                renderMessage('حدث خطأ أثناء إرسال السؤال.');
            });
    }

        // إضافة سؤال طريقة الوصول إلى الأسئلة العامة
        if (!questions.general.includes('كيف أصل إلى العيادة؟')) {
            questions.general.unshift('كيف أصل إلى العيادة؟');
        }
    