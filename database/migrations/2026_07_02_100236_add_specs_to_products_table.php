<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('name');
            $table->string('processor')->nullable()->after('description');
            $table->integer('ram')->nullable()->comment('RAM in GB')->after('processor');
            $table->integer('storage')->nullable()->comment('Storage in GB')->after('ram');
            $table->string('graphic_card')->nullable()->after('storage');
            $table->decimal('screen_size', 3, 1)->nullable()->comment('Screen size in inches')->after('graphic_card');
            $table->integer('sold')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand', 'processor', 'ram', 'storage', 'graphic_card', 'screen_size', 'sold']);
        });
    }
};
