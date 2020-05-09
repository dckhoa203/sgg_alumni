<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\RoleUser;
use App\Models\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use DB;
use App\Models\User;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('pages.admins.permissions.index')
            ->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index_role_admin()
    // {
    //     $role_admin = Permission::with(['route','role'])->whereHas('role', function ($query) {
    //         $query->where('role_id', '=', 1);
    //     })->get();
    //     //dd($role_teacher);

    //     return view('pages.admins.permissions.index_role_admin')
    //         ->with('role_admin',$role_admin);
        
    // }


   
    public function create(Request $request, $id)
    {
        // Role_id của mỗi phân quyền
        $role_id = Role::where('role_id','=',$id)->value('role_id');
        // dd($role_id);
       
        // $query = "SELECT * from routes where NOT EXISTS 
        // (SELECT route_id FROM permissions where permissions.route_id=routes.route_id and permissions.role_id=1)";
        //dd($query);
        $routes =DB::select(DB::raw(" 
            SELECT * from routes where NOT EXISTS 
            (SELECT route_id FROM permissions where permissions.route_id=routes.route_id and permissions.role_id=$id)"
        ));
        
        return view('pages.admins.permissions.create')
            // ->with('show_some_route',$show_some_route)
            // ->with('show_all_routes',$show_all_routes)
            ->with('routes',$routes)
            ->with('role_id',$role_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $route_id = implode(",", $request->get('route_id'));
        $role_id = $request->get('role_id');    
        
        foreach ($request->get('route_id') as $key =>  $value) {
            $permission_code = new Permission();
            $permission_code->route_id .= $value.',';
            $permission_code->role_id .= $role_id.',';

            // echo 'Route_id ' . $value;
            // echo 'Role_id ' . $role_id . '<br>';
            $permission_code->save();
        }
        
        return \redirect()->route('permissions/create',$role_id)->with('success','Thêm route truy cập thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $role_id)
    {
        $roles = Role::where('role_id','=',$role_id)->get();
        $permission = Permission::with(['route','role'])->where('role_id','=',$role_id)->get();
        //dd($permission);
        return view('pages.admins.permissions.show')
            ->with('roles',$roles)
            ->with('permission',$permission);
    }


    // TODO XÉT THÊM PHÂN QUYỀN CHO 1 NGƯỜI DÙNG (** NÂNG CAO **)
    public function permission_advance()
    {
        $user_role = User::with('roles')
            ->orderBy('user_id','asc')->paginate(10);

        return view('pages.admins.permissions.permission_advance')
            ->with('user_role',$user_role);
    }



    // TODO CHO PHÂN QUYỀN LÀ ADMIN
    public function give_admin_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Admin')->firstOrFail();
        // dd($adminRole->id);
        $user->roles()->attach($adminRole->role_id);     // $adminRole->id : id cua role

        return redirect('/permissions/advance');
    }


    // TODO XÓA PHÂN QUYỀN ADMIN
    public function remove_admin_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Admin')->firstOrFail();
        //dd($adminRole->id);
        $user->roles()->detach($adminRole->role_id);

        return redirect('/permissions/advance');
    }


    // TODO CHO PHÂN QUYỀN LÀ TEACHER
    public function give_teacher_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Teacher')->firstOrFail();
        // dd($adminRole->id);
        $user->roles()->attach($adminRole->role_id);     // $adminRole->id : id cua role

        return redirect('/permissions/advance');
    }
    // TODO XÓA PHÂN QUYỀN LÀ TEACHER
    public function remove_teacher_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Teacher')->firstOrFail();
        //dd($adminRole->id);
        $user->roles()->detach($adminRole->role_id);

        return redirect('/permissions/advance');
    }

    // TODO CHO PHÂN QUYỀN CỰU SINH VIÊN
    public function give_alumni_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Alumni')->firstOrFail();
        // dd($adminRole->id);
        $user->roles()->attach($adminRole->role_id);     // $adminRole->id : id cua role

        return redirect('/permissions/advance');
    }


    // TODO XÓA PHÂN QUYỀN CỰU SINH VIÊN
    public function remove_alumni_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Alumni')->firstOrFail();
        //dd($adminRole->id);
        $user->roles()->detach($adminRole->role_id);

        return redirect('/permissions/advance');
    }


    // TODO CHO PHÂN QUYỀN SINH VIÊN
    public function give_student_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Student')->firstOrFail();
        // dd($adminRole->id);
        $user->roles()->attach($adminRole->role_id);     // $adminRole->id : id cua role

        return redirect('/permissions/advance');
    }


    // TODO XÓA PHÂN QUYỀN SINH VIÊN
    public function remove_student_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Student')->firstOrFail();
        //dd($adminRole->id);
        $user->roles()->detach($adminRole->role_id);

        return redirect('/permissions/advance');
    }


    // TODO CHO PHÂN QUYỀN GIÁO VỤ KHOA
    public function give_manager_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Manager')->firstOrFail();
        // dd($adminRole->id);
        $user->roles()->attach($adminRole->role_id);     // $adminRole->id : id cua role

        return redirect('/permissions/advance');
    }


    // TODO XÓA PHÂN QUYỀN GIÁO VỤ KHOA
    public function remove_manager_permission(Request $request, $userID)
    {
        $user = User::where('user_id',$userID)->firstOrFail();

        $adminRole = Role::where('role_name','Manager')->firstOrFail();
        //dd($adminRole->id);
        $user->roles()->detach($adminRole->role_id);

        return redirect('/permissions/advance');
    }


    // TODO XÓA MỘT PERMISSION_ID
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($permission_id)
    {
        //
        $permission = Permission::findOrFail($permission_id);
        $permission->delete();
        return redirect()->route('permissions/show',$permission->role_id)->with('success','Data Deleted Success');
    }


    // TODO VIEW THÊM ROUTE ƯU TIÊN CHO NGƯỜI DÙNG CHỈ ĐỊNH
    public function personal_route()
    {
        $user_role = User::with('roles')
        ->orderBy('user_id','asc')->paginate(10);
        // dd($user_role);
        return view('pages.admins.permissions.personal_route',['user_role'=>$user_role]);
    }


    // TODO XEM ROUTE ƯU TIÊN CỦA NGƯỜI DÙNG CHỈ Đ
    public function show_personal_route(Request $request,$userID)
    {
        $role_user = User::with('roles')->where('user_id','=',$userID)->get();
        // dd($roles);
        $permission = PermissionUser::with(['route','user'])->where('user_id','=',$userID)->get();
        //dd($permission);
        return view('pages.admins.permissions.show_personal_route')
            ->with('role_user',$role_user)
            ->with('permission',$permission);
    }
    //  TODO VIEW THÊM ROUTE CHO NGƯỜI DÙNG CHỈ ĐỊNH
    public function add_personal_route(Request $request,$userID)
    {
        $infor_user = User::findOrFail($userID)
            ->join('role_users','users.user_id','=','role_users.user_id')
            ->join('roles','role_users.role_id','=','roles.role_id')
            ->where('users.user_id','=',$userID)->get();
        $routes =DB::select(DB::raw(" 
            SELECT * from routes where NOT EXISTS 
            (SELECT route_id FROM permission_users where permission_users.route_id=routes.route_id and permission_users.user_id=$userID)"
        ));
        return view('pages.admins.permissions.add_personal_route',['infor_user'=> $infor_user,'routes'=>$routes]);
    }


    // TODO LƯU ROUTE
    public function store_personal_route(Request $request)
    {
        $route_id = implode(",", $request->get('route_id'));
        $user_id = $request->get('user_id');    
        
        foreach ($request->get('route_id') as $key =>  $value) {
            $permission_code = new PermissionUser();
            $permission_code->route_id .= $value.',';
            $permission_code->user_id .= $user_id.',';

            // echo 'Route_id ' . $value;
            // echo 'Role_id ' . $role_id . '<br>';
            $permission_code->save();
        }
        
        return \redirect()->route('permissions/add_personal_route',$user_id)->with('success','Thêm route truy cập thành công');
    }

    // TODO XÓA ROUTE ƯU TIÊN CỦA MỘT NGƯỜI DÙNG CHỈ ĐỊNH
    public function remove_personal_route(Request $request,$permissionUserID)
    {
        $permissionUser = PermissionUser::findOrFail($permissionUserID);
        $permissionUser->delete();

        return redirect()->route('permissions/show_personal_route',$permissionUser->user_id)->with('success','Data Deleted Success');
    }
}
