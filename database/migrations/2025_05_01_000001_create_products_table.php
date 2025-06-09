Schema::create('products', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('name', 30);
    $table->text('description');
    $table->bigInteger('price');
    $table->integer('stock');
    $table->string('image', 255);
    $table->timestamps();
});