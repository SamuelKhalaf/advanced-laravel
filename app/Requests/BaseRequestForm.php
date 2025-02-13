<?php

namespace App\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseRequestForm {

    protected $_request;
    private $status=true;
    private $errors=[];

    abstract public function rules(): array;

    public function __construct(Request $request = null, $forceDie = true)
    {
        if(!is_null($request)) {
            $this->_request = $request;
            $rules = $this->rules();
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                if ($forceDie) {
                    $errors = $validator->errors()->toArray();
                    $errors = ValidationException::withMessages($errors);
                    throw $errors;
                } else {
                    $this->status = false;
                    $this->errors = $validator->errors()->toArray();
                }
            }

        }
    }

    public function isStatus():bool
    {
        return $this->status;
    }

    public function getErrors():array
    {
        return $this->errors;
    }

    public function all()
    {
        return $this->_request->all();
    }
}
