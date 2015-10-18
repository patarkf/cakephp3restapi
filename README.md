# CakePHP 3 REST API

A skeleton for creating a REST API using CakePHP 3 with the awesome plugins JWT Authentication and CRUD.
This API was built using the amazing [Bravo's Kernel tutorial](http://www.bravo-kernel.com/2015/04/how-to-build-a-cakephp-3-rest-api-in-minutes/).

### Installation
Firstly, you must create a database and set it on config/app.php file. After that, must run the migrations, that will create the example tables:

```sh
$ bin/cake migrations migrate
```

After that, if all goes well, the API can now be tested through a REST Client as the [Postman](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop), for Chrome.

You can access or retrieve data in two ways: by API or browser request. By the way, in this project, only the API requires some authorization (by JWT, but I'll explain later), if you try to access the data by browser request, you will get it. For example:

```sh
http://localhost/restful/cocktails
```

It will retrieve the list of cocktails existing in the database and display it in the browser. To access the API you must use the "API" prefix in the URL, as in the example below:

```sh
http://localhost/restful/api/cocktails
```

To get permission, you need to have a valid JWT. To get one, you must follow the following steps. With the chosen REST Client, use these settings:

```sh
Url: http://localhost/restful/api/users/register
Http method: POST
Accept Header application/json
Content-Type Header application/json
Body: data with username and password in JSON format. For example:

{
	"username": "patrick",
	"password": "test123",
	"active": true
}
```
If all goes well, a success message 201 will be returned via JSON:
```sh
{
    "success": true,
    "data": {
        "id": 2,
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNDQ1NjA4MjM1fQ.7YJifOL0nQf3XwR1XWIZ969IMzLbFuYLniEEojVjoqA"
    }
}
```

### Accessing the API

After obtaining your token, you will get permission to access all the API, using the Authorization Header with the generated JWT, with the following format:
```sh
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNDQ1NjA4MjM1fQ.7YJifOL0nQf3XwR1XWIZ969IMzLbFuYLniEEojVjoqA
```
#### Index (retrieve all cocktails):
```sh
URL http://cake3api.app/api/cocktails
HTTP Method GET
Accept Header application/json
Authorization Header containing Bearer {YOUR-JWT-TOKEN}
```

#### View (retrieve a specific cocktail):
```sh
URL http://cake3api.app/api/cocktails/5
HTTP Method GET
Accept Header application/json
Authorization Header containing Bearer {YOUR-JWT-TOKEN}
```

#### Add (create a new cocktail):
```sh
URL http://cake3api.app/api/cocktails
HTTP Method POST
Accept Header application/json
Content-type Header aplication/json
Authorization Header containing Bearer {YOUR-JWT-TOKEN}
Body in JSON format:
{ 
    "name": "new cocktail",
	"description": "description"
}
```
#### Edit (update a cocktail info):
```sh
URL http://cake3api.app/api/cocktails/5
HTTP Method PUT
Accept Header application/json
Content-type Header aplication/json
Authorization Header containing Bearer {YOUR-JWT-TOKEN}
Body in JSON format (partial or all content):
{ 
	"description": "new description"
}
```

#### Delete:
```sh
URL http://cake3api.app/api/cocktails/5
HTTP Method DELETE
Accept Header application/json
Authorization Header containing Bearer {YOUR-JWT-TOKEN}
```
This project is completely extensible and was built with the premise to be a case study, so you can create your own controllers using this skeleton as a base.
