<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>
  
  <div class="container mt-3">

    <!-- @if($errors->any())
    <div class="alert alert-danger mb-3">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif -->

    
    <div class="card">
      <div class="card-header">
      <h2>สมัครสมาชิก</h2>
      </div>

      <form method="post" class="card-body" action="{{ route('customer.store') }}">
      @csrf
        <div class="row">
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-6 mb-3">
                <label for="username" class="form-label">ชื่อผู้ใช้:</label>          
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"  name="username" value="{{old('username')}}" placeholder="กรุณาระบุชื่อผู้ใช้" maxlength="100">
                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
              </div>
    
              <div class="col-sm-6 mb-3">
                <label for="password" class="form-label">รหัสผ่าน:</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}" placeholder="กรุณาระบุรหัสผ่าน" maxlength="100" >
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 mb-3">
                <label for="firstName" class="form-label">ชื่อ:</label>
                <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName"  name="firstName"  value="{{old('firstName')}}" placeholder="กรุณาระบุชื่อ" >
                <div class="invalid-feedback">{{ $errors->first('firstName') }}</div>
              </div>
    
              <div class="col-sm-6 mb-3">
                <label for="lastName" class="form-label">นามสกุล:</label>
                <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" value="{{old('lastName')}}" placeholder="กรุณาระบุนามสกุล" >
                <div class="invalid-feedback">{{ $errors->first('lastName') }}</div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label for="address" class="form-label">ที่อยู่:</label>
                <textarea class="form-control" rows="3" name="address" id="address"></textarea>
              </div>              
            </div>
            
          </div>
            <div class="col-sm-4">
              <label>รูปภาพ : </label>
              <div class="card" style="width: 180px;">
                <img src="/assets/customer/avatar.png" alt="ภาพโปรไฟล์" class="rounded" style="width :180px;height :180px" />
              </div>
              <input type="file" name="file" index="file" required/>
            </div>
        </div>



        <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>

      </form>

    </div>
  </div>
</body>
</html>