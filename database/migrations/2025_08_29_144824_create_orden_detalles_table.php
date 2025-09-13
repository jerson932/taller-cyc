<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orden_detalles', function (Blueprint $table) {
            $table->id();

            // 🔹 Forzar nombres de tablas
            $table->foreignId('orden_id')
                  ->constrained('ordenes')
                  ->cascadeOnDelete();

            $table->foreignId('producto_id')
                  ->nullable()
                  ->constrained('productos')
                  ->nullOnDelete();

            $table->foreignId('servicio_id')
                  ->nullable()
                  ->constrained('servicios')
                  ->nullOnDelete();

            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->timestamps();

            // Índices útiles
            $table->index(['orden_id', 'producto_id']);
            $table->index(['orden_id', 'servicio_id']);
        });

        // (Opcional) Asegurar que SOLO uno de los dos (producto|servicio) esté presente
        // PostgreSQL: constraint de verificación
        DB::statement("
            ALTER TABLE orden_detalles
            ADD CONSTRAINT chk_detalle_tipo
            CHECK (
                (producto_id IS NOT NULL AND servicio_id IS NULL)
                OR
                (producto_id IS NULL AND servicio_id IS NOT NULL)
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('orden_detalles');
        Schema::enableForeignKeyConstraints();
    }
};
