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
          <h5 class="my-4">You have invested {{$toalamount}}, in this month</h5>
            @foreach ($investments as $investment)
                <div class="card mb-3">
                  <div>
                    <span class="badge text-bg-success">{{\Carbon\Carbon::parse($investment->created_at)->format('d/m/Y');}}</span>
                  </div>
                    <div class="row p-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="liablity" class="form-label">Liability</label>
                                <input type="text" class="form-control liability-input-{{$investment->id}}" id="liablity" name="liablity" value="{{$investment->liablity}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control cost-input-{{$investment->id}}" id="cost" name="cost" value="{{$investment->cost}}" disabled>
                            </div>
                        </div>
                        <div class="button-group">
                            <button class="btn btn-warning edit" data-id="{{$investment->id}}">Edit</button>
                            <button type="button" class="btn btn-danger delete-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{$investment->id}}">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- delete modal start --}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Do you want to delete</h6>
                </div>
                <form action="{{route('delete')}}" method="POST">
                    @csrf
                    <input type="hidden" id="delete-input-id" name="id">
                    <div class="modal-footer">
                        <button class="btn btn-danger delete" href="">Confirm</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    {{-- delete modal end --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        const editbtns = document.querySelectorAll('.edit');
        const deletebtns = document.querySelector('.delete');
        const delete_modal = document.querySelectorAll('.delete-modal');
        const delete_input_id = document.querySelector('#delete-input-id');
        console.log(editbtns);
        editbtns.forEach((btns) => {
            btns.addEventListener('click', ()=>{
                const id = btns.getAttribute('data-id');
                let liability_input = document.querySelector(`.liability-input-${id}`);
                let cost_input = document.querySelector(`.cost-input-${id}`);
                console.log(cost_input.disabled);
                if(cost_input.disabled == false){
                    // alert("{{route('edit')}}?id="+id+"&liablity="+liability_input.value+"&cost="+cost_input.value);
                    window.location.href = "{{route('edit')}}?id="+id+"&liablity="+liability_input.value+"&cost="+cost_input.value;
                }http://127.0.0.1:8000/edit?id=2&liablity=abanana&cost=100
                liability_input.disabled = false;
                cost_input.disabled = false;
                btns.innerText = 'Update';
            })
        });
        delete_modal.forEach((btns)=>{
            btns.addEventListener('click', ()=>{
                const id = btns.getAttribute('data-id');
                delete_input_id.value = id;
            });
        })
        
        // deletebtns.addEventListener('click', ()=>{
        //     const id = btns.getAttribute('data-id');
        //     alert(id)
        // });
    </script>
</body>

</html>
