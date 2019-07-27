<table>
    <thead>
    <tr>
        <th>message</th>
        <th>date</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($messages as $message)
        <tr>
            <td>{{$message->message}}</td>
            <td>{{$message->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>