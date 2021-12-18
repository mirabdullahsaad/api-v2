Passport was used for generating new token for user and authentication.
Pusher was used for broadcasting.
to create a new user post data to /v1/signup

    {
        "name":"jon",
        "email":"jon@gmail.com",
        "password":"12345678"
    }
    
to sign in post data to /v1/signin

    {
        "email":"jon@gmail.com",
        "password":"12345678"
    }
    
to get all dataset send get request to /v1/get-user-data

to broadcast data send get request to /broadcast

to listen to broadcast data open /listen
