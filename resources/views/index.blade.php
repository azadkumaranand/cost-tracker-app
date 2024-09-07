<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cost Tracker App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
</head>
<style>
    #datepicker:focus{
        border: none;
        outline: none;
    }
</style>
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
                        <input type="number" value="" class="form-control" id="cost" name="cost">
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-success">Add</button>
            </div>
        </form>
        <div class="investments my-3">
            {{-- <form action="{{route('index')}}" method="GET" id="date-form"> --}}
            <label for="datepicker" class="my-4">
                <span>{{$selectedate}}</span>
                <svg style="color: red; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2"/>
                    <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a13 13 0 0 1 1.313-.805h.632z"/>
                  </svg>
            </label>
            
            <input type="text" id="datepicker" value="{{$selectedate}}" name="date" style="border: none">
        {{-- </form> --}}
          <h5 class="my-4">You have invested {{$toalamount}}, in this month</h5>
            @foreach ($investments as $investment)
                <div class="card mb-3">
                  <div>
                    <span class="badge text-bg-success">Month: {{substr($investment->created_at, 4)}} | Year:{{substr($investment->created_at, 0, 4)}}</span>
                  </div>
                  <form action="{{route('edit')}}" method="post" id="update-form-{{$investment->id}}">
                    <div class="row p-3">
                            @csrf
                            <div class="col-md-6">
                                <input type="hidden" name="id" value="{{$investment->id}}">
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
                        </div>
                    </form>
                    <div class="button-group">
                        <button class="btn btn-warning edit" data-id="{{$investment->id}}">Edit</button>
                        <button type="button" class="btn btn-danger delete-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{$investment->id}}">Delete</button>
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
    
    <script>
        $(function(){
            $('#datepicker').datepicker(); 
            $('#datepicker').datepicker('option', 'dateFormat', 'dd/mm/yy'); 
        });
        $('#datepicker').on('change', ()=>{
            let date = $('#datepicker').val();
            window.location.href = `{{route('index')}}?date=${date}`;
        });
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
                let form = document.querySelector(`#update-form-${id}`);
                console.log(cost_input.disabled);
                if(cost_input.disabled == false){
                    form.submit();
                }
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
