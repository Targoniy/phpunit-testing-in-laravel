<?php

use App\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ArticleTest extends TestCase
{
    use DatabaseTransactions;
        use DatabaseMigrations;

    /** @test */
    public function it_fetches_trending_articles()
    {
        //Given
        factory(Article::class, 2)->create();
        factory(Article::class, 2)->create(['reads' => 10]);
        $mostPopular = factory(Article::class)->create(['reads' => 20]);

        //When
        $articles = Article::trending();

        //Then
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);
    }
}
