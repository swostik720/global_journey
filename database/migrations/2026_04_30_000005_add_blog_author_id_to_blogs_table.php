<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('blog_author_id')->nullable()->after('user_id')->constrained('blog_authors')->nullOnDelete();
        });

        $userIds = DB::table('blogs')
            ->whereNotNull('user_id')
            ->distinct()
            ->pluck('user_id');

        foreach ($userIds as $userId) {
            $user = DB::table('users')->where('id', $userId)->first();

            if (!$user) {
                continue;
            }

            $authorId = DB::table('blog_authors')->insertGetId([
                'profile_picture' => $user->image,
                'name' => $user->name,
                'title' => $user->user_type ? ucwords(str_replace('_', ' ', $user->user_type)) : 'Content Writer',
                'email' => $user->email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('blogs')
                ->where('user_id', $userId)
                ->update(['blog_author_id' => $authorId]);
        }
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('blog_author_id');
        });
    }
};
