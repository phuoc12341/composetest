<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\StorePostRequest;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class CreateEditPostRequestTest extends TestCase
{
    public function testCreatePostRequestWithNullOrEmptyTitle()
    {
        $data = [
            'title' => '',
            'content' => 'erqwe',
        ];

        $request = new StorePostRequest();

        $request->setContainer($this->app)->setRedirector($this->app->make(Redirector::class));
        $this->app->instance('request', $request);

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));
        try {
            $request->validateResolved();
        } catch(ValidationException $e) {
            $this->assertValidatorExceptionContainErrorMsg($e, 'A title is required');
        }
    }

    public function testCreatePostRequestWithNullOrEmptyContent()
    {
        $data = [
            'title' => 'Bongda',
            'content' => '',
        ];

        $request = new StorePostRequest();

        $request->setContainer($this->app)->setRedirector($this->app->make(Redirector::class));
        $this->app->instance('request', $request);

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));
        try {
            $request->validateResolved();
        } catch(ValidationException $e) {
            $this->assertValidatorExceptionContainErrorMsg($e, 'A content is required');
        }
    }
}
