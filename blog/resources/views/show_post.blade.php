<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        @foreach($listPosts as $post)
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="{{ $post->title }}" disabled="true">
                    </div>
                </div>
                <div class="col-2 text-center">
                    <a href="" class="btn btn-primary ">Update</a>
                </div>
                <div class="col-2 text-center">
                    <a href="" class="btn btn-danger ">Delete</a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>