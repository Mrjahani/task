<!DOCTYPE html>

<head>
    <title>Todo List</title>
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('308cb53dc8ce56b20c50', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('message-channel');
    channel.bind('message-event', function(data) {
        let messageSection = $("#message");
        console.log(data.id)
        messageSection.append(`
        <div class='alert alert-primary'>${data.message}</div>
        `);
    });
    </script>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>

<body>

    <div class="container">
        
        <h1>Todo List</h1><a href="{{ route('tasks.formTask') }}" class="btn btn-success">task+</a> 
        <hr>
        <div id="message"></div>
        @foreach ($tasks as $task)
         <div class='alert alert-primary'>{{ $task->message }}
             <a href="{{ route("tasks.edit" , $task->id) }}" style="color:blue">ویرایش</a>
             <form action="{{ route("tasks.delete" , $task->id) }}" method="post">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-default" value="حذف">
            </form>
         </div>
        @endforeach
    </div>

</body>