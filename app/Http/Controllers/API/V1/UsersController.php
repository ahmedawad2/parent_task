<?php


namespace App\Http\Controllers\API\V1;


use App\Http\Abstraction\Interfaces\UsersRepositoryInterface;
use App\Http\Abstraction\Interfaces\UserTransformInterface;
use App\Http\Abstraction\Interfaces\ValidatingUserInterface;
use Illuminate\Http\Request;

class UsersController
{
    public function index(Request $request, UsersRepositoryInterface $usersRepository,
                          UserTransformInterface $userTransform, ValidatingUserInterface $validatingUser)
    {
        $data = [];
        while ($user = $usersRepository->currentObject()) {
            $validatingUser
                ->setUser($user)
                ->applyStatus($request->get('statusCode'))
                ->applyCurrency($request->get('currency'))
                ->applyAmount($request->get('balanceMin'), $request->get('balanceMax'));

            if ($validatingUser->isValid()) {
                $data[] = $userTransform
                    ->setUser($user)
                    ->transform();
            }
            $usersRepository->next();
        }

        return $data ? response()->json($data, 200)
            : response()->json(null, 204);
    }
}
