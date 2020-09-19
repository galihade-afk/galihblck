<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

use App\User;
use App\Todo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function list()
    {
        $date = date("d");
        $date = (int)$date;
        // dd($date);
        $data = Todo::all();
        // $arr = [];
        foreach ($data as $list) {
            $day = $list->created_at;
            
            $day = explode("-",$day);
            $day = explode(" ",$day[2]);
            
            $day = (int)$day[0];
            $day = $date - $day;
            if($day < 0)
            {
                $day = $day*-1;
            }

            $list->dateFrom = $day;
            
        }
        
        return response()->json($data);
    }

    public function profile()
    {
        return view('admin/profile');
    }

    public function update_profile(Request $request)
    {
        $img                = $request->file('img');
        $data               = User::find($request->id);
        if (isset($img) )
        {   
            if ($data->img != "user.png")
            {
                $file       = "storage/user/".$data->img;
                if (File::exists($file))
                {
                    File::delete($file);
                }
            }            
            $nama_file      = time()."_".$img->getClientOriginalName();
            $img->move('storage/user/',$nama_file);
            User::where('id', $request->id)
            ->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'birthday'  => $request->birthday,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'img'       => $nama_file
            ]);
        }
        else
        {
            User::where('id', $request->id)
            ->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'birthday'      => $request->birthday,
            'phone'         => $request->phone,
            'address'       => $request->address
            ]);
        }        
        return redirect('/admin')->with('success','Your work has been updated');
    }

    public function todo_list()
    {
        return view("admin/todo");
    }

    public function todo_upload(Request $request)
    {
        $request->validate([
            'title'         =>'required|min:3',
            'date'          =>'required',
            'description'   => 'required'
        ]);

        $data               = $request->file('img');
        if (isset($data))
        {
            $image          = $request->file('img');
            $file_name      = time()."_".$image->getClientOriginalName();

            $image->move('storage/todo',$file_name);
        }
        else
        {
            $file_name      = 'nopicture.png';
        }

        Todo::create([
            'user_id'       => $request->user_id,
            'title'         => $request->title,
            'date'          => $request->date,
            'description'   => $request->description,
            'img'           => $file_name    
        ]);

        $status             = 'OK';
        return response()->json($status);
    }

    public function api(Request $request)
    {
        // dd($request->all());
        $data               = Todo::where('user_id', $request->user_id)
                                ->orderBy('date', 'asc')
                                ->paginate($request->show_qty);
        // dd($data->all());
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $data               = Todo::find($request->id);
        if ($data->img != "nopicture.png")
        {
            $file           = "storage/todo/".$data->img;
            if (File::exists($file))
            {
                File::delete($file);
            }
        }

        Todo::destroy($request->id);
        
        $data->status = "1"; 

        return response() -> json($data);
    }

    public function edit(Request $request)
    {
        $data               = Todo::find($request->id);
        return response()->json($data);
    }

    public function todo_update(Request $request)
    {
        // dd($request->all());
        $data                   = $request->file('img');
        if (isset($data))
        {
            $data               = Todo::find($request->id);
            $file               = "storage/todo/".$data->img;
            if (File::exists($file))
            {
                File::delete($file);
            }

            $image              = $request->file('img');
            $file_name          = time()."_".$image->getClientOriginalName();
            
            $image->move('storage/todo',$file_name);
            Todo::where('id',$request->id)
            ->update([
                'title'         => $request->title,
                'date'          => $request->date,
                'description'   => $request->description,
                'user_id'       => $request->user_id,
                'img'           => $file_name
            ]);
        }
        else
        {
            Todo::where('id',$request->id)
            ->update([
                'title'         => $request->title,
                'date'          => $request->date,
                'description'   => $request->description,
                'user_id'       => $request->user_id,
            ]);
        }

        $status                 = 'OK';
        return response()->json($status);
    }


    public function reminder(Request $request)
    {
        $tomorrow = "";

        //checking last day in month
        if($request->month == "12" || $request->day == "31")
        {
            $tomorrow = ($request->year+1)."-01-01";

        }else if($request->day == $request->totalDay)
        {
            $month = $request->month+1;
            if(strlen($month) == 1)
            {
                $month = "0".$month;
            }
            
            $tomorrow = $request->year."-".$month."-01";

        }else
        {
            if(strlen($request->month) == 1)
            {
                $month = "0".$request->month;
                
            }else
            {
                $month = $request->month;
            }
            $tomorrow = $request->year."-".$month."-".($request->day+1);
        }
        

        $reminder = Todo::where('date', $tomorrow)
                ->where('user_id', $request->id)
                ->get();

        // dd($tomorrow);
        return response()->json($reminder);
        
    }
}
