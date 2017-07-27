<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'token']);
    }

    public function add()
    {
        $this->Crud->on('afterSave', function (\Cake\Event\Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => $token = \Firebase\JWT\JWT::encode(
                        [
                            'id' => $event->subject->entity->id,
                            'exp' => time() + 604800,
                        ],
                        Security::salt()),
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }

    public function token()
    {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }

        $this->set([
            'success' => true,
            'data' => [
                'token' => $token = \Firebase\JWT\JWT::encode([
                    'id' => $user['id'],
                    'exp' => time() + 604800,
                ],
                    Security::salt()),
            ],
            '_serialize' => ['success', 'data'],
        ]);
    }
}
