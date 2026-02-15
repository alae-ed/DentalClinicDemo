<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AIController extends Controller
{
    public function handle(Request $request)
    {
        $requestedLang = $request->input('language', app()->getLocale());

        // تغيير اللغة مؤقتاً إذا لزم الأمر
        if (in_array($requestedLang, ['ar', 'en', 'fr'])) {
            app()->setLocale($requestedLang);
        }

        $message = Str::lower(trim($request->input('message')));

        // === الردود بالعربية ===
        $arabicResponses = [
            'مرحبا' => 'أهلاً وسهلاً! كيف يمكنني مساعدتك اليوم؟',
            'ما هي خدماتكم؟' => 'نقدم خدمات مثل التبييض، الزراعة، تقويم الأسنان، علاج العصب، تنظيف الأسنان، علاج اللثة، حشوات الأسنان، رعاية الأطفال، وتركيب التيجان والجسور.',
            'أين موقعكم؟' => 'نحن في شارع الحسن الثاني، الرباط (عنوان تجريبي). <br><a href="https://maps.google.com/?q=Rabat" target="_blank" class="text-blue-500 underline">اضغط هنا لفتح الخريطة</a>',
            'كيف أحجز موعد؟' => 'يمكنك الحجز من خلال نموذج الحجز في الموقع أو الاتصال بنا مباشرة.',
            'ما هي مواعيد العمل؟' => 'نعمل من الاثنين إلى الجمعة من الساعة 9 صباحًا حتى 6 مساءً، ويوم السبت من 9 صباحًا حتى 2 ظهرًا.',
            'ما هي طرق الدفع المتاحة؟' => 'نقبل الدفع نقدًا وبالبطاقات البنكية.',
            'هل تستقبلون حالات الطوارئ؟' => 'نعم، نستقبل حالات الطوارئ خلال ساعات العمل.',
            'هل تقدمون استشارات مجانية؟' => 'نعم، نقدم استشارات أولية مجانية.',
            'هل يوجد موقف سيارات؟' => 'نعم، يوجد موقف سيارات متاح للمرضى.',
            'هل تقبلون التأمين الصحي؟' => 'نعم، نقبل بعض أنواع التأمين الصحي. يرجى التواصل معنا لمعرفة التفاصيل.',
            'ما هي أسعار الخدمات؟' => 'تختلف الأسعار حسب الخدمة المطلوبة. يرجى التواصل معنا للحصول على تفاصيل الأسعار.',
            'هل يوجد طبيبة أسنان؟' => 'نعم، لدينا أطباء وطبيبات أسنان متخصصون.',
            'ما هي مدة الانتظار؟' => 'عادةً لا تتجاوز مدة الانتظار 10 دقائق في حال وجود حجز مسبق.',
            'هل تقدمون تقويم الأسنان الشفاف؟' => 'نعم، نقدم تقويم الأسنان الشفاف وتقنيات حديثة أخرى.',
            'هل يمكن علاج الأطفال؟' => 'نعم، لدينا قسم خاص برعاية وعلاج أسنان الأطفال.',
            'هل تقدمون تبييض الأسنان؟' => 'نعم، نقدم خدمات تبييض الأسنان بتقنيات حديثة وآمنة.',
            'هل يمكنني تغيير موعد الحجز؟' => 'نعم، يمكنك تغيير موعد الحجز بالتواصل معنا مسبقًا.',
            'ما هي الإجراءات الوقائية ضد كورونا؟' => 'نلتزم بجميع الإجراءات الوقائية والتعقيم المستمر للحفاظ على سلامتكم.',
            'هل يوجد تقسيط للدفع؟' => 'نعم، نوفر خيارات تقسيط لبعض الخدمات. يرجى الاستفسار عند الحجز.',
            'ما هي اللغات التي تتحدثون بها؟' => 'نتحدث العربية، الفرنسية، والإنجليزية.',
            'هل تقدمون علاج العصب؟' => 'نعم، نقدم علاج العصب باستخدام أحدث الأجهزة.',
            'هل يمكنني إلغاء الحجز؟' => 'نعم، يمكنك إلغاء الحجز بالتواصل معنا قبل الموعد.',
            'هل يوجد تخدير موضعي؟' => 'نعم، نستخدم التخدير الموضعي لتقليل الألم أثناء العلاج.',
            'هل تقدمون علاج اللثة؟' => 'نعم، نقدم جميع علاجات اللثة.',
            'هل يوجد عروض أو خصومات؟' => 'نعلن عن العروض والخصومات بشكل دوري على موقعنا وصفحات التواصل الاجتماعي.',
            'هل يمكنني الحجز عبر الواتساب؟' => 'نعم، يمكنك الحجز عبر الواتساب من خلال الرقم الموجود في الموقع.',
            'ما هي مدة جلسة تنظيف الأسنان؟' => 'تستغرق جلسة تنظيف الأسنان عادةً من 30 إلى 45 دقيقة.',
            'هل تقدمون زراعة الأسنان؟' => 'نعم، نقدم خدمات زراعة الأسنان بأحدث التقنيات.',
            'هل يمكنني الحصول على استشارة عبر الهاتف؟' => 'نعم، يمكنك التواصل معنا للحصول على استشارة هاتفية.',
        ];

        // === الردود بالإنجليزية ===
        $englishResponses = [
            'hello' => 'Hello! How can I assist you today?',
            'hi' => 'Hi! How can I help you?',
            'what services do you offer?' => 'We offer services such as whitening, implants, orthodontics, root canal treatment, cleaning, gum treatment, fillings, pediatric care, and crowns & bridges.',
            'where are you located?' => 'We are located on Hassan II Street, Rabat (Demo Address). <br><a href="https://maps.google.com/?q=Rabat" target="_blank" class="text-blue-500 underline">Click here to open map</a>',
            'how can i book an appointment?' => 'You can book through the booking form on the website or by contacting us directly.',
            'what are your working hours?' => 'We work from Monday to Friday from 9 AM to 6 PM, and on Saturday from 9 AM to 2 PM.',
            'what payment methods do you accept?' => 'We accept cash and bank cards.',
            'do you accept emergency cases?' => 'Yes, we accept emergency cases during working hours.',
            'do you offer free consultations?' => 'Yes, we offer free initial consultations.',
            'is there a parking lot?' => 'Yes, there is a parking lot available for patients.',
            'do you accept health insurance?' => 'Yes, we accept some types of health insurance. Please contact us for details.',
            'what are your prices?' => 'Prices vary depending on the service. Please contact us for pricing details.',
            'do you have a female dentist?' => 'Yes, we have specialized male and female dentists.',
            'what is the waiting time?' => 'Waiting time usually does not exceed 10 minutes if you have a prior appointment.',
            'do you offer invisible braces?' => 'Yes, we offer invisible braces and other modern techniques.',
            'can you treat children?' => 'Yes, we have a special department for pediatric dental care.',
            'Do you offer teeth whitening?' => 'Yes, we offer teeth whitening using modern and safe techniques.',
            'can i reschedule my appointment?' => 'Yes, you can reschedule your appointment by contacting us in advance.',
            'what are your precautions against covid-19?' => 'We follow all preventive measures and continuous disinfection to ensure your safety.',
            'do you offer payment plans?' => 'Yes, we offer installment options for some services. Please inquire when booking.',
            'what languages do you speak?' => 'We speak Arabic, French, and English.',
            'do you offer root canal treatment?' => 'Yes, we offer root canal treatment using the latest equipment.',
            'can i cancel my appointment?' => 'Yes, you can cancel your appointment by contacting us before the scheduled time.',
            'do you use local anesthesia?' => 'Yes, we use local anesthesia to minimize pain during treatment.',
            'do you treat gum diseases?' => 'Yes, we provide all gum treatments.',
            'are there any offers or discounts?' => 'We periodically announce offers and discounts on our website and social media pages.',
            'can i book via whatsapp?' => 'Yes, you can book via WhatsApp using the number on our website.',
            'how long does a teeth cleaning session take?' => 'A teeth cleaning session usually takes 30 to 45 minutes.',
            'do you offer dental implants?' => 'Yes, we offer dental implants using the latest technology.',
            'can i get a phone consultation?' => 'Yes, you can contact us for a phone consultation.',
        ];
        $frenchResponses = [
            'bonjour' => 'Bonjour ! Comment puis-je vous aider aujourd’hui ?',
            'quels services proposez-vous ?' => 'Nous proposons des services tels que le blanchiment, les implants, l’orthodontie, le traitement de canal, le nettoyage, le traitement des gencives, les obturations, les soins pédiatriques, et les couronnes & ponts.',
            'où êtes-vous situé ?' => 'Nous sommes situés sur la rue Hassan II, à Rabat (Adresse de démo). <br><a href="https://maps.google.com/?q=Rabat" target="_blank" class="text-blue-500 underline">Cliquez ici pour ouvrir la carte</a>',
            'comment puis-je prendre rendez-vous ?' => 'Vous pouvez réserver via le formulaire sur notre site ou en nous contactant directement.',
            'quelles sont vos heures d\'ouverture ?' => 'Nous travaillons du lundi au vendredi de 9h à 18h, et le samedi de 9h à 14h.',
            'quels modes de paiement acceptez-vous ?' => 'Nous acceptons les paiements en espèces et par carte bancaire.',
            'acceptez-vous les urgences ?' => 'Oui, nous acceptons les cas urgents pendant les heures de travail.',
            'offrez-vous des consultations gratuites ?' => 'Oui, nous offrons des consultations initiales gratuites.',
            'y a-t-il un parking disponible ?' => 'Oui, un parking est disponible pour les patients.',
            'acceptez-vous l\'assurance santé ?' => 'Oui, nous acceptons certains types d’assurance santé. Veuillez nous contacter pour plus de détails.',
            'quels sont vos tarifs ?' => 'Les tarifs varient selon le service. Veuillez nous contacter pour plus d’informations.',
            'avez-vous une dentiste femme ?' => 'Oui, nous avons des dentistes hommes et femmes spécialisés.',
            'quel est le temps d\'attente ?' => 'Le temps d’attente ne dépasse généralement pas 10 minutes avec un rendez-vous préalable.',
            'proposez-vous des appareils dentaires invisibles ?' => 'Oui, nous proposons des appareils dentaires invisibles et d’autres techniques modernes.',
            'traitez-vous les enfants ?' => 'Oui, nous avons un département dédié aux soins dentaires pédiatriques.',
            'proposez-vous le blanchiment des dents ?' => 'Oui, nous proposons le blanchiment des dents avec des techniques modernes et sûres.',
            'puis-je reprogrammer mon rendez-vous ?' => 'Oui, vous pouvez reprogrammer votre rendez-vous en nous contactant à l’avance.',
            'quelles sont vos mesures contre le covid-19 ?' => 'Nous respectons toutes les mesures préventives et procédons à une désinfection continue pour garantir votre sécurité.',
            'proposez-vous des plans de paiement ?' => 'Oui, nous proposons des options de paiement échelonné pour certains services. Veuillez vous renseigner lors de la réservation.',
            'quelles langues parlez-vous ?' => 'Nous parlons arabe, français et anglais.',
            'proposez-vous un traitement de canal ?' => 'Oui, nous proposons le traitement de canal avec des équipements modernes.',
            'puis-je annuler mon rendez-vous ?' => 'Oui, vous pouvez annuler votre rendez-vous en nous contactant avant l’heure prévue.',
            'utilisez-vous une anesthésie locale ?' => 'Oui, nous utilisons une anesthésie locale pour minimiser la douleur pendant le traitement.',
            'traitez-vous les maladies des gencives ?' => 'Oui, nous proposons tous les traitements des gencives.',
            'y a-t-il des offres ou réductions ?' => 'Nous annonçons régulièrement des offres et réductions sur notre site et nos réseaux sociaux.',
            'puis-je réserver via whatsapp ?' => 'Oui, vous pouvez réserver via WhatsApp en utilisant le numéro indiqué sur notre site.',
            'combien de temps dure un nettoyage dentaire ?' => 'Une séance de nettoyage dentaire dure généralement entre 30 et 45 minutes.',
            'proposez-vous des implants dentaires ?' => 'Oui, nous proposons des implants dentaires avec les dernières technologies.',
            'puis-je obtenir une consultation téléphonique ?' => 'Oui, vous pouvez nous contacter pour une consultation par téléphone.',
        ];


        // === تحديد اللغة ===
        switch ($requestedLang) {
            case 'ar':
                $responses = $arabicResponses;
                break;
            case 'fr':
                $responses = $frenchResponses;
                break;
            default:
                $responses = $englishResponses;
                break;
        }


        // === البحث عن الرد ===
        $reply = null;

        foreach ($responses as $question => $answer) {
            if (stripos($message, $question) !== false) {
                $reply = $answer;
                break;
            }
        }

        // إذا لم يُوجد رد
        if (!$reply) {
            switch ($requestedLang) {
                case 'ar':
                    $reply = 'عذرًا، لم أفهم سؤالك. هل يمكنك إعادة صياغته؟';
                    break;
                case 'fr':
                    $reply = 'Désolé, je n\'ai pas compris votre question. Pourriez-vous la reformuler ?';
                    break;
                default:
                    $reply = 'Sorry, I didn\'t understand your question. Could you please rephrase it?';
                    break;
            }
        }


        return response()->json(['reply' => $reply]);
    }
}