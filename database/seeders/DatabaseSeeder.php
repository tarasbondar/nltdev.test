<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        DB::raw('
            INSERT INTO `address_book` (`user_id`, `contact_id`, `created_at`, `updated_at`) VALUES
            (1, 3, \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (1, 5, \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (2, 2, \'2025-02-22 05:25:18\', \'2025-02-22 05:25:18\');
            
            INSERT INTO `contacts` (`id`, `user_id`, `phone`, `created_at`, `updated_at`) VALUES
            (1, 1, \'1111111111110\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (2, 1, \'1111111111111\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (3, 2, \'2222222222220\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (4, 2, \'2222222222221\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (5, 3, \'3333333333330\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\');
            
            INSERT INTO `notes` (`id`, `note`, `notable_id`, `notable_type`, `created_at`, `updated_at`) VALUES
            (1, \'User1 note\', 1, \'App\\Models\\User\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (2, \'Contact2 note\', 2, \'App\\Models\\Contact\', \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (5, \'User4 note\', 4, \'App\\Models\\User\', \'2025-02-22 10:10:58\', \'2025-02-22 10:10:58\');
            
            INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
            (1, \'User1\', \'user1@gmail.com\', NULL, \'\', NULL, \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (2, \'User2\', \'user2@gmail.com\', NULL, \'\', NULL, \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (3, \'User3\', \'user3@gmail.com\', NULL, \'\', NULL, \'2025-01-31 22:00:00\', \'2025-01-31 22:00:00\'),
            (4, \'User4\', \'user4@gmail.com\', NULL, \'$2y$12$GaTaXxRwdWStYM9m5DsHCeNypjFH8BMBDIeaCSuBQH6vECZWJFeR2\', NULL, \'2025-02-22 05:20:14\', \'2025-02-22 05:20:14\');
        ');
    }
}
