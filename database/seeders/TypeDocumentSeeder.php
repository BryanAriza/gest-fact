<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeDocument;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDocument::create([
            'name_document' => 'Cédula de Ciudadania'
        ]);
       
        TypeDocument::create([
            'name_document' => 'Tarjeta de Identidad'
        ]);
        TypeDocument::create([
            'name_document' => 'Cédula de Extranjeria'
        ]);
        TypeDocument::create([
            'name_document' => 'Pasaporte'
        ]);

    }
}
