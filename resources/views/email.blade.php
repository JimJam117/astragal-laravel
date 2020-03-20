<body>
    <h1>New contact from jsparrow.uk!</h1>
<h3>From: {{$name ?? "No name received"}}</h3>
<h3>Email: {{$email ?? "No email received"}}</h3>
<h3>Message:</h3>
{{$body ?? "No message received"}}
</body>



<style>
    body{
        text-align: center;
    font-family: sans-serif;
    }
</style>