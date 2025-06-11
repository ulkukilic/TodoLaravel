<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;         // Şifreleri hash’lemek için

class AuthController extends Controller
{

      public function showLoginForm() // giris formu
      {
        return view('auth.login'); // auth daki login sayfasina yonlendiriyor
      }
      
      public function login(Request $request)// request sinifindan gelen neseler kabul edilir gonderilen parametreler listesisidr yani loginden  gelen islemler kabul edilir 
      {
         $credentails= $request->validate([// verilerde dogrulama islemi yapilmak icin $credentials adli degiskende veriler saklanir
            'email'=>'required|emil',
            'password'=>'required',
         ]);
          
         $user=DB::table('users')
         ->where('email',$request->email)
         ->first(); // burda users tablosunda kayitli olan veriyi cekiyoruz
        

          if ($user->user_type_id ==1)
         {
            return redirect()->route('dash.customer');
         }
          
          elseif ($user->user_type_id == 2) 
         {
            return redirect()->route('dash.admin');
         }
          return back() // mail veya sifre hataliysa geri bidligim atiyor
          ->withErrors(['email' => 'The e-mail or password is incorrect.'])
          ->withInput($request->only('email')); 
       }

       public function logout(Request $request) // tutulan bilgier session da tutuldugu icin onlar temizleniyor
       {
           $request->session()->flush();
           return redirect()->route('login.form');
       }
      
        public function showRegistrationForm() // bu class kayit formunu gosteir 
        {
           return view ('auth.register'); // auth/register.blande.php sayfasini yukleme islemi gorur
        }
        
        public function register(Request $request)
        {
           $validator = Validator::make(
           $request->all(),   // Doğrulanacak veri
            [                  // Kurallar
                'email'    => 'required|email',
                'password' => 'required|min:8'
            ]);
           $validated = $request->only(['name', 'surname','email', 'password']); // formda yazilan yerlerden sadece bu alanlari tutuyoruz 
           
           DB::table('users')->insert([ // yeni kullanici olsutururken burdan alinan dizi icerisindeki veriler kullanima uygun sekilde sql alanina insert ediliyor
            'full_name' => $validated['name']. ' ' . $validated['surname'],        // formdaki name alanı full_name sutununa kaydedilir
            'email'     => $validated['email'],       // formdaki email alanı email sutununa kaydedilir
            'password'  => Hash::make($validated['password']), // plain password bcrypt ile hash'lenir
            'user_type_id'  => 1, 
           ]);
  
           return redirect()
            ->route('login.form')
            ->with('success');
        }
}
