<?php

use App\Entity\Book\Book;
use Illuminate\Database\Seeder;

class BooksTableSeed extends Seeder {

    public function run() {
        factory(Book::class, 1)->create();
    }

}
