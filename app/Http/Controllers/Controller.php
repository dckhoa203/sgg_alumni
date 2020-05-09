<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//Insert of me
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\BaseResponseWeb;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // status contants
    const SUCCESS = 'SUCCESS';
    const VALIDATE = 'VALIDATE';
    const ERROR = 'ERROR';

    // Validation rules(quy tắc xử lý)
    public $rule = [];

    // Request
    public $request = null;

    // Response
    public $response;

    // Model class
    public $model = null;

    // Response key (key trả về)
    public $key = 'data';

    // Response data (dữ liệu trả về)
    public $data = [];

    // Save message default if have validate error (biến để lưu thông điệp khi gặp lỗi xử lý)
    public $valid_msg = [];

    // Custom rule message notification validate error (biến để lưu các thông điệp lỗi khi gặp lỗi xử lý)
    public $custom_msg = [];

    // Status of data empty on respone 
    // trạng thái của dữ liệu rỗng khi trên respone
    public $only_code = true;

    // Status base (success, validate, exception")
    public $status = 'SUCCESS';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->response = new BaseResponseWeb();
    }

    /** Reset key to default
     * @return object
     */
    public function reset_config()
    {
        $this->rule = [];
        $this->request = null;
        $this->model = null;
        $this->key = 'data';
        $this->data = [];
        $this->valid_msg = [];
        $this->custom_msg = [];
        $this->only_code = true;
        $this->status = self::SUCCESS;
    }

    /** Setting default value before handling request
     * @param array $option
     *
     * @return object
     */
    public function config($option)
    {
        isset($option['rule'])          ? $this->rule           = $option['rule']           : '';           // rule check validate
        isset($option['request'])       ? $this->request        = $option['request']        : '';          // rule check validate
        isset($option['model'])         ? $this->model          = $option['model']          : '';           // model class
        isset($option['key'])           ? $this->key            = $option['key']            : '';          // key of data on response
        isset($option['data'])          ? $this->data           = $option['data']           : '';            // data of response
        isset($option['valid_msg'])     ? $this->valid_msg      = $option['valid_msg']      : '';            // data of valid_msg
        isset($option['custom_msg'])    ? $this->custom_msg     = $option['custom_msg']     : '';           // data of custom_msg
        isset($option['only_code'])     ? $this->only_code      = $option['only_code']      : '';      // only_code = true => response not have data value
        isset($option['status'])        ? $this->status         = $option['status']         : '';           // code 200, 400 or 500 of response
    }

    /** Check validate of request
     */
    public function exam()
    {
        if (!empty($this->rule)) {
            // Check the validaty of the request
            $validator = Validator::make($this->request->all(), $this->rule, $this->custom_msg);
            // Return Code 400 if request not valid
            if ($validator->fails()) {
                $this->status = self::VALIDATE; // save code 400 to status value
                $this->valid_msg = $validator->errors(); // save errors array to data value
            }
        }
    }

    /** Call funciton by string name on model
     * @param string $function_name
     *
     * @return object
     */
    public function base_call($function_name)
    {
        try {
            \DB::beginTransaction();
            // Run check validaty if false => return code 400
            $this->exam();
            if ($this->status == self::VALIDATE) {
                return $this->response::errors($this->valid_msg);
            }
            $this->data = $this->model->$function_name($this->request);
            // Commit data if model do finish
            \DB::commit();

            return $this->data; // return data on response
        } catch (Exception $ex) { // if have exception , rollback and return code 500
            \DB::rollBack();

            return $this->response::exception();
        }
    }

    /** Run return response after handling request
     * @return object
     */
    public function response()
    {
        if ($this->only_code) { // return code

            return $this->response::response();
        }

        // Return data and code
        return $this->response::response($this->key, $this->data);
    }
}
