<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>  

  <div class="container mt-3" style="max-width: 600px;">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    
    <div class="col"></div>
    <div class="card">
      <div class="card-header">
      <h2>ระบบการประมาณราคาบ้านที่เหมาะสม</h2>
      </div>      

      <form method="post" class="card-body" action="{{ route('houseprice.predict') }}">
      @csrf
        <div class="mb-3">
          <label for="age" class="form-label fw-bold">อายุบ้าน (ปี) :</label>          
          <input type="text" class="form-control @error('age') is-invalid @enderror" id="age"  name="age" value="{{old('age')}}" placeholder="กรุณาระบุอายุบ้าน">
          <div class="invalid-feedback">{{ $errors->first('age') }}</div>
        </div>

        <div class="mb-3">
          <label for="distance" class="form-label fw-bold">ระยะทาง (เมตร) :</label>
          <input type="text" class="form-control @error('distance') is-invalid @enderror" id="distance" name="distance" value="{{old('distance')}}" placeholder="กรุณาระบุระยะทางจากบ้านไปยังรถไฟฟ้า" >
          <div class="invalid-feedback">{{ $errors->first('distance') }}</div>
        </div>

        <div class="mb-3 mt-3">
          <label for="minimart" class="form-label fw-bold">จำนวนร้านสะดวกซื้อ (แห่ง) :</label>
          <input type="text" class="form-control @error('minimart') is-invalid @enderror" id="minimart"  name="minimart"  value="{{old('minimart')}}" placeholder="กรุณาระบุจำนวนร้านสะดวกซื้อ" >
          <div class="invalid-feedback">{{ $errors->first('minimart') }}</div>
        </div>

        <button type="submit" class="btn btn-primary">ประเมินราคาบ้าน</button>

      </form>

    </div>
  </div>
</body>
</html>