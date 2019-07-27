<?php
namespace App\Http\Controllers;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{

    public function register(Request $request)
    {
        $this->apiResponse['success'] = FALSE;
        $this->apiResponse['service_name'] = "Register";

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if ($validator->fails()) {
//            $this->apiResponse['error'] = $validator->errors();
            if ($validator->fails()) {
                return $this->sendResponse('User input error(s)!', $validator->getMessageBag()->toArray(), 400);
            }
        }

        $input = $request->all();
        $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
        $user = User::create($input);
        $this->apiResponse['success'] = TRUE;
//        $user->sendApiEmailVerificationNotification($user);
        $token= $user->createToken('Yolo Technology Application - User Registrations')->accessToken;
        $result['profile'] = $user;
        $result['token'] = $token;
        //        $this->apiResponse['message'] = 'Please verify your email by clicking on verify email address button sent to you on your email';
        return $this->sendResponse("Registration successful.",$result,201);
//        return $this->sendResponse('Validation Errors', $validator->getMessageBag()->toArray(), 400);

    }



    public function login(Request $request)
    {
        $this->apiResponse['success'] = FALSE;
        $this->apiResponse['service_name'] = "Login";

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return $this->sendResponse('Validation Errors', $validator->getMessageBag()->toArray(), 400);
        }

        $data = $request->all();

        $user = User::where('email', $data['email'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                //enter your code
                $token = $user->createToken('Yolo Technology Application - Password Grant Client')->accessToken;
                $result['profile'] = $user;
                $result['token'] = $token;
                $this->apiResponse['success'] = TRUE;
                return $this->sendResponse("Login Successfull", $result, 200);
            }
            return $this->sendResponse("Incorrect password entered!", '', 404);
        }
        return $this->sendResponse("User with provided email address does not exists!", '', 404);
    }


    public function logout()
    {
        // Check the currently authenticated user...
    }

    //{
//"status": {
//"type": "success",
//"message": "Success",
//"code": 200,
//"error": false
//},
//"data": [
//        {
//            "status": "Authenticated",
//            "user": {
//            "username": "ashley.akua",
//                "email": "mobeendev@gmail.com",
//                "firstname": "Abdul",
//                "id": 88888888,
//                "lastname": "mobeen"
//            },
//            "return_to_url": null,
//            "expires_at": "2019/01/07 05:56:21 +0000",
//            "session_token": "9x8869x31134x7906x6x54474x21x18xxx90857x"
//        }
//    ]
//}


}
