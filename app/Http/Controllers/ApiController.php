<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Repositories\CloneRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Crypt;
use Auth;
use DB;

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
        ]);

        return response()->json(['success' => true], 200);
    }

    public function getClone() {
        $first = DB::table('clone')->orderBy('updated_at', 'asc')->take(1)->lockForUpdate()->get();
        if (!isset($first[0])) {
            return response()->json(['success' => false], 200);
        }

        \Log::error('ID ' . $first[0]->id);
        DB::update('update clone set updated_at = "'. date('Y-m-d H:i:s') .'" where id = ' . $first[0]->id);
        return response()->json(['success' => true, 'data' => $first[0]], 200);
    }
}
