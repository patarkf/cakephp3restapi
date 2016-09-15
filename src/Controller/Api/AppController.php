<?php
namespace App\Controller\Api;

use Cake\Controller\Controller;

class AppController extends Controller
{

    use \Crud\Controller\ControllerTrait;

    public $components = [
        'Flash',
        'RequestHandler',
        'Crud.Crud' => [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete',
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog',
            ],
        ],
    ];

    public function initialize()
    {
        $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form',
                'ADmad/JwtAuth.Jwt' => [
                    'parameter' => '_token',
                    'userModel' => 'Users',
                    'scope' => ['Users.active' => 1],
                    'fields' => [
                        'id' => 'id',
                    ],
                ],
            ],
        ]);
    }
}
