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
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\PostController;

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
            $this->assertValidatorExceptionContainErrorMsg($e, __('messages.contentRequired'));
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
            $this->assertValidatorExceptionContainErrorMsg($e, __('messages.titleRequired'));
        }
    }

    public function testCreatePostRequestWithNullBothTitleAndContent()
    {
        $data = [
            'title' => '',
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
            $this->assertValidatorExceptionContainErrorMsg($e, __('messages.titleRequired'));
            $this->assertValidatorExceptionContainErrorMsg($e, __('messages.contentRequired'));
        }
    }

    public function testStoreWithUploadFileMimesException()
    {
        $controller = new PostController();
        $request = new StorePostRequest();

        $data = [
            'title' => 'dfhf',
            'content' => 'dvghdgbn',
            'postFile' => UploadedFile::fake()->create('test.txt', 1000),
        ];

        $request->setContainer($this->app)->setRedirector($this->app->make(Redirector::class));
        $this->app->instance('request', $request);

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        try {
            $request->validateResolved();
        } catch(ValidationException $e) {
            $this->assertValidatorExceptionContainErrorMsg($e, __('messages.postFileMimes'));
        }
    }

    public function testStoreWithUploadFileSuccessful()
    {
        $controller = new PostController();
        $request = new StorePostRequest();

        $data = [
            'title' => 'dfhf',
            'content' => 'dvghdgbn',
            'postFile' => UploadedFile::fake()->create('test.jpg', 1024),
        ];

        $request->setContainer($this->app)->setRedirector($this->app->make(Redirector::class));
        $this->app->instance('request', $request);

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        try {
            $request->validateResolved();
            $this->assertTrue(true);
        } catch(ValidationException $e) {
            $this->assertTrue(false);
        }
    }

    public function testStoreWithUploadOverloadFileExeption()
    {
        $controller = new PostController();
        $request = new StorePostRequest();

        $data = [
            'title' => 'dfhf',
            'content' => 'dvghdgbn',
            'postFile' => UploadedFile::fake()->create('test.jpg', 2000),
        ];

        $request->setContainer($this->app)->setRedirector($this->app->make(Redirector::class));
        $this->app->instance('request', $request);

        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        try {
            $request->validateResolved();
        } catch(ValidationException $e) {
            $this->assertValidatorExceptionContainErrorMsg($e, __('messages.postFileMax'));
        }
    }
}
