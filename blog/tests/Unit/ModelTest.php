<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Post;
use App\User;

class ModelTest extends TestCase
{
     protected function runConfigurationAssertions(
        Model $model,
        $fillable = [],
        $hidden = [],
        $guarded = ['*'],
        $visible = [],
        $casts = ['id' => 'int'],
        $dates = ['created_at', 'updated_at'],
        $collectionClass = Collection::class,
        $table = null,
        $primaryKey = 'id',
        $connection = null
    )
    {
        $this->assertEquals($fillable, $model->getFillable());
        $this->assertEquals($guarded, $model->getGuarded());
        $this->assertEquals($hidden, $model->getHidden());
        $this->assertEquals($visible, $model->getVisible());
        $this->assertEquals($casts, $model->getCasts());
        $this->assertEquals($dates, $model->getDates());
        $this->assertEquals($primaryKey, $model->getKeyName());
        $c = $model->newCollection();
        $this->assertEquals($collectionClass, get_class($c));
        $this->assertInstanceOf(Collection::class, $c);
        if ($connection !== null) {
            $this->assertEquals($connection, $model->getConnectionName());
        }
        if ($table !== null) {
            $this->assertEquals($table, $model->getTable());
        }
    }

    protected function assertHasManyRelation($relation, Model $model, Model $related, $key = null, $parent = null, Closure $queryCheck = null)
    {
        $this->assertInstanceOf(HasMany::class, $relation);
        if (!is_null($queryCheck)) {
            $queryCheck->bindTo($this);
            $queryCheck($relation->getQuery(), $model, $relation);
        }

        if (is_null($key)) {
            $key = $model->getForeignKey();
        }
        $this->assertEquals($key, $relation->getForeignKeyName());

        if (is_null($parent)) {
            $parent = $model->getKeyName();
        }
        $this->assertEquals($model->getTable().'.'.$parent, $relation->getQualifiedParentKeyName());
    }

    protected function assertBelongsToRelation($relation, Model $model, Model $related, $key, $owner = null, Closure $queryCheck = null)
    {
        $this->assertInstanceOf(BelongsTo::class, $relation);
        if (!is_null($queryCheck)) {
            $queryCheck->bindTo($this);
            $queryCheck($relation->getQuery(), $model, $relation);
        }
        $this->assertEquals($key, $relation->getForeignKeyName());
        if (is_null($owner)) {
            $owner = $related->getKeyName();
        }
        $this->assertEquals($owner, $relation->getOwnerKeyName());
    }

    public function testUserModelConfiguration()
    {
        $this->runConfigurationAssertions(new User(), [
            'name',
            'email',
            'password',
        ], [
            'password',
            'remember_token',
        ], ['*'], [], [
            'id' => 'int', 
            'email_verified_at' => 'datetime',
        ]);
    }

    public function testPostModelConfiguration()
    {
        $this->runConfigurationAssertions(new Post(), [
            'title',
            'content',
            'image',
        ]);
    }

    public function testUserRelatioship()
    {
        $userModel = new User();
        $relationship = $userModel->posts();

        $this->assertHasManyRelation($relationship, $userModel, new User());
    }

    public function testPostRelatioship()
    {
        $postModel = new Post();
        $relationship = $postModel->user();

        $this->assertEquals('user_id' , $relationship->getForeignKeyName());
        $this->assertBelongsToRelation($relationship, $postModel, new Post(), 'user_id');
    }
}
