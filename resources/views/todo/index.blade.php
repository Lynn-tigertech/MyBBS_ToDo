
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <title>My Todos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main>
        <header>
            <h1>Todos</h1>
                <span class="delete-all-todos" data-url="{{ route('todo.deleteall') }}" >Purge</span>
        </header>

        <form action="{{ route('todo_store') }}" method="POST">
            @csrf
            <input type="text" name="title" value="" placeholder="Type new todo.">
        </form>

        <ul>
            @foreach ($todos as $todo)
                <li id="{{ $todo->id }}" class="chk">
                    <input type="checkbox" class="sub_chk" data-id="{{ $todo->id }}">
                    <span>{{ $todo->title }}</span>
                    <span class="delete">
                        <a onclick="return confirm('Are you sure want to delete this record?')" href="{{ route('todo.delete', $todo->id) }}">x</a>
                    </span>
                </li>
            @endforeach
        </ul>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#deleteAllTodo').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            $('.delete-all-todos').on('click', function(e) {
                let allTodos = [];

                $(".sub_chk:checked").each(function() {
                    allTodos.push($(this).attr('data-id'));
                });

                if (allTodos.length <= 0) {
                    alert("Please select atleast one checkbox.");
                } else {
                    let check = confirm("Are you sure you want to delete this record?");

                    if(check == true) {
                        let todo_ids = allTodos.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+todo_ids,
                            success: function (data) {
                                if (data['success']) {
                                    alert(data['success']);
                                    location.reload();
                                } else {
                                    alert('Something went wrong!!');
                                }
                            },
                                error: function (data) {
                                    alert(data.responseText);
                                }
                            });
                        }
                    }
                });
            });
    </script>
</body>
</html>
