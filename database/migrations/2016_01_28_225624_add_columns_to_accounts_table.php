<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('account')->table('accounts', function (Blueprint $table) {
            $table->decimal('money', 10, 2)->nullable();
            $table->enum('role', ['member', 'game master', 'administrator'])->default('member');
            $table->string('language')->default('en');
            $table->rememberToken();
            $table->timestamp('created_at')->default('now()');
            $table->timestamp('updated_at')->default('now()');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('account')->table('accounts', function (Blueprint $table) {
            $table->dropColumn('money');
            $table->dropColumn('role');
            $table->dropColumn('language');
            $table->dropColumn('remember_token');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
