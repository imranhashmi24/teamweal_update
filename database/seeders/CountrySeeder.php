<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $countriesArray = [
            ["Afghanistan", "أفغانستان"], ["Albania", "ألبانيا"], ["Algeria", "الجزائر"], ["Andorra", "أندورا"], ["Angola", "أنغولا"],
            ["Antigua and Barbuda", "أنتيغوا وبربودا"], ["Argentina", "الأرجنتين"], ["Armenia", "أرمينيا"], ["Australia", "أستراليا"], ["Austria", "النمسا"],
            ["Azerbaijan", "أذربيجان"], ["Bahamas", "الباهاما"], ["Bahrain", "البحرين"], ["Bangladesh", "بنغلاديش"], ["Barbados", "بربادوس"],
            ["Belarus", "روسيا البيضاء"], ["Belgium", "بلجيكا"], ["Belize", "بليز"], ["Benin", "بنين"], ["Bhutan", "بوتان"],
            ["Bolivia", "بوليفيا"], ["Bosnia and Herzegovina", "البوسنة والهرسك"], ["Botswana", "بوتسوانا"], ["Brazil", "البرازيل"], ["Brunei", "بروناي"],
            ["Bulgaria", "بلغاريا"], ["Burkina Faso", "بوركينا فاسو"], ["Burundi", "بوروندي"], ["Cabo Verde", "الرأس الأخضر"], ["Cambodia", "كمبوديا"],
            ["Cameroon", "الكاميرون"], ["Canada", "كندا"], ["Central African Republic", "جمهورية أفريقيا الوسطى"], ["Chad", "تشاد"], ["Chile", "تشيلي"],
            ["China", "الصين"], ["Colombia", "كولومبيا"], ["Comoros", "جزر القمر"], ["Congo", "الكونغو"], ["Costa Rica", "كوستاريكا"],
            ["Croatia", "كرواتيا"], ["Cuba", "كوبا"], ["Cyprus", "قبرص"], ["Czech Republic", "التشيك"], ["Denmark", "الدانمرك"],
            ["Djibouti", "جيبوتي"], ["Dominica", "دومينيكا"], ["Dominican Republic", "جمهورية الدومينيكان"], ["East Timor", "تيمور الشرقية"], ["Ecuador", "الإكوادور"],
            ["Egypt", "مصر"], ["El Salvador", "السلفادور"], ["Equatorial Guinea", "غينيا الاستوائية"], ["Eritrea", "إريتريا"], ["Estonia", "إستونيا"],
            ["Eswatini", "سوازيلاند"], ["Ethiopia", "إثيوبيا"], ["Fiji", "فيجي"], ["Finland", "فنلندا"], ["France", "فرنسا"],
            ["Gabon", "الغابون"], ["Gambia", "غامبيا"], ["Georgia", "جورجيا"], ["Germany", "ألمانيا"], ["Ghana", "غانا"],
            ["Greece", "اليونان"], ["Grenada", "غرينادا"], ["Guatemala", "غواتيمالا"], ["Guinea", "غينيا"], ["Guinea-Bissau", "غينيا بساو"],
            ["Guyana", "غيانا"], ["Haiti", "هايتي"], ["Honduras", "هندوراس"], ["Hungary", "المجر"], ["Iceland", "أيسلندا"],
            ["India", "الهند"], ["Indonesia", "إندونيسيا"], ["Iran", "إيران"], ["Iraq", "العراق"], ["Ireland", "أيرلندا"],
            ["Israel", "إسرائيل"], ["Italy", "إيطاليا"], ["Ivory Coast", "ساحل العاج"], ["Jamaica", "جامايكا"], ["Japan", "اليابان"],
            ["Jordan", "الأردن"], ["Kazakhstan", "كازاخستان"], ["Kenya", "كينيا"], ["Kiribati", "كيريباتي"], ["Korea, North", "كوريا الشمالية"],
            ["Korea, South", "كوريا الجنوبية"], ["Kosovo", "كوسوفو"], ["Kuwait", "الكويت"], ["Kyrgyzstan", "قيرغيزستان"], ["Laos", "لاوس"],
            ["Latvia", "لاتفيا"], ["Lebanon", "لبنان"], ["Lesotho", "ليسوتو"], ["Liberia", "ليبيريا"], ["Libya", "ليبيا"],
            ["Liechtenstein", "ليختنشتاين"], ["Lithuania", "ليتوانيا"], ["Luxembourg", "لوكسمبورغ"], ["Madagascar", "مدغشقر"], ["Malawi", "مالاوي"],
            ["Malaysia", "ماليزيا"], ["Maldives", "جزر المالديف"], ["Mali", "مالي"], ["Malta", "مالطا"], ["Marshall Islands", "جزر مارشال"],
            ["Mauritania", "موريتانيا"], ["Mauritius", "موريشيوس"], ["Mexico", "المكسيك"], ["Micronesia", "ميكرونيزيا"], ["Moldova", "مولدوفا"],
            ["Monaco", "موناكو"], ["Mongolia", "منغوليا"], ["Montenegro", "الجبل الأسود"], ["Morocco", "المغرب"], ["Mozambique", "موزمبيق"],
            ["Myanmar", "ميانمار"], ["Namibia", "ناميبيا"], ["Nauru", "ناورو"], ["Nepal", "نيبال"], ["Netherlands", "هولندا"],
            ["New Zealand", "نيوزيلندا"], ["Nicaragua", "نيكاراغوا"], ["Niger", "النيجر"], ["Nigeria", "نيجيريا"], ["North Macedonia", "مقدونيا الشمالية"],
            ["Norway", "النرويج"], ["Oman", "عمان"], ["Pakistan", "باكستان"], ["Palau", "بالاو"], ["Palestine", "فلسطين"],
            ["Panama", "بنما"], ["Papua New Guinea", "بابوا غينيا الجديدة"], ["Paraguay", "باراغواي"], ["Peru", "بيرو"], ["Philippines", "الفلبين"],
            ["Poland", "بولندا"], ["Portugal", "البرتغال"], ["Qatar", "قطر"], ["Romania", "رومانيا"], ["Russia", "روسيا"],
            ["Rwanda", "رواندا"], ["Saint Kitts and Nevis", "سانت كيتس ونيفيس"], ["Saint Lucia", "سانت لوسيا"], ["Saint Vincent and the Grenadines", "سانت فينسنت والغرينادين"], ["Samoa", "ساموا"],
            ["San Marino", "سان مارينو"], ["Sao Tome and Principe", "ساو تومي وبرينسيبي"], ["Saudi Arabia", "المملكة العربية السعودية"], ["Senegal", "السنغال"], ["Serbia", "صربيا"],
            ["Seychelles", "سيشل"], ["Sierra Leone", "سيراليون"], ["Singapore", "سنغافورة"], ["Slovakia", "سلوفاكيا"], ["Slovenia", "سلوفينيا"],
            ["Solomon Islands", "جزر سليمان"], ["Somalia", "الصومال"], ["South Africa", "جنوب أفريقيا"], ["South Sudan", "جنوب السودان"], ["Spain", "إسبانيا"],
            ["Sri Lanka", "سريلانكا"], ["Sudan", "السودان"], ["Suriname", "سورينام"], ["Sweden", "السويد"], ["Switzerland", "سويسرا"],
            ["Syria", "سوريا"], ["Taiwan", "تايوان"], ["Tajikistan", "طاجيكستان"], ["Tanzania", "تانزانيا"], ["Thailand", "تايلاند"],
            ["Togo", "توغو"], ["Tonga", "تونغا"], ["Trinidad and Tobago", "ترينيداد وتوباغو"], ["Tunisia", "تونس"], ["Turkey", "تركيا"],
            ["Turkmenistan", "تركمانستان"], ["Tuvalu", "توفالو"], ["Uganda", "أوغندا"], ["Ukraine", "أوكرانيا"], ["United Arab Emirates", "الإمارات العربية المتحدة"],
            ["United Kingdom", "المملكة المتحدة"], ["United States", "الولايات المتحدة"], ["Uruguay", "أوروغواي"], ["Uzbekistan", "أوزبكستان"], ["Vanuatu", "فانواتو"],
            ["Vatican City", "الفاتيكان"], ["Venezuela", "فنزويلا"], ["Vietnam", "فيتنام"], ["Yemen", "اليمن"], ["Zambia", "زامبيا"], ["Zimbabwe", "زيمبابوي"]
        ];



        foreach($countriesArray as $countrylist){
            $country = new Country();
            $country->name = $countrylist[0];
            $country->name_ar = $countrylist[1];
            $country->save();
        }

    }
}
