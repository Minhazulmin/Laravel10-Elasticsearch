<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="mt-5 card p-5">
            <form method="post" action="{{route('store.data')}}">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control"  name="name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control"  name="email">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control"  name="phone">
                </div>
                <button type="submit" class="btn btn-info mt-2">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
