<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domain_urls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('base_domain_id')->unsigned();
            $table->text('domain_url_name');
            $table->foreign('base_domain_id')->references('id')->on('base_domains')->delete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_urls');
    }
};

