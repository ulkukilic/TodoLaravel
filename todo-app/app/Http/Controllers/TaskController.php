<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;         // Şifreleri hash’lemek için

class TaskController extends Controller
{
    public function index()
    {
         // Rolü ve kimliği oturumdan al
        $role   = Session::get('role');          // 'admin' -or- 'customer'
        $userId = Session::get('user_uni_id');   // giriş yapan kullanıcının PK’si

      
        $query = DB::table('task');

        if ($role !== 'admin') 
        {
            $query->where('user_uni_id', $userId);
        }
         
        $tasks=$query->orderBy('title')
        ->get();

        return view('task.index',compact('tasks')); // blade'e tasklar gonderilir 
    }

    public function create()
    {
       return view('tasks.create'); // yni task olusturmak icin tasks klasoru icerisinde ki create formunu dondurur
    }
    
    public function createStore()
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        DB::table('task')->insert([
            'user_uni_id' => Session::get('user_uni_id'),
            'title'       => $request->title,
            'description' => $request->description,
            
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev eklendi.');
    }

    public function edit($id)
    {
         $role=session::get('role');  // kullanicinin rolunu oturumdan alir
         $userId=session::get('user_uni_id'); // hangi kullanici oldugunu ID den alir

         $task=DB::table('task')// 'task' tablosundan düzenlenecek görevi sorgular
          ->when($role !=='admin',fn($q)=>$q->where('user_uni_id',$userId))// Eğer kullanıcı 'admin' değilse, sadece kendi görevlerine erişim izni verir
          ->where('task_id',$id)//$id değerine göre görevi seçer
          ->first(); // sorgunun sonucunu getirir
    
        return view('tasks.edit', compact('task')); // sonucu edit kismina gonderir
    }

    public function  update(Request  $request, $id) //Url den gelen  adresi php $_get , $_post gibi degiskenlere gonderir , larabel de degiskenleri okuyup HTTP\Request nesenesinin icine paketler ve function olarak cagrildginda otomatik paramtete olarak gecilir
     {

      $request->validate([
         'title'       => 'required|max:255',
         'description' => 'nullable|string',
      ]);

      $role   = Session::get('role');
      $userId = Session::get('user_uni_id');
      
      $query = DB::table('task')->where('task_id', $id);
      
      $affected = $query->update([ // hazirlanan sorgu ile yeni degrler calistirilir. $affected degiskeni , bu "etkilenen satir sayisini" sakladiig iicn bu isimde kullanilri.
          'title'       => $request->title,
          'description' => $request->description,
          'updated_at'  => now(),
       ]);

        return redirect()->route('tasks.index')->with('success', 'Görev güncellendi.'); //Başarılıysa görev listesine yönlendir ve başarı mesajı göster
     }
}