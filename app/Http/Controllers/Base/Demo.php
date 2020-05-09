<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseApiController;
use App\Models\Country;

class CountryApiController extends BaseApiController
{
    public $rule_single = [];
    public $rule_multi  = [];

    // Config controller api, model
    public function __construct()
    {
        $this->model = new Country();
        $this->rule_single = [
            "countryCode"        => "nullable|min:2|max:2|string",
            "countryNameJP"      => "nullable|max:32|string",
            "countryNameEN"      => "nullable|max:128|string",
            "countryCollingCode" => "nullable|max:99999|numeric",
            "orderNumber"        => "nullable|max:2147483646|numeric"
        ];
        $this->rule_multi = [
            "*.countryCode"        => "required|min:2|max:2|string",
            "*.countryNameJP"      => "nullable|max:100|string",
            "*.countryNameEN"      => "nullable|max:100|string",
            "*.countryCollingCode" => "required|max:99999|numeric",
            "*.orderNumber"        => "nullable|max:2147483646|numeric"
        ];
    }

    /** Get list country code
     * API (GET) admin/contrycode
     * @param  Request $request
     * @return object
     */
    public function index(Request $request)
    {
        $rule = [
            "countryCode"        => "nullable|min:2|max:2|string", //VN
            "countryNameJP"      => "nullable|max:32|string", // dfasdf
            "countryNameEN"      => "nullable|max:128|string", // Vietnameses
            "countryCollingCode" => "nullable|max:99999|numeric", // 84
            "orderNumber"        => "nullable|max:2147483646|numeric" // 1
        ];
        $custom_msg = [
            "countryCode.max"        => "Lỗi độ dài tối đa của mã quốc gia",
        ];
        $this->config([
            "rule"      => $this->rule,
            "request"   => $request,
            "custom_msg" => $custom_msg,
            "only_code" => false
        ]);

        return $this->index_full();
    }

    /** Insert country code
     * API (POST) admin/contrycode
     * @param  Request $request
     * @return object
     */
    public function store(Request $request)
    {
        $this->rule_multi["*.countryCode"]    = $this->rule_multi["*.countryCode"]."|unique:countries_code,countries_code";
        $this->config([
            "rule"      => $this->rule_multi,
            "request"   => $request,
            "only_code" => true
        ]);
        return $this->insert_full();
    }

    /** Update country code
     * API (PUT) admin/contrycode
     * @param  Request $request
     * @return object
     */
    public function update(Request $request)
    {
        $this->rule_multi["*.countryCode"] = $this->rule_multi["*.countryCode"]."|exists:countries_code,countries_code,is_delete,0";
        $this->config([
            "rule"      => $this->rule_multi,
            "request"   => $request,
            "only_code" => true
        ]);

        return $this->update_full();
    }

    /** Delete country code
     * API (DELETE) admin/contrycode
     * 処理結果を応答コードとして返却する。
     * パラメタ無指定の場合は、全件削除する
     * @param  Request $request
     * @return object
     */
    public function destroy(Request $request)
    {
        $this->config([
            "rule"      => $this->rule_single,
            "only_code" => true,
            "request"   => $request
        ]);

        return $this->delete_full();
    }
}
