<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$allowedLangs = ['ar', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $allowedLangs, true)) {
    $_SESSION['site_lang'] = $_GET['lang'];
}

$lang = $_SESSION['site_lang'] ?? 'ar';

$translations = [
    'ar' => [
        'dir' => 'rtl',
        'lang_code' => 'ar',
        'home' => 'الرئيسية',
        'services' => 'الخدمات',
        'about' => 'من نحن',
        'templates' => 'القوالب',
        'projects' => 'أعمالنا',
        'contact' => 'تواصل معنا',
        'start_project' => 'ابدأ مشروعك',
        'request_website' => 'اطلب موقعك',
        'request_template' => 'اطلب قالب',
        'hero_title_before' => 'نبني',
        'hero_title_highlight' => 'مواقع إلكترونية',
        'hero_title_after' => 'احترافية تعكس قوة مشروعك',
        'hero_description' => 'نقدم حلول تطوير ويب حديثة، سريعة ومتجاوبة تساعد الشركات والمتاجر والأعمال الناشئة على بناء حضور رقمي احترافي وتحويل الأفكار إلى مشاريع حقيقية قابلة للتطبيق على أرض الواقع.',
        'view_projects' => 'شاهد أعمالنا',
        'about_heading' => 'من نحن ؟؟',
        'about_description' => 'في AG Solutions، نعمل على تقديم حلول ويب وتقنية احترافية تساعد الشركات وأصحاب المشاريع على بناء حضور رقمي قوي واحترافي، من خلال مواقع حديثة، أنظمة مخصصة، وتجربة مستخدم عالية الجودة، وتساعدك على الوصول إلى عملائك بشكل أفضل.',
        'modern_design' => 'تصميم عصري',
        'high_performance' => 'أداء عالي',
        'responsive_devices' => 'متوافق مع جميع الأجهزة',
        'seo_optimization' => 'تحسين SEO',
        'services_heading' => 'خدماتنا',
        'services_description' => 'نقدم حلول ويب متكاملة تجمع بين التصميم الحديث والأداء العالي.',
        'web_design' => 'تصميم مواقع',
        'web_design_desc' => 'تصميم مواقع احترافية متجاوبة مع جميع الأجهزة.',
        'ecommerce' => 'متاجر إلكترونية',
        'ecommerce_desc' => 'إنشاء متاجر حديثة وسريعة مع تجربة مستخدم ممتازة.',
        'full_stack' => 'تطوير Full Stack',
        'full_stack_desc' => 'تطوير Frontend و Backend باستخدام أحدث التقنيات.',
        'projects_heading' => 'أعمالنا',
        'projects_description' => 'مجموعة من المشاريع التي قمنا بتطويرها باحترافية عالية.',
        'view_project' => 'عرض المشروع',
        'contact_heading' => 'تواصل معنا',
        'contact_description' => 'جاهزون لتحويل فكرتك إلى موقع احترافي.',
        'contact_info' => 'معلومات التواصل',
        'full_name' => 'الاسم الكامل',
        'email' => 'البريد الإلكتروني',
        'write_message' => 'اكتب رسالتك',
        'send_message' => 'إرسال الرسالة',
        'message_success' => 'تم إرسال رسالتك بنجاح',
        'copyright' => 'جميع الحقوق محفوظة لدى AG Solutions',
        'back_home' => 'العودة للرئيسية',
        'technologies_used' => 'التقنيات المستخدمة',
        'project_not_found' => 'المشروع غير موجود',
        'templates_heading' => 'القوالب الجاهزة',
        'templates_description' => 'اختر قالب موقع جاهز واحترافي، ويمكننا تخصيصه حسب اسم مشروعك وهويتك.',
        'preview' => 'معاينة',
        'buy_template' => 'شراء القالب',
        'currency' => 'دينار',
        'no_projects' => 'لا توجد مشاريع حالياً',
        'no_templates' => 'لا توجد قوالب حالياً',
        'language' => 'EN'
    ],
    'en' => [
        'dir' => 'ltr',
        'lang_code' => 'en',
        'home' => 'Home',
        'services' => 'Services',
        'about' => 'About Us',
        'templates' => 'Templates',
        'projects' => 'Projects',
        'contact' => 'Contact Us',
        'start_project' => 'Start Your Project',
        'request_website' => 'Request Your Website',
        'request_template' => 'Request a Template',
        'hero_title_before' => 'We Build',
        'hero_title_highlight' => 'Professional Websites',
        'hero_title_after' => 'That Reflect Your Business Strength',
        'hero_description' => 'We provide modern, fast, and responsive web development solutions that help companies, stores, and startups build a professional digital presence and turn ideas into real projects.',
        'view_projects' => 'View Our Work',
        'about_heading' => 'Who Are We?',
        'about_description' => 'At AG Solutions, we provide professional web and technology solutions that help companies and entrepreneurs build a strong digital presence through modern websites, custom systems, and high-quality user experience.',
        'modern_design' => 'Modern Design',
        'high_performance' => 'High Performance',
        'responsive_devices' => 'Responsive on All Devices',
        'seo_optimization' => 'SEO Optimization',
        'services_heading' => 'Our Services',
        'services_description' => 'We provide complete web solutions that combine modern design with high performance.',
        'web_design' => 'Website Design',
        'web_design_desc' => 'Professional responsive website design for all devices.',
        'ecommerce' => 'E-Commerce Stores',
        'ecommerce_desc' => 'Modern and fast online stores with an excellent user experience.',
        'full_stack' => 'Full Stack Development',
        'full_stack_desc' => 'Frontend and Backend development using modern technologies.',
        'projects_heading' => 'Our Projects',
        'projects_description' => 'A collection of projects we developed with high professionalism.',
        'view_project' => 'View Project',
        'contact_heading' => 'Contact Us',
        'contact_description' => 'We are ready to turn your idea into a professional website.',
        'contact_info' => 'Contact Information',
        'full_name' => 'Full Name',
        'email' => 'Email Address',
        'write_message' => 'Write your message',
        'send_message' => 'Send Message',
        'message_success' => 'Your message has been sent successfully',
        'copyright' => 'All rights reserved to AG Solutions',
        'back_home' => 'Back to Home',
        'technologies_used' => 'Technologies Used',
        'project_not_found' => 'Project not found',
        'templates_heading' => 'Ready-Made Templates',
        'templates_description' => 'Choose a professional ready-made website template, and we can customize it to match your brand and project name.',
        'preview' => 'Preview',
        'buy_template' => 'Buy Template',
        'currency' => 'JOD',
        'no_projects' => 'No projects available yet',
        'no_templates' => 'No templates available yet',
        'language' => 'AR'
    ]
];

function t($key) {
    global $translations, $lang;
    return $translations[$lang][$key] ?? $key;
}

function switch_lang_url($targetLang) {
    $params = $_GET;
    $params['lang'] = $targetLang;
    $query = http_build_query($params);
    $path = strtok($_SERVER["REQUEST_URI"], '?');
    return $path . '?' . $query;
}
?>
