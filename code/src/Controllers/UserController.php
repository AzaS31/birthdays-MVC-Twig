<?php
namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;
use Geekbrains\Application1\Models\UserStorage;

class UserController {

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        
        $render = new Render();

        if (!$users) {
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        } else {
            return $render->renderPage(
                'user-index.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    public function actionSave() {
        if (isset($_GET['name']) && isset($_GET['birthday'])) {
            $name = $_GET['name'];
            $birthday = $_GET['birthday'];

            $user = new User($name);
            $user->setBirthdayFromString($birthday);

            if (UserStorage::saveUser($user)) {
                $render = new Render();
                return $render->renderPage(
                    'page-user-saved.twig',
                    [
                        'name' => $user->getUserName(),
                        'birthday' => date("d-m-Y", $user->getUserBirthday()) 
                    ]
                );
            } else {
                return "Ошибка при сохранении пользователя";
            }
        } else {
            return "Не указаны параметры 'name' и 'birthday'";
        }
    }
}
