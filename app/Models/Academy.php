<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;  // Phải chèn đường dẫn bảng BaseModel

// Tất cả các bảng phải kế thừa lớp BaseModel, tên lớp model phải đặt theo số ít của tên bảng, sử dụng
// Viết hoa chữ cái đầu tiên trong 1 từ, các từ liền mạch nhau, tên bảng giống với tên lớp
class Academy extends BaseModel
{
    protected $table = 'academies';  //tên bảng

    protected $primaryKey = 'academy_id'; //khóa chính

    protected $keyType = 'int'; // kiểu của khóa chính

    protected $fillable = [ // Chèn các trường ở đây
        'academy_id',
        'academy_code',
        'academy_name',
        'academy_description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    // Không tùy tuyện thêm các trường cấu hình khác

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->fillable_list = $this->fillable;         // trường fillable sẽ truyền vào biến fillable_list
    }

    public function base_update(Request $request)
    {
        // $filter_param = $request->only($this->$fillable);
        $this->update_conditions = [
            'academy_id' => 1
        ];
        return parent::base_update($this->request);
    }
}
