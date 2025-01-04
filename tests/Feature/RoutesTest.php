<?php


namespace Tests\Feature;


use App\Models\Mare;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPSTORM_META\map;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_screen()
    {
        $response = $this->get('/');
        $response->assertOk();

    }


    public function test_auth_middleware_is_working()
    {

        // Create
        $response = $this->get('/mares/create');
        $response->assertRedirect('/login');


        // Edit
        $mare = Mare::factory()->create();
        $response = $this->get('/mares/'.$mare->id.'/edit');
        $response->assertRedirect('/login');

        // Destroy
        $response = $this->delete('/mares/' . $mare->id);
        $response->assertRedirect('/login');

    }


    public function test_mare_crud_is_working()
    {

        // Index
        $response = $this->get('/mares');
        $response->assertRedirect('/');


        $user = User::factory()->create();

        // Create + store
        $response = $this->actingAs($user)->get('/mares/create');
        $response->assertOk();

        $response = $this->actingAs($user)->post('/mares', ['latitude' => '3.1415926','longitude'=>'2.71828']);
        $response->assertRedirect('/mares');
        $this->assertDatabaseHas(Mare::class, ['latitude' => '3.1415926','longitude'=>'2.71828']);

        // Edit + update
        $mare = Mare::factory()->create(['user_id'=>$user->id]);

        $response = $this->actingAs($user)->get('/mares/'. $mare->id .'/edit');
        $response->assertOk();

        $response = $this->actingAs($user)->put('/mares/' . $mare->id, ['latitude' => '1.23456','longitude'=>'6.54321']);
        $response->assertRedirect('/mares/'.$mare->id);
        $this->assertDatabaseHas(Mare::class, ['latitude' => '1.23456','longitude'=>'6.54321']);

        // Controle contenu : a deplacer ailleurs ?  (ici on profite de la creation de user et mare)

        $response = $this->actingAs($user)->put('/mares/' . $mare->id, ['latitude' => 'A.23456','longitude'=>'B.54321']);
        $response->assertSessionHasErrors(['latitude', 'longitude']);

        // Show
        $response = $this->actingAs($user)->get('/mares/'. $mare->id);
        $response->assertSeeText('1.23456');

        // Destroy
        $response = $this->actingAs($user)->delete('/mares/' . $mare->id);
        $response->assertRedirect('/mares');
        $this->assertDatabaseMissing(Mare::class, ['latitude' => '1.23456']);
    }


    public function test_picture_crud_is_working() {



         $user = User::factory()->create();


         // Store : mare + picture created, picture non mandatory

         Storage::fake('pictures');
         $file = UploadedFile::fake()->image('mare.jpg');


         $response = $this->actingAs($user)->post('/mares', ['latitude' => '6.54321','longitude'=>'1.23456','picture'=> $file,'observed_at'=>'2024-01-01 13:37']);
         $response->assertRedirect('/mares');

         $this->assertDatabaseHas(Mare::class, ['latitude' => '6.54321','longitude'=>'1.23456']);
         $this->assertDatabaseHas(Picture::class, ['path'=>'pictures/'.$file->hashName()]);

        // I don't undestand why the file is not automaticly deleted as we are using fake storage.

         Storage::delete('pictures/'.$file->hashName());

         $file = UploadedFile::fake()->image('mare.php');

         $response = $this->actingAs($user)->post('/mares', ['latitude' => '6.54321','longitude'=>'1.23456','picture'=> $file]);
         $response->assertSessionHasErrors(['picture']);


    }




    public function test_registered_user_crud_is_working()
    {

        // Create + store
        $response = $this->get('/register');
        $response->assertOk();

        $response = $this->post('/register', ['name' => 'Jean','email'=>'jean@test.com', 'password'=>'password', 'password_confirmation'=>'password']);
        $response->assertRedirect('/mares');
        $this->assertDatabaseHas(User::class, ['name' => 'Jean','email'=>'jean@test.com']);


    }



    public function test_session_crud_is_working()
    {

        // Create + store
        $response = $this->get('/login');
        $response->assertOk();



        $user = User::factory()->create(['password'=>'password']);


        $response = $this->post('/login', ['name' => $user->name ,'email'=>$user->email, 'password'=>'drowssap']);
        $response->assertSessionHasErrors();



        $response = $this->post('/login', ['name' => $user->name ,'email'=>$user->email, 'password'=>'password']);
        $response->assertRedirect('/mares');




        // Destroy
        $response = $this->post('/logout');
        $response->assertRedirect('/');


    }


}
