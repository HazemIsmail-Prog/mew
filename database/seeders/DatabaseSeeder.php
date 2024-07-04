<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Stakeholder;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory()->create([
            'name' => 'حازم محمد اسماعيل',
            'username' => 'Hazem',
            'email' => 'hazem.ismail@hotmail.com',
            'is_active' => true,
            'password' => bcrypt('123123123'),
        ]);

        $contracts = array(
            array('id' => '1','name' => 'و ك م /ع/ 5942 /2023/2024 دعوة استشارية لتعيين مستشار مقيم للقيام بأعمال الدراسة والتصميم واعداد المناقصات لبعض المشاريع النوعية - قطاع مشاريع المياه','contract_id' => NULL,'is_active' => '1','created_at' => '2024-04-15 10:49:56','updated_at' => '2024-04-15 10:49:56'),
            array('id' => '2','name' => 'مشروع 1 - Subhan Pump Station','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 10:50:45','updated_at' => '2024-04-15 10:50:45'),
            array('id' => '3','name' => 'مشروع 2 - New Wafra WDC (Water Distribution Complex)','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 10:51:51','updated_at' => '2024-04-15 10:51:51'),
            array('id' => '4','name' => 'مشروع 3 - Naayem WDC (Water Distribution Complex)','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 10:53:20','updated_at' => '2024-04-15 10:53:20'),
            array('id' => '5','name' => 'مشروع 4 - East Ahmadi Pump Station, Water Towers and Associated Pipelines','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 10:55:59','updated_at' => '2024-04-15 10:55:59'),
            array('id' => '6','name' => 'مشروع 5 - Study Fresh & Brackish Water Demand & Supply Up To 2040','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 10:57:38','updated_at' => '2024-04-15 10:57:38'),
            array('id' => '7','name' => 'مشروع 6 - Water Projects Sector Office Building','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 11:00:01','updated_at' => '2024-04-15 11:00:01'),
            array('id' => '8','name' => 'مشروع 7 - Kuwait City Water Networks','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 11:00:48','updated_at' => '2024-04-15 11:00:48'),
            array('id' => '9','name' => 'مشروع 8 - Preparation of Design Manuals and Standards Tender - Contract Documents','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 11:02:19','updated_at' => '2024-04-15 11:02:19'),
            array('id' => '10','name' => 'Overall - Projects','contract_id' => '1','is_active' => '1','created_at' => '2024-04-15 11:57:18','updated_at' => '2024-04-15 11:58:38')
          );

          foreach ($contracts as $contract){
            Contract::create($contract);
          }

          $stakeholders = array(
            array('id' => '1','name' => 'إدارة تصميم مشاريع الشبكات والمنشآت المائية','is_active' => '1','created_at' => '2024-04-15 10:31:30','updated_at' => '2024-04-16 08:57:13'),
            array('id' => '2','name' => 'إدارة مشاريع المياه الجوفية','is_active' => '1','created_at' => '2024-04-15 10:32:00','updated_at' => '2024-04-15 10:32:00'),
            array('id' => '3','name' => 'إدارة الدراسات وبحوث المياه الجوفية','is_active' => '1','created_at' => '2024-04-15 10:32:26','updated_at' => '2024-04-15 10:32:26'),
            array('id' => '4','name' => 'إدارة مشاريع شبكات الوقود','is_active' => '1','created_at' => '2024-04-15 10:32:48','updated_at' => '2024-04-15 10:32:48'),
            array('id' => '5','name' => 'إدارة مشاريع المنشآت المائية','is_active' => '1','created_at' => '2024-04-15 10:33:29','updated_at' => '2024-04-15 10:33:29'),
            array('id' => '6','name' => 'إدارة مشاريع شبكات المياه','is_active' => '1','created_at' => '2024-04-15 10:35:13','updated_at' => '2024-04-15 10:35:13'),
            array('id' => '7','name' => 'الوكيل المساعد لمشاريع المياه','is_active' => '1','created_at' => '2024-04-15 10:37:09','updated_at' => '2024-04-15 10:37:09'),
            array('id' => '8','name' => 'الوكيل المساعد للشؤون المالية','is_active' => '1','created_at' => '2024-04-15 10:37:43','updated_at' => '2024-04-15 10:37:43'),
            array('id' => '9','name' => 'الوكيل المساعد للتخطيط والتدريب ونظم المعلومات','is_active' => '1','created_at' => '2024-04-15 10:38:13','updated_at' => '2024-04-15 10:38:13'),
            array('id' => '10','name' => 'الوكيل المساعد لشبكات التوزيع الكهربائية','is_active' => '1','created_at' => '2024-04-15 10:38:34','updated_at' => '2024-04-15 10:38:34'),
            array('id' => '11','name' => 'الوكيل المساعد لشبكات النقل الكهربائية','is_active' => '1','created_at' => '2024-04-15 10:38:56','updated_at' => '2024-04-15 10:38:56'),
            array('id' => '12','name' => 'الوكيل المساعد لخدمات العملاء','is_active' => '1','created_at' => '2024-04-15 10:39:11','updated_at' => '2024-04-15 10:39:11'),
            array('id' => '13','name' => 'الوكيل المساعد لمحطات القوي الكهربائية وتقطير المياه','is_active' => '1','created_at' => '2024-04-15 10:39:37','updated_at' => '2024-04-15 10:39:37'),
            array('id' => '14','name' => 'الوكيل المساعد لتشغيل وصيانة المياه','is_active' => '1','created_at' => '2024-04-15 10:39:57','updated_at' => '2024-04-15 10:39:57'),
            array('id' => '15','name' => 'الوكيل المساعد للخدمات الفنية والمشاغل الرئيسية','is_active' => '1','created_at' => '2024-04-15 10:40:25','updated_at' => '2024-04-15 10:40:25'),
            array('id' => '16','name' => 'الوكيل المساعد لمراكز المراقبة والتحكم والرقابة','is_active' => '1','created_at' => '2024-04-15 10:41:06','updated_at' => '2024-04-15 10:41:06'),
            array('id' => '17','name' => 'الوكيل المساعد للشؤون الادارية','is_active' => '1','created_at' => '2024-04-15 10:41:24','updated_at' => '2024-04-15 10:41:24'),
            array('id' => '18','name' => 'وكيل وزارة الكهرباء والماء والطاقة المتجددة','is_active' => '1','created_at' => '2024-04-15 10:43:26','updated_at' => '2024-04-15 10:43:26'),
            array('id' => '19','name' => 'دار الهندسة للتصميم والاستشارات الفنية (شاعر ومشاركوه) ','is_active' => '1','created_at' => '2024-04-15 10:45:20','updated_at' => '2024-04-15 10:45:20')
          );

          foreach($stakeholders as $stakeholder){
            Stakeholder::create($stakeholder);
          }
    }
}
