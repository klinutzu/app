<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'proiecte_access',
            ],
            [
                'id'    => 18,
                'title' => 'administrare_access',
            ],
            [
                'id'    => 19,
                'title' => 'monitorizare_access',
            ],
            [
                'id'    => 20,
                'title' => 'initiatori_create',
            ],
            [
                'id'    => 21,
                'title' => 'initiatori_edit',
            ],
            [
                'id'    => 22,
                'title' => 'initiatori_show',
            ],
            [
                'id'    => 23,
                'title' => 'initiatori_delete',
            ],
            [
                'id'    => 24,
                'title' => 'initiatori_access',
            ],
            [
                'id'    => 25,
                'title' => 'servicii_create',
            ],
            [
                'id'    => 26,
                'title' => 'servicii_edit',
            ],
            [
                'id'    => 27,
                'title' => 'servicii_show',
            ],
            [
                'id'    => 28,
                'title' => 'servicii_delete',
            ],
            [
                'id'    => 29,
                'title' => 'servicii_access',
            ],
            [
                'id'    => 30,
                'title' => 'comenzi_create',
            ],
            [
                'id'    => 31,
                'title' => 'comenzi_edit',
            ],
            [
                'id'    => 32,
                'title' => 'comenzi_show',
            ],
            [
                'id'    => 33,
                'title' => 'comenzi_delete',
            ],
            [
                'id'    => 34,
                'title' => 'comenzi_access',
            ],
            [
                'id'    => 35,
                'title' => 'instalari_create',
            ],
            [
                'id'    => 36,
                'title' => 'instalari_edit',
            ],
            [
                'id'    => 37,
                'title' => 'instalari_show',
            ],
            [
                'id'    => 38,
                'title' => 'instalari_delete',
            ],
            [
                'id'    => 39,
                'title' => 'instalari_access',
            ],
            [
                'id'    => 40,
                'title' => 'detaliitehnice_create',
            ],
            [
                'id'    => 41,
                'title' => 'detaliitehnice_edit',
            ],
            [
                'id'    => 42,
                'title' => 'detaliitehnice_show',
            ],
            [
                'id'    => 43,
                'title' => 'detaliitehnice_delete',
            ],
            [
                'id'    => 44,
                'title' => 'detaliitehnice_access',
            ],
            [
                'id'    => 45,
                'title' => 'facturare_create',
            ],
            [
                'id'    => 46,
                'title' => 'facturare_edit',
            ],
            [
                'id'    => 47,
                'title' => 'facturare_show',
            ],
            [
                'id'    => 48,
                'title' => 'facturare_delete',
            ],
            [
                'id'    => 49,
                'title' => 'facturare_access',
            ],
            [
                'id'    => 50,
                'title' => 'surveyuri_create',
            ],
            [
                'id'    => 51,
                'title' => 'surveyuri_edit',
            ],
            [
                'id'    => 52,
                'title' => 'surveyuri_show',
            ],
            [
                'id'    => 53,
                'title' => 'surveyuri_delete',
            ],
            [
                'id'    => 54,
                'title' => 'surveyuri_access',
            ],
            [
                'id'    => 55,
                'title' => 'presale_create',
            ],
            [
                'id'    => 56,
                'title' => 'presale_edit',
            ],
            [
                'id'    => 57,
                'title' => 'presale_show',
            ],
            [
                'id'    => 58,
                'title' => 'presale_delete',
            ],
            [
                'id'    => 59,
                'title' => 'presale_access',
            ],
            [
                'id'    => 60,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 61,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 62,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 63,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 64,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
