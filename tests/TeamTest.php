<?php

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TeamTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_team_has_a_name()
    {
    	$team = new Team(['name' => 'Acme']);

    	$this->assertEquals('Acme', $team->name);
    }

    /** @test */
    public function a_team_can_add_a_memberes()
    {
    	$team = factory(Team::class)->create();

    	$user = factory(User::class)->create();
    	$userTwo = factory(User::class)->create();

    	$team->add($user);
    	$team->add($userTwo);

    	$this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_has_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($user);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

        $this->setExpectedException('Exception');
        $userThree = factory(User::class)->create();
        $team->add($userThree);

    }
}
