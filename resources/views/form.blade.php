<!DOCTYPE html>
<head>
  <title>Task</title>
  <script src="{{ asset("js/app.js") }}"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>
<body>

<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card my-5">
                <a href="{{ route('home') }}" class="btn btn-primary">back to home page</a> 
                <div class="card-body">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('tasks.sendMessage') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="message">task : </label>
                            <input type="text" name="message" id="message" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>