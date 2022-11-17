
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Todos</h1>
        <span class="purge">Purge</span>
    </header>

    <form action = "{{ route('todo_store') }}" method = "POST" >
        @csrf
        <input type = "text" name = "title" value = "" placeholder = "Type new todo.">
    </form>

    <ul>
        @foreach ($todos as $todo)
        <li id = "{{ $todo->id }}">
            <input type = "checkbox" <?= $todo->is_done ? 'checked' : ''; ?>>
            <span>{{ $todo->title }}</span>
            <span class = "delete">
                <a onclick = "return confirm('Are you sure?')" href = "{{ url('todo_delete/'.$todo->id) }}">x</a>
            </span>
        </li>
        @endforeach
    </ul>
  </main>
  <script src="js/main.js"></script>
<script>
    'use strict';
    const purge = document.querySelector('.purge');
    purge.addEventListener('click', () => {
        if (!confirm('Are you sure?')) {
            return;
        }
    fetch(purge, {
      method: 'POST',
      body: new URLSearchParams({
      }),
    });
  });
</script>
</body>
</html>
