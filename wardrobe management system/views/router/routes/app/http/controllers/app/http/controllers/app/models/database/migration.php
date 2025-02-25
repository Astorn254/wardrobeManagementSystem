public function up()
{
    Schema::create('clothes', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('category');
        $table->string('size');
        $table->string('color');
        $table->string('image_url');
        $table->timestamps();
    });
}
