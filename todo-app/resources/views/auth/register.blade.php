@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
         @foreach($errors->all() as $error)  <!-- iceride hata veren tum errorlari alir ve liste halinde yazdirir -->
         <li> {{$error}} </li>
         @endforeach
</ul>
</div>
@endif 

<form method="POST" action="{{route('register.submit')}}"> <!-- alinicak degerler post ile gonderilir-->
 @csrf <!-- Her kullanici icin oturum acildiginda LAravel , session icerisinde rastgele token uretir form gondeirlirken bu bilgi kontrol edilir  dogru ise devam eder  -->   
 <div class="form-group">
            <label for="name"> Name </label>
            <input   
                type="text"
                id="name"  
                name="name"   
                class="form-control" 
                value="{{ old('name') }}"
                required
            > <!-- {{old('name')}} önceki gonderide input degerini korur -->
        </div>

        <div class="form-group">
            <label for="surname">Last Name</label>
            <input
                type="text"
                id="surname"
                name="surname"
                class="form-control"
                value="{{ old('surname') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="password"> Password </label>
            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                required
            >
        </div>

        <div class="form-group">
            <label for="password_confirmation">Password Again </label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Register</button>

        <p class="mt-2">
            Already have an account?
            <a class="text-primary" href="{{ route('login.form') }}">Sign in</a>
        </p>
    </form>
@endsection