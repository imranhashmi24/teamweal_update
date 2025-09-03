<?php

namespace Database\Seeders;

use App\Models\OpenBankingForm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\OpenBankingFormForm;
use App\Models\OpenBankingFormList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OpenBankFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "title" => "Open Bank Form",
                "title_ar" => "نموذج بنك",
                "status" => "active",
                "forms" => [
                    [
                        "name" => "Personal Information",
                        "name_ar" => "المعلومات الشخصية",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "Personal Information",
                        "placeholder_ar" => "المعلومات الشخصية",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Full Name",
                        "name_ar" => "الاسم الكامل",
                        "type" => "text",
                        "required" => "yes",
                        "placeholder" => "Full Name",
                        "placeholder_ar" => "الاسم الكامل",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "National ID / Commercial Registration No.",
                        "name_ar" => "رقم الهوية الوطنية / رقم التسجيل التجاري",
                        "type" => "text",
                        "required" => "no",
                        "placeholder" => "National ID / Commercial Registration No.",
                        "placeholder_ar" => "رقم الهوية الوطنية / رقم التسجيل التجاري",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Mobile Number",
                        "name_ar" => "رقم الجوال",
                        "type" => "number",
                        "required" => "yes",
                        "placeholder" => "Mobile Number",
                        "placeholder_ar" => "رقم الجوال",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 6,
                        "status" => "active"
                    ],
                    [
                        "name" => "Email Address",
                        "name_ar" => "البريد الإلكتروني",
                        "type" => "email",
                        "required" => "yes",
                        "placeholder" => "Email Address",
                        "placeholder_ar" => "البريد الإلكتروني",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 6,
                        "status" => "active"
                    ],
                    [
                        "name" => "Client Type",
                        "name_ar" => "نوع العميل",
                        "type" => "checkbox",
                        "required" => "no",
                        "placeholder" => "Client Type",
                        "placeholder_ar" => "نوع العميل",
                        "options" => [
                            "Individual",
                            "Company",
                            'Small/Medium Enterprise'
                        ],
                        "options_ar" => [
                            "فرد",
                            "شركة",
                            'شركة صغيرة/وسطى'
                        ],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Service Details",
                        "name_ar" => "تفاصيل الخدمة",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "Service Details",
                        "placeholder_ar" => "تفاصيل الخدمة",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Type of obligation or dispute:",
                        "name_ar" => "نوع الخدمة المطلوبة",
                        "type" => "checkbox",
                        "required" => "no",
                        "placeholder" => "Type of obligation or dispute:",
                        "placeholder_ar" => "نوع الخدمة المطلوبة",
                        "options" => [
                            "Financial Dispute Settlement (Partners/Heirs/Commercial)",
                            "Collection of Outstanding Receivables",
                            "Payment Scheduling & Financial Settlements",
                            "Digital Collection & Documentation Solutions",
                            "Legal & Financial Advisory"
                        ],
                        "options_ar" => [
                            "تسوية النزاعات المالية (الشركاء/الورثة/التجارية)",
                            "تحصيل المستحقات المالية",
                            "جدولة المدفوعات والتسويات المالية",
                            "حلول التحصيل الرقمي والتوثيق",
                            "الاستشارات القانونية والمالية"
                        ],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Estimated Value of Obligation/Amount: ",
                        "name_ar" => "قيمة الديون المقدرة/المبلغ: ",
                        "type" => "number",
                        "required" => "no",
                        "placeholder" => "Estimated Value of Obligation/Amount: ",
                        "placeholder_ar" => "قيمة الديون المقدرة/المبلغ: ",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Related Parties (optional):",
                        "name_ar" => "الطرف المتنازع عليه (اختياري)",
                        "type" => "text",
                        "required" => "no",
                        "placeholder" => "Related Parties (optional): ",
                        "placeholder_ar" => "الطرف المتنازع عليه (اختياري)",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Have there been previous settlement attempts?",
                        "name_ar" => "هل هناك محاولات سابقة للتسوية؟",
                        "type" => "checkbox",
                        "required" => "no",
                        "placeholder" => "Have there been previous settlement attempts?",
                        "placeholder_ar" => "هل هناك محاولات سابقة للتسوية؟",
                        "options" => [
                            "Yes",
                            "No"
                        ],
                        "options_ar" => [
                            "نعم",
                            "لا"
                        ],
                        "col" => 12,
                        "status" => "active"
                    ],

                    [
                        "name" => "Additional Notes",
                        "name_ar" => "ملاحظات إضافية",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "Additional Notes",
                        "placeholder_ar" => "ملاحظات إضافية",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Notes",
                        "name_ar" => "ملاحظات إضافية",
                        "type" => "textarea",
                        "required" => "no",
                        "placeholder" => "Notes",
                        "placeholder_ar" => "ملاحظات إضافية",
                        "options" => [],
                        "options_ar" => [],
                        "col" => 12,
                        "status" => "active"
                    ],
                    [
                        "name" => "Request Confirmation",
                        "name_ar" => "تأكيد الطلب",
                        "type" => "checkbox",
                        "required" => "no",
                        "placeholder" => "Request Confirmation",
                        "placeholder_ar" => "تأكيد الطلب",
                        "options" => [
                            "I hereby confirm that all provided information is accurate, and I consent to the use of my data solely for the purpose of providing collection and settlement services, with full confidentiality and privacy protection."
                        ],
                        "options_ar" => [
                            "أقر بأن كافة المعلومات المدخلة صحيحة، وأوافق على استخدام بياناتي بغرض تقديم خدمة التسوية والتحصيل فقط، مع الحفاظ التام على الخصوصية والسرية."
                        ],
                        "col" => 12,
                        "status" => "active"
                    ]
                ]
            ]
        ];

        // check foreign key

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        OpenBankingForm::truncate();
        OpenBankingFormList::truncate();
        OpenBankingFormForm::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        foreach ($datas as $os) {
            $ds = new OpenBankingForm();
        
            $ds->title = $os['title'];
            $ds->title_ar = $os['title_ar'];
            $ds->status = $os['status'];
            $ds->save();
        
            if (isset($os['lists'])) {
                foreach ($os['lists'] as $list) {
                    $oslist = new OpenBankingFormList();
        
                    $oslist->service_id = $ds->id;
                    $oslist->title = $list['title'];
                    $oslist->title_ar = $list['title_ar'];
                    $oslist->status = $list['status'];
                    $oslist->save();
                }
            }
        
            if (isset($os['forms'])) {
                foreach ($os['forms'] as $form) {
                    $osform = new OpenBankingFormForm();
        
                    $osform->service_id = $ds->id;
                    $osform->name = $form['name'];
                    $osform->name_ar = $form['name_ar'];
                    $osform->type = $form['type'];
                    $osform->required = $form['required'];
                    $osform->placeholder = isset($form['placeholder']) ? $form['placeholder'] : null;
                    $osform->placeholder_ar = isset($form['placeholder_ar']) ? $form['placeholder_ar'] : null;
                    $osform->options = isset($form['options']) ? json_encode($form['options']) : [];
                    $osform->options_ar = isset($form['options_ar']) ? json_encode($form['options_ar']) : [];
                    $osform->col = $form['col'];
                    $osform->status = $form['status'];
                    $osform->save();
                }
            }
        }
    }
}
