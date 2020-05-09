<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseResponseJson;

class BaseApiController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->response = new BaseResponseJson();
    }

    /** First data and handle common operations for most controllers
     * @return object
     */
    public function api_first()
    {
        try {
            \DB::beginTransaction();
            // Run check validaty if false => return code 400
            $this->exam();
            if ($this->status == self::VALIDATE) {
                return $this->response::errors($this->valid_msg);
            } else {
                $this->data = $this->model->api_first($this->request); // first data with conditions on request
            }
            // Commit data if model do finish
            \DB::commit();

            return $this->response(); // return data on response
        } catch (Exception $ex) { // if have exception , rollback and return code 500
            \DB::rollBack();

            return $this->response::exception();
        }
    }

    /** Get data and handle common operations for most controllers
     * @return object
     */
    public function api_index()
    {
        try {
            \DB::beginTransaction();
            // Run check validaty if false => return code 400
            $this->exam();
            if ($this->status == self::VALIDATE) {
                return $this->response::errors($this->valid_msg);
            } else {
                $this->data = $this->model->api_index($this->request); // get data with conditions on request
            }
            // Commit data if model do finish
            \DB::commit();

            return $this->response(); // return data on response
        } catch (Exception $ex) { // if have exception , rollback and return code 500
            \DB::rollBack();

            return $this->response::exception();
        }
    }

    /** Insert data and handle common operations for most controllers
     * @return object
     */
    public function api_insert()
    {
        try {
            \DB::beginTransaction();
            // Run check validaty if false => return code 400
            $this->exam();
            if ($this->status == self::VALIDATE) {
                return $this->response::errors($this->valid_msg);
            }

            $this->data = $this->model->api_insert($this->request); // insert data with request
            // Commit data if model do finish
            \DB::commit();

            return $this->response();
        } catch (Exception $ex) { // if have exception , rollback and return code 500
            \DB::rollBack();

            return $this->response::exception();
        }
    }

    /** Update data and handle common operations for most controllers
     * @return object
     */
    public function api_update()
    {
        try {
            \DB::beginTransaction();
            // Run check validaty if false => return code 400
            $this->exam();
            if ($this->status == self::VALIDATE) {
                return $this->response::errors($this->valid_msg);
            } else {
                $this->data = $this->model->api_update($this->request);
            }
            if ($this->data == false) {
                $this->valid_msg = [
                    'DB' => [
                        'No rows found to update',
                    ],
                ];

                return $this->response::errors($this->valid_msg);
            }
            // Commit data if model do finish
            \DB::commit();

            return $this->response();
        } catch (Exception $ex) { // if have exception , rollback and return code 500
            \DB::rollBack();

            return $this->response::exception();
        }
    }

    /** Delete data and handle common operations for most controllers
     * @return object
     */
    public function api_delete()
    {
        try {
            \DB::beginTransaction();
            // Run check validaty if false => return code 400
            $this->exam();
            if ($this->status == self::VALIDATE) {
                return $this->response::errors($this->valid_msg);
            }
            if (empty((array)$this->request->all())) {
                $this->valid_msg = [
                    'REQUEST' => [
                        "Request is not allowed to be empty."
                    ]
                ];
                return $this->response::errors($this->valid_msg);
            }
            $this->data = $this->model->api_delete($this->request); //delete data with request conddition
            if ($this->data == false) {
                $this->valid_msg = [
                        'DB' => [
                            "Can't find the row to delete.",
                        ],
                    ];
                \DB::rollBack();

                return $this->response::errors($this->valid_msg);
            }
            // Commit data if model do finish
            \DB::commit();

            return $this->response();
        } catch (Exception $ex) { // if have exception , rollback and return code 500
            \DB::rollBack();

            return $this->response::exception();
        }
    }
}
