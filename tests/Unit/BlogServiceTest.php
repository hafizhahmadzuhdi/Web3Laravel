<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class BlogServiceTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const MOCK_IMAGE_NAME = "image_test.png";

    public function setUp() {
        parent::setUp();
        $this->blogService = $this->app->make('App\Services\BlogService');
    }

    public function test_should_create_a_blog_in_database()
    {
        // we need a user in database to create a blog
        $user = factory(\App\User::class)->create();
        $title = $this->faker->sentence(6);
        $content = $this->faker->text;
        $countries = $this->faker->randomElement(['South America', 'North America', 'Europe', 'Middle East', 'Asia']);
        $image = UploadedFile::fake()->image(self::MOCK_IMAGE_NAME);
        $blog = $this->blogService->create($user, $title, $content, $countries, $image);

        // verifying that the database contains a new blog with good values
        $this->assertDatabaseHas('blogs', [
            'title' => $title,
            'content' => $content,
            'countries' => $countries,
            'image' => self::MOCK_IMAGE_NAME,
            'user_id' => $user->id
        ]);
    }

    public function test_should_update_a_blog_in_database(){
        // creating a blog in db to work with
        $blog = factory(\App\Blog::class)->create([
            'user_id' => function() {
                // create a User, because a blog need a user to exist
                $user = factory(\App\User::class)->create();
                return $user->id;
            }
        ]);

        $title = $this->faker->sentence(6);
        $content = $this->faker->text;
        $countries = $this->faker->randomElement(['South America', 'North America', 'Europe', 'Middle East', 'Asia']);
        $image = UploadedFile::fake()->image(self::MOCK_IMAGE_NAME);

        $blog = $this->blogService->update($blog, $title, $content, $countries, $image);

        // verifiying that the blog has been updated and persisted into DB
        $this->assertDatabaseHas('blogs', [
            'title' => $title,
            'content' => $content,
            'countries' => $countries,
            'image' => self::MOCK_IMAGE_NAME,
            'id' => $blog->id
        ]);

        $this->assertTrue(\App\Blog::count() == 1);
    }
}
