<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarTable extends Migration
{
public function up()
{
Schema::create('calendars', function (Blueprint $table) {
$table->id();
$table->string('title');
$table->date('start');
$table->date('end')->nullable();
$table->string('description')->nullable();
$table->string('tags')->nullable();
$table->string('comments')->nullable();
$table->string('color')->default('#007bff'); // Add default color
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('calendars');
}
}
