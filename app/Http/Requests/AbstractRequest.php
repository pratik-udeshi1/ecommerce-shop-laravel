<?php
/**
 * @file
 * AbstractRequest abstract class for allowing Controller AbstractRequest to implement request method.
 */
namespace App\Http\Requests;

use App\Interfaces\RequestInterface;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Validator;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var
     */
    protected $functionName;
    /**
     * @var
     */
    protected $request;

    /**
     * AbstractRequest constructor.
     * @param string $functionName
     * @param Request $request
     */
    public function __construct(string $functionName, Request $request)
    {
        $this->functionName = $functionName;
        $this->request = $request;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|void
     */
    public function __call($name, $arguments)
    {
        return [];
    }

    /**
     * call the corresponding request validation: late static binding with the concrete class.
     *
     * @return mixed
     * @throws Throwable
     */
    public function validate()
    {
        throw_if(!method_exists(static::class, $this->functionName), new Exception('validator for the requested method not exists.'));

        $v = Validator::make($this->request->all(), static::{$this->functionName}());

        if ($v->fails()) {
            http_response_code(400);
            echo json_encode(['success' => false, 'errors' => $v->errors()->toArray()], JSON_PRETTY_PRINT);
            die;
        }
    }
}
