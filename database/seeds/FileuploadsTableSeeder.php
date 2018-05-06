<?php

use Illuminate\Database\Seeder;
use App\Models\Fileupload;

class FileuploadsTableSeeder extends Seeder
{
    public function run()
    {
        $fileuploads = factory(Fileupload::class)->times(50)->make()->each(function ($fileupload, $index) {
            if ($index == 0) {
                // $fileupload->field = 'value';
            }
        });

        Fileupload::insert($fileuploads->toArray());
    }

}

