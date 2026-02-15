@extends('layouts.app')

@section('content')
  <div class="relative min-h-screen">
    <!-- زر إظهار الدردشة -->
    <div class="chat-toggle" onclick="toggleChat()">🤖 مساعد</div>

    <!-- نافذة الدردشة المنبثقة -->
    <div id="chat-popup"
      class="fixed bottom-20 right-4 w-80 max-h-[600px] bg-white border border-gray-300 rounded-xl shadow-lg hidden flex flex-col">
      <div class="p-4 border-b border-gray-200 font-bold text-center bg-sky-100 text-sky-800">مساعد العيادة الذكي</div>
      <div id="chat-box" class="p-3 flex-1 overflow-y-auto space-y-3"></div>

      <!-- فقرة من الأسئلة -->
      <div id="question-section" class="p-3 border-t border-gray-200">
        <div id="question-group" class="flex flex-wrap gap-2"></div>
        <button onclick="showNextGroup()" class="mt-3 w-full text-sky-600 text-sm hover:underline">عرض المزيد من
          الأسئلة</button>
      </div>
    </div>

    <script>
      const allQuestions = [
        'ما هي خدماتكم؟', 'ما مواعيد العمل؟', 'كيف يمكنني الحجز؟', 'أين موقعكم؟', 'هل تستقبلون حالات الطوارئ؟', 'هل تقدمون استشارات مجانية؟', 'هل يوجد موقف سيارات؟', 'هل تقبلون التأمين الصحي؟', 'ما هي أسعار الخدمات؟', 'هل يوجد طبيبة أسنان؟', 'ما هي مدة الانتظار؟', 'هل تقدمون تقويم الأسنان الشفاف؟', 'هل يمكن علاج الأطفال؟', 'هل تقدمون تبييض الأسنان؟', 'هل يمكنني تغيير موعد الحجز؟', 'ما هي الإجراءات الوقائية ضد كورونا؟', 'هل يوجد تقسيط للدفع؟', 'ما هي اللغات التي تتحدثون بها؟', 'هل تقدمون علاج العصب؟', 'هل يمكنني إلغاء الحجز؟', 'هل يوجد تخدير موضعي؟', 'هل تقدمون علاج اللثة؟', 'هل يوجد عروض أو خصومات؟', 'هل يمكنني الحجز عبر الواتساب؟', 'ما هي مدة جلسة تنظيف الأسنان؟', 'هل تقدمون زراعة الأسنان؟', 'هل يمكنني الحصول على استشارة عبر الهاتف؟'
      ];

      let currentGroup = 0;
      const groupSize = 4;

      function toggleChat() {
        const popup = document.getElementById('chat-popup');
        popup.classList.toggle('hidden');
      }

      function showNextGroup() {
        const container = document.getElementById('question-group');
        container.innerHTML = '';
        const start = currentGroup * groupSize;
        const end = Math.min(start + groupSize, allQuestions.length);
        for (let i = start; i < end; i++) {
          const btn = document.createElement('button');
          btn.className = 'question-btn';
          btn.innerText = allQuestions[i];
          btn.onclick = () => askQuestion(allQuestions[i]);
          container.appendChild(btn);
        }
        currentGroup++;
        if (currentGroup * groupSize >= allQuestions.length) {
          document.querySelector('#question-section button').classList.add('hidden');
        }
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

      // بدء بفقرة أولى من الأسئلة
      showNextGroup();
    </script>
  </div>
@endsection