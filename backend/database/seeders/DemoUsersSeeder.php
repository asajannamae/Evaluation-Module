<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => 'coordinator1',
                'name' => 'Research Coordinator One',
                'email' => 'coordinator1@unc.edu.ph',
                'password' => 'coord123',
                'role' => 'Research Coordinator',
                'role_label' => 'Research Coordinator',
                'department' => 'University Research Center',
                'position' => 'Coordinator',
                'account_type' => 'Staff',
                'status' => 'Active',
            ],
            [
                'username' => 'rc.admin',
                'name' => 'RC Admin',
                'email' => 'rc.admin@unc.edu.ph',
                'password' => 'admin2024',
                'role' => 'Research Coordinator',
                'role_label' => 'Research Coordinator',
                'department' => 'University Research Center',
                'position' => 'Administrator',
                'account_type' => 'Staff',
                'status' => 'Active',
            ],
            [
                'username' => 'dean.andrey',
                'name' => 'Dean Andrey',
                'email' => 'dean.andrey@unc.edu.ph',
                'password' => 'dean123',
                'role' => 'Dean',
                'role_label' => 'Dean',
                'department' => 'College of Computing',
                'position' => 'Dean',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
            [
                'username' => 'andrey.quintela',
                'name' => 'Andrey Quintela',
                'email' => 'andrey.quintela@unc.edu.ph',
                'password' => 'unc2024',
                'role' => 'Dean',
                'role_label' => 'Dean',
                'department' => 'College of Computing',
                'position' => 'Dean',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
            [
                'username' => 'panelist1',
                'name' => 'Panel Member One',
                'email' => 'panelist1@unc.edu.ph',
                'password' => 'panel123',
                'role' => 'Panelist',
                'role_label' => 'Panel Member',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Faculty',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
            [
                'username' => 'dr.santos',
                'name' => 'Dr. Maria Santos',
                'email' => 'dr.santos@unc.edu.ph',
                'password' => 'santos2024',
                'role' => 'Panelist',
                'role_label' => 'Panel Member',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Not specified',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
            [
                'username' => 'adviser1',
                'name' => 'Adviser One',
                'email' => 'adviser1@unc.edu.ph',
                'password' => 'adv123',
                'role' => 'Adviser',
                'role_label' => 'Adviser',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Professor',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
            [
                'username' => 'prof.reyes',
                'name' => 'Prof. Reyes',
                'email' => 'prof.reyes@unc.edu.ph',
                'password' => 'reyes2024',
                'role' => 'Adviser',
                'role_label' => 'Adviser',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Professor',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
            [
                'username' => 'student1',
                'name' => 'Student One',
                'email' => 'student1@unc.edu.ph',
                'password' => 'stud123',
                'role' => 'Student',
                'role_label' => 'Student',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Student',
                'account_type' => 'Student',
                'status' => 'Active',
            ],
            [
                'username' => 'juan.delacruz',
                'name' => 'Juan Dela Cruz',
                'email' => 'juan.delacruz@unc.edu.ph',
                'password' => 'juan2024',
                'role' => 'Student',
                'role_label' => 'Student',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Student',
                'account_type' => 'Student',
                'status' => 'Active',
            ],
            [
                'username' => 'admin',
                'name' => 'System Admin',
                'email' => 'admin@local.test',
                'password' => 'admin123',
                'role' => 'Admin',
                'role_label' => 'Administrator',
                'department' => 'University Research Center',
                'position' => 'Administrator',
                'account_type' => 'Staff',
                'status' => 'Active',
            ],
            [
                'username' => '23-181818',
                'name' => 'Dr. Jeremy Quintela',
                'email' => 'jeremy.quintela@unc.edu.ph',
                'password' => 'password123',
                'role' => 'Panelist',
                'role_label' => 'Panel Member',
                'department' => 'School of Computer and Information Sciences',
                'position' => 'Faculty',
                'account_type' => 'Faculty',
                'status' => 'Active',
            ],
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
