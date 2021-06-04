<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Administrador Geral',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => Carbon::now()
        ]);

        for ($i=0; $i < 10; $i++) { 
            DB::table('categories')->insert([
                'name' => "Categoria $i",
                'slug' => slug("Categoria $i"),
                'user_id' => 1
            ]);
        }

        for ($i=0; $i < 9; $i++) { 
            $title = "O que é o Lorem Ipsum? $i";
            $body = "O Lorem Ipsum é um texto modelo da 
            indústria tipográfica e de impressão. O Lorem Ipsum 
            tem vindo a ser o texto padrão usado por estas 
            indústrias desde o ano de 1500, quando uma 
            misturou os caracteres de um texto para criar 
            um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset, que continham passagens com Lorem Ipsum, e mais recentemente com os programas de publicação como o Aldus 
            PageMaker que incluem versões do Lorem Ipsum.";

            DB::table('posts')->insert([
                'title' => $title,
                'slug' => slug($title),
                'body' => $body,
                'category_id' => rand(1,10),
                'user_id' => 1
            ]);
        }
        
    }
}
