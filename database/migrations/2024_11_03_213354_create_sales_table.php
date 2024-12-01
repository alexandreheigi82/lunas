<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('sales', function (Blueprint $table) {
        $table->id(); // ID do registro de venda (número do pedido)
        $table->foreignId('client_id')->constrained('clients'); // ID do cliente
        $table->foreignId('user_id')->constrained('users_tabela'); // ID do vendedor
        $table->foreignId('package_id')->constrained('packages'); // ID do pacote de turismo
        $table->integer('quantidade'); // Quantidade de pacotes vendidos
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('sales');
}


};
