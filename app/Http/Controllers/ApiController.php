<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Repositories\CloneRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Crypt;
use Auth;
use DB;
use \Cache;

class ApiController extends Controller
{
    public function getSsh()
    {
        $ssh_folder_path = env('SSH_PATH', '/var/www/get_ssh');

        $data = array();
        if (Cache::has('get_ssh')) {
            $data = Cache::get('get_ssh', array());
        }

        if (count($data) == 0) {
            $data = array();

            $files = scandir($ssh_folder_path);
            foreach ($files as $key => $value) {
                if ($value != '.' && $value != '..') {
                    $data[] = $value;
                }
            }

            shuffle($data);
            Cache::add('get_ssh', $data, 0);
        }

        $max_key = max(array_keys($data));
        $file_name = $data[$max_key];
        if (file_exists($ssh_folder_path . '/' . $file_name)) {
            unset($data[$max_key]);
            Cache::forget('get_ssh');
            Cache::add('get_ssh', $data, 0);
        } else {
            Cache::forget('get_ssh');
            $data = array();

            $files = scandir($ssh_folder_path);
            foreach ($files as $key => $value) {
                if ($value != '.' && $value != '..') {
                    $data[] = $value;
                }
            }

            shuffle($data);
            Cache::add('get_ssh', $data, 0);
            $max_key = max(array_keys($data));
            $file_name = $data[$max_key];
        }

        unset($data[$max_key]);
        Cache::forget('get_ssh');
        Cache::add('get_ssh', $data, 0);

        return response()->json(file_get_contents($ssh_folder_path . '/' . $file_name), 200);
    }

    public function getAvatar() {
        $continent = Input::get('continent', '');
        $gender = Input::get('gender', '');

        $ssh_folder_path = env('SSH_CONTINENT_PATH', '/var/www/continent');
        $ssh_folder_path = $ssh_folder_path . '/' . $continent . '/' . $gender;

        $data = array();
        if (Cache::has('get_continent_ssh_' . $continent . '_' . $gender)) {
            $data = Cache::get('get_continent_ssh_' . $continent . '_' . $gender, array());
        }

        if (count($data) == 0) {
            $data = array();

            $files = scandir($ssh_folder_path);
            foreach ($files as $key => $value) {
                if ($value != '.' && $value != '..') {
                    $data[] = $value;
                }
            }

            shuffle($data);
            Cache::add('get_continent_ssh_' . $continent . '_' . $gender, $data, 0);
        }

        $max_key = max(array_keys($data));
        $file_name = $data[$max_key];

        unset($data[$max_key]);
        Cache::forget('get_continent_ssh_' . $continent . '_' . $gender);
        Cache::add('get_continent_ssh_' . $continent . '_' . $gender, $data, 0);

        return response()->json(file_get_contents($ssh_folder_path . '/' . $file_name), 200);
    }
}
