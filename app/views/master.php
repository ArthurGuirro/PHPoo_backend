<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $this->e($title)?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php echo $this->section('css')?>
</head>
<body>
    <div class="container">
            <?php echo $this->insert('partials/header')?>
            <?php echo $this->section('content')?>
            <?php echo $this->insert('partials/footer')?>
    </div>

</body>
</html>