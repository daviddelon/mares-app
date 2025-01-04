<?php

namespace Tests\Feature;

use App\Models\Kv;
use App\Models\Mare;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_picture_model_is_working() {

        // Create image from factory and check belongsto relationship

        $user = User::factory()->create();
        $mare = Mare::factory()->create(['user_id'=>$user->id]);
        $picture = Picture::factory()->create(['user_id'=>$user->id,'mare_id'=>$mare->id]);
        $this->assertTrue($picture->user->id==$user->id);
        $this->assertTrue($picture->mare->id==$mare->id);

   }

   public function test_kv_model_is_working() {

    // Create key from kv factory and check belongsto relationship

    $user = User::factory()->create();
    $mare = Mare::factory()->create(['user_id'=>$user->id]);
    $name = Kv::factory()->create(['user_id'=>$user->id,'mare_id'=>$mare->id]);
    $this->assertTrue($name->user->id==$user->id);
    $this->assertTrue($name->mare->id==$mare->id);

}
}
