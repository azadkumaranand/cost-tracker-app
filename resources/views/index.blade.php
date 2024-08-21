<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container my-3">
        <h3 class="text-center">Add Your Investment</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('about') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="liablity" class="form-label">Liability</label>
                        <input type="text" class="form-control" id="liablity" name="liablity">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cost" class="form-label">Cost</label>
                        <input type="number" class="form-control" id="cost" name="cost">
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-success">Add</button>
            </div>
        </form>
        <div class="investments my-3">
          <h5 class="mb-2">This month investment</h5>
            @foreach ($investments as $investment)
                <div class="card">
                  <div>
                    <span class="badge text-bg-success">{{\Carbon\Carbon::parse($investment->created_at)->format('d/m/Y');}}</span>
                  </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="liablity" class="form-label">Liability</label>
                                <input type="text" class="form-control" id="liablity" name="liablity" value="{{$investment->liablity}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control" id="cost" name="cost" value="{{$investment->cost}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
