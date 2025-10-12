<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <h1>Someone is Enquiring Us </h1>
    <p>Name: {{ $name }}</p>
    <p>Email: {{ $email }}</p>
    <p>Phone number: {{ $phone ?? '' }}</p>
    <p>Address: {{ $address }}</p>
    <p>Message: {{ $enquiry_message }}</p>
    <p>Branch: {{ $branch->name }}</p>

</body>

</html>
