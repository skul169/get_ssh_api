<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Repositories\CloneRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Crypt;
use Auth;

class ApiController extends Controller
{
    /** @var CloneRepositoryInterface */
    protected $cloneRepository;

    public function __construct(CloneRepositoryInterface $cloneRepository)
    {
        $this->cloneRepository = $cloneRepository;
    }

    public function addClone()
    {
        $uid = Input::get('uid');
        $first = Input::get('first');
        $last = Input::get('last');
        $email = Input::get('email');
        $pass = Input::get('pass');
        $cookie = Input::get('cookie');
        $token = Input::get('token');
        $sex = Input::get('sex');
        $birthday = Input::get('birthday');

        $user = $this->cloneRepository->create([
            'uid' => $uid,
            'first' => $first,
            'last' => $last,
            'email' => $email,
            'pass' => $pass,
            'cookie' => $cookie,
            'token' => $token,
            'sex' => $sex,
            'birthday' => $birthday,
//            'created_at' => '2017-12-24 00:00:01',
//            'updated_at' => '2017-12-24 00:00:01',
        ]);

        return response()->json(['success' => true], 200);
    }
}
