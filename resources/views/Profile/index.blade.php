<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <div>
        <h2>User Profile</h2>
        <div>
            <dl>
                <div>
                    <dt>ID</dt>
                    <dd>{{ Auth::user()->id }}</dd>
                </div>
                <div>
                    <dt>Name</dt>
                    <dd>{{ Auth::user()->name }}</dd>
                </div>
                <div>
                    <dt>Email</dt>
                    <dd>{{ Auth::user()->email }}</dd>
                </div>
                <div>
                    <dt>Created At</dt>
                    <dd>{{ Auth::user()->created_at->format('F j, Y, g:i a') }}</dd>
                </div>
                <div>
                    <dt>Updated At</dt>
                    <dd>{{ Auth::user()->updated_at->format('F j, Y, g:i a') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</body>
</html>
