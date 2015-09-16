<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Email\Email;
use Intervention\Image\ImageManager;


class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'add', 'logout']);
    }

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    /**
     * Visualisations de tout les tickets pour les admins/modos
     **/
    public function index()
    {
        $this->loadModel('Tickets');

        $user = $this->Auth->user();
        $tickets_count = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();

        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('tickets_count', $tickets_count);
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }
    /**
     * Connexion votre compte
     */
    public function login()
    {
        $userLogin = $this->Auth->identify();

        if ($userLogin) {
            $this->Auth->setUser($userLogin);
            $user = $this->Users->newEntity($userLogin);
            $user->isNew(false);
            $user->last_login = new Time();
            $url = $this->Auth->redirectUrl();

            $this->Users->save($user);
            $this->request->session()->write('Auth.User', $user);

            return $this->redirect($url);
        }
    }

    /**
     * Visualisations de tout les tickets pour les admins/modos
     **/
    public function view($id = null)
    {
        $this->loadModel('Tickets');

        $user = $this->Auth->user();
        $tickets_count = $this->Tickets->find('all', [
            'conditions' => [
                'Tickets.user_id' => $user['id']
            ]
        ])->count();

        $user = $this->Users->get($id, [
            'contain' => ['Tickets']
        ]);

        $this->paginate = [
            'maxLimit' => Configure::read('Paginate.Ticket.viewUsers'),
            'conditions' => [
                'Tickets.user_id' => $user['id']
            ]
        ];

        $this->set('user', $user);
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('tickets_count', $tickets_count);
        $this->set('_serialize', ['user']);
    }

    /**
     * Ajouté un compte
     **/
     public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre compte à bien était créé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre compte n\'a pas plus être créé.'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    /**
     * Mon profile
     */
    public function profile(){
        $this->loadModel('Tickets');

        $user = $this->Auth->user();
        $tickets_count = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();

        $this->paginate = [
            'limit' => 5,
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];

        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('tickets_count', $tickets_count);
        $this->set('user', $user);

    }

    /**
     * Édition de votre compte
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $extension = '';
            $name_image = '';
            $repertoire = WWW_ROOT . 'img/upload/avatars/';
            $all_extension = ['jpg','gif','png','jpeg','svg'];

            // Upload
            if(isset($this->request->data['avatar_file']) && !empty($this->request->data['avatar_file'])){
                $extension  = pathinfo($this->request->data['avatar_file']['name'], PATHINFO_EXTENSION);
                if(in_array(strtolower($extension), $all_extension)){
                    $name_image = $user['id']. '-' . $user['username'] . '.' . $extension;

                    if(
                        move_uploaded_file($this->request->data['avatar_file']['tmp_name'] , $repertoire . $name_image)
                    ){
                        // Intervention
                        $manager = new ImageManager();
                        // Répertoire de l'avatar
                        $manager->make($repertoire . $name_image)
                        // Rogner et redimensionner l'avatar
                        ->fit(170)
                        // Sauvegarde de l'avatar
                        ->save($repertoire . $name_image);

                        $this->Users->patchEntity($user, ['avatar' => $name_image]);

                        return $this->redirect(['action' => 'profile']);
                    }
                }
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre compte a bien été édité.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre compte n\'a pas pu être édité.'));
            }
        }
        
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Supression de votre compte
     **/
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Votre compte à bien était supprimé'));
        } else {
            $this->Flash->error(__('Votre compte n\'a pas pu être supprimé'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        $this->Flash->success(__('Vous êtes bien déconnecté'));

        return $this->redirect($this->Auth->logout());
    }
}