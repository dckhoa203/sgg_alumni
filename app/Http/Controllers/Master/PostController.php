<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
// use App\User;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Comment;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Classes;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Role;
use Carbon\Carbon;

class PostController extends Controller
{

    // TODO TRANG INDEX CỦA QUẢN LÝ BÀI ĐĂNG
    public function index()
    {
        $posts = Post::
            join('categorys_posts','posts.post_id','categorys_posts.post_id')
            ->join('categories','categorys_posts.category_id','categories.category_id')
            ->select('categories.*','posts.*')
            ->where('post_status','accepted')
            ->orderBy('posts.post_id', 'desc')
            ->paginate(5);
        $count_comment = DB::table('posts')
            ->join('comments','posts.post_id','=','comments.post_id')
            ->select(DB::raw('count(*) as count_comment,comments.post_id'))
            ->where('comments.post_id','<>',0)
            ->groupBy('comments.post_id')
            ->get();

        $show_comments = Comment::with('user')->get();

        return view('pages.admins.posts.index',compact('posts'))
        ->with('count_comment',$count_comment)
        ->with('show_comments',$show_comments);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // TODO INDEX CỦA CHỨC NĂNG ĐĂNG BÀI
    public function add_posts(Request $request)
    {
        // $posts = DB::table('posts')
        //     ->select('posts.*', 'users.name', 'users.email')
        //     ->join('users', 'posts.user_id', '=', 'users.user_id')
        //     ->orderBy('posts.post_id', 'desc')
        //     ->get();
        
        if(request()->ajax())
        {
            $postID = $request->get('ID');
            return response()->json(['ID' => $postID]);
        }
        // TODO Tìm ra được số bài đăng của người dùng trong bảng posts
        $count = Post::with('user')
            ->select(DB::raw('count(*) as user_count, user_id'))
            ->where('user_id', '<>', 0)
            ->groupBy('user_id')
            ->get();

        $categories = Category::all();

        $classes = Classes::selectRaw('YEAR(class_begin) as year,class_name,class_id')
        ->orderby('class_begin','desc')
        ->whereHas('users', function ($query) {
            $query->where('users.user_id', '=', Auth::user()->user_id);
        })
        ->get();
        // dd($classes);

        // $course = Classes::selectRaw('YEAR(class_begin) as year,class_name,class_id')->distinct()->orderby('updated_at','desc')->get();
        $course = Classes::selectRaw('YEAR(class_begin) as year,class_name,class_id')->orderby('class_begin','desc')->get();
        // dd($course);
        foreach ($course as $row) {
            //echo "Lop $row->class_name: " . "Khoa:" .($row->year - 1974) . "<br>";
        }
        $userID = DB::table('posts')->select('posts.user_id')
            ->where([
                ['status_user','blocked'],
                ['posts.user_id','=',Auth::user()->user_id]
                ])->value('posts.user_id');
        // dd($userID);
        $roles = Role::all();
        return view('pages.admins.posts.add_posts')
        // ->with('posts',$posts)
        ->with('categories',$categories)
        ->with('count',$count)
        ->with('userID',$userID)
        ->with('classes',$classes)
        ->with('roles',$roles)
        ->with('course',$course);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    // TODO LƯU KHI CREATE BÀI VIẾT
    public function store(Request $request)
    {
       $this->validate($request,[
            'category_id'   => 'required',
            'post_title'    => 'required',
            'post_content'  => 'required',
            'post_file.*'   => 'mimes:doc,docx,pdf,zip',     

       ]);
       if($request->hasFile('post_file'))
       {
           foreach ($request->file('post_file') as $file) {
               $name = $file->getClientOriginalName();
               $file->move(public_path().'/files/',$name);
               $data[] = $name;
           }
       }
        $host_CIT = 'http://cit.ctu.edu.vn/sv/';

        $posts = new Post();
        $posts->user_id              = Auth::user()->user_id;
        $posts->post_title           = $request->get('post_title');
        $posts->post_content         = $request->get('post_content');
        // TODO TỰ THÊM SLUG THEO TIÊU ĐỀ
        $posts->post_slug            = SlugService::createSlug(Post::class, 'post_slug', $posts->post_title);
        $posts->role_id              = $request->role_id;
        
        $posts->category_id          = $request->input('category_id');
        $posts->post_link            = $request->get('post_link');
        // dd($request->input("class_id"));
        $class_id = $request->input("class_id");
        // dd($posts->class_id);
        // dd($request->get("class_id"));
        if(isset($class_id))
        {   if(is_array($class_id))         
            {
                foreach($class_id as $key=>$row)
                {
                    if(isset($name))
                    {
                        $posts->post_file            = $host_CIT.$name;
                        $baidang = Post::insertGetId(array(
                            'user_id'       => $posts->user_id,
                            'class_id'      => (int)$row,
                            'role_id'       => $posts->role_id,
                            'category_id'   => (int)$posts->category_id ,
                            'post_title'    => $posts->post_title ,
                            'post_content'  => $posts->post_content ,
                            'post_slug'     => $posts->post_slug ,
                            'post_file'     => $posts->post_file,
                        ));
                    }
                    else
                    {
                        $baidang = Post::insertGetId(array(
                            'user_id'       => $posts->user_id,
                            'class_id'      => (int)$row,
                            'role_id'       => $posts->role_id,
                            'category_id'   => (int)$posts->category_id ,
                            'post_title'    => $posts->post_title ,
                            'post_content'  => $posts->post_content,
                            'post_slug'     => $posts->post_slug ,
                            'post_file'     => '',
                        ));
                    }
                 $posts->roles()->attach(['role_id' => (int)$posts->role_id],['post_id' => $baidang]);
                 // CLASSES
                 $posts->classes()->attach(['class_id' => (int)$row],['post_id' => $baidang]);
                 // CATEGORY
                 $posts->posts_categories()->attach(['category_id'=>$posts->category_id],['post_id'=>$baidang]);
                }
            }else{
                if(isset($name))
                {
                    $posts->post_file            = $host_CIT.$name;
                    $baidang = Post::insertGetId(array(
                        'user_id'       => $posts->user_id,
                        'class_id'      => (int)$class_id,
                        'role_id'       => $posts->role_id,
                        'category_id'   => (int)$posts->category_id ,
                        'post_title'    => $posts->post_title ,
                        'post_content'  => $posts->post_content ,
                        'post_slug'     => $posts->post_slug ,
                        'post_file'     => $posts->post_file,
                    ));
                }
                else
                {
                    $baidang = Post::insertGetId(array(
                        'user_id'       => $posts->user_id,
                        'class_id'      => (int)$class_id,
                        'role_id'       => $posts->role_id,
                        'category_id'   => (int)$posts->category_id ,
                        'post_title'    => $posts->post_title ,
                        'post_content'  => $posts->post_content,
                        'post_slug'     => $posts->post_slug ,
                        'post_file'     => '',
                    ));
                }
            $posts->roles()->attach(['role_id' => (int)$posts->role_id],['post_id' => $baidang]);
            // CLASSES
            $posts->classes()->attach(['class_id' => (int)$class_id],['post_id' => $baidang]);
            // CATEGORY
            $posts->posts_categories()->attach(['category_id'=>$posts->category_id],['post_id'=>$baidang]);
            }
            
        }
        else
        {
            if(isset($name))
            {
                $posts->post_file            = $host_CIT.$name;
                $baidang = Post::insertGetId(array(
                    'user_id'       => $posts->user_id,
                    'class_id'      => (int)$class_id,
                    'role_id'       => $posts->role_id,
                    'category_id'   => (int)$posts->category_id ,
                    'post_title'    => $posts->post_title ,
                    'post_content'  => $posts->post_content ,
                    'post_slug'     => $posts->post_slug ,
                    'post_file'     => $posts->post_file,
                ));
            }
            else
            {
                $baidang = Post::insertGetId(array(
                    'user_id'       => $posts->user_id,
                    'class_id'      => (int)$class_id,
                    'role_id'       => $posts->role_id,
                    'category_id'   => (int)$posts->category_id ,
                    'post_title'    => $posts->post_title ,
                    'post_content'  => $posts->post_content,
                    'post_slug'     => $posts->post_slug ,
                    'post_file'     => '',
                ));
            }
         $posts->roles()->attach(['role_id' => (int)$posts->role_id],['post_id' => $baidang]);
         // CLASSES
         $posts->classes()->attach(['class_id' => (int)$class_id],['post_id' => $baidang]);
         // CATEGORY
         $posts->posts_categories()->attach(['category_id'=>$posts->category_id],['post_id'=>$baidang]);
        }
        
       return redirect()->route('posts.add_posts')->with('success','The post successfully');
    }


    // TODO Hiển thị các bài viết cần chờ Admin duyệt của chức năng Duyệt bài
    public function list_post()
    {
        $posts = Post::with(['user','classes','roles'])
            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
            ->join('categories','categorys_posts.category_id','categories.category_id')
            ->select('categories.*','posts.*')
            ->where([
                ['post_status','pending'],
            ])->orderBy('post_id','desc')->get();
                

        return view('pages.admins.posts.list_post')
            ->with('posts',$posts);
    }


    // TODO Nhận dữ liệu từ view gửi qua thuộc chức năng Duyệt bài của Admin
    public function list_post_ajax(Request $request)
    {
        if(request()->ajax()){
            $postId = $request->get('postId');

            DB::table('posts')->where('post_id', $postId)->update(['post_status' => 'accepted']);
            return response()->json(["result" => "success"]);
        }
    }


    // TODO HIỂN THỊ CHI TIẾT BÀI VIẾT CỦA ADMIN XEM ĐỂ DUYỆT BÀI
    public function show_post_detail_of_admin(Request $request, $post_id)
    {
        $posts = Post::with('user')->where('post_status','pending')->get()->find($post_id);
        return view('pages.admins.posts.show_post_detail_of_admin',compact('posts','post_id'));
    }


    // TODO CHỨC NĂNG KHÓA TÀI KHOẢN NGƯỜI DÙNG NẾU ĐĂNG KO HỢP LÝ
    public function block_user_ajax(Request $request)
    {
        if(request()->ajax())
        {
            $userID = $request->get('userID');
            DB::table('posts')->where('user_id',$userID)->update(['status_user' => 'blocked']);
            return response()->json(['result' => "success"]);
        }
    }


    // TODO HIỂN THỊ DANH SÁCH TÀI KHOẢN BỊ KHÓA VÀ UNBLOCK THAT'S ACCOUNT
    public function lists_account_blocked()
    {
        $account_blocked = Post::with('user')
            ->where('posts.status_user','blocked')
            ->get();
            
        $count_block = DB::table('posts')
                        ->select(DB::raw('count(*) as solankhoa'))
                        ->where('status_user','blocked')
                        ->groupBy('posts.user_id')
                        ->value('solankhoa');
        //dd($count_block);  
        return view('pages.admins.posts.lists_account_blocked')
        ->with('account_blocked',$account_blocked)
        ->with('count_block',$count_block);
    }


    // TODO CHỨC NĂNG MỞ KHÓA TÀI KHOẢN
    public function unblock_account_ajax(Request $request)
    {
        if(request()->ajax())
        {
            $userID = $request->get('userID');
            DB::table('posts')->where('user_id',$userID)->update(['status_user' => 'active']);
            return response()->json(['result' => "success"]);
        }
    }
    /**
     * 
     * 
     */
    // TODO Danh sách bài đăng thuộc role = student *
    public function list_post_students()
    {
        $query = DB::table('posts')
            ->join('post_classes','posts.post_id','=','post_classes.post_id')
            ->join('classes','post_classes.class_id','=','classes.class_id')
            ->select('classes.*','posts.*')
            ->get();
        //echo $query .'<hr>' . '<br>';

        // $post_users = User::with('post_classes')->get();

        // dd($post_users);
        //echo 'Auth_user_ID: ' . Auth::user()->user_id . '<br>';

        // foreach($post_users as $post)
        // {
        //     // if($post->user_id === Auth::user()->user_id){
        //         // echo $post.'<hr>' . '<br>';
        //         foreach ($post->post_classes as $post_class) {
        //             //echo $post_class . '<hr>' . "<br>";
        //         }
        //     //}
        // }
        //dd($post_users);

        // FIXME:
        // Đếm comment theo post_id
        $count_comment = DB::table('posts')
            ->join('comments','posts.post_id','=','comments.post_id')
            ->select(DB::raw('count(*) as count_comment,comments.post_id'))
            ->where('comments.post_id','<>',0)
            ->groupBy('comments.post_id')
            ->get();
        //echo $count_comment . '<hr>';

        $show_comments = Comment::with('user')->get();
        /**
         * * SUCCESSFULLY!
         */
        //dd($show_comments);
        foreach ($show_comments as $show) {
            //echo $show->user->name;
        }

        $class_names = Post::with('classes')->get();
        /**
         * * SUCCESSFULLY!
         */
        //dd($class_names);
        foreach ($class_names as $class) {
            // echo $class->classes;
            foreach ($class->classes as $class_name) {
                //echo $class_name->pivot->post_id . ', ' . $class_name->class_name. '<br>';
                // echo $class_name->class_name;
                // echo $tenlop;
            }
        }
        // dd($class_names);
        $post_students = Post::with('user')
            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
            ->join('categories','categorys_posts.category_id','categories.category_id')
            ->select('categories.*','posts.*')
            ->where([
                ['role_id','=',3],
                ['post_status','accepted'],
            ])
            ->orWhere('role_id','=',4)
            ->orderBy('posts.post_id', 'desc')->paginate(5);
        // posts join classes, if user co class_id thuoc post_classes thi moi thay dc bai dang
        // $post_category = Post::with('posts_categories')->get();
        // dd($post_category);
        //echo $post->created_at . '<br>'; // Y-m-d

        // $day = strtotime($post->created_at);
        // echo "Day: " . date("d",$day) ;    // jusn get specific day
        // echo "Month: " . date("m",$day);    // jusn get specific month
        // echo "Year: " . date("Y",$day);    // jusn get specific year


        return view('pages.admins.posts.list_post_students')
        ->with('i',(request()->input('page',1) - 1 ) * 3)
        ->with('post_students',$post_students)
        ->with('class_names',$class_names)
        ->with('count_comment',$count_comment)
        ->with('show_comments',$show_comments);
    }


    // TODO: HIỂN THỊ CHI TIẾT BÀI VIẾT KHI CLICK VÀO  https://domain.com/posts/{category_slug}/{slug}
    public function posts_slug(Request $request,$category_slug, $slug,$postID)
    {

        // TODO BÀI VIẾT GỢI Ý TOP-LEFT
        $post_radom = Post::inRandomOrder()
            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
            ->join('categories','categorys_posts.category_id','categories.category_id')
            ->select('categories.*','posts.*')
            ->where('post_status','accepted')
            ->orderBy('post_id', 'desc')
            ->paginate(3);
        
        // TODO CHI TIẾT BÀI VIẾT
        $post_slug = Post::with('posts_categories')
        ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
        ->join('categories','categorys_posts.category_id','categories.category_id')
        ->where([
            ['posts.post_status','accepted'],
            ['posts.post_id',$postID],
            ['categories.category_slug',$category_slug],
            ['posts.post_slug',$slug]
        ])
        ->join('users','posts.user_id','=','users.user_id')
        ->get();

        // TODO NGÀY ĐĂNG CỦA BÀI VIẾT
        $create_post = Post::with('posts_categories')
        ->where([
            ['post_status','accepted'],
            ['posts.post_id',$postID],
            ['post_slug',$slug]
        ])->get();
        // dd($post_slug);
        
        return view('pages.admins.posts.details_an_article')
        ->with('post_slug',$post_slug)
        ->with('create_post',$create_post)
        ->with('post_radom',$post_radom);
    }


    // TODO Chức năng xem bài đăng của mình, những bài đăng nào mình được thấy trên lớp của mình đăng theo học
    // TODO Khi giảng viên đăng  1 bài đăng muốn chỉ trên lớp đó thấy thôi, và các sih viên thuộc lớp đó sẽ thấy, còn sinh viên khác thì không.
    // public function post_yourself()
    // {
    //     /**
    //      * * SUCCESSFULLY!
    //      */
    //     $data = Post::with('user')
    //     ->join('post_classes','posts.post_id','=','post_classes.post_id')
    //     ->join('class_users','post_classes.class_id','=','class_users.class_id')
    //     ->join('users','users.user_id','=','class_users.user_id')
    //     ->join('classes','classes.class_id','=','class_users.class_id')
    //         ->select('users.*','classes.*','class_users.class_id','post_classes.post_id','posts.*')
    //         ->where([
    //             ['users.user_id','=',Auth::user()->user_id],
    //             ['post_status','accepted'],
    //             ])
    //         ->get();
    //     //echo 'Data: ' . $data . '<br>' . '<hr>';

    //     // FIXME:
    //     // Đếm comment theo post_id
    //     $count_comment = DB::table('posts')
    //         ->join('comments','posts.post_id','=','comments.post_id')
    //         ->select(DB::raw('count(*) as count_comment,comments.post_id'))
    //         ->where('comments.post_id','<>',0)
    //         ->groupBy('comments.post_id')
    //         ->get();
    //     //echo $count_comment . '<hr>';

    //     $show_comments = Comment::with('user')->get();


    //     return view('pages.admins.posts.post_yourself')
    //         ->with('data',$data)
    //         ->with('count_comment',$count_comment)
    //         ->with('show_comments',$show_comments);
    // }


    // TODO Danh sách bài đăng thuộc role = teacher * 
    public function list_post_teachers()
    {
        // FIXME:
        // Đếm comment theo post_id
        $count_comment = DB::table('posts')
            ->join('comments','posts.post_id','=','comments.post_id')
            ->select(DB::raw('count(*) as count_comment,comments.post_id'))
            ->where('comments.post_id','<>',0)
            ->groupBy('comments.post_id')
            ->get();
        //echo $count_comment . '<hr>';

        $show_comments = Comment::with('user')->get();

        $post_teachers = Post::with('user')
            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
            ->join('categories','categorys_posts.category_id','categories.category_id')
            ->select('categories.*','posts.*')
            ->where([
                ['role_id','=',2],
                ['post_status','accepted'],
            ])
            ->orderBy('posts.post_id', 'desc')->paginate(5);
        //dd($post_teachers);
        return view('pages.admins.posts.list_post_teachers')
        ->with('post_teachers',$post_teachers)
        ->with('count_comment',$count_comment)
        ->with('show_comments',$show_comments);
    }


    // TODO CHỨC NĂNG LOAD COMMENT TRÊN BÀI VIẾT
    public function comment_ajax(Request $request)
    {
        if(request()->ajax())
        {
            $userId            = $request->get('userId');
            $commentContent    = $request->get('commentContent');
            $postId            = $request->get('postId');

            DB::table('comments')->insertGetId([
                'post_id'           => $postId,
                'user_id'           => $userId,
                'comment_content'  => $commentContent,
            ]);
            $count_comment = DB::table('comments')->select(DB::raw('count(*) as count_comment'))->where('post_id',$postId)->get();
            return response()->json(['postId' => $postId,'userId' => $userId ,'commentContent' => $commentContent ,'status' => 'success','count_comment' => $count_comment]);
        }

    }


    // TODO HIỂN THỊ CÁC BÀI VIẾT TRÊN LỚP CỦA MÌNH HỌC
    public function post_your_class(Request $request)
    {
        $count_comment = DB::table('posts')
            ->join('comments','posts.post_id','=','comments.post_id')
            ->select(DB::raw('count(*) as count_comment,comments.post_id'))
            ->where('comments.post_id','<>',0)
            ->groupBy('comments.post_id')
            ->get();

        $show_comments = Comment::with('user')->get();

        // FIXME: Cái này lỗi vì ngày created_at của bảng posts không lấy ra đúng
        // $post_user = Post::with('user')
        //     ->join('post_classes','posts.post_id','=','post_classes.post_id')
        //     ->join('class_users','post_classes.class_id','=','class_users.class_id')
        //     ->join('classes','class_users.class_id','=','classes.class_id')
        //     ->join('users','class_users.user_id','=','users.user_id')
        //     ->select('users.*','posts.*','classes.*')
        //     ->where([
        //         ['class_users.user_id','=',$id],
        //         ['post_status','accepted'],
        //         ])
        //         ->orderBy('post_id', 'desc')->paginate(5);
        //echo $post_user;

        // FIXMED: 
        // $post_user = User::with('classes')      // === class_users tại đặt tên nhầm
        //         ->join('class_users','users.user_id','class_users.user_id')
        //         ->join('classes','class_users.class_id','classes.class_id')
        //         ->join('post_classes','classes.class_id','post_classes.class_id')
        //         ->join('posts','post_classes.post_id','posts.post_id')
        //         ->select('classes.*','posts.*')
        //         ->where([
        //             ['users.user_id',$id],
        //             ['posts.post_status','accepted']
        //         ])->get();
                // ->orderBy('post_id', 'desc')->paginate(5);
    
                
        // FIXMED: TODO: Lỗi ngày 28/9/19 chưa lấy ra được tên của người đăng bài mà chỉ lấy tên của người có trong điều kiện where
        // TODO: ĐÃ SỬA LỖI NGÀY 29/9/19
        // $post_user = User::with('classes')      // === class_users tại đặt tên nhầm
        // ->join('class_users','users.user_id','class_users.user_id')
        // ->join('classes','class_users.class_id','classes.class_id')
        // ->join('post_classes','classes.class_id','post_classes.class_id')
        // ->join('posts','post_classes.post_id','posts.post_id')
        // ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
        // ->join('categories','categorys_posts.category_id','categories.category_id')
        // ->select('users.name','classes.class_name','categories.*','posts.*')
        // ->where([
        //     ['users.user_id',Auth::user()->user_id],
        //     ['posts.post_status','accepted']
        // ])
        // ->orderBy('post_id', 'desc')->paginate(5);

        // TODO: AWESOME !!
        $post_user = Post::with(['user','post_classes','posts_categories'])
        ->whereHas('post_classes', function ($query) {
            $query->join('class_users','post_classes.class_id','=','class_users.class_id')
            ->where('class_users.user_id',Auth::user()->user_id);
        })
        ->where('post_status','=','accepted')
        ->orderBy('post_id', 'desc')->paginate(5);
        // dd($post_user[0]->posts_categories);

        Carbon::setLocale('vi');
        $days = array();
        foreach ($post_user as $row) {
            $days[$row->post_id] = Carbon::parse($row->created_at)->diffForHumans();
        }
       

        return view('pages.admins.posts.post_your_class')
        ->with('post_user',$post_user)
        ->with('count_comment',$count_comment)
        ->with('show_comments',$show_comments)
        ->with('days',$days);
    }

    /*******************************************************************************
     * 
     * TODO          CÁC BÀI ĐĂNG LIÊN QUAN ĐẾN THỂ LOẠI
     *
     *****************************************************************************/

                // TODO BÀI VIẾT THUỘC THỂ LOẠI TÌM VIỆC LÀM CHO SINH VIÊN
                public function categories_find_job()
                {
                    $count_comment = DB::table('posts')
                    ->join('comments','posts.post_id','=','comments.post_id')
                    ->select(DB::raw('count(*) as count_comment,comments.post_id'))
                    ->where('comments.post_id','<>',0)
                    ->groupBy('comments.post_id')
                    ->get();
        
                    $show_comments = Comment::with('user')->get();

                    $post_categories = Post::with('user')
                            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
                            ->join('categories','categorys_posts.category_id','categories.category_id')
                            ->select('categories.*','posts.*')
                            ->where([
                                ['categorys_posts.category_id','=',1],
                                ['posts.post_status','accepted'],
                            ])
                    ->orderBy('post_id', 'desc')->paginate(5);
                    //echo $post_categories . '<br>';

                    return view('pages.admins.posts.categories_find_job')
                    ->with('post_categories',$post_categories)
                    ->with('count_comment',$count_comment)
                    ->with('show_comments',$show_comments);
                }


                // TODO BÀI VIẾT THUỘC THỂ LOẠI TUYỂN DỤNG VIỆC LÀM CỦA CÁC CÔNG TY
                public function categories_apply_job()
                {
                    $count_comment = DB::table('posts')
                    ->join('comments','posts.post_id','=','comments.post_id')
                    ->select(DB::raw('count(*) as count_comment,comments.post_id'))
                    ->where('comments.post_id','<>',0)
                    ->groupBy('comments.post_id')
                    ->get();
        
                    $show_comments = Comment::with('user')->get();

                    // $post_categories = Post::with('posts_categories')
                    //     ->join('users','posts.user_id','=','users.user_id')
                    //     ->select('posts.*','users.name')
                    //     ->where([
                    //         ['category_id','=',2],
                    //         ['post_status','accepted'],
                    //         ])
                    //     ->orderBy('post_id', 'desc')->paginate(5);
                    $post_categories = Post::with('user')
                            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
                            ->join('categories','categorys_posts.category_id','categories.category_id')
                            ->select('categories.*','posts.*')
                            ->where([
                                ['categorys_posts.category_id','=',2],
                                ['posts.post_status','accepted'],
                            ])
                    ->orderBy('post_id', 'desc')->paginate(5);

                    return view('pages.admins.posts.categories_apply_job')
                    ->with('post_categories',$post_categories)
                    ->with('count_comment',$count_comment)
                    ->with('show_comments',$show_comments);
                }


                // TODO BÀI VIẾT THUỘC THỂ LOẠI HỢP LỚP GẶP MẶT CỦA SINH VIÊN
                public function categories_class_meeting()
                {
                    $count_comment = DB::table('posts')
                    ->join('comments','posts.post_id','=','comments.post_id')
                    ->select(DB::raw('count(*) as count_comment,comments.post_id'))
                    ->where('comments.post_id','<>',0)
                    ->groupBy('comments.post_id')
                    ->get();
        
                    $show_comments = Comment::with('user')->get();

                    $post_categories = Post::with('user')
                            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
                            ->join('categories','categorys_posts.category_id','categories.category_id')
                            ->select('categories.*','posts.*')
                            ->where([
                                ['categorys_posts.category_id','=',3],
                                ['posts.post_status','accepted'],
                            ])
                    ->orderBy('post_id', 'desc')->paginate(5);
                    //echo $post_categories . '<br>';
                    return view('pages.admins.posts.categories_class_meeting')
                    ->with('post_categories',$post_categories)
                    ->with('count_comment',$count_comment)
                    ->with('show_comments',$show_comments);
                }


                // TODO BÀI VIẾT THUỘC THỂ LOẠI HỖ TRỢ HỌC BỔNG
                public function categories_support_scholarship()
                {
                    $count_comment = DB::table('posts')
                    ->join('comments','posts.post_id','=','comments.post_id')
                    ->select(DB::raw('count(*) as count_comment,comments.post_id'))
                    ->where('comments.post_id','<>',0)
                    ->groupBy('comments.post_id')
                    ->get();
        
                    $show_comments = Comment::with('user')->get();

                    $post_categories = Post::with('user')
                            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
                            ->join('categories','categorys_posts.category_id','categories.category_id')
                            ->select('categories.*','posts.*')
                            ->where([
                                ['categorys_posts.category_id','=',4],
                                ['posts.post_status','accepted'],
                            ])
                    ->orderBy('post_id', 'desc')->paginate(5);
                    //echo $post_categories . '<br>';
                    return view('pages.admins.posts.categories_support_scholarship')
                    ->with('post_categories',$post_categories)
                    ->with('count_comment',$count_comment)
                    ->with('show_comments',$show_comments);
                }


                // TODO BÀI VIẾT THUỘC THỂ LOẠI QUYÊN GÓP TRANG THIẾT BỊ
                public function categories_donations()
                {
                    $count_comment = DB::table('posts')
                    ->join('comments','posts.post_id','=','comments.post_id')
                    ->select(DB::raw('count(*) as count_comment,comments.post_id'))
                    ->where('comments.post_id','<>',0)
                    ->groupBy('comments.post_id')
                    ->get();
        
                    $show_comments = Comment::with('user')->get();

                    $post_categories = Post::with('user')
                            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
                            ->join('categories','categorys_posts.category_id','categories.category_id')
                            ->select('categories.*','posts.*')
                            ->where([
                                ['categorys_posts.category_id','=',5],
                                ['posts.post_status','accepted'],
                            ])
                    ->orderBy('post_id', 'desc')->paginate(5);
                    //echo $post_categories . '<br>';
                    return view('pages.admins.posts.categories_donations')
                    ->with('post_categories',$post_categories)
                    ->with('count_comment',$count_comment)
                    ->with('show_comments',$show_comments);
                }


                // TODO BÀI VIẾT THUỘC THỂ LOẠI "THÔNG BÁO"
                public function categories_notifications()
                {
                    $count_comment = DB::table('posts')
                    ->join('comments','posts.post_id','=','comments.post_id')
                    ->select(DB::raw('count(*) as count_comment,comments.post_id'))
                    ->where('comments.post_id','<>',0)
                    ->groupBy('comments.post_id')
                    ->get();
        
                    $show_comments = Comment::with('user')->get();

                    $post_categories = Post::with('user')
                            ->join('categorys_posts','posts.post_id','categorys_posts.post_id')
                            ->join('categories','categorys_posts.category_id','categories.category_id')
                            ->select('categories.*','posts.*')
                            ->where([
                                ['categorys_posts.category_id','=',6],
                                ['posts.post_status','accepted'],
                            ])
                    ->orderBy('post_id', 'desc')->paginate(5);
                    //echo $post_categories . '<br>';
                    return view('pages.admins.posts.categories_notifications')
                    ->with('post_categories',$post_categories)
                    ->with('count_comment',$count_comment)
                    ->with('show_comments',$show_comments);
                }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function post_class_url($classID = null)
    {
        if($classID)
        {
            $userID = DB::table('posts')->select('posts.user_id')
            ->where([
                ['status_user','blocked'],
                ['posts.user_id','=',Auth::user()->user_id]
                ])->value('posts.user_id'); 
            $count = Post::with('user')
                ->select(DB::raw('count(*) as user_count, user_id'))
                ->where('user_id', '<>', 0)
                ->groupBy('user_id')
                ->get();

            $categories = Category::all();

            $classes = Classes::all();
            $roles = Role::all();
            $course = Classes::selectRaw('YEAR(class_begin) as year,class_name,class_id')
                ->orderby('class_begin','desc')
                ->get();
            $only_class = Classes::selectRaw('YEAR(class_begin) as year,class_name,class_id')
                ->where('class_id',$classID)
                ->orderby('class_begin','desc')
                ->value('class_id');
            // dd($only_class);
            return view('pages.admins.posts.add_posts',['userID' => $userID,'count' => $count,
            'categories' => $categories,'classes' => $classes,'roles'=> $roles,'course'=> $course,'only_class' => $only_class]);
        }
    }


    // TODO: XÓA BÀI ĐĂNG
    public function destroy($postID)
    {
        $post = Post::findOrFail($postID);
        $post->delete();

        return redirect('posts')->with('success', 'Data Deleted Success');
    }


    // TODO CẬP NHẬT COMMENT CỦA NGƯỜI DÙNG
    public function submit_comment(Request $request, $commentID)
    {
        $comment = Comment::findOrFail($commentID);
        $comment->comment_content = $request->get('comment_content');
        // dd($comment);
        $comment->save();
        return back()->with('success','Cập nhật bình luận thành công!');
    }



    // TODO XOA COMMENT
    public function delete_comment(Request $request, $commentID)
    {
        $comment = Comment::findOrFail($commentID);
        $comment->delete();
        return back()->with('success','Xóa bình luận thành công');
    }
}
