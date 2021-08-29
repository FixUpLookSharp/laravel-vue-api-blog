<h1>Пояснение</h1>
<p>{{ $data['explanation'] }}</p>

<h1>Пользователь</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Ид</th>
        <th scope="col">Имя</th>
        <th scope="col">Ник</th>
        <th scope="col">Email</th>
        <th scope="col">Email с формы</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">{{ $data['user']['id'] }}</th>
        <td>{{ $data['user']['name'] }}</td>
        <td>{{ $data['user']['nickname'] }}</td>
        <td>{{ $data['user']['email'] }}</td>
        <td>{{ $data['email'] }}</td>
    </tr>
    </tbody>
</table>
